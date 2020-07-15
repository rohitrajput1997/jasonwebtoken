<?php
include_once 'database.php';
require "../vendor/autoload.php";

use \Firebase\JWT\JWT;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$secret_key = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJUSEVfSVNTVUVSIiwiYXVkIjoiVEhFX0FVRElFTkNFIiwiaWF0IjoxNTk0ODI4MTI1LCJuYmYiOjE1OTQ4MjgxMzUsImV4cCI6MTU5NDgyODE4NSwiZGF0YSI6eyJpZCI6IjEiLCJmaXJzdG5hbWUiOiJyb2hpdCIsImxhc3RuYW1lIjoicmFqcHV0IiwiZW1haWwiOiJyb2hpdEBnbWFpbC5jb20ifX0.UzKYXjU-Gd_2y7POsH8kwvI8tu_zdi9EYvwup7xUwls";
$jwt = "JWT";
$databaseService = new DatabaseService();
$conn = $databaseService->getConnection();

$data = json_decode(file_get_contents("php://input"));


// $authHeader = $_SERVER['HTTP_AUTHORIZATION'];

// $arr = explode(" ", $authHeader);

// $jwt = $arr[1];

if ($jwt) {

    try {

        $decoded = JWT::decode($jwt, $secret_key, array('HS256'));

        // Access is granted. Add code of the operation here 

        echo json_encode(array(
            "message" => "Access granted:",
            "error" => $e->getMessage()
        ));
    } catch (Exception $e) {

        http_response_code(401);

        echo json_encode(array(
            "message" => "Access denied.",
            "error" => $e->getMessage()
        ));
    }
}
