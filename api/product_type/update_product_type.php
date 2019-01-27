<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
  
  include_once '../../config/Database.php';
  include_once '../../models/Product_type.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  
  // Instantiate product type object
  $product_type = new Product_type($db);
  
  // Get raw product type data
  $data = json_decode(file_get_contents("php://input"));
  
  // Set ID to update
  $product_type->id = $data->id;
  
  $product_type->type = $data->type;
  $product_type->description = $data->description;
  
  // Update product type
  if($product_type->update_product_type()) {
    echo json_encode(
      array('message' => 'Product type has been updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Product type has not been updated')
    );
  }