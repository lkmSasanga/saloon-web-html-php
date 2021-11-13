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

    $item->email = isset($_GET['email']) ? $_GET['email'] : die();
    $password = isset($_GET['password']) ? $_GET['password'] : die();
  
    $item->loginClient();

    if($item->name != null && $item->password == $password){
        // create array
        $cli_arr = array(
            "id" =>  $item->id,
            "name" => $item->name,
            "email" => $item->email,
            "password" => $item->password,
            "role" => $item->role,
            "created" => $item->created
        );
      
        http_response_code(200);
        echo json_encode($cli_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Wrong Password.");
    }
?>