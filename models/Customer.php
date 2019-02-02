<?php
  class Customer {
    // Database connection and table information
    private $conn;
    private $table = 'customers';
	
    // Properties of the customer table
    public $id;
    public $first_name;
    public $last_name;
    public $address;
    public $city;
    public $state;
    public $pcode;
    public $phone;
    public $email;
	
    // Constructor for the Database
    public function __construct($db) {
      $this->conn = $db;
    }
	
    // Get the customers from the database
    public function get_customer() {
      // Create the query
      $query = 'SELECT
        id,
        first_name,
        last_name,
        address,
        city,
        state,
        pcode,
        phone,
        email
      FROM
        ' . $this->table . '
      ORDER BY
        id DESC';
		
      // Prepare the statement
      $stmt = $this->conn->prepare($query);
	  
      // Execute the query
      $stmt->execute();
	  
      return $stmt;
    }
	
    // Get a single customer
  public function get_single_customer(){
    // Create query
    $query = 'SELECT
                id,
                first_name,
                last_name,
                address,
                city,
                state,
                pcode,
                phone,
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
      $this->first_name = $row['first_name'];
      $this->last_name = $row['last_name'];
      $this->address = $row['address'];
      $this->city = $row['city'];
      $this->state = $row['state'];
      $this->pcode = $row['pcode'];
      $this->phone = $row['phone'];
      $this->email = $row['email'];
  }
  
  // Create a new customer
  public function create_customer() {
    // Create the Query
    $query = 'INSERT INTO ' .
      $this->table . '
    SET
      first_name = :first_name,
      last_name = :last_name,
      address = :address,
      city = :city,
      state = :state,
      pcode = :pcode,
      phone = :phone,
      email = :email';
	  
  // Prepare the Statement
  $stmt = $this->conn->prepare($query);
  
  // Cleanup the data
  $this->first_name = htmlspecialchars(strip_tags($this->first_name));
  $this->last_name = htmlspecialchars(strip_tags($this->last_name));
  $this->address = htmlspecialchars(strip_tags($this->address));
  $this->city = htmlspecialchars(strip_tags($this->city));
  $this->state = htmlspecialchars(strip_tags($this->state));
  $this->pcode = htmlspecialchars(strip_tags($this->pcode));
  $this->phone = htmlspecialchars(strip_tags($this->phone));
  
  // Bind data
  $stmt-> bindParam(':first_name', $this->first_name);
  $stmt-> bindParam(':last_name', $this->last_name);
  $stmt-> bindParam(':address', $this->address);
  $stmt-> bindParam(':city', $this->city);
  $stmt-> bindParam(':state', $this->state);
  $stmt-> bindParam(':pcode', $this->pcode);
  $stmt-> bindParam(':phone', $this->phone);
  $stmt-> bindParam(':email', $this->email);
  
  // Execute query
  if($stmt->execute()) {
    return true;
  }
  
  // Print error if customer fails to be created
  printf("Error: $s.\n", $stmt->error);
  
  return false;
  }
  
  // Update a Customer
  public function update_customer() {
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
  $this->first_name = htmlspecialchars(strip_tags($this->first_name));
  $this->last_name = htmlspecialchars(strip_tags($this->last_name));
  $this->address = htmlspecialchars(strip_tags($this->address));
  $this->city = htmlspecialchars(strip_tags($this->city));
  $this->state = htmlspecialchars(strip_tags($this->state));
  $this->pcode = htmlspecialchars(strip_tags($this->pcode));
  $this->phone = htmlspecialchars(strip_tags($this->phone));
  $this->email = $this->email;
  
  // Bind data
  $stmt-> bindParam(':first_name', $this->first_name);
  $stmt-> bindParam(':last_name', $this->last_name);
  $stmt-> bindParam(':address', $this->address);
  $stmt-> bindParam(':city', $this->city);
  $stmt-> bindParam(':state', $this->state);
  $stmt-> bindParam(':pcode', $this->pcode);
  $stmt-> bindParam(':phone', $this->phone);
  $stmt-> bindParam(':email', $this->email);
  
  // Execute query
  if($stmt->execute()) {
    return true;
  }
  
  // Print error if customer fails to be updated
  printf("Error: $s.\n", $stmt->error);
  
  return false;
  }
  
  // Delete a Customer
  public function delete_customer() {
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
	
    // Print error if customer is unable to be deleted
    printf("Error: $s.\n", $stmt->error);
	
    return false;
    }
  }