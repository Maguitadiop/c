<?php
try {
   $dbh = new PDO('mysql:host=localhost;dbname=badminton',"root", "admin");
   $adherent= $dbh->query('SELECT * from adherent ORDER BY nomAdh');
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>gestion adhérent</title>
        <link rel="stylesheet" href="/css/bootstrap.min.css" >
    </head>
<body>
<?php include("entete.php"); ?>
<marquee><h2>Gestion des adhérents</h2></marquee>
     <div class="container">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link active" href=""></a>
          </li>
        </ul>
        <form method="GET" action ="/rechercher.php">
          <input type="search" name="q" placeholder="Recherche..." />
          <input type="submit" value="Rechercher" />
        </form><br>

        <table class="table">
       <thead>
         <tr>
          <th scope="col">#</th>
          <th scope="col">Nom</th>
          <th scope="col">Prenom</th>
          <th scope="col">Niveau</th>
          <th scope="col">Action</th>
       </tr>
       </thead>
       <tbody>
       <?php   foreach($adherent as $key => $personne) : ?>
       <tr>
      <th scope="row"><?php echo $key+1; ?></th>
      <td><?php echo $personne['nomAdh'];?></td>
      <td><?php echo $personne['prenomAdh'];?></td>
      <td><?php echo $personne['niveauAdh'];?></td>
      <td>
      <a href="detail.php?idp=<?php echo $personne['matriculeAdh'];?>" class="badge badge-danger">Detail</a>
      <a href="modifier.php?idp=<?php echo $personne['matriculeAdh'];?>" class="badge badge-success">Modifier</a>
      <a href="supprimer.php?idp=<?php echo $personne['matriculeAdh'];?>" class="badge badge-danger">Supprimer</a>
      </td>
    </tr>
        <?php   endforeach; ?>
  </tbody>
</table>
<?php include("pied.php"); ?>
<script src="/js/jquery-3.3.1.slim.min.js" ></script>
<script src="/js/popper.min.js" ></script>
<script src="/js/bootstrap.min.js" ></script>
</body>
</html>