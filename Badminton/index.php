<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css"/>
    
    <title></title>
</head>
<body>
<?php include("entete.php"); ?>

<marquee><h2>Badminton</h2></marquee>
<div id="bloc">
<div class="card-deck">
  <div class="card">
    <img class="card-img-top" src="images/gestion.jpg" alt="Card image cap" height="180px" width="200px">
    <div class="card-body">
      <h5 class="card-title" id="bloc">Gestion des adhérents</h5>
      <p class="card-text">Les adhésions seront d’abord ouvertes aux adhérents de l’année passée, puis à tous. Si le formulaire ne vous autorise pas l’accès, c’est parce que vous n’étiez pas adhérent(e) l’an dernier.</p>
    </div>
    <div class="card-footer">
      <small class="text-muted"><a href="gestion.php">En savoir plus</a></small>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" src="images/ajoute.jpg" alt="Card image cap" height="180px">
    <div class="card-body">
      <h5 class="card-title" id="bloc">Ajouter un adhérent</h5>
      <p class="card-text">Il vous faudra remplir le formulaire d’adhésion mis en ligne. <br> Le remplissage de l’ensemble du formulaire devrait vous prendre moins de 5 minutes.</p>
    </div>
    <div class="card-footer">
      <small class="text-muted"><a href="ajout.php">En savoir plus</a></small>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" src="images/pat.jpg" alt="Card image cap" height="180px">
    <div class="card-body">
      <h5 class="card-title" id="bloc">Rechercher des partenaires</h5>
      <p class="card-text">Le badminton est un petit monde dans lequel on se croise toujours avec plaisir.
      Les partenaires de Badminton méritent surement d'être les vôtres. 
      </p>
    </div>
    <div class="card-footer">
      <small class="text-muted"><a href="partenaire.php">En savoir plus</a></small>
    </div>
  </div>
</div>
</div>
<?php include("pied.php"); ?>
<script src="/js/jquery-3.3.1.slim.min.js" ></script>
<script src="/js/popper.min.js" ></script>
<script src="/js/bootstrap.min.js" ></script>
</body>
</html>