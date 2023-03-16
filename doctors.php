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
  <title>Les médecins</title>
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
    <script>
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
}
  ?>


<!-- Edit Modal -->
<div class="ui modal edit mini" id="editmodal">
  <i class="close icon"></i>
  <div class="header">
   <h3><i class="edit icon"></i> Modifier le dossier du médecin</h3>
  </div>
  <div class="content">
<form class="ui form">

<input type="hidden" id="id">
<input type="hidden" id="job" value="Médecin">

<div class="field">
  <label>Prenom(s)</label>
  <input required id="name" type="text">
</div>

<div class="field">
  <label>Nom</label>
  <input required id="fn" type="text">
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

<div class="field">
  <label>Date de naissance</label>
  <input required id="dob" type="date">
  </div>

<div class="field">
  <label class="field">Adresse e-mail</label>
  <input required id="email" type="email">
</div>

<div class="field">
  <label>Numéro de téléphone</label>
  <input required id="pn" type="tel">
  </div>

<div class="field">
  <label>Wilaya</label>
<select required id="wilaya" class="ui search dropdown">
<?php include('wilayas.php'); ?>
</select>
</div>

  <div class="field">
  <label>Adresse</label>
  <input required id="address" type="text">
  </div>

  <div class="field">
  <label>Spécialité</label>
  <select required id="description" class="ui search dropdown">
    <option value="">--Sélectionner--</option>
    <?php
    include "db.php";
    $sql = "SELECT name FROM specialties";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<option value='$row[name]'>$row[name]</option>";
  }
} else {}
$conn->close();
    ?>
  </select>
  </div>

<div class="field">
  <label>Cachet <img src="" id="sealimg" style="margin-left: 2.5px;" width="25" height="25"></label>
    <div class="ui action input">
  <input id="seal" type="file" accept="image/*">
  <button type="button" onclick="sealdel()" class="ui button icon red"><i class="trash icon"></i></button>
</div>
   <input type="hidden" id="sealto">
</div>

<div class="field">
  <label>Signature <img src="" id="signatureimg" style="margin-left: 2.5px;" width="25" height="25"></label>
  <div class="ui action input">
  <input id="signature" type="file" accept="image/*">
  <button type="button" onclick="signaturedel()" class="ui button icon red"><i class="trash icon"></i></button>
</div>
  <input type="hidden" id="signatureto">
  </div>

<div class="field">
  <label>Mot de passe</label>
  <input required id="password" type="text">
</div>
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
   <h3><i class="print icon"></i> Imprimer la carte sanitaire du médecin</h3>
  </div>
  <div class="content" id="printable" style="text-align: center;">
    <center>
    <div style="border: 2.5px solid black; width: 75%; border-style: dashed;">
      <img src="ms.jpg" width="100%" height="30%" style="position: relative;">
      <h3 style="margin-top: -5px !important;">Carte sanitaire du médecin</h3>
      <div id="margindetails" style="text-align: left; margin-left: 72.5px; margin-top: 25px; font-size: 20px;">
        <span id="printnom">Nom:</span>
        <br>
        <span id="printprenom">Prenom(s):</span>
        <br>
        <span id="printddn">Date de naissance:</span>
        <br>
        <span id="printsexe">Sexe:</span>
        <br>
        <span id="printprofession">Profession:</span>
        <br>
        <span id="printemail">Adresse e-mail:</span>
        </div>
        <div id="marginphoto" style="border: 1px solid black; text-align: center; width: 150px; height: 200px; position: absolute; margin-left: 405px; margin-top: -185px;vertical-align: middle;line-height: 200px;">
          <span>Photo</span>
        </div>
        <br>
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
<div class="ui basic modal mini">
  <i class="close icon"></i>
  <div class="header">
   <h3><i class="plus icon"></i> Ajouter un dossier</h3>
  </div>
  <div class="content">
    
<div class="ui placeholder segment">

    <div class="column">
      <form class="ui form" method="POST" action="douser" enctype="multipart/form-data">
        
<input type="hidden" name="job" value="Médecin">
<input type="hidden" name="from" value="doctors">

<div class="field">
  <label>Prenom(s) <span style="color: red !important;">*</span></label>
  <input required name="name" type="text">
</div>
<div class="field">
  <label>Nom <span style="color: red !important;">*</span></label>
  <input required name="fn" type="text">
</div>
<div class="field">
  <label>Sexe <span style="color: red !important;">*</span></label>
  <select required name="gender" class="ui search dropdown">
    <option value="">--Sélectionner--</option>
    <option value="Mâle">Mâle</option>
    <option value="Femalle">Femalle</option>
  </select>
</div>
<div class="field">
  <label>Groupe sanguin <span style="color: red !important;">*</span></label>
  <select required name="groupage" class="ui search dropdown">
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
<div class="field">
  <label>Date de naissance <span style="color: red !important;">*</span></label>
  <input required name="dob" type="date">
</div>
<div class="field">
   <label>Adresse e-mail <span style="color: red !important;">*</span></label>
  <input required name="email" type="email">
</div>
<div class="field">
  <label>Numéro de téléphone <span style="color: red !important;">*</span></label>
  <input required name="pn" type="tel">
</div>
<div class="field">
   <label>Wilaya <span style="color: red !important;">*</span></label>
<select required name="wilaya" class="ui search dropdown">
<?php include('wilayas.php'); ?>
</select>
</div>
<div class="field">
   <label>Adresse <span style="color: red !important;">*</span></label>
  <input required name="address" type="text">
</div>
<div class="field">
  <label>Spécialité <span style="color: red !important;">*</span></label>
  <select required name="description" class="ui search dropdown">
    <option value="">--Sélectionner--</option>
    <?php
    include "db.php";
    $sql = "SELECT name FROM specialties";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<option value='$row[name]'>$row[name]</option>";
  }
} else {}
$conn->close();
    ?>
  </select>
  </div>
<div class="field">
 <label>Cachet <img src="img/no.jpg" id="sealimgt" style="margin-left: 2.5px;" width="25" height="25"></label>
  <input id="sealt" type="file" accept="image/*">
   <input type="hidden" id="sealtot" name="seal">
</div>
<div class="field">
  <label>Signature <img src="img/no.jpg" id="signatureimgt" style="margin-left: 2.5px;" width="25" height="25"></label>
  <input id="signaturet" type="file" accept="image/*">
  <input type="hidden" id="signaturetot" name="signature">
</div>
      
        <button type="submit" class="ui blue inverted labeled icon button" style="width: 100% !important;"><i class="plus icon"></i> Ajouter</button>
      </form>
    </div>
</div>

  </div>
  <div class="actions">
    <center>
    <div class="ui buttons" style="width: 100% !important;">
  <button class="ui labeled icon button negative">
    <i class="close icon"></i>
  Fermer
 </button>
</div>
</center>
  </div>
</div>




<div class="ui large breadcrumb">
<a href="userschoose" class="ui blue tag label">Gestion des utilisateurs</a>
<a class="ui green tag label">Les médecins</a>
</div>


<div class="ui top attached tabular menu">
<div class="active item" data-tab="first"><i class="folder icon inverted green circular"></i> Les dossiers
<div style="display: none;" class="ui green label" id="num1"></div></div>
<div class="item" data-tab="second"><i class="trash icon inverted green circular"></i> Les dossiers supprimés
<div style="display: none;" class="ui red label" id="num2"></div></div>
</div>
  
<div class="ui bottom attached active tab segment" data-tab="first">

<div style="float: right; position: relative;">
  <button class="ui labeled icon button green inverted" onclick="AddUser()">
  <i class="plus icon"></i>
  Ajouter un dossier
 </button>
</div>
<br><br>

<div class="ui negative message">
    <p>Vous pouvez 'Activer/ Désactiver' le compte du médecin en double-cliquant sur le 'statut'.</p>
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
      <th>Wilaya</th>
      <th>Adresse</th>
      <th>Spécialité</th>
      <th>Groupe sanguin</th>
      <th>Cachet</th>
      <th>Signature</th>
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
    <p>Les dossiers des médecins supprimés seront définitivement supprimés après 30 jours.</p>
</div>


<table class="ui celled striped selectable table" id="table2display" style="width:100%">
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
      <th>Wilaya</th>
      <th>Adresse</th>
      <th>Spécialité</th>
      <th>Groupe sanguin</th>
      <th>Cachet</th>
      <th>Signature</th>
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
  function sealdel(){
document.getElementById('sealimg').setAttribute('src', 'img/no.jpg');
document.getElementById('sealto').value = "";
}

function signaturedel() {
document.getElementById('signatureimg').setAttribute('src', 'img/no.jpg');
document.getElementById('signatureto').value = "";
}
  function AddUser(){
$('.ui.basic.modal').modal('show');
}
  function loader(){
  /*$.ajax({
    url: "ajaxusers.php",
    type: "POST",
    cache: false,
    success: function(data){
      $('#table').html(data); 
    }
  });
  $.ajax({
    url: "ajaxusersdel.php",
    type: "POST",
    cache: false,
    success: function(data){
      $('#table2').html(data); 
    }
  });*/

var table = $('#tabledisplay').DataTable({
    columnDefs: [
            {
                target: 0,
                visible: false,
                searchable: false
            },
            {
                target: 15,
                visible: false,
                searchable: true
            }
    ],
    ordering: true,
    scrollX: true,
    searching: true,
    paging: true,
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
"url": "ajaxdoctors.php",
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
{"wilaya": "Wilaya"},
{"address": "Adresse"},
{"specialty": "Spécialité"},
{"groupage": "Groupe sanguin"},
{"seal": "Cachet"},
{"signature": "Signature"},
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



var table2 = $('#table2display').DataTable({
    columnDefs: [
            {
                target: 0,
                visible: false,
                searchable: false
            },
            {
                target: 14,
                visible: false,
                searchable: true
            }
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
"url": "ajaxdoctorsdel.php",
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
{"wilaya": "Wilaya"},
{"address": "Adresse"},
{"specialty": "Spécialité"},
{"groupage": "Groupe sanguin"},
{"seal": "Cachet"},
{"signature": "Signature"},
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

table.on('dblclick', '.acdesac', function (e) {
  var tr = $(this).closest('tr');
  var data = table.row(tr).data();
  var stat = data[14].substring(66, 72);
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
          from: 'users'
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
$('#dob').val(data[4]);
$('#gender').val(data[5]);
$('#email').val(data[6]);
$('#pn').val(data[7]);
$('#wilaya').val(data[8]);
$('#address').val(data[9]);
$('#description').val(data[10]);
$('#groupage').val(data[11]);
var f = document.getElementById(data[0]+"f").src;
var s =document.getElementById(data[0]+"s").src;
$('#sealto').val(f);
$('#signatureto').val(s);
if(f != ""){
document.getElementById('sealimg').setAttribute('src', f);
}else{
document.getElementById('sealimg').setAttribute('src', 'img/no.jpg');
}
if(s != ""){
document.getElementById('signatureimg').setAttribute('src', s);
}else{
document.getElementById('signatureimg').setAttribute('src', 'img/no.jpg');
}
$('#id').val(data[0]);

});

table.on('click', '.print', function (e) {
  var tr = $(this).closest('tr');
  var data = table.row(tr).data();

$('.ui.modal.print').modal('show');
$('#printprenom').html("Prenom(s):"+" "+data[2]);
$('#printnom').html("Nom:"+" "+data[3]);
$('#printemail').html("Adresse e-mail:"+" "+data[6]);
$('#printprofession').html("Profession: Médecin");
$('#printsexe').html("Sexe:"+" "+data[5]);
$('#printddn').html("Date de naissance:"+" "+data[4]);
JsBarcode("#code", data[15]);

});

table2.on('click', '.restore', function (e) {
  var tr = $(this).closest('tr');
  var data = table2.row(tr).data();
 $.ajax({
        url: "ajaxusersdeldelete.php",
        type: "POST",
        data: {
          name: data[2],
          email: data[6]    
        },
        cache: false,
        success: function(dataResult){
          if(dataResult=='200'){
        $('#tabledisplay').DataTable().ajax.reload(null, false).draw(false);
                        $('#table2display').DataTable().ajax.reload(null, false).draw(false);   
alertify.success("Le compte a été restauré avec succès");        
          }
          else{
            alertify.error('Erreur...');
          }
          
        }
      });
});



table.on('click', '.delete', function (e) {
  var tr = $(this).closest('tr');
  var data = table.row(tr).data();

alertify.confirm("Voulez-vous vraiment supprimer ce dossier:"+" "+data[2]+" "+"("+data[6]+")"+"?",
  function(){
$.ajax({
        url: "ajaxusersdelete.php",
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


}



$(document).ready(function() {

/*$(function () {
    $('#editmodal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); 
      var id = button.data('id');
      var name = button.data('name');
      var fn = button.data('fn');
      var email = button.data('email');
      var pn = button.data('pn');
      var password = button.data('password');
      var job = button.data('job');
      var gender = button.data('gender');
      var dob = button.data('dob');
      var seal = button.data('seal');
      var signature = button.data('signature');
      var modal = $(this);
      modal.find('#name').val(name);
      modal.find('#fn').val(fn);
      modal.find('#email').val(email);
      modal.find('#pn').val(pn);
      modal.find('#password').val(password);
      modal.find('#job').val(job);
      modal.find('#gender').val(gender);
      modal.find('#dob').val(dob);
      modal.find('#sealto').val(seal);
      document.getElementById('sealimg').setAttribute('src', 'sealssignatures/'+seal);
      modal.find('#signatureto').val(signature);
      document.getElementById('signatureimg').setAttribute('src', 'sealssignatures/'+signature);
      modal.find('#id').val(id);
    });
    });*/

/*$(function () {
    $('#printmodal').on('show.bs.modal', function (eventt) {
      var buttont = $(eventt.relatedTarget);
      var namet = buttont.data('name');
      var fnt = buttont.data('fn');
      var emailt = buttont.data('email');
      var pnt = buttont.data('pn');
      var passwordt = buttont.data('password');
      var jobt = buttont.data('job');
      var gendert = buttont.data('gender');
      var dobt = buttont.data('dob');
      var statust = buttont.data('status');
      var modalt = $(this);
      modalt.find('#printprenom').html("Prenom:"+" "+namet);
      modalt.find('#printnom').html("Nom:"+" "+fnt);
      modalt.find('#printemail').html("Adresse e-mail:"+" "+emailt);
      modalt.find('#printndt').html("Numéro de téléphone:"+" "+pnt);
      modalt.find('#printmdp').html("Mot de passe:"+" "+passwordt);
      modalt.find('#printprofession').html("Profession:"+" "+jobt);
      modalt.find('#printsexe').html("Sexe:"+" "+gendert);
      modalt.find('#printddn').html("Date de naissance:"+" "+dobt);
      modalt.find('#printstatut').html("Statut:"+" "+statust);
    });
  });*/



$(document).on("click", "#saveinfo", function() { 
    $.ajax({
      url: "ajaxusersupdate.php",
      type: "POST",
      cache: false,
      data:{
        id: $('#id').val(),
        name: $('#name').val(),
        dob: $('#dob').val(),
        gender: $('#gender').val(),
        job: $('#job').val(),
        fn: $('#fn').val(),
        seal: $('#sealto').val(),
        signature: $('#signatureto').val(),
        email: $('#email').val(),
        pn: $('#pn').val(),
        password: $('#password').val(),
        groupage: $('#groupage').val(),
        address: $('#address').val(),
        wilaya: $('#wilaya').val(),
        description: $('#description').val()
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
