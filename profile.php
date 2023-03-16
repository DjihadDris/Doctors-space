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
  <title>Mon profil</title>
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
    <script src="alertify.min.js"></script>
    <link rel="stylesheet" href="css/alertify.min.css" />
    <link rel="stylesheet" href="css/themes/default.min.css" />
    <script>
alertify.defaults.glossary.title = 'Ministère de la Santé';
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
  }elseif ($_GET['false'] == "errorpassword") {
    echo "<script>alertify.alert('Le mot de passe invalid');</script>";
  }else if($_GET['false'] == "erroractualpassword"){
    echo "<script>alertify.alert('Le mot de passe actuel invalid');</script>";
  }else{
    echo "<script>alertify.alert('La confirmation du nouvel mot de passe invalide');</script>";
  }
}
  ?>


<div class="ui column grid profile">
  <div class="column">
    <div class="ui raised segment">
      <a class="ui blue ribbon label">Mon profil</a>
      
 <?php
if($_COOKIE['job'] == "Médecin"){
      ?>
<div class="ui negative message" style="margin-top: 7.5px;">
    <p>Si vous souhaitez d'apposer automatiquement le cachet et la signature sur l'ordonnance, téléchargez une copie de votre cachet et de votre signature, mais si vous ne le souhaitez pas, laissez les champs (Cachet/ Signature) vides.</p>
</div>

<?php
}
?>

<?php
include('db.php');
$name=$_COOKIE['name'];
$email = $_COOKIE['email'];
$sqld = "SELECT * FROM admins WHERE name='$name' AND email='$email'";
$resultd = $conn->query($sqld);

if ($resultd->num_rows > 0) {
  // output data of each row
  while($row = $resultd->fetch_assoc()) {
?>

<form class="ui form" method="POST" action="doprofile" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?php echo "$row[ID]"; ?>">
  <div class="field">
    <label>Prenom(s)/ <?php if("$row[job]" == "Infirmier"){echo"Médecin";}else{echo"Nom";} ?></label>
    <div class="two fields">
      <div class="field">
<input readonly type="text" required value="<?php echo "$row[name]"; ?>" name="name" placeholder="Prenom(s) <?php if("$row[job]" == "Infirmier"){echo "/ Nom";} ?>">
      </div>
      <div class="field">
<?php
if("$row[job]" == "Infirmier"){
?>
<input type="text" readonly required value="<?php echo "$row[fn]"; ?>" name="fn" placeholder="Médecin">
<?php
}else{
?>
<input readonly type="text" required value="<?php echo "$row[fn]"; ?>" name="fn" placeholder="Nom">
<?php
}
?>
      </div>
    </div>
  </div>



  <div class="field">
    <label>Sexe/ Profession</label>
    <div class="two fields">
      <div class="field">
<select required name="gender" class="ui search dropdown">
    <option disabled value="">--Sélectionner--</option>
    <option <?php if("$row[gender]" == "Mâle"){echo "selected";}else{echo "disabled";} ?> value="Mâle">Mâle</option>
    <option <?php if("$row[gender]" == "Femalle"){echo "selected";}else{echo "disabled";} ?> value="Femalle">Femalle</option>
  </select>
      </div>
      <div class="field">
<select readonly required name="job" class="ui search dropdown">
    <option disabled value="">--Sélectionner--</option>
    <?php
if($_COOKIE["job"] == "Admin"){
  ?>
<option selected value="Admin">Admin</option>
  <?php
}
    ?>
    <option <?php if("$row[job]" == "Médecin"){echo "selected";}else{echo "disabled";} ?> value="Médecin">Médecin</option>
    <option <?php if("$row[job]" == "Pharmacien"){echo "selected";}else{echo "disabled";} ?> value="Pharmacien">Pharmacien</option>
    <option <?php if("$row[job]" == "Infirmier"){echo "selected";}else{echo "disabled";} ?> value="Infirmier">Infirmier</option>
  </select>
      </div>
    </div>
  </div>

  <div class="field">
    <label><?php if($_COOKIE['job'] == "Médecin"){ ?>Spécialité/ <?php } ?> Adresse/ Wilaya/ Groupe sanguin</label>
    <div class="<?php if($_COOKIE['job'] == "Médecin"){ ?>four<?php }else{?>three<?php } ?> fields">
      <?php if($_COOKIE['job'] == "Médecin"){ ?>
      <div class="field">
<input type="text" required value="<?php echo "$row[description]"; ?>" readonly name="description" placeholder="Spécialité">
      </div>
      <?php
    }
    ?>
    <div class="field">
<input type="text" required value="<?php echo "$row[address]"; ?>" name="address" placeholder="Adresse">
      </div>
      <div class="field">
<select name="wilaya" required class="ui search dropdown">
  <option disabled value="">--Sélectionner--</option>
  <option value="<?php echo "$row[wilaya]"; ?>"><?php echo "$row[wilaya]"; ?></option>
</select>
      </div>
       <div class="field">
<select name="groupage" class="ui search dropdown">
    <option disabled value="">--Sélectionner--</option>
    <option <?php if("$row[groupage]" == "O+"){echo "selected";}else{echo "disabled";} ?> value="O+">O+</option>
    <option <?php if("$row[groupage]" == "O-"){echo "selected";}else{echo "disabled";} ?> value="O-">O-</option>
    <option <?php if("$row[groupage]" == "A+"){echo "selected";}else{echo "disabled";} ?> value="A+">A+</option>
    <option <?php if("$row[groupage]" == "A-"){echo "selected";}else{echo "disabled";} ?> value="A-">A-</option>
    <option <?php if("$row[groupage]" == "B+"){echo "selected";}else{echo "disabled";} ?> value="B+">B+</option>
    <option <?php if("$row[groupage]" == "B-"){echo "selected";}else{echo "disabled";} ?> value="B-">B-</option>
    <option <?php if("$row[groupage]" == "AB+"){echo "selected";}else{echo "disabled";} ?> value="AB+">AB+</option>
    <option <?php if("$row[groupage]" == "AB-"){echo "selected";}else{echo "disabled";} ?> value="AB-">AB-</option>
  </select>
      </div>
    </div>
  </div>

  <div class="field">
    <label>Date de naissance/ Adresse e-mail</label>
    <div class="two fields">
      <div class="field">
<input readonly type="date" required value="<?php echo "$row[dob]"; ?>" name="dob" placeholder="Date de naissance">
      </div>
      <div class="field">
<input type="email" required value="<?php echo "$row[email]"; ?>" name="email" placeholder="Adresse e-mail">
      </div>
    </div>
  </div>



  <div class="field">
    <label>Numéro de téléphone<?php
if($_COOKIE['job'] == "Médecin"){
      ?>/ Cachet <img src="<?php if("$row[signature]" != ""){ echo "$row[seal]"; }else{ echo "img/no.jpg"; } ?>" id="sealimg" style="margin-left: 2.5px;" width="25" height="25"><?php } ?></label>
      <?php
if($_COOKIE['job'] == "Médecin"){
      ?>
    <div class="two fields">
      <?php
    }
    ?>
      <div class="field">
<input type="tel" required value="<?php echo "$row[pn]"; ?>" name="pn" placeholder="Numéro de téléphone">
      </div>
       <?php
if($_COOKIE['job'] == "Médecin"){
      ?>
      <div class="field">
<div class="ui action input">
<input type="file" id="seal" accept="image/*" placeholder="Cachet">
<button type="button" onclick="sealdel()" class="ui button icon red"><i class="trash icon"></i></button>
</div>
<input type="hidden" value="<?php echo "$row[seal]"; ?>" id="sealto" name="seal">
      </div>
    <?php
  }
if($_COOKIE['job'] == "Médecin"){
      ?>
    </div>
    <?php
  }
  ?>
  </div>



  <div class="field">
    <label> <?php
if($_COOKIE['job'] == "Médecin"){
      ?>Signature <img src="<?php if("$row[signature]" != ""){ echo "$row[signature]"; }else{ echo "img/no.jpg"; } ?>" id="signatureimg" style="margin-left: 2.5px;" width="25" height="25">/ <?php } ?>Mot de passe</label>
      <?php
if($_COOKIE['job'] == "Médecin"){
      ?>
    <div class="two fields">
      <div class="field">
<div class="ui action input">
<input type="file" id="signature" accept="image/*" placeholder="Signature">
<button type="button" onclick="signaturedel()" class="ui button icon red"><i class="trash icon"></i></button>
</div>
<input type="hidden" value="<?php echo "$row[signature]"; ?>" id="signatureto" name="signature">
      </div>
      <?php
}
?>
      <div class="field">
 <input required value="" name="password" type="password" Placeholder="Mot de passe">
      </div>
     <?php
if($_COOKIE['job'] == "Médecin"){
      ?>
    </div>
    <?php
  }
  ?>
  </div>



  <div class="field" style="margin-bottom: 10px !important;">
<button type="submit" class="ui labeled icon button green inverted right" style="width: 100% !important;"><i class="save icon"></i> Enregistrer</button>
  </div>
</form>

<?php
}}else{
  echo "Aucun informations...";
}
$conn->close();
?>

      <a class="ui red ribbon label">Mot de passe</a>
      
<form class="ui form" method="POST" action="dopassword" enctype="multipart/form-data">

  <div class="field">
    <label>Mot de passe actuel</label>
      <div class="field">
<input type="password" required name="actualpassword" placeholder="Mot de passe actuel" maxlength="16">
      </div>
      <label>Nouveau mot de passe</label>
      <div class="field">
<input type="password" required name="newpassword" placeholder="Nouveau mot de passe" maxlength="16">
      </div>
      <label>Confirmez le nouveau mot de passe</label>
      <div class="field">
<input type="password" required name="newnewpassword" placeholder="Confirmez le nouveau mot de passe" maxlength="16">
      </div>
    </div>
 

  <div class="field" style="margin-bottom: 10px !important;">
<button type="submit" class="ui labeled icon button green inverted right" style="width: 100% !important;"><i class="save icon"></i> Enregistrer</button>
  </div>
</form>

    </div>
  </div>
</div>


<script type="text/javascript">
function sealdel(){
document.getElementById('sealimg').setAttribute('src', 'img/no.jpg');
document.getElementById('sealto').value = "";
}

function signaturedel() {
document.getElementById('signatureimg').setAttribute('src', 'img/no.jpg');
document.getElementById('signatureto').value = "";
}
</script>


<script type="text/javascript" src="admin.js"></script>
</body>
</html>
