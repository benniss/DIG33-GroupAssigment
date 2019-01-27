<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
  
  include_once '../../config/Database.php';
  include_once '../../models/Faq.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  
  // Instantiate FAQ object
  $faq = new Faq($db);
  
  // Get raw FAQ data
  $data = json_decode(file_get_contents("php://input"));
  
  // Set ID to update
  $faq->id = $data->id;
  
  // Delete category
  if($faq->delete_faq()) {
    echo json_encode(
      array('message' => 'Contact has been deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Contact has not been deleted')
    );
  }