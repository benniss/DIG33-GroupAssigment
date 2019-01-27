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
  
  // Get ID
  $product_type->id = isset($_GET['id']) ? $_GET['id'] : die();
  
  // Get product type
  $product_type->get_single();
  
  //create array
  $product_type_arr = array(
	'id' => $product_type->id,
	'type' => $product_type->type,
	'description' => $product_type->description
  );
  
  // convert to JSON database
  print_r(json_encode($product_type_arr));
  
  