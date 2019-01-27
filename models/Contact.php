<?php
  class Contact {
    // Database connection and table information
    private $conn;
    private $table = 'contacts';
	
    // Properties of the contacts table
    public $id;
    public $title;
    public $description;
    public $email;
	
    // Constructor for the Database
    public function __construct($db) {
      $this->conn = $db;
    }
	
    // Get the contacts from the database
    public function get_contact() {
      // Create the query
      $query = 'SELECT
        id,
        title,
        description,
        email
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
	
    // Get a single contact
  public function get_single_contact(){
    // Create query
    $query = 'SELECT
                id,
                title,
                description,
                email
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
      $this->title = $row['title'];
      $this->description = $row['description'];
      $this->youtube_url = $row['email'];
  }
  
  // Create a new contact
  public function create_contact() {
    // Create the Query
    $query = 'INSERT INTO ' .
      $this->table . '
    SET
      title = :title,
      description = :description,
      email = :email';
	  
  // Prepare the Statement
  $stmt = $this->conn->prepare($query);
  
  // Cleanup the data
  $this->title = htmlspecialchars(strip_tags($this->title));
  $this->description = htmlspecialchars(strip_tags($this->description));
  
  // Bind data
  $stmt-> bindParam(':title', $this->title);
  $stmt-> bindParam(':description', $this->description);
  $stmt-> bindParam(':email', $this->email);
  
  // Execute query
  if($stmt->execute()) {
    return true;
  }
  
  // Print error if contact fails to be created
  printf("Error: $s.\n", $stmt->error);
  
  return false;
  }
  
  // Update a Contact
  public function update_contact() {
    // Create Query
    $query = 'UPDATE ' .
      $this->table . '
    SET
     title,
     description,
     email
    WHERE
      id = :id';
	  
  // Prepare Statement
  $stmt = $this->conn->prepare($query);
  
  // Clean data
  $this->id = htmlspecialchars(strip_tags($this->id));
  $this->title = htmlspecialchars(strip_tags($this->title));
  $this->description = htmlspecialchars(strip_tags($this->description));
  $this->email = $this->email;
  
  // Bind data
  $stmt-> bindParam(':id', $this->id);
  $stmt-> bindParam(':title', $this->title);
  $stmt-> bindParam(':description', $this->description);
  $stmt-> bindParam(':email', $this->email);
  
  // Execute query
  if($stmt->execute()) {
    return true;
  }
  
  // Print error if contact fails to be updated
  printf("Error: $s.\n", $stmt->error);
  
  return false;
  }
  
  // Delete a Contact
  public function delete_contact() {
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
	
    // Print error if contact is unable to be deleted
    printf("Error: $s.\n", $stmt->error);
	
    return false;
    }
  }