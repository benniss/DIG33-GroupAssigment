<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  
  include_once '../../config/Database.php';
  include_once '../../models/Product_type.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  
  // Instantiate product type object
  $product_type = new Product_type($db);
  
  // Product type query
  $result = $product_type->get_product_type();  
  // Get row count
  $num = $result->rowCount();
  
  // Check if any product types
  if($num > 0) {
    // Video array
    $product_type_arr = array();
    $product_type_arr['data'] = array();
	
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
	  
      $product_type_item = array(
        'id' => $id,
        'type' => type,
        'description' => $description
      );
	  
      // Push to "data"
      array_push($product_type_arr, $product_type_item);
      array_push($product_type_arr['data'], $product_type_item);
    }
	
    // Turn to JSON & output
    echo json_encode($product_type_arr);
	
  } else {
    // No Product types
    echo json_encode(
      array('message' => 'No Product type have been found')
    );
  }