<?php

class Database 
{
    private $host       = "localhost", 
            $username   = "root",
            $password   = "",
            $db_name    = "db_onlineshop";
    protected $conn;

    public function __construct()
    {
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
}