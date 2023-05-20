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
  <title>Les rendez-vous</title>
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
window.print();
document.body.innerHTML = oldPage;
location.reload();
        }
        function printinfol() {


var divToPrint=document.getElementById("printablelist");
var dt = document.getElementById('selecteddate').value;
 newWin= window.open("");
 newWin.document.write("<center><h1>La liste des rendez-vous</h1><h3>"+dt+"</h3></center>");
 newWin.document.write("<center>"+divToPrint.outerHTML+"<div style='text-align: right !important; margin-right: 50px !important;'><h5>Cachet et signature</h5></div></center>");
 newWin.document.write("<style> table, th, td{border:1px solid!important;border-collapse:collapse!important;text-align:center!important} td:nth-child(10){display:none;} th:nth-child(10){display:none;} </style>");
 newWin.print();
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
   <h3><i class="eye icon"></i> La carte du RDV</h3>
  </div>
      <div class="content">

<div id="printable">

<table class="ui celled striped selectable table">
  <thead>
    <tr class="center aligned">
      <th>Nom</th>
      <th>Prenom(s)</th>
      <th>Date de naissance</th>
    </tr>
  </thead>
  <tbody>
    <tr class="center aligned">
      <td id="fnp"></td>
      <td id="np"></td>
      <td id="dobp"></td>
    </tr>
  </tbody>
</table>

<table class="ui celled striped selectable table">
  <thead>
    <tr class="center aligned">
      <th>Validation</th>
      <th>Date du RDV</th>
      <th>Heure du RDV</th>
      <th>Observation</th>
      <th>Prix</th>
      <th>Versement</th>
      <th>Reste</th>
    </tr>
  </thead>
  <tbody id="appointslist">

  </tbody>
</table>

</div>

<center>
<div style="display: inline-block; margin-top: 10px; margin-bottom: -2.5px;">
<span style="margin-right: 15px;"><i class="circle icon green" style="margin-right: -2px;"></i> Le RDV d'aujourd'hui</span>
<span style="margin-right: 15px;"><i class="circle icon blue" style="margin-right: -2px;"></i> Le RDV à venir</span>
<span><i class="circle icon orange" style="margin-right: -2px;"></i> Ancien RDV</span>
</div>
</center>

      </div>
      <div class="actions">
         <center>
    <div class="ui buttons" style="width: 100% !important;">
      <button class="ui positive left labeled icon button" onclick="printinfo()"><i class="print icon"></i>
      Imprimer</button>
  <div class="or" data-text="ou"></div>
    <button class="ui negative right labeled icon button"><i class="close icon"></i> Fermer</button>
</div>
</center>
      </div>
    </div>



<!-- Valid Modal -->
<div class="ui modal valid small">
  <i class="close icon"></i>
  <div class="header">
   <h3><i class="check icon"></i> Valider le RDV</h3>
  </div>
      <div class="content">

<div class="ui form">
<div class="field">
    <div class="three fields">
     <div class="field">
      <label style="color: white !important;">Prenom(s)</label>
       <input required id="patientnamev" type="text" readonly>
     </div> 
     <div class="field">
      <label style="color: white !important;">Nom</label>
       <input required id="patientfnv" type="text" readonly>
     </div>
     <div class="field">
      <label style="color: white !important;">Date de naissance</label>
       <input required id="patientdobv" type="text" readonly>
     </div>
    </div>
  </div>
<hr>
<div class="field">
<div class="ui action input">
<select onchange="gettimes()" id="dateslist" required class="ui search dropdown">
<option value="">--Sélectionner la date--</option>

</select>

<select onchange="showbtn()" id="timeslist" required class="ui search dropdown">
<option value="">--Sélectionner l'heure--</option>

</select>

<button onclick="del()" style="display: none;" id="delbtn" type="button" class="button ui red inverted icon"><i class="trash icon"></i></button>

</div>
</div>
<div id="ppr" style="display: none;" class="field">
    <div class="three fields">
     <div class="field">
<div class="ui right labeled input">
       <input required id="price" type="number" placeholder="Prix" onkeyup="countremain()">
       <div class="ui basic label">
    <span>DA</span>
  </div>
</div>
     </div> 
     <div class="field">
<div class="ui right labeled input">
       <input required id="pay" type="number" placeholder="Versement" onkeyup="countremain()">
       <div class="ui basic label">
    <span>DA</span>
  </div>
</div>
     </div>
     <div class="field">
<div class="ui right labeled input">
       <input required id="remain" type="number" placeholder="Reste" readonly>
       <div class="ui basic label">
    <span>DA</span>
  </div>
</div>
     </div>
    </div>
  </div>
<div class="field">
<input type="text" placeholder="Observation" required id="obs">
</div>
</div>
      </div>
      <div class="actions">
         <center>
    <div class="ui buttons" style="width: 100% !important;">
      <button class="ui green left labeled icon button" onclick="validdatetime()"><i class="check icon"></i>
      Valider</button>
  <div class="or" data-text="ou"></div>
    <button class="ui negative right labeled icon button"><i class="close icon"></i> Fermer</button>
</div>
</center>
      </div>
    </div>



<!-- Add Modal -->
<div class="ui basic modal add">
  <i class="close icon"></i>
  <div class="header">
   <h3><i class="plus icon"></i> Créer un rendez-vous</h3>
  </div>
      <div class="content">
<div class="ui form">
<input type="hidden" id="mp">
<input type="hidden" id="patientid">

  <div class="field">
    <div class="three fields">
     <div class="field">
      <label style="color: white !important;">Prenom(s)</label>
       <input required id="patientname" type="text" readonly>
     </div> 
     <div class="field">
      <label style="color: white !important;">Nom</label>
       <input required id="patientfn" type="text" readonly>
     </div>
     <div class="field">
      <label style="color: white !important;">Date de naissance</label>
       <input required id="patientdob" type="text" readonly>
     </div>
    </div>
  </div>

  <div class="field">
    <div class="two fields">
     <div class="field">
      <label style="color: white !important;">Date</label>
       <input required id="todaydate" type="date" placeholder="Date du rendez-vous" min="<?php echo date("Y-m-d"); ?>">
     </div> 
     <div class="field">
      <label style="color: white !important;">Heure</label>
       <input required id="todaytime" type="time" placeholder="Heure du rendez-vous">
     </div>
    </div>
  </div>

<div class="field">
  <label style="color: white !important;">Observation</label>
  <input type="text" id="addobs" required placeholder="Observation">
</div>

</div>
</div>
      <div class="actions">
    <center>
    <div class="ui buttons" style="width: 100% !important;">
      <button onclick="savetodata()" class="ui green left labeled icon button"><i class="plus icon"></i> Ajouter</button>
      <div class="or" data-text="ou"></div>
  <button class="ui negative right labeled icon button"><i class="close icon"></i> Fermer</button>
   </div>
   </center>
</div>
  </div>


<!-- List Modal -->
<div class="ui basic modal list">
  <i class="close icon"></i>
  <div class="header">
   <h3><i class="sort numeric down icon"></i> La liste des RDV</h3>
  </div>
<div class="content">

<div class="ui form">
  <div class="field">
    <label style="color: white !important;">Date</label>
    <input onchange="getliste()" type="date" id="selecteddate" value="<?php echo date("Y-m-d"); ?>">
  </div>
</div>

<table id="printablelist" class="ui celled striped selectable table">
  <thead>
    <tr class="center aligned">
      <th>Validation</th>
      <th>Nom</th>
      <th>Prenom(s)</th>
      <th>Date de naissance</th>
      <th>Heure du RDV</th>
      <th>Observation</th>
      <th>Prix</th>
      <th>Versement</th>
      <th>Reste</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody id="selectedcontent">

  </tbody>
</table>

</div>
      <div class="actions">
    <center>
       <div class="ui buttons" style="width: 100% !important;">
        <button class="ui positive left labeled icon button" onclick="printinfol()"><i class="print icon"></i> Imprimer</button>
        <div class="or" data-text="ou"></div>
  <button class="ui negative right labeled icon button"><i class="close icon"></i> Fermer</button>
</div>
</center>
  </div>
</div>


<!-- Edit Modal -->
<div class="ui basic modal edit">
  <i class="close icon"></i>
  <div class="header">
   <h3><i class="plus icon"></i> Éditer le rendez-vous</h3>
  </div>
      <div class="content">
<div class="ui form">
<input type="hidden" id="patientide">

  <div class="field">
    <div class="three fields">
     <div class="field">
      <label style="color: white !important;">Prenom(s)</label>
       <input required id="patientnamee" type="text" readonly>
     </div> 
     <div class="field">
      <label style="color: white !important;">Nom</label>
       <input required id="patientfne" type="text" readonly>
     </div>
     <div class="field">
      <label style="color: white !important;">Date de naissance</label>
       <input required id="patientdobe" type="text" readonly>
     </div>
    </div>
  </div>
  <div class="field">
    <div class="two fields">
     <div class="field">
      <label style="color: white !important;">Date</label>
       <input required id="todaydatee" type="date" readonly>
     </div> 
     <div class="field">
      <label style="color: white !important;">Heure</label>
       <input required id="todaytimee" type="time" readonly>
     </div>
    </div>
  </div>
  <div class="field">
    <div class="three fields">
     <div class="field">
      <label style="color: white !important;">Prix</label>
      <div class="ui right labeled input">
       <input required id="pricee" type="text" placeholder="Prix" onkeyup="countremains()">
       <div class="ui basic label">
    <span>DA</span>
  </div>
</div>
     </div> 
     <div class="field">
      <label style="color: white !important;">Versement</label>
      <div class="ui right labeled input">
       <input required id="paye" type="text" placeholder="Versement" onkeyup="countremains()">
       <div class="ui basic label">
    <span>DA</span>
  </div>
</div>
     </div>
     <div class="field">
      <label style="color: white !important;">Reste</label>
      <div class="ui right labeled input">
       <input required id="remaine" type="text" placeholder="Reste" readonly>
       <div class="ui basic label">
    <span>DA</span>
  </div>
</div>
     </div>
    </div>
  </div>
    <div class="field">
 <label style="color: white !important;">Observation</label>
 <input type="text" id="observatione" required placeholder="Observation">
    </div>
    </div>
</div>
      <div class="actions">
    <center>
    <div class="ui buttons" style="width: 100% !important;">
      <button onclick="edit()" class="ui green left labeled icon button"><i class="save icon"></i> Enregistrer</button>
      <div class="or" data-text="ou"></div>
  <button class="ui negative right labeled icon button"><i class="close icon"></i> Fermer</button>
   </div>
   </center>
</div>
  </div>




<div class="ui large breadcrumb">
<a href="patientschoose" class="ui blue tag label">Gestion des patients</a>
<a class="ui green tag label">Les rendez-vous</a>
</div>


<div class="ui top attached tabular menu">
<div class="active item" data-tab="first"><i class="list icon inverted green circular"></i> Les rendez-vous
<div style="display: none;" class="ui green label" id="num1"></div></div>
<div class="item" data-tab="second"><i class="check icon inverted green circular"></i> Les rendez-vous validés
<div style="display: none;" class="ui green label" id="num2"></div></div>
<div style="display: <?php if($_COOKIE['job'] == "Admin" OR $_COOKIE['job'] == "Médecin"){echo "";}else{echo "none";} ?>;" class="item" data-tab="third"><i class="trash icon inverted green circular"></i> Les rendez-vous supprimés
<div style="display: none;" class="ui red label" id="num3"></div></div>
</div>

<div class="ui bottom attached active tab segment" data-tab="first">

<div style="float: right; position: relative;">
  <button class="ui labeled icon button green inverted" onclick="ShowList()">
  <i class="sort numeric down icon"></i>
  La liste des RDV
 </button>
</div>
<br><br>

<script type="text/javascript">
function ShowList(){
$('.ui.basic.modal.list').modal('show');
getliste.call();
}
</script>

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

<table class="ui celled striped selectable table" id="table3display" style="width:100%">
  <thead>
    <tr>
      <th>#</th>
      <th>Date</th>
      <th>Heure</th>
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
      <th>Prix</th>
      <th>Versement</th>
      <th>Reste</th>
      <th>Observation</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody id="table3">

  </tbody>
</table>

</div>

<div class="ui bottom attached tab segment" data-tab="third">

<div class="ui negative message">
    <p>Les RDV supprimés seront définitivement supprimés après 30 jours.</p>
</div>

<table class="ui celled striped selectable table" id="table2display" style="width:100%">
  <thead>
    <tr>
      <th>#</th>
      <th>Date</th>
      <th>Heure</th>
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

function getliste(){
var date = document.getElementById('selecteddate').value;

$.ajax({
        url: "getappointsliste.php",
        type: "POST",
        data: {
          date: date
        },
        cache: false,
        success: function(dataResult){
document.getElementById('selectedcontent').innerHTML = dataResult; 
        }
      });

}

function edit(){

var id = document.getElementById('patientide').value;
var name = document.getElementById('patientnamee').value;
var fn = document.getElementById('patientfne').value;
var dob = document.getElementById('patientdobe').value;

var date = document.getElementById('todaydatee').value;
var time = document.getElementById('todaytimee').value;

var price = document.getElementById('pricee').value;
var pay = document.getElementById('paye').value;
var remain = document.getElementById('remaine').value;
var observation = document.getElementById('observatione').value;

$.ajax({
        url: "appointsedit.php",
        type: "POST",
        data: {
          name: name,
          fn: fn,
          dob: dob,
          date: date,
          time: time,
          price: price,
          pay: pay,
          remain: remain,
          observation: observation
        },
        cache: false,
        success: function(dataResult){
$('.ui.modal.edit').modal('hide');
alertify.success('Modifications enregistrées avec succès');
$('#tabledisplay').DataTable().ajax.reload(null, false).draw(false);
$('#table2display').DataTable().ajax.reload(null, false).draw(false);  
$('#table3display').DataTable().ajax.reload(null, false).draw(false);    
        }
      });

}

function valider2(id, fn, name, date, time){

var observation = document.getElementById(id+'ob').innerHTML;
var price = Number(document.getElementById(id+'pr').innerHTML);
var pay = Number(document.getElementById(id+'pa').innerHTML);
var remain = (price-pay);

if(price != "" && price >= 0 || price == "-"){
if(pay >= 0 && pay <= price || pay == "-"){

$.ajax({
        url: "appointsvalid.php",
        type: "POST",
        data: {
          valid: 'yes',
          name: name,
          fn: fn,
          date: date,
          observation: observation,
          time: time,
          price: price,
          pay: pay,
          remain: remain
        },
        cache: false,
        success: function(dataResult){
getliste.call();
alertify.success("Le RDV a été validé avec succès");
$('#tabledisplay').DataTable().ajax.reload(null, false).draw(false);
$('#table2display').DataTable().ajax.reload(null, false).draw(false);  
$('#table3display').DataTable().ajax.reload(null, false).draw(false);    
        }
      });

}else{
alertify.error("Veuillez entrer le versement correctement");
}
}else{
alertify.error("Veuillez entrer le prix");
}

}

function invalider2(id, fn, name, date, time){

$.ajax({
        url: "appointsvalid.php",
        type: "POST",
        data: {
          valid: '',
          name: name,
          fn: fn,
          date: date,
          time: time
        },
        cache: false,
        success: function(dataResult){
getliste.call();
alertify.success("Le RDV a été invalidé avec succès");
$('#tabledisplay').DataTable().ajax.reload(null, false).draw(false);
$('#table2display').DataTable().ajax.reload(null, false).draw(false);  
$('#table3display').DataTable().ajax.reload(null, false).draw(false);    
        }
      });

}

function validdatetime(){
  var name = document.getElementById('patientnamev').value;
  var fn = document.getElementById('patientfnv').value;
  var date = document.getElementById('dateslist').value;
  var time = document.getElementById('timeslist').value;
  var observation = document.getElementById('obs').value;
  var price = document.getElementById('price').value;
  var pay = document.getElementById('pay').value;
  var remain = document.getElementById('remain').value;

if(date != ""){
if(time != ""){
if(price != "" && price >= 0 || price == "-"){
if(pay >= 0 && pay <= price || pay == "-"){

$.ajax({
        url: "appointsvalid.php",
        type: "POST",
        data: {
          valid: 'yes',
          name: name,
          fn: fn,
          date: date,
          observation: observation,
          time: time,
          price: price,
          pay: pay,
          remain: remain
        },
        cache: false,
        success: function(dataResult){
$('.ui.modal.valid').modal('hide');
alertify.success("Le RDV a été validé avec succès");
$('#tabledisplay').DataTable().ajax.reload(null, false).draw(false);
$('#table2display').DataTable().ajax.reload(null, false).draw(false);  
$('#table3display').DataTable().ajax.reload(null, false).draw(false);    
        }
      });

}else{
alertify.error("Veuillez entrer le versement correctement");
}
}else{
alertify.error("Veuillez entrer le prix");
}
}else{
alertify.error("Veuillez sélectionner l'heure");
}
}else{
alertify.error("Veuillez sélectionner la date");
}
}

function countremain(){
  var price = Number(document.getElementById('price').value);
  var pay = Number(document.getElementById('pay').value);
  if(price != ""){
    if(pay != ""){
  document.getElementById('remain').value = price-pay;
}else{
  document.getElementById('remain').value = price;
}
}else{
  document.getElementById('remain').value = "";
}
}

function countremains(){
  var price = document.getElementById('pricee').value;
  var pay = document.getElementById('paye').value;
  if(price === "-"){
    document.getElementById('remaine').value = "-";
}else{
  if(pay === "-"){
  document.getElementById('remaine').value = "-";
}else{
  if(pay != ""){
  document.getElementById('remaine').value = price-pay;
}else{
  document.getElementById('remaine').value = price;
}
}
}
}

function showbtn(name, fn) {
  var date = document.getElementById('dateslist').value;
  var time = document.getElementById('timeslist').value;
  if(date != "" && time != ""){
    <?php
if($_COOKIE['job'] == "Infirmier" OR $_COOKIE['job'] == "Pharmacien"){}else{
    ?>
    document.getElementById('delbtn').setAttribute("onclick", "del('"+name+"', '"+fn+"', '"+date+"', '"+time+"')");
    document.getElementById('delbtn').style.display = "block";
    <?php
  }
  ?>

alertify.confirm("Ce RDV est-il payant?",
  function(){
document.getElementById('ppr').style.display = "";
$('#price').attr('type', 'number');
$('#pay').attr('type', 'number');
$('#remain').attr('type', 'number');
document.getElementById('price').value = "";
document.getElementById('pay').value = "";
document.getElementById('remain').value = "";
  },
  function(){
document.getElementById('ppr').style.display = "none";
$('#price').attr('type', 'text');
$('#pay').attr('type', 'text');
$('#remain').attr('type', 'text');
document.getElementById('price').value = "-";
document.getElementById('pay').value = "-";
document.getElementById('remain').value = "-";
  });

}
}

function gettimes(){
  var name = document.getElementById('patientnamev').value;
  var fn = document.getElementById('patientfnv').value;
  var date = document.getElementById('dateslist').value;
  var time = document.getElementById('timeslist').value;
  if(date != ""){
    document.getElementById('timeslist').setAttribute("onchange", "showbtn('"+name+"', '"+fn+"')");
$.ajax({
        url: "appointstimeslist.php",
        type: "POST",
        data: {
          name: name,
          fn: fn,
          date: date
        },
        cache: false,
        success: function(dataResult){

document.getElementById('timeslist').innerHTML = dataResult;

        }
      });
}else{
  document.getElementById('timeslist').innerHTML = "<option value=''>--Sélectionner l'heure--</option>";
}
}

  function savetodata(){
    var name = document.getElementById('patientname').value;
    var fn = document.getElementById('patientfn').value;
    var dob = document.getElementById('patientdob').value;
    var id = document.getElementById('patientid').value;
    var date = document.getElementById('todaydate').value;
    var time = document.getElementById('todaytime').value;
    var mp = document.getElementById('mp').value;
    var obs = document.getElementById('addobs').value;
    if(date != "" && time != ""){
$.ajax({
        url: "addappointment.php",
        type: "POST",
        data: {
          name: name,
          fn: fn,
          dob: dob,
          id: id,
          date: date,
          time: time,
          mp: mp,
          obs: obs
        },
        cache: false,
        success: function(dataResult){
          if(dataResult == 200){
            $('.ui.modal.add').modal('hide');
alertify.success("Opération terminée avec succès");
}else{
  alertify.error('Erreur...');
}
        }
      });
    }else{
      alertify.error('Erreur...');
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
"url": "ajaxappointments.php",
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

$('#np').html(data[2]);
$('#fnp').html(data[3]);
$('#dobp').html(data[4]);

$.ajax({
        url: "appointsdates.php",
        type: "POST",
        data: {
          name: data[2],
          fn: data[3]
        },
        cache: false,
        success: function(dataResult){

            document.getElementById('appointslist').innerHTML = dataResult;  
     
        }
      });

});



table.on('click', '.valid', function (e) {
  var tr = $(this).closest('tr');
  var data = table.row(tr).data();
$('.ui.modal.valid').modal('show');
$('#patientnamev').val(data[2]);
$('#patientfnv').val(data[3]);
$('#patientdobv').val(data[4]);


$.ajax({
        url: "appointsdateslist.php",
        type: "POST",
        data: {
          name: data[2],
          fn: data[3]
        },
        cache: false,
        success: function(dataResult){

     document.getElementById('dateslist').innerHTML = dataResult;  
     document.getElementById('dateslist').setAttribute("onchange", "gettimes('"+data[2]+"', '"+data[3]+"')");
     gettimes.call(data[2], data[3]);
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
    "emptyTable":     "Aucun RDV disponible",
    "info":           "Affichage de _START_ à _END_ RDV sur _TOTAL_",
    "infoEmpty":      "Affichage de 0 à 0 sur 0 RDV",
    "infoFiltered":   "(filtré à partir de _MAX_ RDV au total)",
    "infoPostFix":    "",
    "thousands":      ",",
    "lengthMenu":     "Afficher les RDV du _MENU_",
    "loadingRecords": "Chargement...",
    "processing":     "",
    "search":         "Chercher:",
    "zeroRecords":    "Aucun RDV correspondants trouvés",
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
"url": "ajaxpatients3.php",
"dataSrc": ""
        },
        "columns": [
{"ID": "#"},
{"date": "Date"},
{"time": "Heure"},
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
  $("#num3").html(nbr);  
  document.getElementById('num3').style.display = "block";
}
          });


var table3 = $('#table3display').DataTable({
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
    "emptyTable":     "Aucun RDV disponible",
    "info":           "Affichage de _START_ à _END_ RDV sur _TOTAL_",
    "infoEmpty":      "Affichage de 0 à 0 sur 0 RDV",
    "infoFiltered":   "(filtré à partir de _MAX_ RDV au total)",
    "infoPostFix":    "",
    "thousands":      ",",
    "lengthMenu":     "Afficher les RDV du _MENU_",
    "loadingRecords": "Chargement...",
    "processing":     "",
    "search":         "Chercher:",
    "zeroRecords":    "Aucun RDV correspondants trouvés",
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
"url": "ajaxappoints.php",
"dataSrc": ""
        },
        "columns": [
{"ID": "#"},
{"date": "Date"},
{"time": "Heure"},
{"name": "Prenom(s)"},
{"fn": "Nom"},
{"dob": "Date de naissance"},
<?php if($_COOKIE['job'] == "Admin"){ ?>
{"mpi": "Médecin"},
<?php } ?>
{"price": "Prix"},
{"pay": "Versement"},
{"remain": "Reste"},
{"observation": "Observation"},
{"actions": "Actions"}

        ],
         initComplete: function(settings, json) {
  var info = table3.page.info();
  var nbr = info.recordsDisplay;
  $("#num2").html(nbr);  
  document.getElementById('num2').style.display = "block";
}
          });


table3.on('click', '.unvalid', function (e) {
  var tr = $(this).closest('tr');
  var data = table3.row(tr).data();

$.ajax({
        url: "appointsvalid.php",
        type: "POST",
        data: {
          valid: '',
          name: data[3],
          fn: data[4],
          date: data[1],
          time: data[2],
        },
        cache: false,
        success: function(dataResult){
alertify.success("Le RDV a été invalidé avec succès");
            $('#tabledisplay').DataTable().ajax.reload(null, false).draw(false);
            $('#table2display').DataTable().ajax.reload(null, false).draw(false);  
            $('#table3display').DataTable().ajax.reload(null, false).draw(false);    
        }
      });

});



table3.on('click', '.edit', function (e) {
  var tr = $(this).closest('tr');
  var data = table3.row(tr).data();
$('.ui.modal.edit').modal('show');
<?php
if($_COOKIE['job'] == "Admin"){
?>
var prix = data[7];
var versement = data[8];
var obs = data[10];
<?php
}else{
?>
var prix = data[6];
var versement = data[7];
var obs = data[9];
<?php
}
?>
$('#patientnamee').val(data[3]);
$('#patientfne').val(data[4]);
$('#patientdobe').val(data[5]);
$('#todaydatee').val(data[1]);
$('#todaytimee').val(data[2]);
$('#pricee').val(prix);
$('#paye').val(versement);
$('#observatione').val(obs);
$('#patientide').val(data[0]);

countremains.call();

});



table2.on('click', '.restore', function (e) {
  var tr = $(this).closest('tr');
  var data = table2.row(tr).data();

$.ajax({
        url: "ajaxappointmentsdel.php",
        type: "POST",
        data: {
          name: data[3],
          fn: data[4],
          date: data[1],
          time: data[2]
        },
        cache: false,
        success: function(dataResult){
          if(dataResult=='200'){
            alertify.success("Le RDV a été restauré avec succès");
            $('#tabledisplay').DataTable().ajax.reload(null, false).draw(false);
            $('#table2display').DataTable().ajax.reload(null, false).draw(false);  
            $('#table3display').DataTable().ajax.reload(null, false).draw(false);        
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
}

function del(name, fn, date, time){
  alertify.confirm("Voulez-vous vraiment supprimer ce RDV?",
  function(){
$.ajax({
        url: "ajaxappointmentsdelete.php",
        type: "POST",
        data: {
          name: name,
          fn: fn,
          date: date,
          time: time
        },
        cache: false,
        success: function(dataResult){
          if(dataResult=='200'){
            alertify.success("Le RDV a été supprimé avec succès");
            $('.ui.modal.valid').modal('hide');
            $('#tabledisplay').DataTable().ajax.reload(null, false).draw(false);
            $('#table2display').DataTable().ajax.reload(null, false).draw(false);  
            $('#table3display').DataTable().ajax.reload(null, false).draw(false);    
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
</script>
</body>
</html>