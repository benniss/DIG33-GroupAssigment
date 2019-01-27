<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
  
  include_once '../../config/Database.php';
  include_once '../../models/Faq.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  
  // Instantiate FAQ object
  $faqs = new Faq($db);
  
  // Get raw FAQ data
  $data = json_decode(file_get_contents("php://input"));
  
  // Set ID to update
  $faqs->id = $data->id;
  
  $faqs->question = $data->question;
  $faqs->answer = $data->answer;
  
  // Update FAQ
  if($faqs->update()) {
    echo json_encode(
      array('message' => 'FAQ has been updated')
    );
  } else {
    echo json_encode(
      array('message' => 'FAQ has not been updated')
    );
  }