<?php

//Database class
class Database {

    //Database credentials
    private $host = "localhost";
    private $Db_name = "bella";
    private $username = "root";
    private $password = "";
    public  $connect;

    //Get the database connection
    public function GetConnection() {
        # code...
        $this ->connect = null;

        try
        {
            $this->connect =  new PDO("mysql:host=" . $this->host . ";dbname=" . $this->Db_name, $this->username, $this->password);
            
        }
        catch ( PDOException $Exception )
        {
            echo"Error" .$Exception ->getMessage();

        }
        return $this ->connect ;
    }
    
}



?>