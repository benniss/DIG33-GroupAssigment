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
  $customers = new Customer($db);
  
  // Get raw customer data
  $data = json_decode(file_get_contents("php://input"));
  
  // Set ID to update
  $customers->id = $data->id;
  
  $customers->first_name = $data->first_name;
  $customers->last_name = $data->last_name;
  $customers->address = $data->address;
  $customers->city = $data->city;
  $customers->state = $data->state;
  $customers->pcode = $data->pcode;
  $customers->phone = $data->phone;
  $customers->email = $data->email;
  
  // Update customer
  if($customers->update()) {
    echo json_encode(
      array('message' => 'Customer has been updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Customer has not been updated')
    );
  }