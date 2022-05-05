<?php

session_start();



include_once 'head.php';
include_once 'pdo.php';

$errors = [];
$email = '';
$pseudo = '';

if (isset($_POST['email']) && isset($_POST['passwords'])) {
  $email = htmlspecialchars($_POST['email']);
  $password = htmlspecialchars($_POST['passwords']);
  $secretPassword = hash('sha256', $password);

  $check = $dataBase->prepare('SELECT * FROM users WHERE email = ? AND passwords = ? ');
  $checkEmail = $check->execute(array($email, $secretPassword));
  $data = $check->fetch();
  $row = $check->rowCount();

  if ($row == 1) {

    $_SESSION = array_merge($_SESSION, $data);


    header('Location:accueil.php');
  } else {
    $errors[] = 'Votre addresse mail est invalide ou votre mot de passe est invalide';
  }
}

?>


<header>
  <h1><strong>Connexion</strong></h1>
</header>


<!-- Si il y a une erreur de validation -->

<body>
  <form action="connexion.php" method="POST">
    <fieldset>
      <legend>Insert your informations</legend>
      <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger">
          <?php foreach ($errors as $error) :   ?>
            <div> <?php echo $error  ?> </div>
          <?php endforeach; ?>
        <?php endif; ?>
        </div>
        <div class="container">
          <div class="row mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required class="form-control" />
          </div>
          <div class="row mb-3">
            <label for="passwords">Password</label>
            <input class="form-control" type="password" name="passwords" id="passwords" required minlength="6" maxlength="25" />
          </div>

          <a href="./inscription.php" class="btn btn-primary btn-lg">Inscription</a>
          <button type="submit" class="btn btn-primary btn-lg" name="connexion">Connexion</button>
        </div>
    </fieldset>
  </form>
</body>

</html>