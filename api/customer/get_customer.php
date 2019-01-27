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
  
  // Customer query
  $result = $customers->read();  
  // Get row count
  $num = $result->rowCount();
  
  // Check if there are any customers
  if($num > 0) {
    // Video array
    $customers_arr = array();
    $customers_arr['data'] = array();
	
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
	  
      $customers_item = array(
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
      array_push($customers_arr, $customers_item);
      array_push($customers_arr['data'], $customers_item);
    }
	
    // Turn to JSON & output
    echo json_encode($customers_arr);
	
  } else {
    // No customers
    echo json_encode(
      array('message' => 'No Customers have been found')
    );
  }