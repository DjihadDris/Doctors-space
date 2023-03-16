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
  <title>Gestion des médicaments</title>
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
<a class="ui green tag label">Gestion des médicaments</a>
</div>


<div class="ui segment blue first">
<div class="ui segment second">

<div class="ui equal width grid" style="text-align: center !important;">

  <div data-tooltip="Les médicaments, ajouter un médicament, les médicaments supprimés..." data-position="top center" class="column choosecol colbackground">
    <i class="pills  icon blue big circular inverted"></i> <h3 class="choosetitle">Les médicaments</h3>
    <button class="ui button primary choose"><a href="drugs" class="choosea"><i class="hand point right outline icon small circular"></i> Entrer</a></button>
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