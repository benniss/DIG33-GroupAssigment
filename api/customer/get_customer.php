<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  
  include_once '../../config/Database.php';
  include_once '../../models/Customer.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  
  // Instantiate contact object
  $customer = new Customer($db);
  
  // Contacts query
  $result = $customer->get_customer();  
  // Get row count
  $num = $result->rowCount();
  
  // Check if there are any customers
  if($num > 0) {
    // Customer array
   $customers_arr = array();
    $customers_arr['data'] = array();
	
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
	  
      $customer_item = array(
        'id' => $id,
        'first_name' => $first_name,
        'last_name' => $last_name,
        'address' => $address,
        'city' => $city,
        'state' => $state,
        'pcode' => $pcode,
        'phone' => $phone,
        'email' => $email
      );
	  
      // Push to "data"
      array_push($customers_arr, $customer_item);
      array_push($customers_arr['data'], $customer_item);
    }
	
    // Turn to JSON & output
    echo json_encode($customers_arr);
	
  } else {
    // No Customers
    echo json_encode(
      array('message' => 'No Customers have been found')
    );
  }