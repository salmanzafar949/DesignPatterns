<?php

class Database
{

    public static $instance;
    protected $server = "localhost";
    protected $uname  = "";
    protected $pass   = "";
    protected $db     = "";
    public    $conn   = "";

    private function __construct()
    {

    }

    public static function getInstance()
    {
        if(!isset(Database::$instance))
            Database::$instance = new Database();
        return Database::$instance;
    }

    public function connect()
    {
        $this->conn = new mysqli($this->server, $this->uname,$this->pass,$this->db);

        if($this->conn->connect_error)
        {
            die("Connection failed: ".$this->conn->connect_error);
        }
        else
        {
            return $this->conn;
        }
    }
}


$s = Database::getInstance();

$conn = $s->connect();

$q = "select * from sample_table";

$res = $conn->query($q);

if ($res->num_rows > 0) {
    // output data of each row
    while($row = $res->fetch_assoc()) {
        echo $row['serial']. '<br/>';
    }
}