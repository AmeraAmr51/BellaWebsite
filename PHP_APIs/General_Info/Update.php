<?php
// Required headers
header ( "Access-Control-Allow-Origin: *" );
header ( "Content-Type: application/json; charset=UTF-8" );

//Includes Database & Objects files 
include_once "../Configuration/Database.php";
include_once "../Objects/General_info.php";

$Token ="4de49ad472ecad92c5c20a7f3e890c25";

//Check the Url
if ($_SERVER['REQUEST_METHOD'] == "POST"){

    $database = New Database();
    $DB = $database -> GetConnection();
    $general_info = new General_Info ( $DB );

    // Get posted data
    $data = json_decode(file_get_contents("php://input"));

    // Set property values
    $general_info->id = $data->id;
    $general_info->InfoName = $data->InfoName;
    $general_info->InfoValue = $data->InfoValue;

    if($general_info->update()) {
        
        http_response_code(200);
        echo json_encode(array("message" => "Successful Updated."));
    }

    // If unable to update the Info, tell the user
    else {
         http_response_code(503);
         echo json_encode(array("message" => " Failed Updated ."));
    }

}

// If Request is wrong
else {
    http_response_code (404);
    echo json_encode( array ( "message" => "Undefind Request." ));
}