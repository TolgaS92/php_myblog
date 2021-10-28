<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

// Instantiate DB $ Connect

$database = new Database();
$db = $database->connect();

// Instantiate blog post

$post = new Post($db);

// Blog post query
$result = $post->read();
//Get row count
$num = $result->rowCount();

//Check ifany post
if($num > 0) {
    // Post array
    $posts_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $post_item = array(
            'id' => $id,
            'title' => $title,
            'body' => html_entity_decode($body),
            'author' => $author,
            'category_id' => $category_id,
            'category_name' => $category_name
        );

        //Push to "data"
        array_push($posts_arr, $post_item);
    }

    // Turn to JSON& from php
    echo json_encode($posts_arr);
} else {
    echo json_encode(
        array('message' => 'No post found')
    );
}