<?php

try{

  $dataBase = new PDO('mysql:host=localhost;dbname=bts;charset=utf8', 'root', '');

} 
catch(Exception $e) {

die ('Erreur :'. $e->getMessage());

}


try{
if (isset($_POST['submit'])) {

  $email = htmlspecialchars(trim($_POST['email']));
  $password = htmlspecialchars(trim($_POST['password']));
  $repeatpassword = htmlspecialchars(trim($_POST['repeatpassword']));
  $datetime = new DateTime();
  $Newdatetime  = $datetime->format('Y-m-d H:i:s');

  if ($email && $password && $repeatpassword )
  {
    if (strlen($password) >= 6 && $password === $repeatpassword )
    echo hash('sha256', $password );
   
   // Verification de l'email :
    if (isset($_POST['email']))
    {
    
      $checkEmail = "SELECT * FROM users WHERE email = '$email'";
      $query = $dataBase->prepare($checkEmail); 
      $query->execute();  
      $resultat = $query->fetchAll();
      // var_dump($checkEmail);
      if (count($resultat) >=1)  {
 
        throw new Exception('Email déjà existant');
         
      } 

      }
    
    }


  $sqlQuery = "INSERT INTO users (email, passwords, date_connexion) VALUES ('$email','$password','$Newdatetime')";
$query = $dataBase->prepare($sqlQuery); 
$query->execute();  



}

} catch(Exception $e){
  $erreur = 'Erreur : ' . $e->getMessage();

}




?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>4 For Win</title>
  </head>
  <body>
    <h1>4 For Win</h1>

  <?php


if (!empty($erreur)){
  echo $erreur;
} 

  ?>

    <form action="acceuil.php" method="POST">
      <label for="">
        Email : <input type="email" name="email" placeholder="exemple@outlook.fr" />
      </label>
      <label for="">
        Mot de passe :
        <input
          type="password"
          id="password"
          name = "password"
          required
          minlength="6"
          maxlength="25"
        />
      </label>
      <label for="">Répeter votre MDP : 
        <input
          type="password"
          id="repeatpassword"
          name = "repeatpassword"
          required
          minlength="6"
          maxlength="25"
        />
      </label>

      <button type="submit" name ="submit" >Connexion</button>
    </form>
  </body>
</html>



