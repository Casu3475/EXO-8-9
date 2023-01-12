<?php 
// session_start();

// $cookie_name = "name";
// $cookie_value = "value";
// setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); 

if (isset($_GET["name"])){
    // $_SESSION['name']= $_GET['name']; 
    echo 'Hello ' . htmlspecialchars($_GET['name']) . '!';
    setcookie("name",$_GET['name'],time()+3600); 
    // echo 'Cookie : ' .$_COOKIE['name'];

} elseif (isset($_COOKIE["name"])) {
    echo 'Hello ' . htmlspecialchars($_COOKIE['name']) . '!';

} else {echo "Hello platypus";
}


?>