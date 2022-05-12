<?php $title = "Inscription" ?>
<?php ob_start(); ?>

<p>
  <a href="?action=connexion" class="btn btn-secondary">Retourner à la connexion</a>
</p>
<h1>Inscription</h1>

<!-- Si il y a une erreur de validation -->

<?php if (!empty($errors)) : ?>
  <div class="alert alert-danger">
    <?php foreach ($errors as $error) :   ?>
      <div> <?php echo $error  ?> </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>



<form action="inscription.php" method="POST">
  <div class="container">
    <label for="">Email :</label>
    <div class="row mb-3">
      <input type="email" class="form-control" name="email" placeholder="exemple@outlook.fr" value="<?php echo $email ?>" />
    </div>

    <label for="">Pseudonyme :</label>
    <div class="row mb-3">
      <input type="text" class="form-control" name="pseudo" placeholder="Toto" value="<?php echo $pseudo ?>" />
    </div>
    <label for="">Mot de passe :</label>
    <div class="row mb-3">
      <input class="form-control" type="password" name="passwords" required minlength="6" maxlength="25" />
    </div>

    <label for="">Répeter votre MDP :</label>
    <div class="row mb-3">
      <input class="form-control" type="password" name="repeatpassword" required minlength="6" maxlength="25" />
    </div>

    <button type="submit" class="btn btn-primary btn-lg" name="submit">Submit</button>
  </div>
</form>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>