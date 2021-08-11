<?php 
require_once('dbConnection.php');

class user{
    private $id;
    private $email;
    private $username;
    private $password;
    private $method;
    private $tableName;
    private $error = [];
    private $connection = null;

    function insert($email,$username,$password,$method){

        $this->setLocalValues($email,$username,$password,$method);

        $this->error = $this->verifyAndGetErrors();
        if(count($this->error) == 0){
            $conn = $this->startConnection();
            // insert
            $insertQuery = "INSERT INTO myuser (email, username, pass)
            VALUES ('$this->email', '$this->username', '$this->password')";
            $conn->query($insertQuery);
        }
        return $this->error;

    }

    function update($id,$email,$username,$password,$method){
        $this->setLocalValues($email,$username,$password,$method);
        $this->id = $id;

        $this->error = $this->verifyAndGetErrors();
        if(count($this->error) == 0){
            $conn = $this->startConnection();
            $updateQuery = "UPDATE myuser SET email='$this->email', username='$this->username', pass='$this->password' WHERE id=$this->id";
            $conn->query($updateQuery);
        }
        return $this->error;
    }

    function delete($id){
        $this->id = $id;

        $conn = $this->startConnection();
        $deleteQuery = "DELETE FROM myuser WHERE id=$this->id";
        return $conn->query($deleteQuery);
    }

    function getSingleRow($tableName,$username,$password){
        $this->username = $username;
        $this->password = $password;
        $this->tableName = $tableName;

        $conn = $this->startConnection();
        $selectQuery = "SELECT * FROM $this->tableName WHERE username='$this->username' and pass='$this->password'";
        $result = $conn->query($selectQuery);
        return $result->fetch_assoc();
    }
    
    private function verifyAndGetErrors(){
        $this->verifyMethod($this->method);
        $this->verifyEmail($this->email);
        $this->verifyUsername($this->username);
        $this->verifyPassword($this->password);
        return $this->error;
    }

    private function verifyMethod($method){
        if ($method != "POST") $this->error['method'] = 'Insecure request method';
    }

    private function verifyEmail($email){
        if (empty($email)) {
            $this->error['email'] = "Email is required";
          } else {
            $email = $this->test_input($email);
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->error['email'] = "Invalid email format";
            }
          }
    }

    private function verifyUsername($username){
        if (empty($username)) {
            $this->error['username'] =  "Name is required";
          } else {
            $username = $this->test_input($username);
            if (!preg_match("/^[a-zA-Z-' ]*$/",$username)) {
                $this->error['username'] =  "Only letters and white space allowed";
            }
          }
    }


    private function verifyPassword($password){
        if (empty($password)) {
            $this->error['password'] =  "Password is required";
          } 
    }
    
    
    private function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    private function startConnection(){
       if($this->connection == null){
            $db = new dbConnection();
            $this->connection = $db->startConnection();
            return $this->connection;
        }
        return $this->connection;
    }

    private function setLocalValues($email,$username,$password,$method){
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->method = $method;   
        $this->error = [];
    }


    
}


?>