<?php
class config
{


    private $database = [
        "type" => "mysql",
        "host" => "localhost",
        "port" => "3306",
        "user" => "root",
        "database" => "pasantia",
        "password" => ""
    ];



    function getDatabase()
    {
        return $this->database;
    }
}
