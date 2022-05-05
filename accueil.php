<?php
session_start();
include_once 'pdo.php';
include_once 'navbar.php';
include_once 'head.php';

// echo '<pre>';
// var_dump($_SESSION);
// echo '<pre>';


?>


<header>
  <h1> Four For Win</h1>
</header>

<body>


  <p> Bienvenue <?php echo $pseudo ?> </p>

  <a href="niveau_1.php">Niveau 1</a>


 
</body>

<footer>


</footer>

</html>