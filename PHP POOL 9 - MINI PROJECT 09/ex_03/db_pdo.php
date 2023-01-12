<?php

// const ERROR_LOG_FILE = "/C:/xampp/htdocs/C-RDG-111-REM-1-1-phpday09-romain.casubolo/ex_03";
const ERROR_LOG_FILE = "error_log_file.log";

$host = "localhost";
$db = "coding";
$username = "root";
$password = "RSNA3475rsna42&";
$port = 3306;

function connect_db($host, $username, $password, $port, $db){

    $connection = new PDO("mysql:host=$host;dbname=$db;port=$port",$username,$password);
}

try {
    connect_db($host, $username, $password, $port, $db);
    echo "Connected\n";

} catch (PDOException $e) {
    echo("PDO ERROR: ".$e->getmessage()."storage in".ERROR_LOG_FILE."\n");
    file_put_contents(ERROR_LOG_FILE,$e->getmessage(),FILE_APPEND);
    // $log = "PDO ERROR: ".$toto->getMessage();
    // file_put_contents("toto.txt", $log, FILE_APPEND)
    // return false
}

// echo "connexion réussie";
// return $connection;
// }

// connect_db("127.0.0.1", "root", "root", "8889", "coding");