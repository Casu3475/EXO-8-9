<?php 
session_start();
// if ($_SESSION['LOGGED_USER'] = $user['name']) {
// echo $_SESSION['LOGGED_USER'];

if (isset($_GET["name"])){
    $_SESSION['name']= $_GET['name']; 
    echo 'Hello ' . htmlspecialchars($_SESSION['name']) . '!';

} elseif (isset($_SESSION["name"])) {
    echo 'Hello ' . htmlspecialchars($_SESSION['name']) . '!';

} else {echo "Hello platypus";
}


?>