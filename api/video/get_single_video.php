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
  $video = new Video($db);
  
  // Get ID
  $video->id = isset($_GET['id']) ? $_GET['id'] : die();
  
  // Get category
  $video->get_single_video();
  
  //create array
  $videos_arr = array(
	'id' => $video->id,
	'title' => $video->title,
	'description' => $video->description,
	'youtube_url' => $video->youtube_url
  );
  
  // convert to JSON database
  print_r(json_encode($videos_arr));
  
  