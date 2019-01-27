<?php
  class Faq {
    // Database connection and table information
    private $conn;
    private $table = 'faqs';
	
    // Properties of the FAQs table
    public $id;
    public $question;
    public $answer;
	
    // Constructor for the Database
    public function __construct($db) {
      $this->conn = $db;
    }
	
    // Get the FAQs from the database
    public function get_faq() {
      // Create the query
      $query = 'SELECT
        id,
        question,
        answer
      FROM
        ' . $this->table . '
      ORDER BY
        id ASC';
		
      // Prepare the statement
      $stmt = $this->conn->prepare($query);
	  
      // Execute the query
      $stmt->execute();
	  
      return $stmt;
    }
	
    // Get a single FAQ
  public function get_single_faq(){
    // Create query
    $query = 'SELECT
                id,
                question,
                answer
            FROM
                ' . $this->table . '
            WHERE id = ?
            LIMIT 0,1';
	  
      //Prepare the statement
      $stmt = $this->conn->prepare($query);
	  
      // Bind the ID
      $stmt->bindParam(1, $this->id);
	  
      // Execute the query
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
	  
      // Set the object properties
      $this->id = $row['id'];
      $this->question = $row['question'];
      $this->answer = $row['answer'];
  }
  
  // Create a new FAQ
  public function create_faq() {
    // Create the Query
    $query = 'INSERT INTO ' .
      $this->table . '
    SET
      question = :question,
      answer = :answer';
	  
  // Prepare the Statement
  $stmt = $this->conn->prepare($query);
  
  // Cleanup the data
  $this->question = htmlspecialchars(strip_tags($this->question));
  $this->answer = htmlspecialchars(strip_tags($this->answer));
  
  // Bind data
  $stmt-> bindParam(':question', $this->question);
  $stmt-> bindParam(':answer', $this->answer);
  
  // Execute query
  if($stmt->execute()) {
    return true;
  }
  
  // Print error if FAQ fails to be created
  printf("Error: $s.\n", $stmt->error);
  
  return false;
  }
  
  // Update a FAQ
  public function update_faq() {
    // Create Query
    $query = 'UPDATE ' .
      $this->table . '
    SET
     question,
     answer
    WHERE
      id = :id';
	  
  // Prepare Statement
  $stmt = $this->conn->prepare($query);
  
  // Clean data
  $this->id = htmlspecialchars(strip_tags($this->id));
  $this->question = htmlspecialchars(strip_tags($this->question));
  $this->answer = htmlspecialchars(strip_tags($this->answer));
  
  // Bind data
  $stmt-> bindParam(':id', $this->id);
  $stmt-> bindParam(':question', $this->question);
  $stmt-> bindParam(':answer', $this->answer);
  
  // Execute query
  if($stmt->execute()) {
    return true;
  }
  
  // Print error if FAQ fails to be updated
  printf("Error: $s.\n", $stmt->error);
  
  return false;
  }
  
  // Delete a FAQ
  public function delete_faq() {
    // Create query
    $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
	
    // Prepare Statement
    $stmt = $this->conn->prepare($query);
	
    // clean data
    $this->id = htmlspecialchars(strip_tags($this->id));
	
    // Bind Data
    $stmt-> bindParam(':id', $this->id);
	
    // Execute query
    if($stmt->execute()) {
      return true;
    }
	
    // Print error if FAQ is unable to be deleted
    printf("Error: $s.\n", $stmt->error);
	
    return false;
    }
  }