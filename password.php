<?php
if(!isset($_COOKIE['name'])){
  header('Location: login');
}
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Mot de passe - E-learning DZ</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
  <!-- MDB -->
  <link rel="stylesheet" href="css/mdb.min.css" />
  <!-- Custom styles -->
  <link rel="stylesheet" href="css/admin.css" />
  <link rel="stylesheet" href="admin.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw=="
    crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <link rel="shortcut icon" type="text/css" href="../square.webp">
    <script src="../alertify.min.js"></script>
    <link rel="stylesheet" href="../css/alertify.min.css" />
    <link rel="stylesheet" href="../css/themes/default.min.css" />
    <script>
alertify.defaults.glossary.title = 'E-learning DZ';
alertify.defaults.glossary.ok = 'Ok';
alertify.defaults.glossary.cancel = 'Cancel';
    </script>
</head>

<body>
  
  <?php
include('sidebar.php');

if(isset($_GET['false'])){
  if($_GET['false'] == "errordb"){
    echo "<script>alertify.alert('Erreur...');</script>";
  }else if($_GET['false'] == "erroractualpassword"){
    echo "<script>alertify.alert('Le mot de passe actuel invalide');</script>";
  }else{
    echo "<script>alertify.alert('La confirmation du nouvel mot de passe invalide');</script>";
  }
}
  ?>
  <!--Main layout-->
  <main style="margin-top: 58px">
    <div class="container pt-4">


<!-- Section: Main chart -->
      <section class="mb-4">
        <div class="card">
          <div class="card-header py-3">
            <h5 class="mb-0 text-center"><strong><i class="fas fa-lock fa-fw me-3"></i>Mot de passe</strong></h5>
          </div>
          <div class="card-body">
<form method="POST" action="dopassword" enctype="multipart/form-data">

<div class="input-group">
  <span class="input-group-text">Mot de passe actuel</span>
  <input required name="actualpassword" type="password" aria-label="Mot de passe actuel" class="form-control" />
  </div>
  <br>
  <div class="input-group">
  <span class="input-group-text">Nouveau mot de passe</span>
  <input required name="newpassword" type="password" aria-label="Nouveau mot de passe" class="form-control" />
  </div>
  <br>
  <div class="input-group">
  <span class="input-group-text">Confirmez le nouveau mot de passe</span>
  <input required name="newnewpassword" type="password" aria-label="Confirmez le nouveau mot de passe" class="form-control" />
</div>


<br>
<center>
<button type="submit" class="btn btn-primary">Enregistrer</button>
</center>
</form>

          </div>
        </div>
      </section>
      <!-- Section: Main chart -->


    </div>
  </main>
  <!--Main layout-->
  <!-- MDB -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Custom scripts -->
  <script type="text/javascript" src="admin.js"></script>

</body>

</html>
