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
    <title>Réinitialiser le mot de passe - E-learning DZ</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="css/mdb.min.css" />
    <link rel="stylesheet" href="admin.css" />
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <link rel="shrtcut icon" type="text/css" href="../square.webp">
    <script src="../alertify.min.js"></script>
    <link rel="stylesheet" href="../css/alertify.min.css" />
    <link rel="stylesheet" href="../css/themes/default.min.css" />
</head>
<body>
      <!--Main Navigation-->
  <header>
    <style>
      #intro {
        background-image: url(https://mdbootstrap.com/img/new/fluid/city/008.jpg);
        height: 100vh;
      }

      /* Height for devices larger than 576px */
      @media (min-width: 992px) {
        #intro {
          margin-top: -58.59px;
        }
      }

      .navbar .nav-link {
        color: #fff !important;
      }
    </style>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark d-none d-lg-block" style="z-index: 2000;">
      <div class="container-fluid">
        <!-- Navbar brand -->
        <a class="navbar-brand nav-link" target="" href="../">
          <strong>E-learning DZ</strong>
        </a>
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarExample01"
          aria-controls="navbarExample01" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
        </button>
      </div>
    </nav>
    <!-- Navbar -->

    <!-- Background image -->
    <div id="intro" class="bg-image shadow-2-strong">
      <div class="mask d-flex align-items-center h-100" style="background-color: rgba(0, 0, 0, 0.8);">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-md-8">
              <div class="bg-white rounded shadow-5-strong p-5">
                <!-- Email input -->
                <div class="form-outline mb-4">
                  <input type="email" id="email" class="form-control" />
                  <label class="form-label" for="email">Adresse e-mail</label>
                </div>

                <!-- 2 column grid layout for inline styling -->
                <div class="row mb-4">
                  <div class="col d-flex justify-content-center">
                  </div>
                  <div class="col text-center">
                    <!-- Simple link -->
                    <a href="login">S'identifier</a>
                  </div>
                </div>

                <!-- Submit button -->
                <button id="login" type="submit" class="btn btn-primary btn-block">Envoyer</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Background image -->
  </header>
  <!--Main Navigation-->

  <script>
$(document).ready(function() {
  $('#login').on('click', function() {
    var emaili = $('#email').val();
    if(emaili!=""){
      $.ajax({
        url: "doresetpassword.php",
        type: "POST",
        data: {
          email: emaili    
        },
        cache: false,
        success: function(dataResult){
          if(dataResult=='200'){
           alertify.success('Le mot de passe a été envoyé à votre adresse e-mail avec succès');   
          }
          else{
            alertify.error('Email invalide');
          }
          
        }
      });
    }
    else{
      alertify.error("Veuillez remplir l'adresse e-mail");
    }
  });
});
</script>
</body>
</html>
  </script>

    <!-- MDB -->
    <script type="text/javascript" src="js/mdb.min.js"></script>

</body>
</html>