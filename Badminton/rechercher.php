<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css"/>
    <title>Recherche d'un adhérent</title>
</head>
<body>

<?php include("entete.php"); ?>

<marquee><h2>Résultat de recherche</h2></marquee>
<?php
 try {
   $dbh = new PDO('mysql:host=localhost;dbname=badminton',"root", "admin");
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
$adherent= $dbh->query('SELECT * FROM adherent ORDER BY matriculeAdh DESC');
if(isset($_GET['q']) AND !empty($_GET['q'])) {
    $q = htmlspecialchars($_GET['q']);
    $adherent = $dbh->query('SELECT* FROM adherent WHERE prenomAdh LIKE "%'.$q.'%" ORDER BY matriculeAdh DESC');
    if($adherent->rowCount() == 0) {
        $adherent = $dbh->query('SELECT * FROM adherent WHERE CONCAT(prenomAdh,nomAdh,sexe,adresseAdh,villeAdh,cpAdh
                              ,niveauAdh,typeAdh) LIKE "%'.$q.'%" ORDER BY matriculeAdh DESC');
    }
}
if($adherent ->rowCount() > 0) { ?>
    <div class="container">
           <ul class="nav">
             <li class="nav-item">
               <a class="nav-link active" href="/"></a>
             </li>
           </ul>
        
       <table class="table">
       <thead>
         <tr>
          <th scope="col">Nom</th>
          <th scope="col">Prenom</th>
          <th scope="col">Niveau</th>
          <th scope="col">Action</th>
         </tr>
       </thead>
       <?php while($a = $adherent ->fetch()) {  ?>
       <tbody>
      <tr>
      <td><?php echo $a['nomAdh'];?></td>
      <td><?php echo $a['prenomAdh'];?></td>
      <td><?php echo $a['niveauAdh'];?></td>
      <td>
      <a href="detail.php?idp=<?php echo $a['matriculeAdh'];?>" class="badge badge-danger">Detail</a>
      <a href="modifier.php?idp=<?php echo $a['matriculeAdh'];?>" class="badge badge-success">Modifier</a>
      <a href="supprimer.php?idp=<?php echo $a['matriculeAdh'];?>" class="badge badge-danger">Supprimer</a>
      </td>
      </tr>
     </tbody>
     <?php
     } ?>
 <?php } else { ?>
    Aucun résultat pour:  <?= $q ?>...
    <?php } ?>
     <br>
<div class="precede"><a href="gestion.php">Cliquez ici pour retourner </a></div>
<?php include("pied.php"); ?>
<script src="/js/jquery-3.3.1.slim.min.js" ></script>
<script src="/js/popper.min.js" ></script>
<script src="/js/bootstrap.min.js" ></script>
</body>
</html>