<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
  
  include_once '../../config/Database.php';
  include_once '../../models/Video.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  
  // Instantiate blog category object
  $videos = new Video($db);
  
  // Get raw categoryed data
  $data = json_decode(file_get_contents("php://input"));
  
  // Set ID to update
  $videos->id = $data->id;
  
  // Delete category
  if($videos->delete()) {
    echo json_encode(
      array('message' => 'Video has been deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Video has not been deleted')
    );
  }