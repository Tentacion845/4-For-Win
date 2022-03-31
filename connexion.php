<?php

session_start();
var_dump($_POST);

try
{

if (isset($_POST['email']) && isset($_POST['passwords']))
 {
  $email = htmlspecialchars($_POST['email']);
  $password = htmlspecialchars($_POST['passwords']);
  $secretPassword = hash('sha256', $password);

  $bdd = new PDO('mysql:host=localhost;dbname=ffw;charset=utf8', 'root', '');
  $check = $bdd->prepare('SELECT * FROM users WHERE email = ? AND passwords = ?');
  $checkEmail = $check->execute(array($email, $secretPassword));
  $data = $check->fetch();
  $row = $check->rowCount();

  if ($row == 1) {
    echo "Ca marche !";
  $_SESSION['username'] = $email;
    header('Location:accueil.php');
    

   } else {
     header('Location:inscription.php?login_err=email');
     echo "1";
   }

} else {
  echo "2";
}
}
catch(Exception $e){
  die('Erreur : '.$e->getMessage());
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Four For Win</title>
  </head>

  <header>
    <h1><strong>Connexion</strong></h1>
  </header>

  <body>
    <form action="connexion.php" method="POST">
      <fieldset>
        <legend>Insert your informations</legend>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required /> <br />

        <label for="passwords">Password</label>
        <input
          type="passwords"
          name="passwords"
          id="passwords"
          required
          minlength="6"
          maxlength="25"
        />
        <br />

        <button type="submit" name="connexion" class="connexion">
          Connexion
        </button>
      </fieldset>
    </form>
  </body>
</html>
