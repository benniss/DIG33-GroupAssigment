<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  
  include_once '../../config/Database.php';
  include_once '../../models/Video.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  
  // Instantiate video object
  $videos = new Video($db);
  
  // Video query
  $result = $videos->read();  
  // Get row count
  $num = $result->rowCount();
  
  // Check if any videos
  if($num > 0) {
    // Video array
    $videos_arr = array();
    $videos_arr['data'] = array();
	
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
	  
      $videos_item = array(
        'id' => $id,
        'title' => $title,
        'description' => $description,
        'youtube_url' => $youtube_url
      );
	  
      // Push to "data"
      array_push($videos_arr, $videos_item);
      array_push($videos_arr['data'], $video_item);
    }
	
    // Turn to JSON & output
    echo json_encode($videos_arr);
	
  } else {
    // No videos
    echo json_encode(
      array('message' => 'No Videos have been found')
    );
  }