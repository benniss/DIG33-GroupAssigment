<?php
  class Product_type {
    // Database connection and table information
    private $conn;
    private $table = 'product_type';
	
    // Properties of the product_type table
    public $id;
    public $type;
    public $description;
	
    // Constructor for the Database
    public function __construct($db) {
      $this->conn = $db;
    }
	
    // Get the product types from the database
    public function get_product_type() {
      // Create the query
      $query = 'SELECT
        id,
        type,
        description
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
	
    // Get a single product type
  public function get_single_product_type(){
    // Create query
    $query = 'SELECT
                id,
                type,
                description
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
      $this->type = $row['type'];
      $this->description = $row['description'];
  }
  
  // Create a new product type
  public function create_product_type() {
    // Create the Query
    $query = 'INSERT INTO ' .
      $this->table . '
    SET
      type = :type,
      description = :description';
	  
  // Prepare the Statement
  $stmt = $this->conn->prepare($query);
  
  // Cleanup the data
  $this->type = htmlspecialchars(strip_tags($this->type));
  $this->description = htmlspecialchars(strip_tags($this->description));
  
  // Bind data
  $stmt-> bindParam(':type', $this->type);
  $stmt-> bindParam(':description', $this->description)
  
  // Execute query
  if($stmt->execute()) {
    return true;
  }
  
  // Print error if product type fails to be created
  printf("Error: $s.\n", $stmt->error);
  
  return false;
  }
  
  // Update a product type
  public function update_product_type() {
    // Create Query
    $query = 'UPDATE ' .
      $this->table . '
    SET
     type,
     description
    WHERE
      id = :id';
	  
  // Prepare Statement
  $stmt = $this->conn->prepare($query);
  
  // Clean data
  $this->id = htmlspecialchars(strip_tags($this->id));
  $this->type = htmlspecialchars(strip_tags($this->type));
  $this->description = htmlspecialchars(strip_tags($this->description));
  
  // Bind data
  $stmt-> bindParam(':id', $this->id);
  $stmt-> bindParam(':type', $this->type);
  $stmt-> bindParam(':description', $this->description);
  
  // Execute query
  if($stmt->execute()) {
    return true;
  }
  
  // Print error if procduct type fails to be updated
  printf("Error: $s.\n", $stmt->error);
  
  return false;
  }
  
  // Delete a product type
  public function delete_product_type() {
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
	
    // Print error if product type is unable to be deleted
    printf("Error: $s.\n", $stmt->error);
	
    return false;
    }
  }