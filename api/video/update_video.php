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
  $video = new Video($db);
  
  // Get raw video data
  $data = json_decode(file_get_contents("php://input"));
  
  // Set ID to update
  $video->id = $data->id;
  
  $video->title = $data->title;
  $video->description = $data->description;
  $video->youtube_url = $data->youtube_url;
  
  // Update video
  if($video->update_video()) {
    echo json_encode(
      array('message' => 'Video has been updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Video has not been updated')
    );
  }