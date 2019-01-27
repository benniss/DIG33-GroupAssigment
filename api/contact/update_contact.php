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
  $contacts = new Contact($db);
  
  // Get raw video data
  $data = json_decode(file_get_contents("php://input"));
  
  // Set ID to update
  $contacts->id = $data->id;
  
  $contacts->title = $data->title;
  $contacts->description = $data->description;
  $contacts->email = $data->email;
  
  // Update video
  if($contacts->update()) {
    echo json_encode(
      array('message' => 'Contact has been updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Contact has not been updated')
    );
  }