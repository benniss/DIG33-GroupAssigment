<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
  
  include_once '../../config/Database.php';
  include_once '../../models/Product_type.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  
  // Instantiate product type object
  $product_type = new Product_type($db);
  
  // Get raw categoryed data
  $data = json_decode(file_get_contents("php://input"));
  
  // Set ID to update
  $product_type->id = $data->id;
  
  // Delete category
  if($product_type->delete()) {
    echo json_encode(
      array('message' => 'Product type has been deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Product type has not been deleted')
    );
  }