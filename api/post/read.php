<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Databse.php';
include_once '../../models/post.php';

// instantiate db & connect
$database = new Database();
$db = $database->connect();

// instantiate blog post object
$post = new Post($db);
// blog post query 
$result = $post->read();
