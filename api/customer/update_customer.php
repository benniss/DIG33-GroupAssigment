<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
  
  include_once '../../config/Database.php';
  include_once '../../models/Customer.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  
  // Instantiate customer object
  $customer = new Customer($db);
  
  // Get raw customer data
  $data = json_decode(file_get_contents("php://input"));
  
  // Set ID to update
  $customer->id = $data->id;
  
  $customer->first_name = $data->first_name;
  $customer->last_name = $data->last_name;
  $customer->address = $data->address;
  $customer->city = $data->city;
  $customer->state = $data->state;
  $customer->pcode = $data->pcode;
  $customer->phone = $data->phone;
  $customer->email = $data->email;
  
  // Update customer
  if($customer->update_customer()) {
    echo json_encode(
      array('message' => 'Customer has been updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Customer has not been updated')
    );
  }