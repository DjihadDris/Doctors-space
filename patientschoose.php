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
  <title>Gestion des patients</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />

<link rel="stylesheet" type="text/css" href="ui/semantic.min.css">
<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>
<script src="ui/semantic.min.js"></script>
<link rel="stylesheet" href="admin.css" />
    <link rel="shortcut icon" type="text/css" href="square.webp">
</head>

<body style="overflow-y: auto !important;">
  

  <?php
include('sidebar.php');
  ?>



<div class="ui large breadcrumb">
<a href="dashboard" class="ui blue tag label">Acceuil</a>
<a class="ui green tag label">Gestion des patients</a>
</div>


<div class="ui segment blue first">
<div class="ui segment second">

<div class="ui equal width grid" style="text-align: center !important;">
  
  <div data-tooltip="Les dossiers, ajouter un dossier, les dossiers supprimés..." data-position="top center" class="column choosecol colbackground">
    <i class="users icon blue big circular inverted"></i> <h3 class="choosetitle">Les patients</h3>
    <button class="ui button primary choose"><a href="patients" class="choosea"><i class="hand point right outline icon circular small"></i> Entrer</a></button>
  </div>

<?php
if($_COOKIE['job'] == "Admin" OR $_COOKIE['job'] == "Médecin" OR $_COOKIE['job'] == "Infirmier"){
?>
  <div data-tooltip="Les rendez-vous, créer un rendez-vous, les redez-vous supprimés..." data-position="top center" class="column choosecol colbackground">
    <i class="calendar alternate icon blue big circular inverted"></i> <h3 class="choosetitle">Les rendez-vous</h3>
    <button class="ui button primary choose"><a href="appointments" class="choosea"><i class="hand point right outline icon circular small"></i> Entrer</a></button>
  </div>
  <?php
}
  ?>

  <div data-tooltip="Les ordonnances, créer une ordonnance, les ordonnances supprimées..." data-position="top center" class="column choosecol colbackground">
    <i class="file alternate icon blue big circular inverted"></i> <h3 class="choosetitle">Les ordonnances</h3>
    <button class="ui button primary choose"><a href="prescriptions" class="choosea"><i class="hand point right outline icon circular small"></i> Entrer</a></button>
  </div>

  <div data-tooltip="Les analyses, créer une analyse, les analyses supprimées" data-position="top center" class="column choosecol colbackground">
    <i class="medkit icon blue big circular inverted disabled"></i> <h3 class="choosetitle">Les analyses</h3>
    <button class="ui button primary choose disabled"><a href="tests" class="choosea"><i class="hand point right outline icon circular small"></i> Entrer</a></button>
  </div>

</div>
<div class="ui equal width grid" style="text-align: center !important;">
  
  <div data-tooltip="Les images et les photos des patients" data-position="top center" class="column choosecol colbackground">
    <i class="images icon blue big circular inverted disabled"></i> <h3 class="choosetitle">Gallery</h3>
    <button class="ui button primary choose disabled"><a href="gallery" class="choosea"><i class="hand point right outline icon circular small"></i> Entrer</a></button>
  </div>

  <div data-tooltip="Faire une discussion avec les patients..." data-position="top center" class="column choosecol colbackground">
    <i class="comments icon blue big circular inverted"></i> <h3 class="choosetitle">Discussion</h3>
    <button class="ui button primary choose"><a href="patientschat/" class="choosea"><i class="hand point right outline icon circular small"></i> Entrer</a></button>
  <div class="floating ui red label">Nouveau</div>
  </div>

</div>
</div>
</div>


<script type="text/javascript">
    
$(document).ready(function() {
$('.column')
  .transition({
    animation : 'jiggle',
    duration  : 800,
    interval  : 200
  })
;
});


</script>

</body>
</html>