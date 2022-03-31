<?php


session_start();
// var_dump($_SESSION);

if (isset($_SESSION['username'])){
//  echo 'Bienvenue ' . $_SESSION['username'];
} else{
header('Location:connexion.php');
}





?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Four For Win</title>
      <link href="./style.css" rel="stylesheet" > </link>
  </head>

  <header>

  </header>


  <nav>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
  </nav>
  
  <body>




  </body>
  
  <footer>


  </footer>

  </html>
