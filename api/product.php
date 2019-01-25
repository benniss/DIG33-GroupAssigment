<?php

/* This is the API for the companies products */

// link to the database connection file
require '..\connect.php';

get_product();

post_product();

update_product();

delete_product();

add_tocart();

?>