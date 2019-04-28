<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css"/>
    <title>detail d'un adhérent</title>
</head>
<body>
<?php include("entete.php"); ?>
<marquee><h2>Détail d'un adhérent</h2></marquee>
<div id="detail">
<?php
try {
    $dbh = new PDO('mysql:host=localhost;dbname=badminton',"root", "admin");
    $idmatricule = $_GET['idp'];
    $adherent= $dbh->query('SELECT * from adherent,type WHERE typeAdh=numType AND matriculeAdh ='.$idmatricule );
 } catch (PDOException $e) {
     print "Erreur !: " . $e->getMessage() . "<br/>";
     die();
 }
 foreach($adherent as $key => $personne) :?>
   <h3>Nom :&nbsp;&nbsp;&nbsp;<?php echo $personne['nomAdh'];?></h3>
   <h3>Prenom :&nbsp;&nbsp;&nbsp;<?php echo $personne['prenomAdh'];?></h3>
   <h3>Sexe :&nbsp;&nbsp;&nbsp;<?php echo $personne['sexe'];?></h3>
   <h3>Adresse :&nbsp;&nbsp;&nbsp;<?php echo $personne['adresseAdh'];?></h3>
   <h3>Ville :&nbsp;&nbsp;&nbsp;<?php echo $personne['villeAdh'];?></h3>
   <h3>Code postal :&nbsp;&nbsp;&nbsp;<?php echo $personne['cpAdh'];?></h3>
   <h3>Niveau :&nbsp;&nbsp;&nbsp;<?php echo $personne['niveauAdh'];?></h3>
   <h3>Libellé type :&nbsp;&nbsp;&nbsp;<?php echo $personne['libelleType'];?></h3>
   <h3>Montant licence :&nbsp;&nbsp;&nbsp;<?php echo $personne['montantLicence'];?></h3>
</div>
<?php   endforeach; ?><br><br>
<div class="precede"><a href="gestion.php">Cliquez ici pour retourner</a></div>
<?php include("pied.php"); ?>

<script src="/js/jquery-3.3.1.slim.min.js" ></script>
<script src="/js/popper.min.js" ></script>
<script src="/js/bootstrap.min.js" ></script>
</body>
</html>