<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  
  include_once '../../config/Database.php';
  include_once '../../models/Product.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  
  // Instantiate blog post object
  $product = new Product($db);
  
  // Product query
  $result = $product->read();  
  // Get row count
  $num = $result->rowCount();
  
  // Check if any products
  if($num > 0) {
    // Post array
    $product_arr = array();
    $product_arr['data'] = array();
	
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
	  
     $product_item = array(
        'id' => $id,
        'name' => $name,
        'description' => html_entity_decode($description),
        'size' => $size,
        'cost' => $cost,
        'image_url' => $image_url,
        'type_id' => $type_id,
        'type_type' => $type_type
      );
	  
      // Push to "data"
      array_push($product_arr, $product_item);
      // array_push($posts_arr['data'], $post_item);
    }
	
    // Turn to JSON & output
    echo json_encode($product_arr);
	
  } else {
    // No Posts
    echo json_encode(
      array('message' => 'No Posts Found')
    );
  }