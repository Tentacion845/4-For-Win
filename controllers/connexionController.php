<?php

include_once 'models/model.php';
include_once 'pdo.php';

$errors = [];
$email = '';
$pseudo = '';

if (isset($_POST['email']) && isset($_POST['passwords'])) {
  $email = htmlspecialchars($_POST['email']);
  $password = htmlspecialchars($_POST['passwords']);
  $secretPassword = hash('sha256', $password);
  $user = checkUser($email, $secretPassword);
  if ($user) {
    $_SESSION = array_merge($_SESSION, $user);
    header('Location:/ffw/');
  } else {
    $errors[] = 'Votre addresse mail est invalide ou votre mot de passe est invalide';
  }
}

include 'views/connexionView.php';
