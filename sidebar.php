<div style="height: 78px !important; " class="ui fixed blue inverted main menu">
<div class="ui blue big launch left attached fixed button" onclick="sidebar()">
<i class="circular white content icon"></i>
</div>
<a class="item">
<img src="ms.png" style="width: 357px; height: 50px;">
</a>
<a style="color: white !important;" href="profile" class="item">
<center>

<h4>
<i class="hand point right outline icon circular small"></i>
<?php if ($_COOKIE['gender'] == "Mâle"){echo "Monsieur, ";}else{echo "Madame, ";}echo $_COOKIE['name']; ?>
<br>
<?php echo $_COOKIE['job']; ?>
</h4>
</center>
</a>
<div class="right menu">
<div class="item">
<a class="ui inverted button" href="logout"><i class="logout icon"></i> Se déconnecter</a>
</div>
</div>
</div>



<div class="ui left demo vertical blue inverted sidebar labeled icon menu">
  <a class="item" href="dashboard">
    <i class="home icon"></i>
    Accueil
  </a>
  <a class="item" href="patientschoose">
    <i class="users icon"></i>
    Gestion des patients
  </a>
  <?php
if($_COOKIE['job'] == "Admin" OR $_COOKIE['job'] == "Médecin"){
  ?>
  <a class="item" href="nurseschoose">
    <i class="doctor icon"></i>
    Gestion des infirmiers
  </a>
  <?php
}
?>
  <a class="item" href="<?php if($_COOKIE['job'] == "Admin" OR $_COOKIE['job'] == "Médecin"){ ?>drugschoose<?php }else{echo "#";} ?>">
    <i class="pills icon"></i>
    Gestion des médicaments
  </a>
  <?php
if($_COOKIE['job'] == "Admin"){
  ?>
 <a class="item" href="userschoose">
    <i class="users icon"></i>
    Gestion des utilisateurs
  </a>
<?php
}
?>
</div>

<script type="text/javascript">
  function sidebar(){
    $('.ui.labeled.icon.sidebar')
    .sidebar('setting', 'transition', 'overlay')
  .sidebar('toggle')
;
  }
</script>