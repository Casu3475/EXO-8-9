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

// $db=connect_db($host, $username, $password, $port, $db);


function my_change_user($PDO, $name){

    $updated_name = array();

    foreach($name as $value){

        if(is_string($value)){
            $check_user=$PDO->prepare('SELECT name FROM users WHERE name = ?');
            $check_user->execute(array($value));
            $check_user=$check_user->fetch();

            if($check_user){
                $change_user = $PDO->prepare('UPDATE users SET name = CONCAT(UPPER(LOWER(SUBSTRING(name,1,1))),LOWER(SUBSTRING(name,2)),42) WHERE name = ?');
                $change_user->execute(array($value));
                $updated_name[] = $value;

            } else {
                throw new Exception("user $value not found.",1);
            }
        }  
    }
}

// $host = "localhost";
// $db = "gecko";
// $username = "root";
// $password = "RSNA3475rsna42&";
// $port = 3306;
// $gecko = new PDO("mysql:host=$host;dbname=$db;port=$port",$username,$password);

// try{

//  echo(my_change_user($gecko,["Martin42", "casu"]));   

// } catch(Exception $e){
//     echo $e->getMessage()."\n";
// }

// finally {
//     echo "Good luck with the user DB!\n";
// }
