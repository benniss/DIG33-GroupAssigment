<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  
  include_once '../../config/Database.php';
  include_once '../../models/Customer.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  
  // Instantiate customer object
  $customer = new Customer($db);
  
  // Get ID
  $customer->id = isset($_GET['id']) ? $_GET['id'] : die();
  
  // Get customer
  $customer->get_single_customer();
  
  //create array
  $customers_arr = array(
	'id' => $customer->id,
	'first_name' => $customer->first_name,
	'last_name' => $customer->last_name,
	'address' => $customer->address,
	'city' => $customer->city,
	'state' => $customer->state,
	'pcode' => $customer->pcode,
	'phone' => $customer->phone,
	'email' => $customer->email
  );
  
  // convert to JSON database
  print_r(json_encode($customers_arr));
  
  