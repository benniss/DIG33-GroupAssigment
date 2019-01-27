<?php
	class Post{
		// Database connection and table information
		private $conn;
		private $table = 'products';
	
		//Properties of the products table
		public $id;
		public $name;
		public $description;
		public $size;
		public $cost;
		public $image_url;
		public $type_id;
		public $type_type;
	
	
		// Constructor with DB
		public function __construct($db) {
			$this->conn = $db;
		}
	
		//Get products
		public function get_product(){
			//Create Query
			$query = 'SELECT 
				t.type as type_type,
				p.id,
				p.name,
				p.description,
				p.size,
				p.cost,
				p.image_url,
				p.type_id
			FROM
				' . $this->table. ' p
			LEFT JOIN
				product_type t ON p.type_id = t.id
			ORDER BY
				p.it ASC';
			
			//Prepare statement
			$stmt = $this->conn->prepare($query);
			
			//Execute query
			$stmt->execute();
			
			return $stmt;
	}
	
	// Get single posts
	public function get_single_product(){
	
	//Create Query
		$query = 'SELECT 
		t.type as type_type,
				p.id,
				p.name,
				p.description,
				p.size,
				p.cost,
				p.image_url,
				p.type_id
			FROM
				' . $this->table. ' p
			LEFT JOIN
				product_type t ON p.type_id = t.id
		WHERE
			p.id = ?
		LIMIT 0,1';
		
		//Prepare statement
			$stmt = $this->conn->prepare($query);
			
		// Bind ID
		$stmt->bindParam(1, $this->id);
		
		//Execute query
		$stmt->execute();
			
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		//Set properties
		$this->name = $row['name'];
		$this->description = $row['description'];
		$this->size = $row['size'];
		$this->cost = $row['cost'];
		$this->image_url = $row['image_url'];
		$this->type_id = $row['type_id'];
		$this->type_type = $row['type_type'];
	}	
		
	// create product	
	public function create_product(){
		
		//Create query
		$query = 'INSERT INTO ' . 
				$this->table . '
			SET
				name = :name,
				description = :description,
				size = :size,
				cost = :cost,
				image_url = :image_url,
				type_id = :type_id';
				
		// Prepare  statement
		$stmt = $this->conn->prepare($query);
		
		//clean data
		$this->name = htmlspecialchars(strip_tags($this->name));
		$this->description = htmlspecialchars(strip_tags($this->description));
		$this->size = htmlspecialchars(strip_tags($this->size));
		$this->cost = htmlspecialchars(strip_tags($this->cost));
		$this->image_url = $this->image_url;
		$this->type_id = htmlspecialchars(strip_tags($this->type_id));
		
		//Bind the named parameters
		$stmt->bindParam(':name', $this->name);
		$stmt->bindParam(':description', $this->description);
		$stmt->bindParam(':size', $this->size);
		$stmt->bindParam(':cost', $this->cost);
		$stmt->bindParam(':image_url', $this->image_url);
		$stmt->bindParam(':type_id', $this->type_id);
		
		// Execute the query
		if($stmt->execute()){	
			return true;
		}
		
		//Print error if something goes wrong
		printf("Error: %s.\n", $stmt->error);
		
		return false;
	}
	
	
	// Update products
    public function update_product() {
          // Create query
          $query = 'UPDATE ' . $this->table . '
                    SET 
                        name = :name, 
                        description = :description, 
                        size = :size, 
                        cost = :cost, 
                        image_url = :image_url, 
                        type_id = :type_id
                    WHERE 
                        id = :id';
								
          // Prepare statement
          $stmt = $this->conn->prepare($query);
		  
          // Clean data
          $this->name = htmlspecialchars(strip_tags($this->name));
		$this->description = htmlspecialchars(strip_tags($this->description));
		$this->size = htmlspecialchars(strip_tags($this->size));
		$this->cost = htmlspecialchars(strip_tags($this->cost));
		$this->image_url = $this->image_url;
		$this->type_id = htmlspecialchars(strip_tags($this->type_id));
		  
          // Bind data
          $stmt->bindParam(':name', $this->name);
	    $stmt->bindParam(':description', $this->description);
		$stmt->bindParam(':size', $this->size);
		$stmt->bindParam(':cost', $this->cost);
		$stmt->bindParam(':image_url', $this->image_url);
		$stmt->bindParam(':type_id', $this->type_id);
		  
          // Execute query
          if($stmt->execute()) {
            return true;
          }
		  
          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);
		  
          return false;
    }
	
	// delete product
	public function delete_product(){
		
		//create query
		$query = 'DELETE FROM ' . $this->table . ' WHERE id= :id';
		
		// Prepare statement
        $stmt = $this->conn->prepare($query);
		  
		// Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));
		  
        // Bind data
        $stmt->bindParam(':id', $this->id);
		
		// Execute query
          if($stmt->execute()) {
            return true;
          }
		  
          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);
		  
          return false;
	}	
}
	