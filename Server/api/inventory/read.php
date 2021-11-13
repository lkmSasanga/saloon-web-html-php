<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/inventory.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Inventory($db);

    $stmt = $items->getInventory();
    $itemCount = $stmt->rowCount();


    // echo json_encode($itemCount);

    if($itemCount > 0){
        
        $inventArr = array();
        $inventArr["body"] = array();
        // $inventArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "name" => $name,
                "count" => $count,
                "created" => $created
            );

            array_push($inventArr["body"], $e);
            // array_push($inventArr["body"]);
        }
        echo json_encode($inventArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>