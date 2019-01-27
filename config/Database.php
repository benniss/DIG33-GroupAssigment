<?php
/* This file contains the connection information for accessing the MySQL database */

  class Database {
    // Settings required to access the database
    private $host = 'localhost';
    private $db_name = 'c9';
    private $username = 'DIG33_Group';
    private $password = 'DIG33-2019';
    private $conn;
    
    // This is the actual connection to MySQL
    public function connect() {
      $this->conn = null;
      try { 
        $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        echo 'Connection Error: ' . $e->getMessage();
      }
      return $this->conn;
    }
  }