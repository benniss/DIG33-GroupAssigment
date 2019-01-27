<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  
  include_once '../../config/Database.php';
  include_once '../../models/Product.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  
  // Instantiate product object
  $product = new Product($db);
  
  // Get ID
  $product->id = isset($_GET['id']) ? $_GET['id'] : die();
  
  // Get Product
  $product->read_single();
  
  //create array
  $product_arr = array(
	'id' => $product->id,
	'name' => $product->name,
	'description' => $product->description,
	'size' => $product->size,
	'cost' => $product->cost,
	'image_url' => $product->image_url,
	'type_id' => $product->type_id,
	'type_type' => $product->type_type
  );
  
  // convert to JSON database
  print_r(json_encode($product_arr));
  
  