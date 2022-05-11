<?php

session_start();
include_once 'head.php';
include_once 'pdo.php';
$errors = [];


// Verification de l'email :

$email = '';
$password = '';
$repeatPassword = '';
$secretPassword = '';
$pseudo = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $email = htmlspecialchars(trim($_POST['email']));
  $pseudo = htmlspecialchars(trim($_POST['pseudo']));
  $password = htmlspecialchars(trim($_POST['passwords']));
  $repeatPassword = htmlspecialchars(trim($_POST['repeatpassword']));
  $dateObject = new DateTime();
  $newDateTime  = $dateObject->format('Y-m-d H:i:s');

  $secretPassword = hash('sha256', $password);


  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[]  = "Email non valide";
  }

  $checkPseudo = "SELECT * FROM users WHERE pseudo = '$pseudo' ";
  $query = $dataBase->prepare($checkPseudo);
  $query->execute();
  $resultat = $query->fetchAll();
  if (count($resultat) >= 1) {
    $errors[] = 'Pseudo déjà existant';
  }

  $checkEmail = "SELECT * FROM users WHERE email = '$email'";
  $query = $dataBase->prepare($checkEmail);
  $query->execute();
  $resultat = $query->fetchAll();
  // var_dump($checkEmail);
  if (count($resultat) >= 1) {
    $errors[] = 'Email déjà existant';
  }
  if ($_POST['passwords'] != $_POST['repeatpassword']) {
    $errors[] = 'Il y a une faute dans le mot de passe';
  }



  if (empty($errors)) {

    $sqlQuery = $dataBase->prepare("INSERT INTO users (email, pseudo ,passwords, date_connexion) VALUES (:email, :pseudo ,:passwords, :newDateTime)");

    $sqlQuery->bindValue(':email', $email);
    $sqlQuery->bindValue(':pseudo', $pseudo);
    $sqlQuery->bindValue(':passwords', $secretPassword);
    $sqlQuery->bindValue(':newDateTime', $newDateTime);
    $sqlQuery->execute();


    $check = $dataBase->prepare('SELECT * FROM users WHERE email = ? AND passwords = ? ');
    $data = $check->fetch();
    $row = $check->rowCount();
    $_SESSION = array_merge($_SESSION, $row);

    header('Location:accueil.php');
  }
}




?>






<body>

  <p>
    <a href="connexion.php" class="btn btn-secondary">Retourner à la connexion</a>
  </p>
  <h1>Inscription</h1>

  <!-- Si il y a une erreur de validation -->

  <?php if (!empty($errors)) : ?>
    <div class="alert alert-danger">
      <?php foreach ($errors as $error) :   ?>
        <div> <?php echo $error  ?> </div>
      <?php endforeach; ?>
    <?php endif; ?>
    </div>



    <form action="inscription.php" method="POST">
      <div class="container">
        <label for="">Email :</label>
        <div class="row mb-3">
          <input type="email" class="form-control" name="email" placeholder="exemple@outlook.fr" value="<?php echo $email ?>" />
        </div>

        <label for="">Pseudonyme :</label>
        <div class="row mb-3">
          <input type="text" class="form-control" name="pseudo" placeholder="Toto" value="<?php echo $pseudo ?>" />
        </div>
        <label for="">Mot de passe :</label>
        <div class="row mb-3">
          <input class="form-control" type="password" name="passwords" required minlength="6" maxlength="25" />
        </div>

        <label for="">Répeter votre MDP :</label>
        <div class="row mb-3">
          <input class="form-control" type="password" name="repeatpassword" required minlength="6" maxlength="25" />
        </div>

        <button type="submit" class="btn btn-primary btn-lg" name="submit">Submit</button>
    </form>
</body>

</html>