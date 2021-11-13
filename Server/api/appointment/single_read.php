<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/appointments.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Appointment($db);

    $item->id = isset($_GET['id']) ? $_GET['id'] : die();
  
    $item->getSingleAppointment();

    if($item->name != null){
        // create array
        $app_arr = array(
            "id" =>  $item->id,
            "name" => $item->name,
            "services" => $item->services,
            "day" => $item->day,
            "month" => $item->month,
            "time" => $item->time,
            "status" => $item->status,
            "created" => $item->created
        );
      
        http_response_code(200);
        echo json_encode($app_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Employee not found.");
    }
?>