<?php

define("ERROR_LOG_FILE", "errors.log");

$host = "localhost";
$db = "gecko";
$username = "root";
$password = "RSNA3475rsna42&";
$port = '3306';
$gecko = new PDO("mysql:host=$host;dbname=$db;port=$port",$username,$password);


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

    if ($param!=6) {
        $message="Bad params! Usage: php connect_db.php host username password port db\n";
        echo $message;
        file_put_contents(ERROR_LOG_FILE,$message ."\n",FILE_APPEND);

    } else {
    array_shift($argv);
    $host=$argv[0];
    $username=$argv[1];
    $password=$argv[2];
    $port=$argv[3];
    $db=$argv[4];
    connect_db($host, $username, $password, $port, $db);
    }
}

$db = connect_db($host,$username,$password,$port,$db);


function my_show_db($PDO, $table){

$query= $PDO->prepare("SELECT * FROM $table");
$query->execute($table);
$data =$query->fetchAll(PDO::FETCH_ASSOC);

foreach ($data as $element){
        $array_length = count($element);
        $i=0;
        foreach($element as $key => $value) {
        $i+=1;
        if($i == $array_length){
                yield("[" . $key . "]=>[" . $value . "]\n");
        }
        else {
                yield("[" . $key . "]=>[" . $value . "],");
        }
        if ($value==NULL || !isset($value) || $value==""){
            return NULL;}
        }
    }
}

$host = "localhost";
$db = "gecko";
$username = "root";
$password = "RSNA3475rsna42&";
$port = '3306';
$gecko = new PDO("mysql:host=$host;dbname=$db;port=$port",$username,$password);

$table= "users";
$generator = my_show_db($gecko,$table);

foreach ($generator as $element){
    echo "$element\n";
}




