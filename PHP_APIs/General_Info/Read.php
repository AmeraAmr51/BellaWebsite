<?php
// Required headers
header ( "Access-Control-Allow-Origin: *" );
header ( "Content-Type: application/json; charset=UTF-8" );

//Includes Database & Objects files 
include_once "../Configuration/Database.php";
include_once "../Objects/General_info.php";

$Api_Token ="4de49ad472ecad92c5c20a7f3e890c25";

//Check the Url
if ($_SERVER['REQUEST_METHOD'] == "POST"){

    $database = New Database();
    $DB = $database -> GetConnection();
    $general_info = new General_Info ( $DB );


    //Query General Info
    $result = $general_info -> Read();
    $num = $result -> rowCount();

    // Check if row more than 0 found
    if( $num > 0 ) {

        //General info array
        $general_info_array = array();

        // Rename the index
        $general_info_array['General_Info'] = array();

        while( $row = $result -> fetch(PDO::FETCH_ASSOC) ) {

            extract($row);
            $general_info_array_item = array(
                "Id" => $id ,
                "Info Name" => $InfoName ,
                "Info Value" => $InfoValue ,
                "Created" => $created
            );
            array_push ( $general_info_array['General_Info'] , $general_info_array_item );
                
        }
        // Set response code - 200 OK
        http_response_code( 200 );
        echo json_encode ( $general_info_array );
       
    }

    //If no information in table
    else {
        http_response_code ( 500 );
        echo json_encode ( array ( "message" => "No Information found." ));
    }
}

// If Request is wrong
else {
    http_response_code (404);
    echo json_encode( array ( "message" => "Undefind Request." ));
}




