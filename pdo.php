<?php
$dataBase = new PDO('mysql:host=localhost;dbname=ffw;charset=utf8', 'root', '');
$dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
