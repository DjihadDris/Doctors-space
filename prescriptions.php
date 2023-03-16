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
  <title>Les ordonnances</title>
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
document.getElementById('printable').style.fontSize = "10px !important";
var oldPage = document.body.innerHTML;
document.body.innerHTML = divElements;
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
    <style type="text/css">
.ui.search.dropdown.selection{
  width: 100% !important;
}
    </style>
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


<!-- Print Modal -->
<div class="ui modal print small">
  <i class="close icon"></i>
  <div class="header">
   <h3><i class="print icon"></i> Imprimer l'ordonnance</h3>
  </div>
      <div class="content">
<div class="ui form">    
<div class="field">
<label>Date</label>
<div class="ui action input">
 <select onchange="getpres()" id="dateslist" required class="ui search dropdown">
  <option value="">--Sélectionner--</option>

</select>

<button onclick="del()" style="display: none;" id="delbtn" type="button" class="button ui red inverted icon"><i class="trash icon"></i></button>

</div>
</div>
</div>
<hr>

<div id="printable">

<?php
if($_COOKIE['job'] == "Admin" OR $_COOKIE['job'] == "Infirmier" OR $_COOKIE['job'] == "Médecin"){
include('db.php');
if($_COOKIE['job'] == "Admin" OR $_COOKIE['job'] == "Médecin"){
$sqld = "SELECT * FROM admins WHERE name='$_COOKIE[name]' AND status='Activé' AND del<>'yes'";
}else{
$sqls = "SELECT fn FROM admins WHERE job='Infirmier' AND name='$_COOKIE[name]' AND status='Activé' AND del<>'yes'";
$results = $conn->query($sqls);

if ($results->num_rows > 0) {
  // output data of each row
  while($rows = $results->fetch_assoc()) {

$medecin = "$rows[fn]";

$sqld = "SELECT * FROM admins WHERE name='$medecin' AND job='Médecin' AND status='Activé' AND del<>'yes'";

}} else {
$sql = "";
}
}
$resultd = $conn->query($sqld);

if ($resultd->num_rows > 0) {
  // output data of each row
  while($row = $resultd->fetch_assoc()) {
?>

<div style="text-align: center !important; margin-top: 25px !important;">
  <div style="float: left !important; text-align: center !important; margin-left: 10% !important; margin-bottom: 15px !important; height: 125px !important;">
  <h3>Docteur: <?php echo strtoupper("$row[fn]"); echo " $row[name]"; ?></h3>
  <h4 style="margin-top: -10px !important;"><?php if($_COOKIE['job'] == "Médecin" OR $_COOKIE['job'] == "Infirmier"){ echo "Spécialiste en $row[description]"; }else{ echo "Administrateur"; } ?></h4>
  <h4 style="margin-top: -10px !important;">Tél: <?php echo "$row[pn]"; ?></h4>
  <h4 style="margin-top: -10px !important;">Adresse e-mail: <?php echo "$row[email]"; ?></h4>
  <h5 style="margin-top: -10px !important;"><?php echo "$row[address], $row[wilaya]"; ?></h5>
</div>
<div style="float: right !important; text-align: center !important; margin-right: 12.5% !important; vertical-align: middle; line-height: 100px;">
  <i class="doctor icon huge black"></i>
</div>
</div>

<?php
}}else{
echo "";
}
$conn->close();
}
?>
<table class="ui celled striped selectable table">
  <thead>
  <tr class="center aligned">
    <th>Nom</th>
    <th>Prenom(s)</th>
    <th>Date de naissance (Âge)</th>
    <th>Date</th>
  </tr>
</thead>
<tbody>
  <tr class="center aligned">
    <td id="fn"></td>
    <td id="name"></td>
    <td id="dob"></td>
    <td id="dos"></td>
  </tr>
</tbody>
</table>
<br>
<table id="showhide" class="ui celled striped selectable table">
<thead>
  <tr class="center aligned">
    <?php
if($_COOKIE['job'] == "Admin" OR $_COOKIE['job'] == "Médecin" OR $_COOKIE['job'] == "Infirmier"){
    ?>
    <th colspan="5" contenteditable="true"><u>ORDONNANCE</u></th>
    <?php
  }else{
    ?>
<th colspan="5"><u>ORDONNANCE</u></th>
    <?php
  }
  ?>
  </tr>
</thead>
<tbody>
  <tr class="left aligned">
    <td colspan="5">
       <div style="white-space: pre-wrap; margin-left: 75px;" id="pres"></div>
    </td>
  </tr>
</tbody>
</table>

<?php
if($_COOKIE['job'] == "Admin" OR $_COOKIE['job'] == "Infirmier" OR $_COOKIE['job'] == "Médecin"){
include('db.php');
if($_COOKIE['job'] == "Admin" OR $_COOKIE['job'] == "Médecin"){
$sqld = "SELECT * FROM admins WHERE name='$_COOKIE[name]' AND status='Activé' AND del<>'yes'";
}else{
$sqls = "SELECT fn FROM admins WHERE job='Infirmier' AND name='$_COOKIE[name]' AND status='Activé' AND del<>'yes'";
$results = $conn->query($sqls);

if ($results->num_rows > 0) {
  // output data of each row
  while($rows = $results->fetch_assoc()) {

$medecin = "$rows[fn]";

$sqld = "SELECT * FROM admins WHERE name='$medecin' AND job='Médecin' AND status='Activé' AND del<>'yes'";

}} else {
$sql = "";
}
}
$resultd = $conn->query($sqld);

if ($resultd->num_rows > 0) {
  // output data of each row
  while($row = $resultd->fetch_assoc()) {
    if("$row[seal]" != "" && "$row[signature]" != ""){
?>
<center style="bottom: 0 !important;">
<img src="<?php echo "$row[seal]"; ?>" width="225px" height="100px" style="position: relative;">
<img src="<?php echo "$row[signature]"; ?>" width="225px" height="100px" style="position: relative;">
</center>
<?php
}}}else{
echo "";
}
$conn->close();
}
?>

</div>

      </div>
      <div class="actions">
         <center>
    <div class="ui buttons" style="width: 100% !important;">
      <?php 
if($_COOKIE['job'] == "Admin" OR $_COOKIE['job'] == "Médecin" OR $_COOKIE['job'] == "Infirmier"){
      ?>
      <button disabled class="ui positive left labeled icon button" onclick="printinfo()" id="printbtn"><i class="print icon"></i>
      Imprimer</button>
  <div class="or" data-text="ou"></div>
  <?php
}
  ?>
    <button class="ui negative right labeled icon button"><i class="close icon"></i> Fermer</button>
</div>
</center>
      </div>
    </div>



<!-- AddDrug Modal -->
<div class="ui basic modal adddrug">
  <i class="close icon"></i>
  <div class="header">
   <h3><i class="plus icon"></i> Ajouter un médicament</h3>
  </div>
      <div class="content">

<div class="ui form" method="POST" action="dodrug" enctype="multipart/form-data">
  <div class="field">
    <div class="two fields">
     <div class="field">
      <label style="color: white !important;">Nom du médicament</label>
       <input required id="nod" type="text" placeholder="Nom du médicament">
     </div> 
     <div class="field">
      <label style="color: white !important;">Forme</label>
       <select required id="fod" class="ui search dropdown">
<option value="">--Sélectionner--</option>
<option value="comprimé">Comprimé</option>
<option value="sachet">Sachet</option>
<option value="flacon">Flacon</option>
<option value="gelule">Gelule</option>
<option value="suppositoire">Suppositoire</option>
<option value="collyre">Collyre</option>
<option value="injectable">Injectable</option>
<option value="granule">Granule</option>
<option value="sirop">Sirop</option>
<option value="solution buvable">Solution buvable</option>
<option value="pommade">Pommade</option>
<option value="crème">Crème</option>
<option value="bain de bouche">Bain de bouche</option>
<option value="patch">Patch</option>
  </select>
     </div>
    </div>
  </div>
</div>
</div>
      <div class="actions">
    <center>
    <div class="ui buttons" style="width: 100% !important;">
      <button onclick="AddDrugToData()" type="submit" class="ui green left labeled icon button"><i class="plus icon"></i>
      Ajouter</button>
      <div class="or" data-text="ou"></div>
  <button class="ui negative right labeled icon button"><i class="close icon"></i> Fermer</button>
</div>
</center>
  </div>
</div>



<!-- Add Modal -->
<div class="ui modal add small">
  <i class="close icon"></i>
  <div class="header">
   <h3><i class="plus icon"></i> Créer une ordonnance</h3>
  </div>
  <div class="content">
<div class="ui form">
<input type="hidden" id="mp">
<input type="hidden" id="patientid">
<div class="field">
          <label>Date</label>
          <input required type="date" id="todaydate" value="<?php echo date("Y-m-d"); ?>" max="<?php echo date("Y-m-d"); ?>">
        </div>
    <hr>
        <div class="field">
          <label>Prenom(s)</label>
          <input readonly required type="text" id="patientname">
        </div>
  
        <div class="field">
          <label>Nom</label>
          <input readonly required type="text" id="patientfn">
        </div>
  
        <div class="field">
          <label>Date de naissance</label>
          <input readonly required type="text" id="patientdob">
        </div>
        <hr>
<div class="field">
  <label>Nom de médicament</label>
  <div class="ui action input">
  <select class="ui search dropdown" onchange="uplist()" required id="drugslist" type="text">

  </select>
  <button onclick="AddDrug()" type="button" class="button ui green inverted icon"><i class="plus icon"></i></button>

</div>
</div>
  <script type="text/javascript">
function AddDrug(){
$('.ui.basic.modal.adddrug').modal('show');
}
  </script>
<div class="field">
<label>Dose</label>
<div class="ui right labeled input">
  <input required id="dose" type="number">
  <div class="ui basic label">
    <span id="drugslistform" style="margin-left: 5px;"></span>
  </div>
</div>
</div>
<div class="field">
  <label>Posologie</label>
<div class="ui right labeled input">
  <input required id="number" type="number">
  <div class="ui basic label">
    <span id="drugslistform2" style="margin-left: 5px;"></span><span style="/*margin-left: 5px;*/">/ jour</span>
  </div>
</div>
</div>
<div class="field">
  <label>Durée</label>
<div class="two fields">
<div class="field">
<input required id="duration" type="number">
</div>
<div class="field">
<select class="ui search dropdown" required id="durationname">
  <option value="">--Sélectionner--</option>
  <option value="jour(s)">Jour(s)</option>
  <option value="semaine(s)">Semaine(s)</option>
  <option value="mois">Mois</option>
</select>
</div>
  </div>
</div>
  <center><button class="ui button blue inverted labeled icon" onclick="adddrug()" style="width: 100% !important;"><i class="plus icon"></i> Ajouter</button></center>
  <hr>
  <textarea id="prescriptiondetails" rows="5"></textarea>
</div>
  </div>
  <div class="actions">
    <center>
    <div class="ui buttons" style="width: 100% !important;">
      <button class="ui positive left labeled icon button" onclick="savetodata()"><i class="save icon"></i>
      Enregistrer</button>
  <div class="or" data-text="ou"></div>
    <button class="ui negative right labeled icon button"><i class="close icon"></i> Fermer</button>
</div>
</center>

  </div>
</div>




<div class="ui large breadcrumb">
<a href="patientschoose" class="ui blue tag label">Gestion des patients</a>
<a class="ui green tag label">Les ordonnances</a>
</div>


<div class="ui top attached tabular menu">
<div class="active item" data-tab="first"><i class="list icon inverted green circular"></i> Les ordonnances
<div style="display: none;" class="ui green label" id="num1"></div></div>
<div style="display: <?php if($_COOKIE['job'] == "Admin" OR $_COOKIE['job'] == "Médecin"){echo "";}else{echo "none";} ?>;" class="item" data-tab="second"><i class="trash icon inverted green circular"></i> Les ordonnances supprimés
<div style="display: none;" class="ui red label" id="num2"></div></div>
</div>

<div class="ui bottom attached active tab segment" data-tab="first">

<table class="ui celled striped selectable table" id="tabledisplay" style="width:100%">
  <thead>
    <tr>
      <th>#</th>
      <th></th>
      <th>Prenom(s)</th>
      <th>Nom</th>
      <th>Date de naissance</th>
      <?php
if($_COOKIE['job'] == "Admin"){
  ?>
      <th>Médecin</th>
      <?php
}
      ?>
      <th>Code</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody id="table">

  </tbody>
</table>

</div>

<div class="ui bottom attached tab segment" data-tab="second">

<table class="ui celled striped selectable table" id="table2display" style="width:100%">
  <thead>
    <tr>
      <th>#</th>
      <th>Date</th>
      <th>Prenom(s)</th>
      <th>Nom</th>
      <th>Date de naissance</th>
      <?php
if($_COOKIE['job'] == "Admin"){
  ?>
      <th>Médecin</th>
      <?php
    }
    ?>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody id="table2">

  </tbody>
</table>

</div>



<script type="text/javascript" src="admin.js"></script>
<script>
$('.ui.dropdown').dropdown();
$('.menu .item').tab();

function AddDrugToData(){

var name = document.getElementById('nod').value;
var form = document.getElementById('fod').value;

if(name != "" && form != ""){

$.ajax({
        url: "dodrug.php",
        type: "POST",
        data: {
          name: name,
          form: form,
          type: 'add'
        },
        cache: false,
        success: function(dataResult){

loader.call();
$('.ui.basic.modal.adddrug').modal('hide');
$('.ui.modal.add').modal('show');
alertify.success('Le médicament a été ajouté avec succès');

        }
      });
}else{
  alertify.error("Erreur...");
}

}

function getpres(){
  var name = document.getElementById('name').innerHTML;
  var fn = document.getElementById('fn').innerHTML;
  var date = document.getElementById('dateslist').value;
  if(date != ""){
    <?php
if($_COOKIE['job'] == "Infirmier" OR $_COOKIE['job'] == "Pharmacien"){}else{
    ?>
    document.getElementById('delbtn').setAttribute("onclick", "del('"+name+"', '"+fn+"', '"+date+"')");
    document.getElementById('delbtn').style.display = "block";
    <?php
  }
  if($_COOKIE['job'] == "Pharmacien"){}else{
  ?>
    document.getElementById('printbtn').disabled = false;
    <?php
  }
  ?>
    document.getElementById('showhide').style.display = "";
    document.getElementById('dos').innerHTML = date;
$.ajax({
        url: "getpres.php",
        type: "POST",
        data: {
          name: name,
          fn: fn,
          date: date
        },
        cache: false,
        success: function(dataResult){

document.getElementById('pres').innerHTML = dataResult;

        }
      });
}else{
  document.getElementById('showhide').style.display = "none";
}
}

  function savetodata(){
    var details = document.getElementById('prescriptiondetails').value;
    var name = document.getElementById('patientname').value;
    var fn = document.getElementById('patientfn').value;
    var dob = document.getElementById('patientdob').value;
    var id = document.getElementById('patientid').value;
    var date = document.getElementById('todaydate').value;
    var mp = document.getElementById('mp').value;
    if(details != ""){
$.ajax({
        url: "addprescription.php",
        type: "POST",
        data: {
          date: date,
          details: details,
          name: name,
          fn: fn,
          dob: dob,
          id: id,
          mp: mp
        },
        cache: false,
        success: function(dataResult){
          if(dataResult == 200){
alertify.success("Opération terminée avec succès");
document.getElementById('drugslist').value = "";
  document.getElementById('drugslistform').innerHTML = "";
  document.getElementById('drugslistform2').innerHTML = "";
  document.getElementById('dose').value = "";
  document.getElementById('number').value = "";
  document.getElementById('duration').value = "";
  document.getElementById('durationname').value = "";
  document.getElementById('prescriptiondetails').value = "";
}else{
  alertify.error('Erreur...');
}
        }
      });
    }else{
      alertify.error('Erreur...');
    }
  }
  function adddrug(){
    var drugname = document.getElementById('drugslist').value;
    var drugform = document.getElementById('drugslistform').innerHTML;
    var dose = document.getElementById('dose').value;
    var number = document.getElementById('number').value;
    var duration = document.getElementById('duration').value;
    var durationname = document.getElementById('durationname').value;
    var textarea = document.getElementById('prescriptiondetails');
if(drugname !="" && drugform != "" && dose != "" && number != ""){
  if(textarea.value.length == 0){
    if(duration != "" && durationname != "" && duration != 0 && dose != 0 && number != 0){
    textarea.value = '- '+drugname+": "+dose+" "+drugform+" => "+number+" x jour"+'\n   Pendant '+duration+" "+durationname;
  }else{
    textarea.value = '- '+drugname+": "+dose+" "+drugform+" => "+number+" x jour";
  }
  }else{
    if(duration != "" && durationname != "" && duration != 0 && dose != 0 && number != 0){
    textarea.value += '\n\n- '+ drugname+": "+dose+" "+drugform+" => "+number+" x jour"+'\n   Pendant '+duration+" "+durationname;
  }else{
    textarea.value += '\n\n- '+ drugname+": "+dose+" "+drugform+" => "+number+" x jour";
  }
  }

  }else{
    alertify.error('Entrez toutes les informations du médicament');
  }
  }
  function loader(){

   var table = $('#tabledisplay').DataTable({
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
                target: 6,
                visible: false,
                searchable: true
            },
            <?php 
}else{
  ?>
{
                target: 5,
                visible: false,
                searchable: true
            },
  <?php
}
            ?>
            <?php 
if($_COOKIE['job'] == "Infirmier" OR $_COOKIE['job'] == "Pharmacien"){
  ?>
 {
                target: 1,
                visible: false,
                searchable: false
            }
  <?php
}
            ?>
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
    "info":           "Affichage de _START_ à _END_ dossier sur _TOTAL_",
    "infoEmpty":      "Affichage de 0 à 0 sur 0 dossier",
    "infoFiltered":   "(filtré à partir de _MAX_ dossier au total)",
    "infoPostFix":    "",
    "thousands":      ",",
    "lengthMenu":     "Afficher les dossier du _MENU_",
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
"url": "ajaxprescriptions.php",
"dataSrc": ""
        },
        "columns": [
{"ID": "#"},
{"Add": ""},
{"name": "Prenom(s)"},
{"fn": "Nom"},
{"dob": "Date de naissance"},
<?php if($_COOKIE['job'] == "Admin"){ ?>
{"mpi": "Médecin"},
<?php } ?>
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

table.on('click', '.show', function (e) {
  var tr = $(this).closest('tr');
  var data = table.row(tr).data();
$('.ui.modal.print').modal('show');

document.getElementById('pres').innerHTML = "";
document.getElementById('delbtn').style.display = "none";

var dob = new Date(data[4]);
var month_diff = Date.now() - dob.getTime();
var age_dt = new Date(month_diff);   
var year = age_dt.getUTCFullYear();
var age = Math.abs(year - 1970);

$('#name').html(data[2]);
$('#fn').html(data[3]);
<?php
if($_COOKIE['job'] == "Admin" OR $_COOKIE['job'] == "Médecin" OR $_COOKIE['job'] == "Infirmier"){
?>
$('#dob').html(data[4]+" (<span contenteditable='true'>"+age+"</span> ans)");
<?php
}else{
?>
$('#dob').html(data[4]+" ("+age+" ans)");
<?php
}
?>
$('#age').html();

$.ajax({
        url: "presdates.php",
        type: "POST",
        data: {
          name: data[2],
          fn: data[3]
        },
        cache: false,
        success: function(dataResult){

            document.getElementById('dateslist').innerHTML = dataResult;  
            document.getElementById('dateslist').setAttribute("onchange", "getpres('"+data[2]+"', '"+data[3]+"')");
            getpres.call();

        }
      });

});

table.on('click', '.add', function (e) {
  var tr = $(this).closest('tr');
  var data = table.row(tr).data();
$('.ui.modal.add').modal('show');
$('#patientname').val(data[2]);
$('#patientfn').val(data[3]);
$('#patientdob').val(data[4]);
           <?php
if($_COOKIE['job'] == "Admin"){
     ?> 
   $('#mp').val(data[5]);
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
$('#mp').val("<?php echo $medecin; ?>");
<?php
  }
} else {
?>
$('#mp').val('');
<?php
}
}else{
?>
$('#mp').val("<?php echo $_COOKIE['name']; ?>");
<?php
}
      ?>
$('#patientid').val(data[0]);

});



var table2 = $('#table2display').DataTable({
    columnDefs: [
            {
                target: 0,
                visible: false,
                searchable: false
            }
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
    "emptyTable":     "Aucune ordonnance disponible",
    "info":           "Affichage de _START_ à _END_ ordonnances sur _TOTAL_",
    "infoEmpty":      "Affichage de 0 à 0 sur 0 ordonnances",
    "infoFiltered":   "(filtré à partir de _MAX_ ordonnances au total)",
    "infoPostFix":    "",
    "thousands":      ",",
    "lengthMenu":     "Afficher les ordonnances du _MENU_",
    "loadingRecords": "Chargement...",
    "processing":     "",
    "search":         "Chercher:",
    "zeroRecords":    "Aucun ordonnances correspondants trouvés",
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
"url": "ajaxpatients2.php",
"dataSrc": ""
        },
        "columns": [
{"ID": "#"},
{"date": "Date"},
{"name": "Prenom(s)"},
{"fn": "Nom"},
{"dob": "Date de naissance"},
<?php if($_COOKIE['job'] == "Admin"){ ?>
{"mpi": "Médecin"},
<?php } ?>
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
        url: "ajaxprescriptionsdel.php",
        type: "POST",
        data: {
          name: data[2],
          fn: data[3],
          date: data[1]
        },
        cache: false,
        success: function(dataResult){
          if(dataResult=='200'){
            alertify.success("L'ordonnance a été restaurée avec succès");
            $('#tabledisplay').DataTable().ajax.reload(null, false).draw(false);
            $('#table2display').DataTable().ajax.reload(null, false).draw(false);        
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
  $.ajax({
    url: "drugslist.php",
    type: "POST",
    cache: false,
    success: function(data){
$('#drugslist').html(data);
    }
  });
}

function uplist() {
  var drug = document.getElementById('drugslist').value;
  $.ajax({
        url: "drugslistform.php",
        type: "POST",
        data: {
          drug: drug   
        },
        cache: false,
        success: function(dataResult){
document.getElementById('drugslistform').innerHTML = dataResult;
document.getElementById('drugslistform2').innerHTML = dataResult;
        }
      });
}

function del(name, fn, date){
  alertify.confirm("Voulez-vous vraiment supprimer cette ordonnance?",
  function(){
$.ajax({
        url: "ajaxprescriptionsdelete.php",
        type: "POST",
        data: {
          name: name,
          fn: fn,
          date: date
        },
        cache: false,
        success: function(dataResult){
          if(dataResult=='200'){
            alertify.success("L'ordonnance a été supprimée avec succès");
            $('.ui.modal.print').modal('hide');
                $('#tabledisplay').DataTable().ajax.reload(null, false).draw(false);
            $('#table2display').DataTable().ajax.reload(null, false).draw(false);      
            document.getElementById('printbtn').disabled = true;
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
}

/*function restore(name, fn, date){
  $.ajax({
        url: "ajaxprescriptionsdel.php",
        type: "POST",
        data: {
          name: name,
          fn: fn,
          date: date
        },
        cache: false,
        success: function(dataResult){
          if(dataResult=='200'){
            alertify.success("L'ordonnance a été restaurée avec succès");
            loader.call();           
          }
          else{
            alertify.error('Erreur...');
          }
          
        }
      });
}*/


$(document).ready(function() {

/*$(function () {
    $('#printmodal').on('show.bs.modal', function (event) {

document.getElementById('pres').innerHTML = "";
document.getElementById('delbtn').style.display = "none";

      var button = $(event.relatedTarget);
      var name = button.data('patientname');
      var fn = button.data('patientfn');
      var dob = new Date("'"+button.data('patientdob')+"'");


      var month_diff = Date.now() - dob.getTime();
      var age_dt = new Date(month_diff);   
      var year = age_dt.getUTCFullYear();
      var age = Math.abs(year - 1970);


      var modal = $(this);
      modal.find('#namefn').html(fn+" "+name);
      modal.find('#dob').html(age+" ans");

$.ajax({
        url: "presdates.php",
        type: "POST",
        data: {
          name: name,
          fn: fn
        },
        cache: false,
        success: function(dataResult){

            document.getElementById('dateslist').innerHTML = dataResult;  

            document.getElementById('dateslist').setAttribute("onchange", "getpres('"+name+"', '"+fn+"')");
     
        }
      });

    });
    });*/

/*$(function () {
    $('#addmodal').on('show.bs.modal', function (eventt) {
      var buttont = $(eventt.relatedTarget);
      var patientnamet = buttont.data('patientname');
      var patientfnt = buttont.data('patientfn');
      var patientdobt = buttont.data('patientdob');
      var idt = buttont.data('id');
      var mpt = buttont.data('mp');
      var modalt = $(this);
      modalt.find('#patientname').val(patientnamet);
      modalt.find('#patientfn').val(patientfnt);
      modalt.find('#patientdob').val(patientdobt);
      modalt.find('#mp').val(mpt);
      modalt.find('#patientid').val(idt);
    });
  });*/



/*$(document).on("click", "#saveinfo", function() { 
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
        password: $('#password').val(),
      },
      success: function(dataResult){
        var dataResult = JSON.parse(dataResult);
        if(dataResult.statusCode==200){
          $('#editmodal').modal().hide();
          alertify.success('Modifications enregistrées avec succès');
          loader.call();          
        }else{
          alertify.error('Erreur...');
          location.reload();
        }
      }
    });
  }); */
});
</script>
</body>
</html>