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
  $faqs = new Faq($db);
  
  // Get ID
  $faqs->id = isset($_GET['id']) ? $_GET['id'] : die();
  
  // Get FAQ
  $faqs->get_single();
  
  //create array
  $faqs_arr = array(
	'id' => $faqs->id,
	'question' => $faqs->question,
	'answer' => $faqs->answer
  );
  
  // convert to JSON database
  print_r(json_encode($contacts_arr));
  
  