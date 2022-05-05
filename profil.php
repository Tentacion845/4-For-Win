<?php

session_start();
include_once 'pdo.php';
include_once 'head.php';
include_once 'navbar.php';



$errors = [];
$password = '';
$repeatPassword = '';
$secretPassword = '';
$id = $_SESSION['user_id'] ?? null;
$email = $_SESSION['email'];


if (!$id) {
  header('Location: accueil.php');
  exit;
}

$statement = $dataBase->prepare('SELECT * FROM users WHERE user_id = :id');
$statement->bindValue(':id', $id);
$statement->execute();
$profil = $statement->fetch(pdo::FETCH_ASSOC);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $pseudo = ($_POST['pseudo']);
  $password = ($_POST['passwords']);
  $repeatPassword = ($_POST['repeatpassword']);
  $dateObject = new DateTime();
  $newDateTime  = $dateObject->format('Y-m-d H:i:s');
  $id = ($_SESSION['user_id']);
  $secretPassword = hash('sha256', $password);


  // $checkPseudo = "SELECT * FROM users WHERE pseudo = :pseudo";
  // $checkPseudo->bindValue(':pseudo', $pseudo);
  // $query = $dataBase->prepare($checkPseudo); 
  // $query->execute();  
  // $resultat = $query->fetchAll();
  // if (count($resultat) >=1){
  //   $errors[] = 'Pseudo déjà existant';
  // }


  if ($_POST['passwords'] != $_POST['repeatpassword']) {
    $errors[] = 'Il y a une faute dans le mot de passe';
  }

  if (!is_dir(__DIR__ . '/images')) {
    mkdir(__DIR__ . '/images');
  }


  if (empty($errors)) {

    $sqlQuery = $dataBase->prepare("UPDATE users SET   pseudo = :pseudo, passwords = :passwords WHERE user_id = :id");

    $sqlQuery->bindValue(':pseudo', $pseudo);
    $sqlQuery->bindValue(':passwords', $secretPassword);
    $sqlQuery->bindValue(':id', $id);
    $sqlQuery->execute();
    $_SESSION["pseudo"] = $pseudo;
  }
}

?>




<body>


  <h1>Mon Profil</h1>




  <!-- Si il y a une erreur de validation -->

  <?php if (!empty($errors)) : ?>
    <div class="alert alert-danger">
      <?php foreach ($errors as $error) :   ?>
        <div> <?php echo $error  ?> </div>
      <?php endforeach; ?>
    <?php endif; ?>
    </div>

    <?php if ($profil['image']) : ?>
      <a href="image_profil.php"> <img class="product-img-view" src="<?php echo $profil['image'] ?>" class="image-profil"> </a>

    <?php else : ?>
      <a href="image_profil.php"><img src="images/DEFAULT/2Q.jpg" class="product-img-view"></a>

    <?php endif; ?>




    <p> <?php echo $email ?> </p>

    <form action="" method="POST" enctype="multipart/form-date">

      <div class="container">


        <label for="">Pseudonyme :</label>
        <div class="row mb-3">
          <input type="text" class="form-control" name="pseudo" placeholder="Toto" value="<?php echo $profil['pseudo'] ?>" />
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