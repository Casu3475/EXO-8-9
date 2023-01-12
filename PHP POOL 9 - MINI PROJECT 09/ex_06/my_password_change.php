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


function my_password_change (PDO $bdd, $email, $password) {

if(empty($email) || empty($password)){
    throw new Exception("");
}

$email_exist = $bdd->prepare('SELECT name FROM users WHERE email = ?');
$email_exist->execute(array($email));

if($password == "" || $email_exist->fetch() == FALSE){
    throw new Exception("empty password or email already exists.\n");
}

$hashed_passwd = password_hash($password, PASSWORD_DEFAULT);
$change_passwd = $bdd->prepare('UPDATE users SET password= ? WHERE email= ?');
$change_passwd->execute(array($hashed_passwd, $email));

$check_pwd=$bdd->prepare('SELECT password FROM users WHERE email = ?');
$check_pwd->execute(array($email));
$check_pwd=$check_pwd->fetch()["password"];

return(password_verify($password,$check_pwd));
}

// $host = "localhost";
// $db = "gecko";
// $username = "root";
// $password = "RSNA3475rsna42&";
// $port = 3306;
// $gecko = new PDO("mysql:host=$host;dbname=$db;port=$port",$username,$password);

// try {
//     echo(my_password_change($gecko, "casu@casu.com", "test")) ? "Yes\n" : "No\n";
// } catch (Exception $e){
//     echo $e->getMessage();
// }