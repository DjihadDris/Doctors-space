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
  <title>Les médicaments</title>
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


<!-- Edit Modal -->
<div class="ui modal edit mini" id="editmodal">
  <i class="close icon"></i>
  <div class="header">
   <h3><i class="edit icon"></i> Modifier les informations du médicament</h3>
  </div>
      <div class="content">
<div class="ui form">
<input type="hidden" name="id" id="id">
<div class="field">
  <label>Nom de médicament</label>
  <input required id="name" name="name" type="text">
</div>
<br>
<div class="field">
  <label>Forme</label>
  <select required id="form" name="form" class="ui search dropdown">
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

<!-- Add Modal -->
<div class="ui basic modal">
  <i class="close icon"></i>
  <div class="header">
   <h3><i class="plus icon"></i> Ajouter un médicament</h3>
  </div>
      <div class="content">

<form class="ui form" method="POST" action="dodrug" enctype="multipart/form-data">
  <div class="field">
    <div class="two fields">
     <div class="field">
      <label style="color: white !important;">Nom du médicament</label>
       <input required name="name" type="text" placeholder="Nom du médicament">
     </div> 
     <div class="field">
      <label style="color: white !important;">Forme</label>
       <select required name="form" class="ui search dropdown add">
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

<!--<div class="ui placeholder segment">

<form method="POST" action="dodrug" enctype="multipart/form-data" class="ui form">
<div class="field">
  <div class="two fields">
      <label>Nom du médicament</label>
<div class="field">
  <input required name="name" type="text" placeholder="Nom du médicament">
</div>
<div class="field">
  <select required name="form" type="text" class="ui search dropdown">
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
</form>

</div>-->
</div>
      <div class="actions">
    <center>
    <div class="ui buttons" style="width: 100% !important;">
      <button type="submit" class="ui green left labeled icon button"><i class="plus icon"></i>
      Ajouter</button>
      </form>
      <div class="or" data-text="ou"></div>
  <button class="ui negative right labeled icon button"><i class="close icon"></i> Fermer</button>
</div>
</center>
  </div>
</div>


<div class="ui large breadcrumb">
<a href="drugschoose" class="ui blue tag label">Gestion des médicaments</a>
<a class="ui green tag label">Les médicaments</a>
</div>


<div class="ui top attached tabular menu">
<div class="active item" data-tab="first"><i class="list icon inverted green circular"></i> Les médicaments
<div style="display: none;" class="ui green label" id="num1"></div></div>
<div class="item" data-tab="second"><i class="trash icon inverted green circular"></i> Les médicaments supprimés
<div style="display: none;" class="ui red label" id="num2"></div></div>
</div>
  
<div class="ui bottom attached active tab segment" data-tab="first">

<div style="float: right; position: relative;">
  <button class="ui labeled icon button green inverted" onclick="AddDrug()">
  <i class="plus icon"></i>
  Ajouter un médicament
 </button>
</div>
<br><br>

  <script type="text/javascript">
function AddDrug(){
$('.ui.basic.modal').modal('show');
}
  </script>

<table class="ui celled striped selectable table" id="tabledisplay" style="width:100%">
  <thead>
    <tr>
      <th>#</th>
      <th>Nom</th>
      <th>Forme</th>
      <th>Actions</th>
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
      <th>Nom</th>
      <th>Forme</th>
      <th>Actions</th>
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
  function loader(){
  /*$.ajax({
    url: "ajaxdrugs.php",
    type: "POST",
    cache: false,
    success: function(data){
      $('#table').html(data); 
    }
  });
  $.ajax({
    url: "ajaxdrugsdel.php",
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
    "emptyTable":     "Aucun médicament disponible",
    "info":           "Affichage de _START_ à _END_ médicaments sur _TOTAL_",
    "infoEmpty":      "Affichage de 0 à 0 sur 0 médicaments",
    "infoFiltered":   "(filtré à partir de _MAX_ médicaments au total)",
    "infoPostFix":    "",
    "thousands":      ",",
    "lengthMenu":     "Afficher les médicaments du _MENU_",
    "loadingRecords": "Chargement...",
    "processing":     "",
    "search":         "Chercher:",
    "zeroRecords":    "Aucun médicaments correspondants trouvés",
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
"url": "ajaxdrugs.php",
"dataSrc": ""
        },
        "columns": [
{"ID": "#"},
{"name": "Nom"},
{"form": "Forme"},
{"actions": "Actions"}

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
$('#name').val(data[1]);
$('#form').val(data[2]);
$('#id').val(data[0]);

});

table.on('click', '.delete', function (e) {
  var tr = $(this).closest('tr');
  var data = table.row(tr).data();

alertify.confirm("Voulez-vous vraiment supprimer ce médicament:"+" "+data[1]+"?",
  function(){
$.ajax({
        url: "ajaxdrugsdelete.php",
        type: "POST",
        data: {
          name: data[1]
        },
        cache: false,
        success: function(dataResult){
          if(dataResult=='200'){
            alertify.success('Le médicament a été supprimé avec succès');
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
    "emptyTable":     "Aucun médicament disponible",
    "info":           "Affichage de _START_ à _END_ médicaments sur _TOTAL_",
    "infoEmpty":      "Affichage de 0 à 0 sur 0 médicaments",
    "infoFiltered":   "(filtré à partir de _MAX_ médicaments au total)",
    "infoPostFix":    "",
    "thousands":      ",",
    "lengthMenu":     "Afficher les médicaments du _MENU_",
    "loadingRecords": "Chargement...",
    "processing":     "",
    "search":         "Chercher:",
    "zeroRecords":    "Aucun médicaments correspondants trouvés",
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
"url": "ajaxdrugsdel.php",
"dataSrc": ""
        },
        "columns": [
{"ID": "#"},
{"name": "Nom"},
{"form": "Forme"},
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
        url: "ajaxdrugsdeldelete.php",
        type: "POST",
        data: {
          name: data[1]   
        },
        cache: false,
        success: function(dataResult){
          if(dataResult=='200'){
           $('#tabledisplay').DataTable().ajax.reload(null, false).draw(false);    
           $('#table2display').DataTable().ajax.reload(null, false).draw(false);    
alertify.success("Le médicament a été restauré avec succès");        
          }
          else{
            alertify.error('Erreur...');
          }
          
        }
      });

});

}


$(document).ready(function() {

$(document).on("click", "#saveinfo", function() { 
    $.ajax({
      url: "ajaxdrugsupdate.php",
      type: "POST",
      cache: false,
      data:{
        id: $('#id').val(),
        name: $('#name').val(),
        form: $('#form').val()
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
            $('#tabledisplay').DataTable().ajax.reload(null, false).draw(false);    
           $('#table2display').DataTable().ajax.reload(null, false).draw(false);   
        }
      }
    });
  }); 

});
</script>
</body>
</html>