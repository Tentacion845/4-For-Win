<?php
include 'pdo.php';
$id = $_SESSION['user_id'];

$statement = $dataBase->prepare('SELECT * FROM users WHERE user_id = :id');
$statement->bindValue(':id', $id);
$statement->execute();
$profil = $statement->fetch(pdo::FETCH_ASSOC);


$pseudo = $_SESSION['pseudo'];


?>



<nav class="navbar sticky-top navbar-expand-lg  navbar-dark bg-dark">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="/ffw/">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="profil.php">Mon profil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/ffw/?logout">Deconnexion</a>
        </li>
        <li>
          <div class="left-container">
            <?php if ($profil['image']) : ?>
              <img class="product-img-view " src="<?php echo $profil['image'] ?>">
            <?php else : ?>
              <img src="images/DEFAULT/2Q.jpg" alt="" class="product-img-view">
            <?php endif; ?>
          </div>
        </li>

      </ul>
    </div>
  </div>
</nav>