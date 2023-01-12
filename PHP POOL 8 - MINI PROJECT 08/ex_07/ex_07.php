<?php
// session_start();

// $cookie_name = "name";
// $cookie_value = "value";
// setcookie($cookie_name, $cookie_value, time()+3600, "/"); 

function modify_cookie ($cookie_name, $cookie_value) {
         
    setcookie($cookie_name, $cookie_value);
}

modify_cookie("name", "hector");
