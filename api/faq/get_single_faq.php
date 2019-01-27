<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  
  include_once '../../config/Database.php';
  include_once '../../models/Faq.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  
  // Instantiate FAQ object
  $faq = new Faq($db);
  
  // Get ID
  $faq->id = isset($_GET['id']) ? $_GET['id'] : die();
  
  // Get FAQ
  $faq->get_single_faq();
  
  //create array
  $faqs_arr = array(
	'id' => $faq->id,
	'question' => $faq->question,
	'answer' => $faq->answer
  );
  
  // convert to JSON database
  print_r(json_encode($faqs_arr));
  
  