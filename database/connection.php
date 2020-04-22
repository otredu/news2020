<?php

require_once "libraries/helpers.php";

function connectDB(){
    static $connection;
 
    if(!isset($connection)) {
        $connection = connect();
    } 
 
    return $connection;
}

function connect(){
    try {
            $host = getenv('DB_HOST');
            $port = getenv('DB_PORT'); 
            $dbname = getenv('DB_NAME'); 
            $user = getenv('DB_USERNAME'); 
            $password = getenv('DB_PASSWORD'); 
            if (getenv('DB_DBTYPE') === "MySql"){
                $connectionString = "mysql:host=$host;dbname=$dbname;port=$port;charset=utf8";
            } else {
                $connectionString = "pgsql:host=$host;dbname=$dbname;port=$port";
            }
        error_log("Connecting to ".$connectionString );
        $pdo = new PDO($connectionString, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e){
        echo "Virhe tietokantayhteydessä: " . $e->getMessage();
        die();
    }
}