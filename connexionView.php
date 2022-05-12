<?php $title = "Connexion" ?>
<?php ob_start(); ?>
<header>
  <h1><strong>Connexion</strong></h1>
</header>


<!-- Si il y a une erreur de validation -->

<form action="?action=connexion" method="POST">
  <fieldset>
    <legend>Insert your informations</legend>
    <?php if (!empty($errors)) : ?>
      <div class="alert alert-danger">
        <?php foreach ($errors as $error) :   ?>
          <div> <?php echo $error  ?> </div>
        <?php endforeach; ?>
      <?php endif; ?>
      </div>
      <div class="container">
        <div class="row mb-3">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" required class="form-control" />
        </div>
        <div class="row mb-3">
          <label for="passwords">Password</label>
          <input class="form-control" type="password" name="passwords" id="passwords" required minlength="6" maxlength="25" />
        </div>

        <a href="?action=inscription" class="btn btn-primary btn-lg">Inscription</a>
        <button type="submit" class="btn btn-primary btn-lg" name="connexion">Connexion</button>
      </div>
  </fieldset>
</form>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>