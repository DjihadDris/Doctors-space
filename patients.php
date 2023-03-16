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
  <title>Les patients</title>
  <!-- Font Awesome 
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />-->
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
    <link rel="stylesheet" type="text/css" href="ui/semantic.min.css">
    <link rel="stylesheet" href="admin.css">
    <link rel="shortcut icon" type="text/css" href="square.webp">
    <link rel="stylesheet" href="css/alertify.min.css">
    <link rel="stylesheet" href="css/themes/default.min.css">
    <script src="alertify.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.semanticui.min.css">
    <script src="ui/semantic.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script scr="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/semantic.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.semanticui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsbarcode/3.11.3/JsBarcode.all.min.js"></script>
<script language="javascript" type="text/javascript">
function printinfo() {
var divElements = document.getElementById('printable').innerHTML;
var oldPage = document.body.innerHTML;
document.body.innerHTML = divElements;
document.getElementById('margindetails').setAttribute('style', 'text-align: left; margin-left: 35px; margin-top: 25px; font-size: 20px;');
document.getElementById('marginphoto').setAttribute('style', 'border: 1px solid black; text-align: center; width: 125px; height: 175px; position: absolute; margin-left: 375px; margin-top: -145px;vertical-align: middle;line-height: 175px;');
/*document.getElementById('td').setAttribute('style', 'position: absolute;display: block;left: ;bottom: 74%');*/

window.print();
document.body.innerHTML = oldPage;
location.reload();
}
</script>
    <script>
alertify.defaults.glossary.title = 'Ministère de la Santé';
alertify.defaults.glossary.ok = 'Oui';
alertify.defaults.glossary.cancel = 'Non';
    </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>

</head>

<body onload="loader()">
  
  <?php
include('sidebar.php');
if(isset($_GET['false'])){
  if($_GET['false'] == "errordb"){
  echo "<script>alertify.alert('Erreur...');</script>";
  }
}elseif (isset($_GET['true'])){
  echo "<script>window.open('patientpdf?name=$_GET[name]&fn=$_GET[fn]&dob=$_GET[dob]&pn=$_GET[pn]&email=$_GET[email]&gender=$_GET[gender]&notes=$_GET[notes]&wilaya=$_GET[wilaya]&address=$_GET[address]&groupage=$_GET[groupage]&height=$_GET[height]&weight=$_GET[weight]&chronic=$_GET[chronic]&surgeries=$_GET[surgeries]&allergies=$_GET[allergies]&mpi=$_GET[mpi]&password=$_GET[password]&code=$_GET[code]');</script>";
}
  ?>



<!-- Edit Modal -->
<div class="ui modal edit mini" id="editmodal">
  <i class="close icon"></i>
  <div class="header">
   <h3><i class="edit icon"></i> Modifier le dossier de patient</h3>
  </div>
  <div class="content">
<form class="ui form">
<input type="hidden" id="id">

<div class="field">
  <label>Prenom(s)</label>
  <input <?php if($_COOKIE['job'] <> "Admin"){echo "readonly";} ?> required id="name" type="text" >
</div>
<div class="field">
  <label>Nom</label>
  <input <?php if($_COOKIE['job'] <> "Admin"){echo "readonly";} ?> required id="fn" type="text">
</div>
<div class="field">
  <label>Sexe</label>
  <select required id="gender" class="ui search dropdown">
    <option value="">--Sélectionner--</option>
    <option id="male" value="Mâle">Mâle</option>
    <option id="female" value="Femalle">Femalle</option>
  </select>
</div>
<div class="field">
  <label>Date de naissance</label>
  <input <?php if($_COOKIE['job'] <> "Admin"){echo "readonly";} ?> required id="dob"type="date">
  </div>
<div class="field">
  <label>Adresse e-mail</label>
  <input required id="email" type="email">
</div>
<div class="field">
  <label>Numéro de téléphone</label>
  <input required id="pn" type="tel" maxlength="10">
  </div>
  <div <?php if($_COOKIE['job'] == "Admin"){ echo ""; }else{ echo "hidden"; } ?> class="field">
  <label>Le Médecin/ Pharmacien</label>
  <select id="mpi" class="ui search dropdown">
    <option value="">--Sélectionner--</option>
    
  </select>
  </div>
<div class="field">
  <label>Wilaya</label>
<select id="wilaya" class="ui search dropdown">
<?php include('wilayas.php'); ?>
</select>
</div>
<div class="field">
<label>Adresse</label>
<input id="address" type="text">
</div>
<div class="field">
  <label>Groupe sanguin</label>
<select id="groupage" class="ui search dropdown">
    <option value="">--Sélectionner--</option>
    <option value="O+">O+</option>
    <option value="O-">O-</option>
    <option value="A+">A+</option>
    <option value="A-">A-</option>
    <option value="B+">B+</option>
    <option value="B-">B-</option>
    <option value="AB+">AB+</option>
    <option value="AB-">AB-</option>
  </select>
</div>

  <div <?php if($_COOKIE['job'] == "Pharmacien"){echo "style='display: none !important;'";} ?> class="field">
  <label>La taille</label>
  <div class="ui right labeled input">
  <input required id="height" type="number" max="250" maxlength="3">
  <div class="ui basic label">
    <span>Cm</span>
  </div>
</div>
  </div>

  <div <?php if($_COOKIE['job'] == "Pharmacien"){echo "style='display: none !important;'";} ?> class="field">
  <label>Le poids</label>
  <div class="ui right labeled input">
  <input required id="weight" type="number" max="500" maxlength="3">
  <div class="ui basic label">
    <span>Kg</span>
  </div>
</div>
  </div>

  <div <?php if($_COOKIE['job'] == "Pharmacien"){echo "style='display: none !important;'";} ?> class="field">
  <label>Maladies chroniques</label>
  <input required id="chronic" type="text">
  </div>

  <div <?php if($_COOKIE['job'] == "Pharmacien"){echo "style='display: none !important;'";} ?> class="field">
  <label>Opérations chirurgicales</label>
  <input required id="surgeries" type="text">
  </div>

  <div <?php if($_COOKIE['job'] == "Pharmacien"){echo "style='display: none !important;'";} ?> class="field">
  <label>Allergies</label>
  <input required id="allergies" type="text">
  </div>

  <div <?php if($_COOKIE['job'] == "Pharmacien"){echo "style='display: none !important;'";} ?> class="field">
  <label>Remarques</label>
  <input required id="notes" type="text">
  </div>
  <?php
if($_COOKIE['job'] == "Admin"){
  ?>
<div class="field">
  <label>Mot de passe</label>
  <input required id="password" type="text">
</div>
<?php 
}
?>
</form>
  </div>
  <div class="actions">
    <center>
    <div class="ui buttons" style="width: 100% !important;">
      <button class="ui positive left labeled icon button" id="saveinfo"><i class="save icon"></i>
      Enregistrer</button>
  <div class="or" data-text="ou"></div>
  <button class="ui negative right labeled icon button"><i class="close icon"></i> Fermer</button>
</div>
</center>
  </div>
</div>



<!-- Print Modal -->
<div class="ui modal print" id="printmodal">
  <i class="close icon"></i>
  <div class="header">
   <h3><i class="print icon"></i> Imprimer la carte sanitaire du patient</h3>
  </div>
  <div class="content" id="printable" style="text-align: center;">
    <center>
    <div style="border: 2.5px solid black; width: 75%; border-style: dashed;">
      <img src="ms.jpg" width="100%" height="30%" style="position: relative;">
      <h3 style="margin-top: -5px !important;">Carte sanitaire du patient</h3>
      <div id="margindetails" style="text-align: left; margin-left: 72.5px; margin-top: 25px; font-size: 20px;">
        <span id="printnom">Nom:</span>
        <br>
        <span id="printprenom">Prenom(s):</span>
        <br>
        <span id="printddn">Date de naissance:</span>
        <br>
        <span id="printsexe">Sexe:</span>
        <!--<br>
        <span id="printstatut">Statut:</span>
        <br>
        <span id="printndt">Numéro de téléphone:</span>
        <br>
        <span id="printmdp">Mot de passe:</span>-->
        <br>
        <span id="printmpi">Le Médecin/ Pharmacien:</span>
        <!--<br>
        <span id="printnotes">Remarques:</span>-->
        <br>
        <span id="printemail">Adresse e-mail:</span>
        </div>
        <div id="marginphoto" style="border: 1px solid black; text-align: center; width: 150px; height: 200px; position: absolute; margin-left: 405px; margin-top: -185px;vertical-align: middle;line-height: 200px;">
          <span>Photo</span>
        </div>
        <br>
        <!--<span id="td" style="position: absolute;margin-bottom: 0px;display: block;right: 15.5%;bottom: 17.5%;"><?php echo date("d-m-Y"); ?></span>-->
        <svg class="barcode" id="code"></svg>
    </div>
  </center>
  </div>
  <div class="actions">
    <center>
    <div class="ui buttons" style="width: 100% !important;">
      <button class="ui positive left labeled icon button" onclick="printinfo()"><i class="print icon"></i>
      Imprimer</button>
  <div class="or" data-text="ou"></div>
  <button class="ui blue button" onclick="getPdf()">
      Enregistrer-sous le code à barre</button>
  <div class="or" data-text="ou"></div>
    <button class="ui negative right labeled icon button"><i class="close icon"></i> Fermer</button>
</div>
</center>

  </div>
</div>

<!-- Add modal -->
<div class="ui basic modal">
  <i class="close icon"></i>
  <div class="header">
   <h3><i class="plus icon"></i> Ajouter un dossier</h3>
  </div>
  <div class="content">
    
<div class="ui placeholder segment">
  <div class="ui dimmer" id="patientdimmer">
    <div class="ui text loader">Patientez...</div>
  </div>
  <div class="ui two column very relaxed stackable grid">
    <div <?php if($_COOKIE['job'] == "Pharmacien"){echo "style='display: none !important;'";} ?> class="column">
      <form class="ui form" method="POST" action="dopatient" enctype="multipart/form-data">
        <div class="field">
 <div class="ui negative message">
    <p>Le mot de passe sera généré et envoyé à l'adresse e-mail du patient.</p>
</div>
        </div>
        <div class="field">
<label>Prenom(s) <span style="color: red;">*</span></label>
  <input required name="name" type="text" placeholder="Prenom">
  <label>Nom <span style="color: red;">*</span></label>
  <input required name="fn" type="text" placeholder="Nom">
        </div>
        <div class="field">
<label>Sexe <span style="color: red;">*</span></label>
  <select required name="gender" class="ui dropdown search">
    <option value="">--Sélectionner--</option>
    <option value="Mâle">Mâle</option>
    <option value="Femalle">Femalle</option>
  </select>
  <label>Date de naissance <span style="color: red;">*</span></label>
  <input required name="dob" type="date" placeholder="Date de naissance">
        </div>
        <div class="field">
<label>Adresse e-mail</label>
  <input name="email" type="email" placeholder="Adresse e-mail">
  <label>Numéro de téléphone <span style="color: red;">*</span></label>
  <input required name="pn" type="tel" placeholder="Numéro de téléphone" maxlength="10">
        </div>
<div class="field">
  <label>Wilaya <span style="color: red;">*</span></label>
<select name="wilaya" class="ui search dropdown" required>
<?php include('wilayas.php'); ?>
</select>
<label>Adresse <span style="color: red;">*</span></label>
<input name="address" type="text" placeholder="Adresse" required>
</div>
<div class="field">
  <label>Groupe sanguin</label>
<select name="groupage" class="ui search dropdown">
    <option value="">--Sélectionner--</option>
    <option value="O+">O+</option>
    <option value="O-">O-</option>
    <option value="A+">A+</option>
    <option value="A-">A-</option>
    <option value="B+">B+</option>
    <option value="B-">B-</option>
    <option value="AB+">AB+</option>
    <option value="AB-">AB-</option>
  </select>

<label>La taille</label>
<div class="ui right labeled input">
  <input name="height" type="number" placeholder="La taille">
  <div class="ui basic label">
    <span>Cm</span>
  </div>
</div>
</div>

<div class="field">

<label>Le poids</label>
<div class="ui right labeled input">
  <input name="weight" type="number" placeholder="Le poids">
  <div class="ui basic label">
    <span>Kg</span>
  </div>
</div>

<label>Maladies chroniques</label>
  <input name="chronic" type="text" placeholder="Maladies chroniques">
</div>

  <div class="field">

<label>Opérations chirurgicales</label>
  <input name="surgeries" type="text" placeholder="Opérations chirurgicales">

    <label>Allergies</label>
  <input name="allergies" type="text" placeholder="Allergies">
        </div>

<div class="field">
    <label style="display: <?php if($_COOKIE['job'] == "Admin"){ echo ""; }else{ echo "none"; } ?>;">Le Médecin/ Pharmacien <span style="color: red;">*</span></label>
  <select style="display: <?php if($_COOKIE['job'] == "Admin"){ echo ""; }else{ echo "none"; } ?>;" id="mpis" required name="mpi" class="ui dropdown search">
  <option value="">--Sélectionner--</option>
  </select>

  <label>Remarques</label>
  <input name="notes" type="text" placeholder="Remarques">
</div>

      <!--  <div class="field">
  <label>Mot de passe</label>
  <input required placeholder="Mot de passe" name="password" type="text">
        </div>-->
        <button type="submit" class="ui blue inverted labeled icon button" style="width: 100% !important;"><i class="plus icon"></i> Ajouter</button>
      </form>
    </div>
    <div class="middle aligned column">
      
<div class="ui form">

  <div <?php if($_COOKIE['job'] == "Admin"){}else{echo "hidden";} ?> class="field">
    <label>Le Médecin/ Pharmacien <span style="color: red;">*</span></label>
          <select id="mpiname" class="ui search dropdown">
    <option value="">--Sélectionner--</option>
    
  </select>
</div>
<div class="field">
<label>Code du patient</label>
          <div class="ui left icon input">
            <input minlength="10" maxlength="10" type="text" placeholder="Le code du patient" id="patientcode" onkeyup="addpatient()">
            <i class="keyboard icon"></i>
          </div>

</div>
</div>

    </div>
  </div>
  <div <?php if($_COOKIE['job'] == "Pharmacien"){echo "style='display: none !important;'";} ?> class="ui vertical divider">
    Ou
  </div>
</div>

  </div>
  <div class="actions">
    <center>
    <div class="ui buttons" style="width: 100% !important;">
      <!--<button class="ui labeled left icon button green inverted">
  <i class="plus icon"></i>
  Ajouter
 </button>
  <div class="or" data-text="ou"></div>-->
  <button class="ui labeled icon button negative">
    <i class="close icon"></i>
  Fermer
 </button>
</div>
</center>
  </div>
</div>


<div class="ui large breadcrumb">
<a href="patientschoose" class="ui blue tag label">Gestion des patients</a>
<a class="ui green tag label">Les patients</a>
</div>


<div class="ui top attached tabular menu">
<div class="active item" data-tab="first"><i class="folder icon inverted green circular"></i> Les dossiers
<div style="display: none;" class="ui green label" id="num1"></div></div>
<div class="item" data-tab="second"><i class="trash icon inverted green circular"></i> Les dossiers supprimés
<div style="display: none;" class="ui red label" id="num2"></div></div>
</div>
  
<div class="ui bottom attached active tab segment" data-tab="first">
<?php
if($_COOKIE['job'] <> "Pharmacien"){
?>
<div style="float: right; position: relative;">
  <button class="ui labeled icon button green inverted" onclick="AddPatient()">
  <i class="plus icon"></i>
  Ajouter un dossier
 </button>
</div>
<br><br>
<script type="text/javascript">
function AddPatient(){
$('.ui.basic.modal').modal('show');
}
</script>
<?php
}
?>
<div class="ui negative message">
    <p>Vous pouvez 'Activer/ Désactiver' le compte du patient en double-cliquant sur le 'statut'.</p>
</div>

<table class="ui celled striped selectable table" id="tabledisplay" style="width:100%">
  <thead>
    <tr>
      <th>#</th>
      <th>Photo</th>
      <th>Prenom(s)</th>
      <th>Nom</th>
      <th>Date de naissance</th>
      <th>Sexe</th>
      <th>Adresse e-mail</th>
      <th>Numéro de téléphone</th>
      <?php
      if($_COOKIE['job'] == "Admin"){
      ?>
      <th>Médecin/ Pharmacien</th>
      <?php
      }
      ?>
      <th>Wilaya</th>
      <th>Adresse</th>
      <th>Groupe sanguin</th>
      <th>La taille</th>
      <th>Le poids</th>
      <th>Maladies chroniques</th>
      <th>Opérations chirurgicales</th>
      <th>Allergies</th>
      <th>Remarques</th>
      <th>Statut</th>
      <th>Code</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody id="table">

  </tbody>
</table>
        </div>
        <div class="ui bottom attached tab segment" data-tab="second">

<div class="ui negative message">
    <p>Les dossiers des patients supprimés seront définitivement supprimés après 30 jours.</p>
</div>

<table id="table2display" class="ui celled striped selectable table" style="width:100%;">
  <thead>
    <tr>
      <th>#</th>
      <th>Photo</th>
      <th>Prenom(s)</th>
      <th>Nom</th>
      <th>Date de naissance</th>
      <th>Sexe</th>
      <th>Adresse e-mail</th>
      <th>Numéro de téléphone</th>
      <?php
      if($_COOKIE['job'] == "Admin"){
      ?>
      <th>Médecin/ Pharmacien</th>
      <?php
      }
      ?>
      <th>Wilaya</th>
      <th>Adresse</th>
      <th>Groupe sanguin</th>
      <th>La taille</th>
      <th>Le poids</th>
      <th>Maladies chroniques</th>
      <th>Opérations chirurgicales</th>
      <th>Allergies</th>
      <th>Remarques</th>
      <th>Code</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody id="table2">

  </tbody>
</table>

        </div>


<script type="text/javascript" src="admin.js"></script>
<script src="svg-to-png-main/main.js"></script>
<script>
  function getPdf(){
  svgToPngLib.svgToPng(document.querySelector('#code')).subscribe(function (value) {
  var name = document.getElementById('printprenom').innerHTML.substring(11);
  var doc = new jsPDF('l', 'in', [1.49, 0.82]);
  /*var doc = new jsPDF('p', 'pt', 'a4');*/
  var imgData = value;
  doc.addImage(imgData, 'PNG', 0.05, 0, -900, -700);
  doc.save('Barcode - '+name+'.pdf');
  });
}
</script>
<script>
$('.menu .item').tab();
  function addpatient(){
    var code = document.getElementById('patientcode').value;
    var mpiname = document.getElementById('mpiname').value;
    if(code.length == 10){
document.getElementById('patientdimmer').setAttribute('class', 'ui dimmer active');
$.ajax({
        url: "getpatient.php",
        type: "POST",
        data: {
          code: code,
          mpi: mpiname
        },
        cache: false,
        success: function(dataResult){
          if(dataResult=='200'){
alertify.success("Le dossier a été ajouté avec succès");
$('#tabledisplay').DataTable().ajax.reload(null, false).draw(false);  
$('#table2display').DataTable().ajax.reload(null, false).draw(false);   
$('.ui.modal.basic').modal('hide');   
document.getElementById('patientdimmer').setAttribute('class', 'ui dimmer'); 
document.getElementById('patientcode').value = "";    
          }
          else if(dataResult=='201'){
            alertify.error('Erreur...');
            document.getElementById('patientdimmer').setAttribute('class', 'ui dimmer');
          }else if(dataResult=='202'){
            alertify.error("Il n'y a pas de dossier avec ce code");
            document.getElementById('patientdimmer').setAttribute('class', 'ui dimmer');
          }else{
            alertify.error("Veuillez sélectionner le médecin/ pharmacien");
            document.getElementById('patientdimmer').setAttribute('class', 'ui dimmer');
          }
          
        }
      });
    }
  }
  function loader(){
  /*$.ajax({
    url: "ajaxpatients.php",
    type: "POST",
    cache: false,
    success: function(data){
      $('#table').html(data); */
   var table = $('#tabledisplay').DataTable({
    columnDefs: [
            {
                target: 0,
                visible: false,
                searchable: false
            },
            <?php if($_COOKIE['job'] == "Admin"){ ?>
            {
                target: 19,
                visible: false,
                searchable: true
            }
<?php }else{ ?>
            {
                target: 18,
                visible: false,
                searchable: true
            }
<?php } ?>
    ],
    ordering: true,
    searching: true,
    paging: true,
    processing: true,
    destroy: true,
    scrollX: true,
    lengthChange: true,
    responsive: true,
        "language": {
    "decimal":        "",
    "emptyTable":     "Aucun dossier disponible",
    "info":           "Affichage de _START_ à _END_ dossiers sur _TOTAL_",
    "infoEmpty":      "Affichage de 0 à 0 sur 0 dossiers",
    "infoFiltered":   "(filtré à partir de _MAX_ dossiers au total)",
    "infoPostFix":    "",
    "thousands":      ",",
    "lengthMenu":     "Afficher les dossiers du _MENU_",
    "loadingRecords": "Chargement...",
    "processing":     "",
    "search":         "Chercher:",
    "zeroRecords":    "Aucun dossiers correspondants trouvés",
    "paginate": {
        "first":      "Première",
        "last":       "Dernière",
        "next":       "Prochaine",
        "previous":   "Précédente"
    },
    "aria": {
        "sortAscending":  ": activer pour trier les colonnes par ordre croissant",
        "sortDescending": ": activer pour trier les colonnes par ordre décroissant"
    }
        },
        "ajax": {
"url": "ajaxpatients.php",
"dataSrc": ""
        },
        "columns": [
{"ID": "#"},
{"photo": "Photo"},
{"name": "Prenom(s)"},
{"fn": "Nom"},
{"dob": "Date de naissance"},
{"gender": "Sexe"},
{"email": "Adresse e-mail"},
{"pn": "Numéro de téléphone"},
<?php if($_COOKIE['job'] == "Admin"){ ?>
{"mpi": "Médecin/ Pharmacien"},
<?php } ?>
{"wilaya": "Wilaya"},
{"address": "Adresse"},
{"groupage": "Groupe sanguin"},
{"height": "La taille"},
{"weight": "Le poids"},
{"chronic": "Maladies chroniques"},
{"surgeries": "Opérations chirurgicales"},
{"allergies": "Allergies"},
{"notes": "Maladies/ Remarques"},
{"status": "Statut"},
{"code": "Code"},
{"actions": "Actions"}

        ],
         initComplete: function(settings, json) {
  var info = table.page.info();
  var nbr = info.recordsDisplay;
  $("#num1").html(nbr);  
  document.getElementById('num1').style.display = "block";
}
          });

table.on('dblclick', '.acdesac', function (e) {
  var tr = $(this).closest('tr');
  var data = table.row(tr).data();
            <?php
if($_COOKIE['job'] == "Admin"){
     ?> 
  var stat = data[18].substring(66, 72);
  <?php
}else{
  ?>
 var stat = data[17].substring(66, 72);
  <?php
}
  ?>
  if(stat == "Activé"){
var acdesac = "Désactivé";
  }else{
var acdesac = "Activé";
  }

$.ajax({
        url: "acdesac.php",
        type: "POST",
        data: {
          name: data[2],
          email: data[6],
          change: acdesac,
          from: 'patients'
        },
        cache: false,
        success: function(dataResult){
          if(dataResult=='200'){
                        $('#tabledisplay').DataTable().ajax.reload(null, false).draw(false);
                        $('#table2display').DataTable().ajax.reload(null, false).draw(false);   
            if(stat == "Activé"){
alertify.success("Le compte a été désactivé avec succès");
            }else{
alertify.success("Le compte a été activé avec succès");
            }         
          }
          else{
            alertify.error('Erreur...');
          }
          
        }
      });
  
});

table.on('click', '.edit', function (e) {
  var tr = $(this).closest('tr');
  var data = table.row(tr).data();

      $('.ui.modal.edit').modal('show');
      $('#name').val(data[2]);
      $('#fn').val(data[3]);
      $('#email').val(data[6]);
      $('#pn').val(data[7]);
      <?php
if($_COOKIE['job'] == "Admin"){
     ?> 
      $('#wilaya').val(data[9]);
      $('#address').val(data[10]);
      $('#groupage').val(data[11]);
      $('#height').val(data[12]);
      $('#weight').val(data[13]);
      $('#chronic').val(data[14]);
      $('#surgeries').val(data[15]);
      $('#allergies').val(data[16]);
      $('#notes').val(data[17]);
            <?php
}else{
?>
$('#wilaya').val(data[8]);
$('#address').val(data[9]);
$('#groupage').val(data[10]);
$('#height').val(data[11]);
$('#weight').val(data[12]);
$('#chronic').val(data[13]);
$('#surgeries').val(data[14]);
$('#allergies').val(data[15]);
$('#notes').val(data[16]);
<?php
}
      ?>
      $('#gender').val(data[5]);
      $('#dob').val(data[4]);
      <?php
if($_COOKIE['job'] == "Admin"){
     ?> 
      $('#mpi').val(data[8]);
      <?php
}?>
      $('#id').val(data[0]);

});

table.on('click', '.print', function (e) {
  var tr = $(this).closest('tr');
  var data = table.row(tr).data();
  <?php
if($_COOKIE['job'] == "Admin"){
  ?>
var inthis = data[18].substring(66, 72);
<?php
}else{
?>
var inthis = data[17].substring(66, 72);
<?php
}
?>
  if(inthis == "Activé"){
var stats = "Activé";
  }else{
var stats = "Désactivé";
  }
      $('.ui.modal.print').modal('show');
      $('#printprenom').html("Prenom(s):"+" "+data[2]);
      $('#printnom').html("Nom:"+" "+data[3]);
      $('#printsexe').html("Sexe:"+" "+data[5]);
      $('#printddn').html("Date de naissance:"+" "+data[4]);
      $('#printstatut').html("Statut:"+" "+stats);
           <?php
if($_COOKIE['job'] == "Admin"){
     ?> 
      $('#printmpi').html("Le Médecin/ Pharmacien:"+" "+data[8]);
      <?php
}elseif($_COOKIE['job'] == "Infirmier"){
include('db.php');
$sqls = "SELECT fn FROM admins WHERE job='Infirmier' AND name='$_COOKIE[name]'";
$results = $conn->query($sqls);

if ($results->num_rows > 0) {
  // output data of each row
  while($rows = $results->fetch_assoc()) {

$medecin = "$rows[fn]";
?>
$('#printmpi').html("Le Médecin/ Pharmacien:"+" "+"<?php echo $medecin; ?>");
<?php
  }
} else {
?>
$('#printmpi').html("Le Médecin/ Pharmacien:"+" "+"");
<?php
}
}else{
?>
$('#printmpi').html("Le Médecin/ Pharmacien:"+" "+"<?php echo $_COOKIE['name']; ?>");
<?php
}
      ?>
      $('#printemail').html("Adresse e-mail:"+" "+data[6]);
                  <?php
if($_COOKIE['job'] == "Admin"){
            ?>
      /*$('#code').html(data[11]);*/
      JsBarcode("#code", data[19]);
      <?php
}else{
?>
JsBarcode("#code", data[18]);
/* $('#code').html(data[10]);*/
<?php
}
      ?>

});

table.on('click', '.delete', function (e) {
  var tr = $(this).closest('tr');
  var data = table.row(tr).data();

  alertify.confirm("Voulez-vous vraiment supprimer ce dossier:"+" "+data[2]+" "+"("+data[6]+")"+"?",
  function(){
$.ajax({
        url: "ajaxpatientsdelete.php",
        type: "POST",
        data: {
          name: data[2],
          email: data[6]
        },
        cache: false,
        success: function(dataResult){
          if(dataResult=='200'){
            alertify.success('Le dossier a été supprimé avec succès');
           $('#tabledisplay').DataTable().ajax.reload(null, false).draw(false);  
           $('#table2display').DataTable().ajax.reload(null, false).draw(false);     
          }
          else{
            alertify.error('Erreur...');
          }
          
        }
      });
  },
  function(){
    alertify.error('Cancel');
  });

});

   /* }
  });

$.ajax({
    url: "ajaxpatientsdel.php",
    type: "POST",
    cache: false,
    success: function(data){
      $('#table2').html(data); */
    var table2 = $('#table2display').DataTable({
    columnDefs: [
            {
                target: 0,
                visible: false,
                searchable: false
            },
            <?php
if($_COOKIE['job'] == "Admin"){
            ?>
            {
                target: 18,
                visible: false,
                searchable: true
            }
            <?php
}else{
?>
            {
                target: 17,
                visible: false,
                searchable: true
            }
<?php
}
            ?>
    ],
    ordering: true,
    searching: true,
    paging: true,
    scrollX: true,
    processing: true,
    destroy: true,
    lengthChange: true,
    responsive: true,
        "language": {
    "decimal":        "",
    "emptyTable":     "Aucun dossier disponible",
    "info":           "Affichage de _START_ à _END_ dossiers sur _TOTAL_",
    "infoEmpty":      "Affichage de 0 à 0 sur 0 dossiers",
    "infoFiltered":   "(filtré à partir de _MAX_ dossiers au total)",
    "infoPostFix":    "",
    "thousands":      ",",
    "lengthMenu":     "Afficher les dossiers du _MENU_",
    "loadingRecords": "Chargement...",
    "processing":     "",
    "search":         "Chercher:",
    "zeroRecords":    "Aucun dossiers correspondants trouvés",
    "paginate": {
        "first":      "Première",
        "last":       "Dernière",
        "next":       "Prochaine",
        "previous":   "Précédente"
    },
    "aria": {
        "sortAscending":  ": activer pour trier les colonnes par ordre croissant",
        "sortDescending": ": activer pour trier les colonnes par ordre décroissant"
    }
        },
        "ajax": {
"url": "ajaxpatientsdel.php",
"dataSrc": ""
        },
        "columns": [
{"ID": "#"},
{"photo": "Photo"},
{"name": "Prenom(s)"},
{"fn": "Nom"},
{"dob": "Date de naissance"},
{"gender": "Sexe"},
{"email": "Adresse e-mail"},
{"pn": "Numéro de téléphone"},
<?php if($_COOKIE['job'] == "Admin"){ ?>
{"mpi": "Médecin/ Pharmacien"},
<?php } ?>
{"wilaya": "Wilaya"},
{"address": "Adresse"},
{"groupage": "Groupe sanguin"},
{"height": "La taille"},
{"weight": "Le poids"},
{"chronic": "Maladies chroniques"},
{"surgeries": "Opérations chirurgicales"},
{"allergies": "Allergies"},
{"notes": "Maladies/ Remarques"},
{"code": "Code"},
{"actions": "Actions"}

        ],
         initComplete: function(settings, json) {
  var info = table2.page.info();
  var nbr = info.recordsDisplay;
  $("#num2").html(nbr);  
  document.getElementById('num2').style.display = "block";
}
          });
table2.on('click', '.restore', function (e) {
  var tr = $(this).closest('tr');
  var data = table2.row(tr).data();
    $.ajax({
        url: "ajaxpatientsdeldelete.php",
        type: "POST",
        data: {
          name: data[2],
          email: data[6]    
        },
        cache: false,
        success: function(dataResult){
          if(dataResult=='200'){
           $('#table2display').DataTable().ajax.reload(null, false).draw(false);   
           $('#tabledisplay').DataTable().ajax.reload(null, false).draw(false);   
alertify.success("Le dossier a été restauré avec succès");        
          }
          else{
            alertify.error('Erreur...');
          }
          
        }
      });
  });
   /* }
  });*/

  $.ajax({
    url: "userslist.php",
    type: "POST",
    cache: false,
    success: function(data){
      <?php
if($_COOKIE['job'] == "Admin"){
      ?>
      $('#mpi').html(data); 
      $('#mpis').html(data); 
      $('#mpiname').html(data); 
      <?php
}else if($_COOKIE['job'] == "Médecin" OR $_COOKIE['job'] == "Pharmacien"){
      ?>

$('#mpi').html("<option selected value='<?php echo $_COOKIE['name']; ?>'><?php echo $_COOKIE['name']; ?></option>"); 
$('#mpis').html("<option selected value='<?php echo $_COOKIE['name']; ?>'><?php echo $_COOKIE['name']; ?></option>"); 
      <?php
}else{
  include('db.php');
  $sql = "SELECT fn FROM admins WHERE job='Infirmier' AND name='$_COOKIE[name]'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
      ?>

$('#mpi').html("<option selected value='<?php echo "$row[fn]"; ?>'><?php echo "$row[fn]"; ?></option>"); 
$('#mpis').html("<option selected value='<?php echo "$row[fn]"; ?>'><?php echo "$row[fn]"; ?></option>"); 

      <?php
}}
$conn->close();
}
      ?>
    }
  });
}


/*function restore(na, em){
  $.ajax({
        url: "ajaxpatientsdeldelete.php",
        type: "POST",
        data: {
          name: na,
          email: em    
        },
        cache: false,
        success: function(dataResult){
          if(dataResult=='200'){
           $('#table2display').DataTable().ajax.reload(null, false).draw(false);   
           $('#tabledisplay').DataTable().ajax.reload(null, false).draw(false);   
alertify.success("Le dossier a été restauré avec succès");        
          }
          else{
            alertify.error('Erreur...');
          }
          
        }
      });
}*/

 /* function acdesac(namee, emaill, acdesac){
if(acdesac == "Activé"){
var edit = "Désactivé";
}else{
var edit = "Activé";
}
$.ajax({
        url: "acdesac.php",
        type: "POST",
        data: {
          name: namee,
          email: emaill,
          change: edit,
          from: 'patients'
        },
        cache: false,
        success: function(dataResult){
          if(dataResult=='200'){
                        $('#tabledisplay').DataTable().ajax.reload(null, false).draw(false);
            if(acdesac == "Activé"){
alertify.success("Le compte a été désactivé avec succès");
            }else{
alertify.success("Le compte a été activé avec succès");
            }         
          }
          else{
            alertify.error('Erreur...');
          }
          
        }
      });
}*/
/*function del(nam, emai){
  alertify.confirm("Voulez-vous vraiment supprimer ce dossier:"+" "+nam+" "+"("+emai+")"+"?",
  function(){
$.ajax({
        url: "ajaxpatientsdelete.php",
        type: "POST",
        data: {
          name: nam,
          email: emai
        },
        cache: false,
        success: function(dataResult){
          if(dataResult=='200'){
            alertify.success('Le dossier a été supprimé avec succès');
            loader.call();           
          }
          else{
            alertify.error('Erreur...');
          }
          
        }
      });
  },
  function(){
    alertify.error('Cancel');
  });
}*/


/*function showedit(id, name, fn, email, pn, password, notes, gender, dob, mpi){
      $('.ui.modal.edit').modal('show');
      $('#name').val(name);
      $('#fn').val(fn);
      $('#email').val(email);
      $('#pn').val(pn);
      $('#password').val(password);
      $('#notes').val(notes);
      $('#gender').val(gender);
      $('#dob').val(dob);
      $('#mpi').val(mpi);
      $('#id').val(id);
}*/

/*function showprint(namet, fnt, emailt, pnt, passwordt, notest, gendert, dobt, mpit, statust, codet){
      $('.ui.modal.print').modal('show');
      $('#printprenom').html("Prenom:"+" "+namet);
      $('#printnom').html("Nom:"+" "+fnt);
      $('#printsexe').html("Sexe:"+" "+gendert);
      $('#printddn').html("Date de naissance:"+" "+dobt);
      $('#printstatut').html("Statut:"+" "+statust);
      $('#printmpi').html("Le Médecin/ Pharmacien:"+" "+mpit);
      $('#printemail').html("Adresse e-mail:"+" "+emailt);
      $('#code').html(codet);
}*/


$(document).ready(function() {
$(document).on("click", "#saveinfo", function() { 
    $.ajax({
      url: "ajaxpatientsupdate.php",
      type: "POST",
      cache: false,
      data:{
        id: $('#id').val(),
        name: $('#name').val(),
        dob: $('#dob').val(),
        gender: $('#gender').val(),
        notes: $('#notes').val(),
        fn: $('#fn').val(),
        email: $('#email').val(),
        pn: $('#pn').val(),
        mpi: $('#mpi').val(),
        wilaya: $('#wilaya').val(),
        address: $('#address').val(),
        height: $('#height').val(),
        weight: $('#weight').val(),
        chronic: $('#chronic').val(),
        surgeries: $('#surgeries').val(),
        allergies: $('#allergies').val(),
        groupage: $('#groupage').val(),
        password: $('#password').val()
      },
      success: function(dataResult){
        var dataResult = JSON.parse(dataResult);
        if(dataResult.statusCode==200){
          $('#editmodal').modal().hide();
          alertify.success('Modifications enregistrées avec succès');
          $('#tabledisplay').DataTable().ajax.reload(null, false).draw(false);    
          $('#table2display').DataTable().ajax.reload(null, false).draw(false);       
        }else{
          alertify.error('Erreur...');
          $('#editmodal').modal().hide();
        }
      }
    });
  }); 
});
</script>
</body>
</html>