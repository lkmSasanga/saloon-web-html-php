<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/appointments.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Appointment($db);

    $stmt = $items->getAppointments();
    $itemCount = $stmt->rowCount();


    // echo json_encode($itemCount);

    if($itemCount > 0){
        
        $appointmentArr = array();
        $appointmentArr["body"] = array();
        // $appointmentArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "name" => $name,
                "services" => $services,
                "day" => $day,
                "month" => $month,
                "time" => $time,
                "status" => $status,
                "created" => $created
            );

            array_push($appointmentArr["body"], $e);
        }
        echo json_encode($appointmentArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>