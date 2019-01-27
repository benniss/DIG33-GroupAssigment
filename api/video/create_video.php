<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
  
  include_once '../../config/Database.php';
  include_once '../../models/Video.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  
  // Instantiate category object
  $videos = new Video($db);
  
  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));
  
  $videos->title = $data->title;
  $videos->description = $data->description;
  $videos->youtube_url = $data->youtube_url;
  
  // Create category
  if($videos->create_video()) {
    echo json_encode(
      array('message' => 'Video has been created')
    );
  } else {
    echo json_encode(
      array('message' => 'Video has not been created')
    );
  }