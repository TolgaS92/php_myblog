<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

// Instantiate DB $ Connect

$database = new Database();
$db = $database->connect();

// Instantiate blog categories

$categories = new Category($db);

// Blog categories query
$result = $categories->read();
//Get row count
$num = $result->rowCount();

//Check ifany categories
if($num > 0) {
    // categories array
    $categoriess_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $categories_item = array(
            'id' => $id,
            'name' => $name,
        );

        //Push to "data"
        array_push($categoriess_arr, $categories_item);
    }

    // Turn to JSON& from php
    echo json_encode($categoriess_arr);
} else {
    echo json_encode(
        array('message' => 'No categories found')
    );
}