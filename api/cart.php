<?php

/* This is the API for the shopping cart */

// link to the database connection file
require '..\connect.php';

get_cart();

post_cart();

update_cart();

delete_cart();

add_product();

delete_product();



?>