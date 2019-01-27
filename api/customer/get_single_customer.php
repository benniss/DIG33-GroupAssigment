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
  $customers = new Customer($db);
  
  // Get ID
  $customers->id = isset($_GET['id']) ? $_GET['id'] : die();
  
  // Get customer
  $customers->get_single();
  
  //create array
  $customers_arr = array(
	'id' => $customers->id,
	'first_name' => $customers->first_name,
	'last_name' => $customers->last_name,
	'address' => $customers->address,
	'city' => $customers->city,
	'state' => $customers->state,
	'pcode' => $customers->pcode,
	'phone' => $customers->phone,
	'email' => $customers->email
  );
  
  // convert to JSON database
  print_r(json_encode($customers_arr));
  
  