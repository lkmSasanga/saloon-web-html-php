<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/clients.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Client($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->name = $data->name;
    $item->email = $data->email;
    $item->password = $data->password;
    $item->role = $data->role;
    $item->created = date('Y-m-d H:i:s');
    
    if($item->createClient()){
        http_response_code(200);
        echo json_encode('Employee created successfully.');
    } else{
        http_response_code(404);
        echo json_encode('Employee could not be created.');
    }
?>