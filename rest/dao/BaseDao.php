<?php

class BaseDao {

    protected $conn;

    /**
    * constructor of dao class
    */
    public function __construct(){
        try {

        /** TODO
        * List parameters such as servername, username, password, schema. Make sure to use appropriate port
        */
        $user = "root";
        $host = "localhost";
        $pass = "";
        $port = 3306;
        $schema = "midterm-final";


      

        /** TODO
        * Create new connection
        * Use $options array as last parameter to new PDO call after the password
        */
            $this->conn = new PDO("mysql:host=$host;port=$port;dbname=$schema", $user, $pass);
        // set the PDO error mode to exception

        /** TODO
        * Create new connection
        */

        // set the PDO error mode to exception
          $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          echo "Connected successfully";
        } catch(PDOException $e) {
          echo "Connection failed: " . $e->getMessage();
        }
    }

}
?>
