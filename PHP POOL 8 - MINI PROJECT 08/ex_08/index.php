<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html> -->

<?php
function display($val){
    echo ("<h1>$val</h1>");
}

if (isset($_GET["name"])){
    echo("<h1>Hello ".$_GET['name']."</h1>");
} else {
?>
    <form action="." method="get"><br>
    <label for="name">Your name</label><br>
    <input type="text" placeholder="Entrez votre nom"  value="" name='name'><br><br>
    <label for="submit">mon boutton</label>
    <input type="submit" name="submit" value="Submit" >
    <!-- <input type="number" id="number-age" value="15" oninput="document.getElementById('range-age').value=this.value"> -->
    </form>
<?php
}

//     <!-- Input select -->
//     <!-- <label for="gender">Genre</label>
//     <select id="gender">
//       <option selected="selected" value="Homme">Homme</option>
//       <option value="Femme">Femme</option> -->
//     <!-- </select><br /> -->



