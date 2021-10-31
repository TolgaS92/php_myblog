<?php
include_once("./config/Database.php");
include_once("./models/Category.php");
include_once("./models/Post.php");

header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, PATCH, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

$db = (new DBConnection($db_config))->getConnection();
$path = array();
preg_match_all('/\/([a-z]|[0-9]|[A-Z])+/', $_SERVER["REQUEST_URI"], $path);

if (sizeof($path) < 1) {
    $err = array(
      "error" => array(
        "status" => "404",
        "message" => "Bad URL"
      )
    );
  
    echo json_encode($err);
    exit();
  }

$method = $_SERVER["REQUEST_METHOD"];
$uri = $path[0];
$resource = $uri[0];

?>