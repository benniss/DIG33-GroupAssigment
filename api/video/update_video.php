<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
  
  include_once '../../config/Database.php';
  include_once '../../models/Video.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  
  // Instantiate video object
  $videos = new Video($db);
  
  // Get raw video data
  $data = json_decode(file_get_contents("php://input"));
  
  // Set ID to update
  $videos->id = $data->id;
  
  $videos->title = $data->title;
  $videos->description = $data->description;
  $videos->youtube_url = $data->youtube_url;
  
  // Update video
  if($videos->update()) {
    echo json_encode(
      array('message' => 'Video has been updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Video has not been updated')
    );
  }