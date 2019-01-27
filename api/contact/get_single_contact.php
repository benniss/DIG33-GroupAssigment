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
  $contacts = new Contact($db);
  
  // Get ID
  $contacts->id = isset($_GET['id']) ? $_GET['id'] : die();
  
  // Get contact
  $contacts->get_single();
  
  //create array
  $contacts_arr = array(
	'id' => $contacts->id,
	'title' => $contacts->title,
	'description' => $contacts->description,
	'email' => $contacts->email
  );
  
  // convert to JSON database
  print_r(json_encode($contacts_arr));
  
  