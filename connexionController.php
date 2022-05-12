<?php

include_once 'model.php';
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
    header('Location:/ffw/');
  } else {
    $errors[] = 'Votre addresse mail est invalide ou votre mot de passe est invalide';
  }
}

include 'connexionView.php';
