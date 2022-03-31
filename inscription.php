<?php

try{

  $dataBase = new PDO('mysql:host=localhost;dbname=ffw;charset=utf8', 'root', '');

} 
catch(Exception $e) {

die ('Erreur :'. $e->getMessage());

}


try{
if (isset($_POST['submit'])) {

  $email = htmlspecialchars(trim($_POST['email']));
  $password = htmlspecialchars(trim($_POST['passwords']));
  $repeatpassword = htmlspecialchars(trim($_POST['repeatpassword']));
  $datetime = new DateTime();
  $Newdatetime  = $datetime->format('Y-m-d H:i:s');

  if ($email && $password && $repeatpassword )
  {
    if (strlen($password) >= 6 && $password === $repeatpassword )
   $secretPassword = hash('sha256', $password );
   
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


  $sqlQuery = "INSERT INTO users (email, passwords, date_connexion) VALUES ('$email','$secretPasswor','$Newdatetime')";
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
    <title>Inscription</title>
  </head>
  <body>
    <h1>Inscription</h1>

  <?php


if (!empty($erreur)){
  echo $erreur;
} 

  ?>

    <form action="inscription.php" method="POST">
      <label for="">Email :</label>
      <input type="email" name="email" placeholder="exemple@outlook.fr" />
   
      <label for="">Mot de passe :</label>
    
        <input
          type="password"
          id="passwords"
          name = "passwords"
          required
          minlength="6"
          maxlength="25"
        />
     
      <label for="">Répeter votre MDP :</label>
        <input
          type="password"
          id="repeatpassword"
          name = "repeatpassword"
          required
          minlength="6"
          maxlength="25"
  
        />
     

      <button type="submit" name ="submit" >Connexion</button>
    </form>
  </body>
</html>



