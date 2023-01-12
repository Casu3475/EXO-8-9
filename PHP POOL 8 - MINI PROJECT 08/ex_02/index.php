<?php 
// session_start();
// if ($_SESSION['LOGGED_USER'] = $user['name']) {
// echo $_SESSION['LOGGED_USER'];
// if ($user = $_SESSION['user']) {

if (isset($_GET["name"])){
    echo 'Hello ' . htmlspecialchars($_GET["name"]) . '!';

} else {
    echo "Hello platypus";
}


// $name= isset($GET['name']) ? $_GET['name'] : 'playpus';

// $_SESSION["toto"]="coucou;
// $_SESSION["newsession"]=1;

?>