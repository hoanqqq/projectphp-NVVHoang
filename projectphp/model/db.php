<?php
class db{

    static private $conn = null;
    static public function connect()
    {
        $servername = "mysql";
        $username = "root";
        $password = "root";
        // Create connection
        $conn= db::$conn;
        if(!$conn){
            $conn = new mysqli($servername, $username, $password,"danhba");
        }
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }
}
?>