<?php 
require_once 'database.php';

class User extends Database {
    public function __construct() 
    {
        parent::__construct();
    }

    public function testConn ()
    {
        echo ($this->conn) ? "koneksi berhasil" : die("koneksi gagal ");
    }

    public function regist(array $data) 
    {
        $username   = $data['username'];
        $pass       = $data['pass'];
        $email      = $data['email'];
        $full_name  = $data['fullname'];
        $no_telp    = $data['no_telp'];
        $address    = $data['address'];
        $role       = $data['role'];

        $sql        = "INSERT INTO tb_user(username, roles, `password`, email, full_name, no_telp, `address`) 
                    VALUES ('$username', '$role', '$pass', '$email', '$full_name', '$no_telp', '$address')";

        return $this->runQuery($sql);
    }

    public function login(array $data)
    {
        $username   = $data['username'];
        $pass       = $data['pass'];
        $sql        = "SELECT * FROM tb_user WHERE username = '$username' AND password = '$pass' LIMIT 1";
        $data       = mysqli_fetch_assoc($this->runQuery($sql));

        if (!$this->runQuery($sql)->num_rows) return false;

        session_start();
        $_SESSION['user_id'] = $data['user_id'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['role'] = $data['roles'];

        return $data;
    }

    public function logout()
    {
        session_destroy();
        header("Location: index.php");
    }

    public function getAllUser()
    {
        return mysqli_fetch_all($this->runQuery("SELECT * FROM tb_user"), MYSQLI_ASSOC);
    }

    public function getUser($id)
    {
        return mysqli_fetch_assoc($this->runQuery("SELECT * FROM tb_user WHERE user_id = $id"));
    }

    public function updateUser(array $data)
    {
        $id         = $data["user_id"];
        $username   = $data['username'];
        $pass       = $data['pass'];
        $email      = $data['email'];
        $full_name  = $data['fullname'];
        $no_telp    = $data['no_telp'];
        $address    = $data['address'];
        $role       = $data['role'];

        return $this->runQuery("UPDATE tb_user SET 
                username    ='$username', 
                roles       ='$role',
                `password`  ='$pass',
                email       ='$email',
                full_name   ='$full_name',
                no_telp     ='$no_telp',
                `address`   ='$address'
                WHERE user_id = '$id';
                ");
    }

    public function deleteUser($id) 
    {
        return $this->runQuery("DELETE FROM tb_user WHERE user_id = $id");
    }
}

$User =  new User();