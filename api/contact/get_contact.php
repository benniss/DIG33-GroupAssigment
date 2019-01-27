<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  
  include_once '../../config/Database.php';
  include_once '../../models/Video.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  
  // Instantiate contact object
  $contact = new Contact($db);
  
  // Contacts query
  $result = $contact->get_contact();  
  // Get row count
  $num = $result->rowCount();
  
  // Check if any contacts
  if($num > 0) {
    // Contact array
   $contacts_arr = array();
    $contacts_arr['data'] = array();
	
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
	  
     $contacts_item = array(
        'id' => $id,
        'title' => $title,
        'description' => $description,
        'email' => $email
      );
	  
      // Push to "data"
      array_push($contacts_arr, $contacts_item);
      array_push($contacts_arr['data'], $contacts_item);
    }
	
    // Turn to JSON & output
    echo json_encode($contacts_arr);
	
  } else {
    // No Contacts
    echo json_encode(
      array('message' => 'No Contacts have been found')
    );
  }