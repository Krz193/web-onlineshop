<?php

class Database 
{
    private $host       = "localhost", 
            $username   = "root",
            $password   = "",
            $db_name    = "db_onlineshop";
    protected $conn, $date;

    public function __construct()
    {
        $this->date = new DateTime();
        $this->date->setTimezone(new DateTimeZone('Asia/Singapore'));
        return $this->conn = mysqli_connect(
            $this->host,
            $this->username,
            $this->password,
            $this->db_name
        );
    }

    public function runQuery($sql)
    {
        return mysqli_query($this->conn, $sql);
    }
    
    public function getInsertId()
    {
        $insert_id = mysqli_insert_id($this->conn);
        mysqli_close($this->conn);
        return $insert_id;
    }
}