<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
  
  include_once '../../config/Database.php';
  include_once '../../models/Contact.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  
  // Instantiate contact object
  $contacts = new Contact($db);
  
  // Get raw contact data
  $data = json_decode(file_get_contents("php://input"));
  
  $contacts->title = $data->title;
  $contacts->description = $data->description;
  $contacts->youtube_url = $data->youtube_url;
  
  // Create contact
  if($contacts->create()) {
    echo json_encode(
      array('message' => 'Contact has been created')
    );
  } else {
    echo json_encode(
      array('message' => 'Contact has not been created')
    );
  }