<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
  
  include_once '../../config/Database.php';
  include_once '../../models/Faq.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  
  // Instantiate FAQ object
  $faq = new Faq($db);
  
  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));
  
  $faq->question = $data->question;
  $faq->answer = $data->answer;
  
  // Create FAQ
  if($faq->create_faq()) {
    echo json_encode(
      array('message' => 'FAQ has been created')
    );
  } else {
    echo json_encode(
      array('message' => 'FAQ has not been created')
    );
  }