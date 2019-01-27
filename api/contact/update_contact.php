<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
  
  include_once '../../config/Database.php';
  include_once '../../models/Contact.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  
  // Instantiate video object
  $contact = new Contact($db);
  
  // Get raw video data
  $data = json_decode(file_get_contents("php://input"));
  
  // Set ID to update
  $contact->id = $data->id;
  
  $contact->title = $data->title;
  $contact->description = $data->description;
  $contact->email = $data->email;
  
  // Update video
  if($contact->update_contact()) {
    echo json_encode(
      array('message' => 'Contact has been updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Contact has not been updated')
    );
  }