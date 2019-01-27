<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  
  include_once '../../config/Database.php';
  include_once '../../models/Video.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  
  // Instantiate blog category object
  $videos = new Video($db);
  
  // Get ID
  $videos->id = isset($_GET['id']) ? $_GET['id'] : die();
  
  // Get category
  $videos->get_single();
  
  //create array
  $videos_arr = array(
	'id' => $videos->id,
	'title' => $videos->title,
	'description' => $videos->description,
	'youtube_url' => $videos->youtube_url
  );
  
  // convert to JSON database
  print_r(json_encode($videos_arr));
  
  