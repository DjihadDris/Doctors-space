<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Imprimer la formulaire du patient</title>
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
		Nom: <?php echo $_GET['fn']; ?>
         <br>
        Prenom(s): <?php echo $_GET['name']; ?>
        <br>
        Date de naissance: <?php echo $_GET['dob']; ?>
        <br>
        Sexe: <?php echo $_GET['gender']; ?>
        <br>
        Adresse e-mail: <?php echo $_GET['email']; ?>
        <br>
        Numéro de téléphone: <?php echo $_GET['pn']; ?>
        <br>
        Wilaya: <?php echo $_GET['wilaya']; ?>
        <br>
        Adresse: <?php echo $_GET['address']; ?>
        <br>
        Le groupe sanguin: <?php echo $_GET['groupage']; ?>
        <br>
        La taille: <?php echo $_GET['height']; ?> cm
        <br>
        Le poids: <?php echo $_GET['weight']; ?> kg
        <br>
        Maladies chroniques: <?php echo $_GET['chronic']; ?>
        <br>
        Opérations chirurgicales: <?php echo $_GET['surgeries']; ?>
        <br>
        Allergies: <?php echo $_GET['allergies']; ?>
        <br>
        Remarques: <?php echo $_GET['notes']; ?>
        <br>
        Le médecin: <?php echo $_GET['mpi']; ?>
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