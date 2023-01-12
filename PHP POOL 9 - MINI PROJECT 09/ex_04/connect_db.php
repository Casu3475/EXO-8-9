<?php
// phpinfo();
// exit;
define("ERROR_LOG_FILE", "errors.log");

$host = "localhost";
$db = "coding";
$username = "root";
$password = "RSNA3475rsna42&";
$port = '3306';

function connect_db($host, $username, $password, $port, $db){

    $connection = new PDO("mysql:host=$host;dbname=$db;port=$port",$username,$password);
}

try {
    connect_db($host, $username, $password, $port, $db);
    echo "Connection to DB successful\n";

} catch (PDOException $e) {
    echo("Error connection to DB".$e->getmessage()."storage in".ERROR_LOG_FILE."\n");
    file_put_contents(ERROR_LOG_FILE,$e->getMessage(),FILE_APPEND);
}

function nbParam($argv){
    $param=count($argv);
    // var_dump($argv);

    if ($param!=6) {
        $message="Bad params! Usage: php connect_db.php host username password port db\n";
        echo $message;
        file_put_contents(ERROR_LOG_FILE,$message ."\n",FILE_APPEND);
        // file_put_contents(ERROR_LOG_FILE,getMessage(),FILE_APPEND);
        // $log = "PDO ERROR: ".$e->getMessage();

    } else {
    array_shift($argv);
    // print_r($argv);
    $host=$argv[0];
    $username=$argv[1];
    $password=$argv[2];
    $port=$argv[3];
    $db=$argv[4];
    connect_db($host, $username, $password, $port, $db);
    }
}

// nbParam($argv);
