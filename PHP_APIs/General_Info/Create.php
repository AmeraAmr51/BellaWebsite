<?php
// Required headers
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

//Includes Database & Objects files 
include_once "../Configuration/Database.php";
include_once "../Objects/General_info.php";

$Api_Token ="4de49ad472ecad92c5c20a7f3e890c25";

//Check the Url
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $database = New Database();
    $DB = $database -> GetConnection();
    $general_info = new General_Info ( $DB );

    // Get posted data
    $data = json_decode(file_get_contents("php://input"));


    if ( !empty( $data->InfoName ) && !empty( $data->InfoValue )){

       // Set property values
       $general_info->InfoName = $data->InfoName;
       $general_info->InfoValue = $data->InfoValue;
       $general_info->created = date('Y-m-d H:i:s');
    
       if($general_info->Create()) {
        
           http_response_code(201);
           echo json_encode(array("message" => "Successful created."));
        }

        // If unable to create the Info, tell the user
        else {
            http_response_code(503);
            echo json_encode(array("message" => " Failed created ."));
        }
    }

    // If the data is incomplete
    else {
        http_response_code(400);
        echo json_encode(array("message" => " Failed created , Data is incomplete."));
    }
}
// If Request is wrong
else {
    http_response_code (404);
    echo json_encode( array ( "message" => "Undefind Request." ));
}






?>