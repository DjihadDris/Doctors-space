<?php
if(isset($_COOKIE["name"])){
  header('Location: dashboard');
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
  <script src="alertify.min.js"></script>
    <link rel="stylesheet" href="css/alertify.min.css" />
    <link rel="stylesheet" href="css/themes/default.min.css" />
<link rel="stylesheet" href="admin.css" />
    <link rel="shortcut icon" type="text/css" href="square.webp">
    <style type="text/css">
      .pack{
    background: transparent;
    float: left;
    margin: 1px 0px;
    width: 290px;
    height: 278px;
    border: 2px #cccccc solid;
    border-left: none;position: relative;border: 1px #cccccc solid;
    transition: 0.5s;
}
.ui.dimmer.modals.page.transition.visible.active{
  overflow-y: hidden !important;
}
.ui.blue.center.aligned.form.segment{
  margin-top: 15% !important;
}
    </style>
</head>
<body oncontextmenu="return false;" style="overflow-y: hidden !important;">

    <div class="ui basic small modal login" style="width: 578px !important; height: 620px !important;">
        <div class="ui blue center aligned form segment">
            <img class="ui centered image" src="ms.jpg">
            <h3 class="center aligned header form-head">
                <div class="container">
                    <font> <span id="holder" style="color: #2185d0;"></span></font>
                </div>
            </h3>
            <form class="ui form">

                <div class="ui dimmer">
                    <div class="ui loader"></div>
                </div>
                <div class="ui segment animated zoomInDown">
                    <div class="field">
                      <div class="ui left icon input">
<a style="width: 130px !important;" class="ui blue medium label"><i class=" blue inverted circular pointing right icon"></i> La Wilaya</a>

<div style="width: 100% !important;" class="ui fluid search selection dropdown">
        <input id="wilaya" type="hidden" name="wilaya">
        <i class="dropdown icon"></i>
        <div class="default text">--Sélectionner la Wilaya--</div>
        <div class="menu">
    <div class="item" data-value="Adrar">Adrar</div>
    <div class="item" data-value="Chlef">Chlef</div>
    <div class="item" data-value="Laghouat">Laghouat</div>
    <div class="item" data-value="Oum El Bouaghi">Oum El Bouaghi</div>
    <div class="item" data-value="Batna">Batna</div>
    <div class="item" data-value="Bejaia">Bejaia</div>
    <div class="item" data-value="Biskra">Biskra</div>
    <div class="item" data-value="Bechar">Bechar</div>
    <div class="item" data-value="Blida">Blida</div>
    <div class="item" data-value="Bouira">Bouira</div>
    <div class="item" data-value="Tamanrasset">Tamanrasset</div>
    <div class="item" data-value="Tebessa">Tebessa</div>
    <div class="item" data-value="Tlemcen">Tlemcen</div>
    <div class="item" data-value="Tiaret">Tiaret</div>
    <div class="item" data-value="Tizi Ouzou">Tizi Ouzou</div>
    <div class="item" data-value="Alger">Alger</div>
    <div class="item" data-value="Djelfa">Djelfa</div>
    <div class="item" data-value="Jijel">Jijel</div>
    <div class="item" data-value="Setif">Setif</div>
    <div class="item" data-value="Saida">Saida</div>
    <div class="item" data-value="Skikda">Skikda</div>
    <div class="item" data-value="Sidi Bel Abbes">Sidi Bel Abbes</div>
    <div class="item" data-value="Annaba">Annaba</div>
    <div class="item" data-value="Guelma">Guelma</div>
    <div class="item" data-value="Constantine">Constantine</div>
    <div class="item" data-value="Medea">Medea</div>
    <div class="item" data-value="Mostaganem">Mostaganem</div>
    <div class="item" data-value="MSila">MSila</div>
    <div class="item" data-value="Mascara">Mascara</div>
    <div class="item" data-value="Ouargla">Ouargla</div>
    <div class="item" data-value="Oran">Oran</div>
    <div class="item" data-value="El Bayadh">El Bayadh</div>
    <div class="item" data-value="Illizi">Illizi</div>
    <div class="item" data-value="Bordj Bou Arreridj">Bordj Bou Arreridj</div>
    <div class="item" data-value="Boumerdes">Boumerdes</div>
    <div class="item" data-value="El Tarf">El Tarf</div>
    <div class="item" data-value="Tindouf">Tindouf</div>
    <div class="item" data-value="Tissemsilt">Tissemsilt</div>
    <div class="item" data-value="El Oued">El Oued</div>
    <div class="item" data-value="Khenchela">Khenchela</div>
    <div class="item" data-value="Souk Ahras">Souk Ahras</div>
    <div class="item" data-value="Tipaza">Tipaza</div>
    <div class="item" data-value="Mila">Mila</div>
    <div class="item" data-value="Ain Defla">Ain Defla</div>
    <div class="item" data-value="Naama">Naama</div>
    <div class="item" data-value="Ain Temouchent">Ain Temouchent</div>
    <div class="item" data-value="Ghardaia">Ghardaia</div>
    <div class="item" data-value="Relizane">Relizane</div>
  </div>
</div>
</div>                   
                    </div>
                    <div class="field">
                        <div class="ui left icon input">
                            <i class=" blue inverted circular user icon"></i>
                            <input id="email" type="text" placeholder="Votre adresse e-mail/ numéro de téléphone/ code sanitaire" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');">
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="blue inverted circular lock icon"></i>
                            <input id="password" type="password" placeholder="Votre mot de passe" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');">
                        </div>
                    </div>
                    <div class="field">
                      <input hidden type="checkbox" value="remember" id="remember">
                    </div>
                     <div id="capt" class="two fields">
                        <div class="field">
                            <div style="background: url('capt.png') no-repeat 100%; width: 100px; height: 35px; margin-left: 70px; font-size: 25px; border-radius: 5px;"><p id="capt2"></p></div>
                        </div>
                        <div class="field">
                            <div class="ui left icon input biarabi">
                                <i class="pencil icon"></i>
                                <input id="capt3" placeholder="Entrez le code" maxlength="3" autocomplete="off">
                            </div>
                        </div>
                    </div>
                   <div class="field">
                        <button type="submit" id="login" class="ui button large fluid blue">Se connecter</button>
                    </div>
                </div>
            </form>

        </div>
    </div>


<div class="ui basic modal new">
  <div class="header">
   <h3><i class="list icon"></i> Le mode d'emploi</h3>
  </div>
      <div class="content">

<div class="ui negative message" style="margin-top: 7.5px;">
    <p>Cette fenêtre contextuelle n'apparaîtra que si vous vous connectez pour la première fois.</p>
</div>

<ul>
    <li>Vous pouvez nous contacter à tout moment, dans tous les cas (demande de modification des données, ...) par l'adresse e-mail (electroniquealgerien@gmail.com) ou WhatsApp uniquement (0673 73 02 90).</li>
    <li>Vous pouvez ajouter un patient/ infirmier en scannant son code à barre à l'aide d'un lecteur code barres (Exemple: SunLux XL-2021), et vous pouvez également taper le code manuellement.</li>
    <li>Vous pouvez imprimer le code à barre du patient/ infirmier à l'aide d'une imprimante code barres (Exemple: TSC TDP-225).</li>
    <li>Il est conseillé de demander au patient s'il possède une carte sanitaire avant de rajouter ses informations dans le système, afin de ne pas provoquer un défaut de transfert et de récupération de ses données.</li>
    <li>Vous pouvez utiliser les fonctionnalités de base du système disponible, mais vous ne pouvez pas utiliser certaines des fonctionnalités payantes sans vous abonner à l'un des forfaits d'abonnement.</li>
</ul>

</div>
      <div class="actions">
    <center>
    <div class="ui buttons" style="width: 100% !important;">
      <a href="dashboard" type="submit" class="ui green left labeled icon button"><i class="check icon"></i>
      Accepter</a>
</div>
</center>
  </div>
</div>


    <div style="height: 78px !important; " class="ui fixed blue inverted main menu ">
        <div class="container">
            <div class="ui blue big launch right attached fixed button ">
                <i class="circular white content icon"></i>

            </div>
            <div class="left menu">

                <div class="title item">
                    <h3 class="ui header white"><a href="#"><img src="ms.png" style="width: 357px; height: 50px;">
</a></h3>
                </div>
            </div>

        </div>
    </div>

<h1 class="ui blue header pack-price1">Le sol numérique du Ministère de la Santé</h1>


<section class="wraper_bg-bright">

<article class="packs-cont">
            <div class="mbl-packs-cont">

                <div class="pack" data-0="opacity:1;left:0%;" data-300="left:-100%; opacity:0" data-600="left:0%; opacity:1" data-900="left:0%; opacity:1" data-1200="left:-100%; opacity:0">
                    <header class="pack-h"></header>
                    <img class="imgradius" src="patients.webp">
                      <div class="pack-info">
                       <div class="menu">
                            <span>Les patients</span>
                        </div>
                        <div class="menu">
                            <span>Les ordonnances</span>
                        </div>
                        <div class="menu">
                            <span>Les rendez-vous</span>
                        </div>
                    </div>
                </div>

                <div class="pack" data-0="opacity:1;left:0%;" data-250="left:-100%; opacity:0" data-510="left:0%; opacity:1" data-960="left:0%; opacity:1" data-1170="left:-100%; opacity:0">
                    <header class="pack-h"></header>
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

                <div class="pack" data-0="opacity:1;left:0%;" data-250="left:100%; opacity:0" data-510="left:0%; opacity:1" data-960="left:0%; opacity:1" data-1170="left:100%; opacity:0">
                    <header class="pack-h"></header>
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

  <script>
$(document).ready(function() {
  $('.ui.dropdown').dropdown();
  $('#capt').hide();
  $('.ui.basic.modal.login').modal({
                    transition: 'horizontal flip',
                    closable: false
                }).modal('show').modal('refresh');
var text = "Bienvenue à le sol numérique du Ministère de la Santé";
                var chars = text.split('');
                var container = document.getElementById("holder");
                var i = 1;
                container.innerHTML = "B";
                setInterval(function() {
                    if (i < chars.length) {
                        container.innerHTML += chars[i++];
                    } else {
                        container.innerHTML = "B"
                        i = 1;
                    }
                }, 100);

$("#wilaya").change(function(){
$('.ui.form').dimmer('show');
if ($("#wilaya").val() != ""){
showcapt.call();
$('.ui.form').dimmer('hide');
$('#capt').show();
}
});

function showcapt(){
var chr1 = Math.ceil(Math.random() * 999) + ''; 
var str = new Array(4).join().replace(/(.|$)/g, function () { return ((Math.random() * 36) | 0).toString(36)[Math.random() < .5 ? "toString" : "toUpperCase"](); });  
var captchaCode =/* str +*/ chr1/* + chr2 + chr3*/;  
document.getElementById("capt2").innerHTML = captchaCode;
}

  $('#login').on('click', function() {
    var emaili = $('#email').val();
    var passwordi = $('#password').val();
    var wilayai = $('#wilaya').val();
    var capt3 = $('#capt3').val();
    var capt2 = $('#capt2').html();
          var test = $('#remember');
      if(test.is(':checked')){
var rememberi = "yes";
      }else{
var rememberi = "no";
      }
    if(wilayai!=""){
      if(emaili!=""){
        if(passwordi!=""){
          if(capt3!=""){
            if(capt3==capt2){
      $.ajax({
        url: "dologin.php",
        type: "POST",
        data: {
          email: emaili,
          password: passwordi,     
          remember: rememberi,
          wilaya: wilayai      
        },
        cache: false,
        beforeSend: function() {
        $('.ui.form').dimmer('show');
        },
        success: function(dataResult){
          if(dataResult=='1'){
            location.href = "dashboard";
          }else if (dataResult=='2'){
            alertify.error('Adresse e-mail/ numéro de téléphone/ code sanitaire invalid');
showcapt.call();
$('.ui.form').dimmer('hide');
          }else if (dataResult=='3'){
            $('.ui.basic.modal.new').modal({
                closable: false
            }).modal('show');
            $('.ui.form').dimmer('hide');
          }else if (dataResult=='4'){
            alertify.error('Mot de passe invalid');
showcapt.call();
$('.ui.form').dimmer('hide');
          }else if (dataResult=='5'){
            alertify.error('Votre compte est désactivé');
showcapt.call();
$('.ui.form').dimmer('hide');
          }else{
            alertify.error('Erreur...');
            location.reload();
          }
          
        }
      });
    }else{
      alertify.error("Le code est invalid");
$('.ui.form').dimmer('show');
showcapt.call();
$('.ui.form').dimmer('hide');
    }
    }else{
      alertify.error("Veuillez remplir le code");
$('.ui.form').dimmer('show');
showcapt.call();
$('.ui.form').dimmer('hide');
    }
    }else{
      alertify.error("Veuillez remplir le mot de passe");
$('.ui.form').dimmer('show');
showcapt.call();
$('.ui.form').dimmer('hide');
    }
    }else{
      alertify.error("Veuillez remplir l'adresse e-mail/ numéro de téléphone/ code sanitaire");
$('.ui.form').dimmer('show');
showcapt.call();
$('.ui.form').dimmer('hide');
    }
    }else{
      alertify.error('Veuillez sélectionner la Wilaya');
$('.ui.form').dimmer('show');
showcapt.call();
$('.ui.form').dimmer('hide');
    }
    return false;
  });
});
</script>
</body>
</html>