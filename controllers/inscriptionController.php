<?php
include_once 'models/model.php';
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
  if (checkElemIsTaken($pseudo, "pseudo")) {
    $errors[] = 'Pseudo déjà existant';
  }
  if (checkElemIsTaken($email, "email")) {
    $errors[] = 'Email déjà existant';
  }
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[]  = "Email non valide";
  }

  if ($_POST['passwords'] != $_POST['repeatpassword']) {
    $errors[] = 'Il y a une faute dans le mot de passe';
  }



  if (empty($errors)) {

    $userCreated = createUser($email, $pseudo, $secretPassword, $newDateTime);
    $_SESSION = array_merge($_SESSION, $userCreated);

    header('Location:/ffw/');
  }
}
include 'views/inscriptionView.php';
