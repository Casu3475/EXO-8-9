<?php

function my_password_hash($password)
{
    $salt = uniqid();
    // $aleatoire1 = md5($aleatoire);
    //$mdp = password_hash($password, PASSWORD_DEFAULT, ["salt" => "$aleatoire1"]);
    $mdp = crypt($password, $salt);
    $array_to_return = [
        "hash" => $mdp,
        "salt" => $salt
    ];
    return $array_to_return;
}

function my_password_verify($password, $salt, $hash)
{
    // $aleatoire1 = md5($salt);
    //$mdphash = password_hash($password, PASSWORD_DEFAULT, ["salt" => "$aleatoire1"]);
    $mdphash = crypt($password, $salt);
    if ($hash == $mdphash) {
        return (true);
    } else return (false);
}

$array=my_password_hash("TOTO");
var_dump($array);
echo "<br>";
$result=my_password_verify("TOT",$array['salt'], $array['hash']);

if ($result) {
    echo 'password verified';

} else {
    echo'Password no verified';
}

