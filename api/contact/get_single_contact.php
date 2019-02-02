<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  
  include_once '../../config/Database.php';
  include_once '../../models/Contact.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  
  // Instantiate contact object
  $contact = new Contact($db);
  
  // Get ID
  $contact->id = isset($_GET['id']) ? $_GET['id'] : die();
  
  // Get contact
  $contact->get_single_contact();
  
  //create array
  $contacts_arr = array(
	'id' => $contact->id,
	'title' => $contact->title,
	'description' => $contact->description,
	'email' => $contact->email
  );
  
  // convert to JSON database
  print_r(json_encode($contacts_arr));
  
  