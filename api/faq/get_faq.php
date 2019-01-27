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
  
  // FAQ query
  $result = $faqs->read();  
  // Get row count
  $num = $result->rowCount();
  
  // Check if any FAQs
  if($num > 0) {
    // Category array
   $faqs_arr = array();
    $faqs_arr['data'] = array();
	
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
	  
     $faqs_item = array(
        'id' => $id,
        'question' => $question,
        'answer' => $answer
      );
	  
      // Push to "data"
      array_push($faqs_arr, $faqs_item);
      array_push($faqs_arr['data'], $faqs_item);
    }
	
    // Turn to JSON & output
    echo json_encode($faqs_arr);
	
  } else {
    // No FAQs
    echo json_encode(
      array('message' => 'No FAQs have been found')
    );
  }