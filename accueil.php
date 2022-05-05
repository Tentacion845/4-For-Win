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

  <div role="alert" aria-live="assertive" aria-atomic="true" class="toast">
    <div class="toast-header">
      <img src="..." class="rounded me-2" alt="...">
      <strong class="me-auto">Bootstrap</strong>
      <small>11 mins ago</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      Hello, world! This is a toast message.
    </div>
  </div>

  <p> Bienvenue <?php echo $pseudo ?> </p>


</body>

<footer>


</footer>

</html>