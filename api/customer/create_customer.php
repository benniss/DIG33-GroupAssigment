<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
  
  include_once '../../config/Database.php';
  include_once '../../models/Customer.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  
  // Instantiate category object
  $customer = new Customer($db);
  
  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));
  
  $customer->first_name = $data->first_name;
  $customer->last_name = $data->last_name;
  $customer->address = $data->address;
  $customer->city = $data->city;
  $customer->state = $data->state;
  $customer->pcode = $data->pcode;
  $customer->phone = $data->phone;
  $customer->email = $data->email;
  
  // Create Customer
  if($customer->create_customer()) {
    echo json_encode(
      array('message' => 'Customer has been created')
    );
  } else {
    echo json_encode(
      array('message' => 'Customer has not been created')
    );
  }