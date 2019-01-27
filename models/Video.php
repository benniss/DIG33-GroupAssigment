<?php
  class Video{
    // Database connection and table information
    private $conn;
    private $table = 'videos';
	
    // Properties of the video table
    public $id;
    public $title;
    public $description;
    public $youtube_url;
	
    // Constructor for the Database
		public function __construct($db) {
			$this->conn = $db;
		}
	
    // Get the videos from the database
    public function get_video() {
      // Create the query
      $query = 'SELECT
        id,
        title,
        description,
        youtube_url
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
	
	    // Get a single video
  public function get_single_video(){
    // Create query
    $query = 'SELECT
                id,
                title,
                description,
                youtube_url
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
      $this->youtube_url = $row['youtube_url'];
  }
  
  // Create a new video
  public function create_video() {
    // Create the Query
    $query = 'INSERT INTO ' .
      $this->table . '
    SET
      title = :title,
      description = :description,
      youtube_url = :youtube_url';
	  
  // Prepare the Statement
  $stmt = $this->conn->prepare($query);
  
  // Cleanup the data
  $this->title = htmlspecialchars(strip_tags($this->title));
  $this->description = htmlspecialchars(strip_tags($this->description));
  
  // Bind data
  $stmt-> bindParam(':title', $this->title);
  $stmt-> bindParam(':description', $this->description);
  $stmt-> bindParam(':youtube_url', $this->youtube_url);
  
  // Execute query
  if($stmt->execute()) {
    return true;
  }
  
  // Print error if video fails to be created
  printf("Error: $s.\n", $stmt->error);
  
  return false;
  }
  
  // Update a Video
  public function update_video() {
    // Create Query
    $query = 'UPDATE ' .
      $this->table . '
    SET
     title,
     description,
     youtube_url
      WHERE
      id = :id';
	  
  // Prepare Statement
  $stmt = $this->conn->prepare($query);
  
  // Clean data
  $this->id = htmlspecialchars(strip_tags($this->id));
  $this->title = htmlspecialchars(strip_tags($this->title));
  $this->description = htmlspecialchars(strip_tags($this->description));
  $this->youtube_url = $this->youtube_url;
  
  // Bind data
  $stmt-> bindParam(':id', $this->id);
  $stmt-> bindParam(':title', $this->title);
  $stmt-> bindParam(':description', $this->description);
  $stmt-> bindParam(':youtube_url', $this->youtube_url);
  
  // Execute query
  if($stmt->execute()) {
    return true;
  }
  
  // Print error if video fails to be updated
  printf("Error: $s.\n", $stmt->error);
  
  return false;
  }
  
  // Delete a Video
  public function delete_video() {
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
	
    // Print error if video is unable to be deleted
    printf("Error: $s.\n", $stmt->error);
	
    return false;
    }

  }