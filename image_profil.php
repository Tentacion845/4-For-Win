<?php
session_start();
include_once 'head.php';
include_once 'navbar.php';
include_once 'pdo.php';

$id = $_SESSION['user_id'];
$statement = $dataBase->prepare('SELECT * FROM users WHERE user_id = :id');
$statement->bindValue(':id', $id);
$statement->execute();

$profil = $statement->fetch(pdo::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $image = $_FILES['image'] ?? null;
    $imagePath = '';

    if (!is_dir(__DIR__ . '/images')) {
        mkdir(__DIR__ . '/images');
    }

    if ($image && $image['tmp_name']) {
        if ($profil['image']) {
            unlink(__DIR__ . '/' . $profil['image']);
        }

        $imagePath = 'images/' . randomString(8) . '/' . $image['name'];
        mkdir(dirname(__DIR__ . '/' . $imagePath));
        move_uploaded_file($image['tmp_name'], __DIR__ . '/' . $imagePath);
    }

    $sqlQuery = $dataBase->prepare("UPDATE users SET image = :image WHERE user_id = :id");

    $sqlQuery->bindValue(':image', $imagePath);
    $sqlQuery->bindValue(':id', $id);

    $sqlQuery->execute();
}

function randomString($n)
{

    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $str = '';

    for ($i = 0; $i < $n; $i++) {

        $index = rand(0, strlen($characters) - 1);
        $str .= $characters[$index];
    }
    return $str;
}

?>



<form action="" method="POST" enctype="multipart/form-data">

    <input type="file" name="image" class="form-control">
    <button type="submit">Envoyez</button>

</form>