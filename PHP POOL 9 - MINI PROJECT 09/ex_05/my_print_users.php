<?php


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

// $db=connect_db($host, $username, $password, $port, $db);


function my_print_users ($connection, $array){
    $status=false;
    foreach($array as $id)
    {
        $sql=" SELECT name FROM users WHERE id=$id";  // CREATE A SELECT QUERY
        if (!is_int($id)){
            // echo "Invalid id given\n";
            throw new Exception('Invalid id given');
            
        } else{- // SIMPLE REQUEST 
            $result=$connection->query($sql); // CREATE A SELECT QUERY
            $all=$result->fetchAll(PDO::FETCH_ASSOC);
            $result->closeCursor();

            foreach($all as $element){
                echo $element['name']."\n";
                if($element['name']==""){
                    $status=false;
                }
                else{
                    $status=true;
                }
            }
        }
    }
    return $status;
}

// $host = "localhost";
// $db = "gecko";
// $username = "root";
// $password = "RSNA3475rsna42&";
// $port = 3306;
// $gecko = new PDO("mysql:host=$host;dbname=$db;port=$port",$username,$password);
// $array=[10,20,30,40];

// try{
//         echo(my_print_users($gecko,["Martin42", "casu"]));   
//         echo $result;

// } catch (Exception $e){
//         echo $e->getMessage()."\n";
// }









