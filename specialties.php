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
  <title>Les spécialités</title>
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
alertify.defaults.glossary.title = 'Ministère de la Santé';
alertify.defaults.glossary.ok = 'Oui';
alertify.defaults.glossary.cancel = 'Non';
    </script>
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

<!-- Add Modal -->
<div class="ui basic modal add">
  <i class="close icon"></i>
  <div class="header">
   <h3><i class="plus icon"></i> Ajouter une spécialité</h3>
  </div>
      <div class="content">

<div class="ui form">
  <div class="field">
     <div class="field">
      <label style="color: white !important;">Nom du spécialité en Français</label>
       <input required id="namefr" type="text" placeholder="Nom du spécialité en Français">
     </div>
     <div class="field">
      <label style="color: white !important;">Nom du spécialité en Arabe</label>
       <input required id="namear" type="text" placeholder="Nom du spécialité en Arabe">
     </div> 
  </div>
  </div>
</div>
      <div class="actions">
    <div class="ui buttons" style="width: 100% !important;">
      <button onclick="savetodata()" class="ui green left labeled icon button"><i class="plus icon"></i> Ajouter</button>
      <div class="or" data-text="ou"></div>
  <button class="ui negative right labeled icon button"><i class="close icon"></i> Fermer</button>
</div>
  </div>
</div>

<!-- Edit Modal -->
<div class="ui basic modal edit" id="editmodal">
  <i class="close icon"></i>
  <div class="header">
   <h3><i class="edit icon"></i> Modifier la spécialité</h3>
  </div>
      <div class="content">

<div class="ui form">
<input type="hidden" id="eid">
  <div class="field">
     <div class="field">
      <label style="color: white !important;">Nom du spécialité en Français</label>
       <input required id="enamefr" type="text" placeholder="Nom du spécialité en Français">
     </div>
     <div class="field">
      <label style="color: white !important;">Nom du spécialité en Arabe</label>
       <input required id="enamear" type="text" placeholder="Nom du spécialité en Arabe">
     </div> 
  </div>
  </div>
</div>
      <div class="actions">
    <div class="ui buttons" style="width: 100% !important;">
      <button id="saveinfo" class="ui green left labeled icon button"><i class="edit icon"></i> Enregistrer</button>
      <div class="or" data-text="ou"></div>
  <button class="ui negative right labeled icon button"><i class="close icon"></i> Fermer</button>
</div>
  </div>
</div>

<div class="ui large breadcrumb">
<a href="userschoose" class="ui blue tag label">Gestion des utilisateurs</a>
<a class="ui green tag label">Les spécialités</a>
</div>


<div class="ui top attached tabular menu">
<div class="active item" data-tab="first"><i class="list icon inverted green circular"></i> Les spécialités
<div style="display: none;" class="ui green label" id="num1"></div></div>
</div>
  
<div class="ui bottom attached active tab segment" data-tab="first">

<div style="float: right; position: relative;">
  <button class="ui labeled icon button green inverted" onclick="AddSpecialty()">
  <i class="plus icon"></i>
  Ajouter une spécialité
 </button>
</div>
<br><br>

  <script type="text/javascript">
function AddSpecialty(){
$('.ui.basic.modal.add').modal('show');
}
  </script>

<table class="ui celled striped selectable table" id="tabledisplay" style="width:100%">
  <thead>
    <tr>
      <th>#</th>
      <th>Nom en Français</th>
      <th>Nom en Arabe</th>
      <?php
      if($_COOKIE['name'] == "Djihad"){
      ?>
      <th>Actions</th>
      <?php
      }
      ?> 
    </tr>
  </thead>
  <tbody id="table">

  </tbody>
</table>
        </div>
        <div class="ui bottom attached tab segment" data-tab="second">

<table id="table2display" class="ui celled striped selectable table" style="width:100%;">
  <thead>
    <tr>
      <th>#</th>
      <th>Nom en Français</th>
      <th>Nom en Arabe</th>
      <?php
      if($_COOKIE['name'] == "Djihad"){
      ?>
      <th>Actions</th>
      <?php
      }
      ?> 
    </tr>
  </thead>
  <tbody id="table2">

  </tbody>
</table>

        </div>


<script type="text/javascript" src="admin.js"></script>
<script>
$('.ui.dropdown.add').dropdown();
$('.menu .item').tab();

function savetodata(){
  var namefr = document.getElementById('namefr').value;
  var namear = document.getElementById('namear').value;

if(namefr != "" && namear !=""){

$.ajax({
        url: "dospecialty.php",
        type: "POST",
        data: {
          namefr: namefr,
          namear: namear
        },
        cache: false,
        success: function(dataResult){
          if(dataResult=='200'){
            $('.ui.basic.modal.add').modal('hide');
            alertify.success('La spécialité a été ajouté avec succès');
            document.getElementById('namefr').value = "";
            document.getElementById('namear').value = "";
            $('#tabledisplay').DataTable().ajax.reload(null, false).draw(false);           
          }
          else{
            alertify.error('Erreur...');
          }
          
        }
      });

}else{
  alertify.alert('Veuillez entrer le nom de la spécialité en Français et en Arabe');
}

}

  function loader(){
var table = $('#tabledisplay').DataTable({
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
    "emptyTable":     "Aucune spécialité disponible",
    "info":           "Affichage de _START_ à _END_ spécialités sur _TOTAL_",
    "infoEmpty":      "Affichage de 0 à 0 sur 0 spécialités",
    "infoFiltered":   "(filtré à partir de _MAX_ spécialités au total)",
    "infoPostFix":    "",
    "thousands":      ",",
    "lengthMenu":     "Afficher les spécialités du _MENU_",
    "loadingRecords": "Chargement...",
    "processing":     "",
    "search":         "Chercher:",
    "zeroRecords":    "Aucun spécialités correspondants trouvés",
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
"url": "ajaxspecialties.php",
"dataSrc": ""
        },
        "columns": [
{"ID": "#"},
{"namefr": "Nom en Français"},
{"namear": "Nom en Arabe"},
<?php
if($_COOKIE['name'] == "Djihad"){
?>
{"actions": "Actions"}
<?php
}
?>
        ],
         initComplete: function(settings, json) {
  var info = table.page.info();
  var nbr = info.recordsDisplay;
  $("#num1").html(nbr);  
  document.getElementById('num1').style.display = "block";
}
          });

table.on('click', '.edit', function (e) {
  var tr = $(this).closest('tr');
  var data = table.row(tr).data();

$('.ui.modal.edit').modal('show');
$('#eid').val(data[0]);
$('#enamefr').val(data[1]);
$('#enamear').val(data[2]);

});

table.on('click', '.delete', function (e) {
  var tr = $(this).closest('tr');
  var data = table.row(tr).data();

alertify.confirm("Voulez-vous vraiment supprimer cette spécialité:"+" "+data[1]+" ("+data[2]+")?",
  function(){
$.ajax({
        url: "ajaxspecialtiesdelete.php",
        type: "POST",
        data: {
          namefr: data[1],
          namear: data[2],
        },
        cache: false,
        success: function(dataResult){
          if(dataResult=='200'){
            alertify.success('La spécialité a été supprimé avec succès');
            $('#tabledisplay').DataTable().ajax.reload(null, false).draw(false);           
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

$(document).on("click", "#saveinfo", function() { 
    $.ajax({
      url: "ajaxspecialtiessupdate.php",
      type: "POST",
      cache: false,
      data:{
        id: $('#eid').val(),
        namefr: $('#enamefr').val(),
        namear: $('#enamear').val()
      },
      success: function(dataResult){
        var dataResult = JSON.parse(dataResult);
        if(dataResult.statusCode==200){
          $('#editmodal').modal().hide();
          alertify.success('Modifications enregistrées avec succès');
          $('#tabledisplay').DataTable().ajax.reload(null, false).draw(false);
        }else{
          alertify.error('Erreur...');
          $('#tabledisplay').DataTable().ajax.reload(null, false).draw(false);
        }
      }
    });
  }); 

});
</script>
</body>
</html>