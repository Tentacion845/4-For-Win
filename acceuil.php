<?php

$dataBase = new PDO('mysql:host=localhost;dbname=bts;charset=utf8', 'root', '');

$email = $_POST['email'];
$password = $_POST['password'];


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
    <form action="acceuil.php" method="POST">
      <label for="">
        Email : <input type="email" placeholder="exemple@outlook.fr" />
      </label>
      <label for="">
        Mot de passe :
        <input
          type="password"
          id="password"
          required
          minlength="6"
          maxlength="25"
        />
      </label>

      <button type="submit" >Connexion</button>
    </form>
  </body>
</html>



