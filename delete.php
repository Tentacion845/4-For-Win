<?php
include_once 'pdo.php';
$id = $_GET['Delete_'];
$sqlQuery = $dataBase->prepare("DELETE FROM users WHERE user_id = :id");
$sqlQuery->bindValue(':id', $id);
die("");
$sqlQuery->execute();
header('Location:inscription.php');
