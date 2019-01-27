<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
  
  include_once '../../config/Database.php';
  include_once '../../models/Product.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  
  // Instantiate product object
  $product = new Product($db);
  
  // Get raw product data
  $data = json_decode(file_get_contents("php://input"));
  
  // Set ID to update
  $product->id = $data->id;
  
  $product->name = $data->name;
  $product->description = $data->description;
  $product->size = $data->size;
  $product->cost = $data->cost;
  $product->image_url = $data->image_url;
  $product->type_id = $data->type_id;
  
  // Update product
  if($product->update()) {
    echo json_encode(
      array('message' => 'Post Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Post Not Updated')
    );
  }