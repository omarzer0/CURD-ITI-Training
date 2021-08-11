<?php

class dbConnection{

    private $localhost="localhost";
    private $username="root";
    private $password="root";
    private $dbName="mydb";
    private $connection = null;

    function startConnection(){
        $connection = new mysqli( $this->localhost,$this->username,
        $this->password,$this->dbName) or die("Couldn't connect");
        return $connection;
    }
}

?>