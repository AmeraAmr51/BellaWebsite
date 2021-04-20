<?php

class General_Info {

    //Database & Table name var
    private $connect;
    private $table_name = "general_info";


    //Object properties
    public $id;
    public $InfoName;
    public $InfoValue;
    public $created;
    

    // Constructor function 
    public function __construct($DB) {

        $this ->connect = $DB;     
    }

    
    function Read() {
    
    // Query to Read record
    $query = "SELECT * FROM ".$this ->table_name ;

    // Prepare query statement
    $stmt = $this ->connect ->prepare ( $query );
 
    // Execute query
    $stmt ->execute();
    
    return $stmt;
    
    }

    // Create General_Info
    function Create () {

        // Query to insert record
        $query = "INSERT INTO " . $this->table_name . " SET InfoName=:InfoName, InfoValue=:InfoValue, created=:created";

        // Prepare query
        $stmt = $this->connect->prepare($query);
    
        // The Validation 
        $this->InfoName = htmlspecialchars( strip_tags( $this->InfoName ));
        $this->InfoValue = htmlspecialchars( strip_tags( $this->InfoValue ));
        $this->created = htmlspecialchars( strip_tags( $this->created ));
    
        // Bind values
        $stmt->bindParam( ":InfoName", $this->InfoName);
        $stmt->bindParam( ":InfoValue", $this->InfoValue);
        $stmt->bindParam( ":created", $this->created);
 
        // Execute query
        if( $stmt->execute() ) {
            return true;
        }
 
        return false;
    
    }

    function update() {

        // Query to update record
        $query = "UPDATE " . $this->table_name . " SET InfoName= :InfoName, InfoValue= :InfoValue WHERE id = :id";

         // Prepare query
         $stmt = $this->connect->prepare($query);
    
         // The Validation 
         $this->id=  htmlspecialchars(strip_tags($this->id));
         $this->InfoName = htmlspecialchars( strip_tags( $this->InfoName ));
         $this->InfoValue = htmlspecialchars( strip_tags( $this->InfoValue ));
     
         // Bind values
         $stmt->bindParam(':id', $this->id);
         $stmt->bindParam( ":InfoName", $this->InfoName);
         $stmt->bindParam( ":InfoValue", $this->InfoValue);
  
         // Execute query
         if( $stmt->execute() ) {
             return true;
         }
  
         return false;

    }
    
    function Delete() {

        // Query to delete record
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";

         // Prepare query
         $stmt = $this->connect->prepare($query);

          // The validation 
          $this->id=  htmlspecialchars(strip_tags($this->id));

        // Bind values
        $stmt->bindParam(':id', $this->id);

         // Execute query
         if( $stmt->execute() ) {
            return true;
        }
 
        return false;

    }

}



?>