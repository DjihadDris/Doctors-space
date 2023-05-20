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
  <title>Les infirmiers</title>
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
}elseif (isset($_GET['true'])){
  echo "<script>window.open('nursepdf?name=$_GET[name]&mp=$_GET[mp]&dob=$_GET[dob]&pn=$_GET[pn]&email=$_GET[email]&gender=$_GET[gender]&groupage=$_GET[groupage]&address=$_GET[address]&wilaya=$_GET[wilaya]&password=$_GET[password]&code=$_GET[code]');</script>";
}
  ?>



<!-- Edit Modal -->
<div class="ui modal edit mini" id="editmodal">
  <i class="close icon"></i>
  <div class="header">
   <h3><i class="edit icon"></i> Modifier le dossier de l'infirmier</h3>
  </div>
  <div class="content">
<form class="ui form">

<input type="hidden" id="id">
<div class="field">
  <label>Prenom(s)/ Nom</label>
  <input <?php if($_COOKIE['job'] <> "Admin"){echo "readonly";} ?> required id="name" type="text">
</div>
<div <?php if($_COOKIE['job'] == "Admin"){echo '';}else{echo 'hidden';} ?> class="field">
  <label>Le Médecin</label>
  <select id="mpi" class="ui search dropdown">
    <option value="">--Sélectionner--</option>
    
  </select>
  </div>
<div class="field">
  <label>Sexe</label>
  <select required id="gender"class="ui search dropdown">
    <option value="">--Sélectionner--</option>
    <option id="male" value="Mâle">Mâle</option>
    <option id="female" value="Femalle">Femalle</option>
  </select>
</div>
<div class="field">
  <label>Date de naissance</label>
  <input <?php if($_COOKIE['job'] <> "Admin"){echo "readonly";} ?> required id="dob" type="date">
  </div>
<div class="field">
  <label>Adresse e-mail</label>
  <input required id="email" type="email">
</div>
<div class="field">
  <label>Numéro de téléphone</label>
  <input required id="pn" type="tel">
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
  <label>Wilaya</label>
<select id="wilaya" class="ui search dropdown">
<?php include('wilayas.php'); ?>
</select>
</div>
<div class="field">
<label>Adresse</label>
<input id="address" type="text">
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
   <h3><i class="print icon"></i> Imprimer la carte sanitaire de l'infirmier</h3>
  </div>
  <div class="content" id="printable" style="text-align: center;">
    <center>
    <div style="border: 2.5px solid black; width: 75%; border-style: dashed;">
      <img src="ms.jpg" width="100%" height="30%" style="position: relative;">
      <h3 style="margin-top: -5px !important;">Carte sanitaire de l'infirmier</h3>
      <div id="margindetails" style="text-align: left; margin-left: 72.5px; margin-top: 25px; font-size: 20px;">
        <span id="printprenom">Nom/ Prenom(s):</span>
        <br>
        <span id="printddn">Date de naissance:</span>
        <br>
        <span id="printsexe">Sexe:</span>
        <br>
        <span id="printmpi">Le Médecin:</span>
        <br>
        <span id="printpn">Numéro de téléphone:</span>
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
<div class="ui basic modal">
  <i class="close icon"></i>
  <div class="header">
   <h3><i class="plus icon"></i> Ajouter un dossier</h3>
  </div>
  <div class="content">
    
<div class="ui placeholder segment">
  <div class="ui dimmer" id="nursedimmer">
    <div class="ui text loader">Patientez...</div>
  </div>
  <div class="ui two column very relaxed stackable grid">
    <div class="column">
      <form class="ui form" method="POST" action="donurse" enctype="multipart/form-data">
        <div class="field">
 <div class="ui negative message">
    <p>Le mot de passe sera généré et envoyé à l'adresse e-mail de l'infirmier.</p>
</div>
        </div>
        <div class="field">
<label>Prenom(s)/ Nom <span style="color: red;">*</span></label>
  <input required name="name" type="text" placeholder="Prenom/ Nom">
            <label style="display: <?php if($_COOKIE['job'] == "Admin"){ echo ""; }else{ echo "none"; } ?>;">Le Médecin <span style="color: red;">*</span></label>
  <select style="display: <?php if($_COOKIE['job'] == "Admin"){ echo ""; }else{ echo "none"; } ?>;" id="mpis" required name="mpi" class="ui search dropdown add">
    <option value="">--Sélectionner--</option>

  </select>
        </div>
        <div class="field">
<label>Sexe <span style="color: red;">*</span></label>
  <select required name="gender" class="ui search dropdown add">
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
  <input required name="pn" type="tel" placeholder="Numéro de téléphone">
        </div>
      <div class="field">
<label>Groupe sanguin <span style="color: red;">*</span></label>
<select required name="groupage" class="ui search dropdown add">
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
<label>Wilaya <span style="color: red;">*</span></label>
<select required name="wilaya" class="ui search dropdown add">
<?php include('wilayas.php'); ?>
</select>
</div>

<div class="field">
<label>Adresse <span style="color: red;">*</span></label>
<input name="address" type="text" placeholder="Adresse">
</div>
        <button type="submit" class="ui blue inverted labeled icon button" style="width: 100% !important;"><i class="plus icon"></i> Ajouter</button>
      </form>
    </div>
    <div class="middle aligned column">
      
<div class="ui form">

  <div <?php if($_COOKIE['job'] == "Admin"){}else{echo "hidden";} ?> class="field">
    <label>Le Médecin <span style="color: red;">*</span></label>
          <select id="mpiname" class="ui search dropdown add">
    <option value="">--Sélectionner--</option>
    
  </select>
</div>
<div class="field">
<label>Code de l'infirmier</label>
          <div class="ui left icon input">
            <input minlength="10" maxlength="10" type="text" placeholder="Le code de l'infirmier" id="nursecode" onkeyup="addnurse()">
            <i class="keyboard icon"></i>
          </div>

</div>
</div>

    </div>
  </div>
  <div class="ui vertical divider">
    Ou
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
<a href="nurseschoose" class="ui blue tag label">Gestion des infirmiers</a>
<a class="ui green tag label">Les infirmiers</a>
</div>


<div class="ui top attached tabular menu">
<div class="active item" data-tab="first"><i class="folder icon inverted green circular"></i> Les dossiers
<div style="display: none;" class="ui green label" id="num1"></div></div>
<div class="item" data-tab="second"><i class="trash icon inverted green circular"></i> Les dossiers supprimés
<div style="display: none;" class="ui red label" id="num2"></div></div>
</div>
  
<div class="ui bottom attached active tab segment" data-tab="first">

<div style="float: right; position: relative;">
  <button class="ui labeled icon button green inverted" onclick="AddNurse()">
  <i class="plus icon"></i>
  Ajouter un dossier
 </button>
</div>
<br><br>

  <script type="text/javascript">
function AddNurse(){
$('.ui.basic.modal').modal('show');
}
  </script>

<div class="ui negative message">
    <p>Vous pouvez 'Activer/ Désactiver' le compte de l'infirmier en double-cliquant sur le 'statut'.</p>
</div>

<table class="ui celled striped selectable table" id="tabledisplay" style="width:100%">
  <thead>
    <tr>
      <th>#</th>
      <th>Photo</th>
      <th>Prenom(s)/ Nom</th>
      <th>Date de naissance</th>
      <th>Sexe</th>
      <th>Adresse e-mail</th>
      <th>Numéro de téléphone</th>
      <?php
if($_COOKIE['job'] == "Admin"){
  ?>
      <th>Médecin</th>
      <?php
}
      ?>
      <th>Wilaya</th>
      <th>Adresse</th>
      <th>Groupe sanguin</th>
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
    <p>Les dossiers des infirmiers supprimés seront définitivement supprimés après 30 jours.</p>
</div>

<table class="ui celled striped selectable table" id="table2display" style="width:100%">
  <thead>
    <tr>
      <th>#</th>
      <th>Photo</th>
      <th>Prenom(s)/ Nom</th>
      <th>Date de naissance</th>
      <th>Sexe</th>
      <th>Adresse e-mail</th>
      <th>Numéro de téléphone</th>
      <?php
if($_COOKIE['job'] == "Admin"){
  ?>
      <th>Médecin</th>
      <?php
}
      ?>
      <th>Wilaya</th>
      <th>Adresse</th>
      <th>Groupe sanguin</th>
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
$('.ui.dropdown.add').dropdown();
$('.menu .item').tab();
   function addnurse(){
    var code = document.getElementById('nursecode').value;
    var mpiname = document.getElementById('mpiname').value;
    if(code.length == 10){
document.getElementById('nursedimmer').setAttribute('class', 'ui dimmer active');
$.ajax({
        url: "getnurse.php",
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
document.getElementById('nursedimmer').setAttribute('class', 'ui dimmer'); 
document.getElementById('nursecode').value = "";    
          }
          else if(dataResult=='201'){
            alertify.error('Erreur...');
            document.getElementById('nursedimmer').setAttribute('class', 'ui dimmer');
          }else if(dataResult=='202'){
            alertify.error("Il n'y a pas de dossier avec ce code");
            document.getElementById('nursedimmer').setAttribute('class', 'ui dimmer');
          }else{
            alertify.error("Veuillez sélectionner le médecin");
            document.getElementById('nursedimmer').setAttribute('class', 'ui dimmer');
          }
          
        }
      });
    }
  }
  function loader(){
  /*$.ajax({
    url: "ajaxnurses.php",
    type: "POST",
    cache: false,
    success: function(data){
      $('#table').html(data); 
    }
  });

$.ajax({
    url: "ajaxnursesdel.php",
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
            <?php if($_COOKIE['job'] == "Admin"){ ?>
            {
                target: 12,
                visible: false,
                searchable: true
            }
<?php }else{ ?>
            {
                target: 11,
                visible: false,
                searchable: true
            }
<?php } ?>
    ],
    ordering: true,
    searching: true,
    paging: true,
    processing: true,
    scrollX: true,
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
"url": "ajaxnurses.php",
"dataSrc": ""
        },
        "columns": [
{"ID": "#"},
{"photo": "Photo"},
{"name": "Prenom(s)/ Nom"},
{"dob": "Date de naissance"},
{"gender": "Sexe"},
{"email": "Adresse e-mail"},
{"pn": "Numéro de téléphone"},
<?php if($_COOKIE['job'] == "Admin"){ ?>
{"mpi": "Médecin"},
<?php } ?>
{"wilaya": "Wilaya"},
{"address": "Adresse"},
{"groupage": "Groupe sanguin"},
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
  var stat = data[11].substring(66, 72);
  <?php
}else{
  ?>
 var stat = data[10].substring(66, 72);
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
          email: data[5],
          change: acdesac,
          from: 'nurses'
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
      $('#email').val(data[5]);
      $('#pn').val(data[6]);
      $('#gender').val(data[4]);
      $('#dob').val(data[3]);
      <?php
      if($_COOKIE['job'] == "Admin"){
     ?> 
      $('#mpi').val(data[7]);
<?php
}
?>
      $('#id').val(data[0]);
      <?php
      if($_COOKIE['job'] == "Admin"){
      ?> 
      $('#wilaya').val(data[8]);
      $('#address').val(data[9]);
      $('#groupage').val(data[10]);
<?php
}else{
?>
      $('#wilaya').val(data[7]);
      $('#address').val(data[8]);
      $('#groupage').val(data[9]);
<?php
}
?>
});

table.on('click', '.print', function (e) {
  var tr = $(this).closest('tr');
  var data = table.row(tr).data();
$('.ui.modal.print').modal('show');
$('#printprenom').html("Non/ Prenom(s):"+" "+data[2]);
$('#printemail').html("Adresse e-mail:"+" "+data[5]);
$('#printsexe').html("Sexe:"+" "+data[4]);
$('#printddn').html("Date de naissance:"+" "+data[3]);
$('#printpn').html("Numéro de téléphone:"+" "+data[6]);
<?php if($_COOKIE['job'] == "Admin"){ ?>
$('#printstatut').html("Statut:"+" "+data[11]);
<?php }else{
?>
$('#printstatut').html("Statut:"+" "+data[10]);
<?php
} ?>
<?php if($_COOKIE['job'] == "Admin"){ ?>
$('#printmpi').html("Le Médecin:"+" "+data[7]);
<?php }else{
?>
$('#printmpi').html("Le Médecin:"+" "+"<?php echo $_COOKIE['name']; ?>");
<?php
} ?>
<?php
if($_COOKIE['job'] == "Admin"){
?>
JsBarcode("#code", data[12]);
<?php
}else{
?>
JsBarcode("#code", data[11]);

<?php
}
      ?>
});

table.on('click', '.delete', function (e) {
  var tr = $(this).closest('tr');
  var data = table.row(tr).data();
alertify.confirm("Voulez-vous vraiment supprimer ce dossier:"+" "+data[2]+" "+"("+data[5]+")"+"?",
  function(){
$.ajax({
        url: "ajaxnursesdelete.php",
        type: "POST",
        data: {
          name: data[2],
          email: data[5]
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


var table2 = $('#table2display').DataTable({
    columnDefs: [
            {
                target: 0,
                visible: false,
                searchable: false
            },
            <?php if($_COOKIE['job'] == "Admin"){ ?>
            {
                target: 11,
                visible: false,
                searchable: true
            }
<?php }else{ ?>
            {
                target: 10,
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
"url": "ajaxnursesdel.php",
"dataSrc": ""
        },
        "columns": [
{"ID": "#"},
{"photo": "Photo"},
{"name": "Prenom(s)/ Nom"},
{"dob": "Date de naissance"},
{"gender": "Sexe"},
{"email": "Adresse e-mail"},
{"pn": "Numéro de téléphone"},
<?php if($_COOKIE['job'] == "Admin"){ ?>
{"mpi": "Médecin"},
<?php } ?>
{"wilaya": "Wilaya"},
{"address": "Adresse"},
{"groupage": "Groupe sanguin"},
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
        url: "ajaxnursesdeldelete.php",
        type: "POST",
        data: {
          name: data[2],
          email: data[5]    
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
}else{
      ?>

$('#mpi').html("<option selected value='<?php echo $_COOKIE['name']; ?>'><?php echo $_COOKIE['name']; ?></option>"); 
$('#mpis').html("<option selected value='<?php echo $_COOKIE['name']; ?>'><?php echo $_COOKIE['name']; ?></option>"); 
      <?php
}
      ?>
    }
  });
}

/*function restore(na, em){
  $.ajax({
        url: "ajaxnursesdeldelete.php",
        type: "POST",
        data: {
          name: na,
          email: em    
        },
        cache: false,
        success: function(dataResult){
          if(dataResult=='200'){
           loader.call();  
alertify.success("Le compte a été restauré avec succès");        
          }
          else{
            alertify.error('Erreur...');
          }
          
        }
      });
}
function acdesac(namee, emaill, acdesac){
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
          from: 'nurses'
        },
        cache: false,
        success: function(dataResult){
          if(dataResult=='200'){
                        loader.call();  
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
        url: "ajaxnursesdelete.php",
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


$(document).ready(function() {

/*$(function () {
    $('#editmodal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var id = button.data('id');
      var name = button.data('name');
      var email = button.data('email');
      var pn = button.data('pn');
      var password = button.data('password');
      var gender = button.data('gender');
      var dob = button.data('dob');
      var mpi = button.data('mpi');
      var modal = $(this);
      modal.find('#name').val(name);
      modal.find('#email').val(email);
      modal.find('#pn').val(pn);
      modal.find('#password').val(password);
      modal.find('#gender').val(gender);
      modal.find('#dob').val(dob);
      modal.find('#mpi').val(mpi);
      modal.find('#id').val(id);
    });
    });

$(function () {
    $('#printmodal').on('show.bs.modal', function (eventt) {
      var buttont = $(eventt.relatedTarget);
      var namet = buttont.data('name');
      var emailt = buttont.data('email');
      var pnt = buttont.data('pn');
      var passwordt = buttont.data('password');
      var gendert = buttont.data('gender');
      var dobt = buttont.data('dob');
      var mpit = buttont.data('mpi');
      var statust = buttont.data('status');
      var modalt = $(this);
      modalt.find('#printprenom').html("Prenom:"+" "+namet);
      modalt.find('#printemail').html("Adresse e-mail:"+" "+emailt);
      modalt.find('#printndt').html("Numéro de téléphone:"+" "+pnt);
      modalt.find('#printmdp').html("Mot de passe:"+" "+passwordt);
      modalt.find('#printsexe').html("Sexe:"+" "+gendert);
      modalt.find('#printddn').html("Date de naissance:"+" "+dobt);
      modalt.find('#printstatut').html("Statut:"+" "+statust);
      modalt.find('#printmpi').html("Le Médecin:"+" "+mpit);
    });
  });*/



$(document).on("click", "#saveinfo", function() { 
    $.ajax({
      url: "ajaxnursesupdate.php",
      type: "POST",
      cache: false,
      data:{
        id: $('#id').val(),
        name: $('#name').val(),
        dob: $('#dob').val(),
        gender: $('#gender').val(),
        email: $('#email').val(),
        pn: $('#pn').val(),
        fn: $('#mpi').val(),
        address: $('#address').val(),
        wilaya: $('#wilaya').val(),
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