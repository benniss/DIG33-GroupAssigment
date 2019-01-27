<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
  
  include_once '../../config/Database.php';
  include_once '../../models/Customer.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  
  // Instantiate customer object
  $customers = new Customer($db);
  
  // Get raw customer data
  $data = json_decode(file_get_contents("php://input"));
  
  // Set ID to update
  $customers->id = $data->id;
  
  // Delete customer
  if($customers->delete()) {
    echo json_encode(
      array('message' => 'Customer has been deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Customer has not been deleted')
    );
  }