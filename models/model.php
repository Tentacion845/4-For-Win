<?php

function checkElemIsTaken(
    $element,
    $type
): bool {
    include "pdo.php";
    $checkElem = "SELECT * FROM users WHERE '$type' = '$element' ";
    $query = $dataBase->prepare($checkElem);
    $query->execute();
    $resultat = $query->fetchAll();
    if (count($resultat) >= 1) {
        return true;
    };
    return false;
}
function createUser($email, $pseudo, $secretPassword, $newDateTime)
{
    include "pdo.php";
    $sqlQuery = $dataBase->prepare("INSERT INTO users (email, pseudo ,passwords, date_connexion) VALUES (:email, :pseudo ,:passwords, :newDateTime)");
    $sqlQuery->bindValue(':email', $email);
    $sqlQuery->bindValue(':pseudo', $pseudo);
    $sqlQuery->bindValue(':passwords', $secretPassword);
    $sqlQuery->bindValue(':newDateTime', $newDateTime);
    $sqlQuery->execute();
    $check = $dataBase->prepare('SELECT * FROM users WHERE email = ? AND passwords = ? ');
    $data = $check->fetch();
    return $data;
}

function checkUser($email, $secretPassword)
{
    include "pdo.php";
    $check = $dataBase->prepare('SELECT * FROM users WHERE email = ? AND passwords = ? ');
    $checkEmail = $check->execute(array($email, $secretPassword));
    $data = $check->fetch();
    $row = $check->rowCount();
    return $data ?? null;
}
