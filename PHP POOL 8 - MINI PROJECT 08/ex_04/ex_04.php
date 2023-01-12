<?php
session_start();

// echo session_id()."\n";

// $_SESSION["name"] = "ndfnfnof";

// if (isset($_GET["name"])){
//     echo "Hello " . $_GET['name'];
//     $_SESSION['name']= $_GET['name']; 
// } elseif (isset($_SESSION["name"])) {
//     echo "Hello " . $_SESSION['name'];
// } else {echo "Hello platypus";
// }

// var_dump($_SESSION);

function remove_session(){
    // $_SESSION["name_session"]="coucou";
    // $_SESSION["age_session"]=34;
    // $_SESSION["data_session"]="sdqioqdfiufnafn";
    // echo "removing session\n";
    session_unset()."\n";
    session_destroy()."\n";
    session_reset()."\n";
        // session_write_close();
    // session_regenerate_id()."\n";
    // session_start()."\n";
    // echo session_id()."\n";
    // session_destroy()."\n";
    // session_reset()."\n";
}


// var_dump($_SESSION);
// remove_session();
// session_unset();

?>