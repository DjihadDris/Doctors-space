<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Imprimer la formulaire de l'infirmier</title>
	<link rel="stylesheet" type="text/css" href="admin.css">
     <link rel="shortcut icon" type="text/css" href="square.webp">
	<script type="text/javascript">
		setTimeout(window.print(), 2500);
	</script>
</head>
<body>

<div style="text-align: center !important;">
	<h3>
République Algérienne Démocratique et Populaire
		<br>
Ministère de la Santé
	</h3>
</div>

<div style="text-align: left !important;">
	<h4>
        Prenom(s)/ Nom: <?php echo $_GET['name']; ?>
        <br>
        Date de naissance: <?php echo $_GET['dob']; ?>
        <br>
        Sexe: <?php echo $_GET['gender']; ?>
        <br>
        Adresse e-mail: <?php echo $_GET['email']; ?>
        <br>
        Numéro de téléphone: <?php echo $_GET['pn']; ?>
        <br>
        Le groupe sanguin: <?php echo $_GET['groupage']; ?>
        <br>
        Wilaya: <?php echo $_GET['wilaya']; ?>
        <br>
        Adresse: <?php echo $_GET['address']; ?>
        <br>
        Le médecin: <?php echo $_GET['mp']; ?>
        <br>
        Code: <?php echo $_GET['code']; ?>
        <br>
        Mot de passe: <?php echo $_GET['password']; ?>
	</h4>
</div>

<div style="text-align: right !important; margin-right: 50px !important;">
     <h5>Cachet et signature</h5>
</div>

</body>
</html>