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
  <title>Ministère de la Santé</title>
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
    <style type="text/css">
      .pack{
  background: transparent;
    float: left;
    margin: 1px 0px;
<?php
if($_COOKIE['job'] == "Admin"){
?>
    width: 218px;
<?php
}elseif($_COOKIE['job'] == "Médecin"){
?>
    width: 290px;
<?php
}else{
?>
    width: 430px;
<?php
}
?>
    height: 278px;
    border: 2px #cccccc solid;
    border-left: none;position: relative;border: 1px #cccccc solid;
    transition: 0.5s;
}
    </style>
</head>

<body style="overflow-y: hidden !important;">
  

  <?php
include('sidebar.php');
  ?>


<h1 class="ui blue header pack-price1">Le sol numérique du Ministère de la Santé</h1>


<section class="wraper_bg-bright">

<article class="packs-cont">
            <div class="mbl-packs-cont">
                  
                  <a style="color: black;" href="patientschoose">
                <div class="pack" data-0="opacity:1;left:0%;" data-300="left:-100%; opacity:0" data-600="left:0%; opacity:1" data-900="left:0%; opacity:1" data-1200="left:-100%; opacity:0">
                    <header class="pack-h">Gestion des patients</header>
                    <img class="imgradius" src="patients.webp">
                      <div class="pack-info">
                       <div class="menu">
                            <span>Les patients</span>
                        </div>
                        <div class="menu">
                            <span>Les ordonnances</span>
                        </div>
                        <div <?php if($_COOKIE['job'] == "Pharmacien"){echo "style='display: none !important;'";} ?> class="menu">
                            <span>Les rendez-vous</span>
                        </div>
                    </div>
                </div>
                </a>
<?php
if($_COOKIE['job'] == "Admin" OR $_COOKIE['job'] == "Médecin"){
?>
<a style="color: black;" href="nurseschoose">
                <div class="pack" data-0="opacity:1;left:0%;" data-250="left:-100%; opacity:0" data-510="left:0%; opacity:1" data-960="left:0%; opacity:1" data-1170="left:-100%; opacity:0">
                    <header class="pack-h">Gestion des infirmiers</header>
                    <img class="imgradius" src="nurses.jpeg">
                    <div class="pack-info">
                        <div class="menu">
                            <span>Les dossiers</span>
                        </div>
                       <div class="menu">
                            <span>Les infirmiers</span>
                        </div>
                        <div class="menu">
                            <span>Discussion</span>
                        </div>
                    </div>
                </div>
              </a>
<?php
}
?>
<a style="color: black;" href="<?php if($_COOKIE['job'] == "Admin" OR $_COOKIE['job'] == "Médecin"){ ?>drugschoose<?php }else{echo "#";} ?>">
                <div class="pack" data-0="opacity:1;left:0%;" data-250="left:100%; opacity:0" data-510="left:0%; opacity:1" data-960="left:0%; opacity:1" data-1170="left:100%; opacity:0">
                    <header class="pack-h">Gestion des médicaments</header>
                    <img class="imgradius" src="drugs.jpg">
                    <div class="pack-info">
                        <div class="menu">
                            <span>Les médicaments</span>
                        </div>
                        <div class="menu">
                            <span>Ajouter un médicament</span>
                        </div>
                        <div class="menu">
                            <span>Les médicaments supprimés</span>
                        </div>
                    </div>
                </div>
</a>
<?php
if($_COOKIE['job'] == "Admin"){
?>
<a style="color: black;" href="userschoose">
                <div class="pack" data-0="opacity:1;left:0%;" data-300="left:100%; opacity:0" data-600="left:0%; opacity:1" data-900="left:0%; opacity:1" data-1200="left:100%; opacity:0">
                    <header class="pack-h">Gestion des utilisateurs</header>
                    <img class="imgradius" src="users.jpg">
                    <div class="pack-info">
                        <div class="menu">
<?php
if($_COOKIE['name'] == "Djihad"){
?>
                            <span>Les administrateurs</span>
<?php
}else{
?>
                            <span>Les spécialités</span>
<?php
}
?>
                        </div>
                        <div class="menu">
                            <span>Les médecins</span>
                        </div>
                        <div class="menu">
                            <span>Les pharmaciens</span>
                        </div>
                    </div>
                </div>
              </a>
            <?php
          }
          ?>

            </div>
        </article>

</section>

<div class="ui bottom fixed fluid one item menu blue inverted">
        <div class="item">
            <marquee>
                <p>Tous droits réservés au Ministère de la Santé &copy; <?php echo date("Y"); ?> </p>
            </marquee>
        </div>
    </div>

</body>
</html>