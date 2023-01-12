
<?php

// if (isset($_GET["name"])){
//     if(strlen($_GET["name"])<3 || strlen($_GET["name"])>10){
//         echo(messageDisplay(("Invalid name")));
//     }

//  if (isset($_GET["email"])){
    // $regex = ;
//     if (!preg_match($regex, $_GET["email"])){
//         echo(messageDisplay(("Invalid email")));
//     }
//     }
 
$validate_name;
$validate_email;
$validate_password;
$validate_password_confirmation;
$message="";
$get=$_POST;

if (exists($get)){
$validate_name=validate_Name($_POST["name"]);
$validate_email=validate_Email($_POST["email"]);
$validate_password=validate_Password($_POST['password']);
$validate_password_confirmation=validate_Password($_POST['password_confirmation']);
$password_equality=validate_Passwords_egality($_POST['password'],$_POST['password_confirmation']);

if ($validate_name==false){
    $message="Invalid name";
}
elseif ($validate_email==false){
    
    $message="Invalid email";
}
elseif ($validate_password==false || $validate_password_confirmation==false){
    
    $message="Invalid password or password confirmation"; 
}
elseif ($password_equality==false){
    $message="Invalid password or password confirmation"; 
}
else{
    $users_exists=verify_user_exist($validate_email);
    if($users_exists){
        $message="Users already exists";
    }
    else{
        $hash=my_password_hash($validate_password);
        save_User($validate_name,$validate_email,$hash);
        $message="User created";
        }
    }
}
else{
    // $message="Enter your information";
}
 ?>
<?php
function exists($_get){ //est ce qu'il existe?
    if (!empty($_get)){
        return true;
    }
    else{
        return false;
    }
}
function validate_Name($name){ //je check le nom
    if(isset($name))
    {
        if (strlen($name)>= 3 && strlen($name)<=10 )
        {
        return $name;
        }
        else
        {return false;}
    }
    else
    {
        return "empty";
    }
}

function validate_Email($email){ //je check l'email
     if (isset($email))
     {
        if (filter_var($email,FILTER_VALIDATE_EMAIL)){
            return $email;
        }
        else{
            return false;
        }
     }
     else
     {
        return "empty";
     }

}

function validate_Password($password){ //idem password
    if(isset($password))
    {
        if (strlen($password)>= 3 && strlen($password)<=10 )
        {
        return $password;
        }
        else
        {return false;}
    }
    else
    {
        return "empty";
    }
}

function validate_Passwords_egality($password,$password_confirmation){
    if ($password===$password_confirmation) //check concordance entre password et confirm
    {
        return true;
    }
    else{
        return false;
    }
}

function my_password_hash($password){ //le hash
    $password_hash=password_hash($password,PASSWORD_DEFAULT);
    return $password_hash;
    
}

function my_password_verify($password,$hash){
   
    $verify = password_verify($password, $hash);
  
    if ($verify) {
        echo 'Password Verified!';
        return true;
    } else {
        echo 'Incorrect Password!';
        return false;
    } 
   
}

// if (!empty($_POST["password"]) && !empty($_POST["password_confirmation"]))
//     {
//         if (strlen($_POST["password"]) <3 ||
//             strlen($_POST["password"])>10 and strlen($_POST["password_confirmation"]) <3 ||
//             strlen($_POST["password_confirmation"])>10)
//             {
//                 echo "Invalid password or password confirmation";
//             }

//         if ($_POST["password"] !== $_POST["password_confirmation"])
//         {
//             echo "Invalid password or password confirmation";
//         }
        
// }

function fileWriteAppend($name, $email,$hash){
    $current_data = file_get_contents('users.json');
    $array_data = json_decode($current_data, true);
    $extra = array(
         'name'      =>     $name,
         'email'     =>     $email,
         'hash'      =>     $hash,
         'created_at'=>     date("Y-m-d H:i:s"),

    );
    $array_data[] = $extra;
    $final_data = json_encode($array_data);
    return $final_data;
}

function fileCreateWrite($name,$email,$hash){
    $file=fopen("users.json","w");
    $array_data=array();
    $extra = array(
        'name'      =>     $name,
        'email'     =>     $email,
        'hash'      =>     $hash,
        'created_at'=>     date("Y-m-d H:i:s"),

   );
    $array_data[] = $extra;
    $final_data = json_encode($array_data);
    fclose($file);
    return $final_data;
}

function save_User($name,$email,$hash){
    if(file_exists('users.json'))
    {
     $final_data=fileWriteAppend($name,$email,$hash);
     if(file_put_contents('users.json', $final_data))
     {
          return "User created ";
     }
    }
    else
    {
    $final_data=fileCreateWrite($name,$email,$hash);
    if(file_put_contents('users.json', $final_data))
        {
          return "User created";
        }
    }
}

function verify_user_exist($email){
    if (file_exists("users.json")) 
    {
        $current_data = file_get_contents('users.json');
        $array_data = json_decode($current_data, true);
        $user_exist=false;
        foreach($array_data as $user)
        {
            if ($user["email"]==$email)
            {
                $user_exist=True;
            }
            
        }
   return $user_exist;

    }
}

//  $users_exists=verify_user_exist("a@a.fr");

// if ($users_exists){echo("Users exists");}else{echo"Users doesn't exits";}

//echo save_User("PEPE","ansddssdtonio@ifa.fr","lljkksdlkj");



// $hash=my_password_hash("1234456789");
// my_password_verify("1234456789",$hash);

/* echo "Name validate: ".Validate_Name("Mar")."\n";
echo "Name validate: ".Validate_Name("12345678901")."\n";
echo "Password validate: ".validate_Password("Ma")."\n";
echo "Password validate: ".validate_Password("12345678901")."\n";
echo "password egality validate: ".validate_Passwords_egality("123456789","123456789")."\n";


    // if(isset($_GET["password"]) && isset($_GET["password_confirmation"]))
    //     if (strlen($_GET["password"])<3 || strlen($_GET["password"])>10 || $_GET["password"] !== $_GET["password_confirmation"]){
    //         echo(messageDisplay(("Invalid password or password confirmation")));
    //     } else {
    //         $passwordHash=password_hash($_GET["password"], PASSWORD_DEFAULT);
    //     }
    

 ?>
 <h3><?php echo $message ?></h3>
<form action="." method="get">
<label for="name">Name</label><br>
<input type="text" name="name" value="" placeholder="Entrez votre nom" minlength="3" maxlength="10" required />
<br><br>
<label for="email">Email</label><br>
<input type="email" name="email" value="" placeholder="Entrez votre email" required />
<br><br>
<label for="email">Password</label><br>
<input type="password" name="password" value="" placeholder="Entrez votre mot de passe">
<br><br>
<label for="password_confirmation">Password confirmation</label><br>
<input type="password" name="password_confirmation" value="" placeholder="confirmez votre mdp">
<br><br>
<input type="submit" name="submit" value="submit">
</form>
<?php
 

//  if (file_exists("users.json")){
//     $file_content = file_get_contents("users.json");
//     $content_array = json_decode($file_content);
//     array_push($content_array, $new_user);
//     $users_json = json_encode($content_array);
//     var_dump($users_json);
//     file_put_contents("users.json", $users_json);
// } else {
//     file_put_contents("users.json", "[", FILE_APPEND);
//     file_put_contents("users.json", json_encode($new_user), FILE_APPEND);
//     file_put_contents("users.json", "]", FILE_APPEND);
// }

