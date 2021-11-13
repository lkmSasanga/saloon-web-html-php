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

    $data = json_decode(file_get_contents("php://input"));

    $item->name = $data->name;
    $item->services = $data->services;
    $item->day = $data->day;
    $item->month = $data->month;
    $item->time = $data->time;
    $item->status = $data->status;
    $item->created = date('Y-m-d H:i:s');
    
    if($item->createAppointment()){
        echo 'Employee created successfully.';
    } else{
        echo 'Employee could not be created.';
    }
?>