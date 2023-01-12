<?php

function my_very_secure_hash($password){
    $password_hash=password_hash($password,PASSWORD_DEFAULT);
    return $password_hash;
}

function my_password_verify($password, $hash) {
    $verify = password_verify($password, $hash);

    if($verify){
        echo 'Password Verified!';
        return true;
    } else {
        echo 'Incorrect Password!';
        return false;
    }
}

$hash=my_very_secure_hash("Casu");
echo($hash);
echo('<br>');
echo (my_password_verify("Casu",$hash));