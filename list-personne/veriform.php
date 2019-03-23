<meta charset="utf-8" />
<link rel="stylesheet" href="/css/bootstrap.min.css" >
<?php // barre de recherche pour les professeur
try {
    $bdd = new PDO('mysql:host=localhost;dbname=test',"root", "admin");
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
$professeur = $bdd->query('SELECT* FROM professeur ORDER BY id DESC');
if(isset($_GET['q']) AND !empty($_GET['q'])) {
   $q = htmlspecialchars($_GET['q']);
   $professeur = $bdd->query('SELECT* FROM professeur WHERE prenomProff LIKE "%'.$q.'%" ORDER BY id DESC');
   if($professeur->rowCount() == 0) {
      $professeur = $bdd->query('SELECT * FROM professeur WHERE CONCAT(prenomProff,nomProff,matiere) LIKE "%'.$q.'%" ORDER BY id DESC');
   }
}
 if($professeur->rowCount() > 0) { ?>
 <div class="container">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link active" href="/"></a>
          </li>
        </ul>
    <table class="table">
       <thead>
         <tr>
          <th scope="col">Prenom</th>
          <th scope="col">Nom</th>
          <th scope="col">Matiere</th>
          <th scope="col">Action</th>
       </tr>
       </thead>
       <?php while($a = $professeur->fetch()) { ?>
       <tbody>
       <tr>
            <td><?php echo $a['prenomProff'];?></td>
            <td><?php echo $a['nomProff'];?></td>
            <td><?php echo $a['matiere'];?></td>
            <td>
                 <a href="/editionProff.php?idp=<?php echo $a['id'];?>" class="badge badge-success">Modifier</a>
                 <a href="/supprimerProff.php?idp=<?php echo $a['id'];?>" class="badge badge-danger">Supprimer</a>
            </td>
            </tr>
            </tbody>
         <?php } ?>
       
<?php } else { ?>
            Aucun résultat pour: <?= $q ?>...
<?php } ?>

<script src="/js/jquery-3.3.1.slim.min.js" ></script>
<script src="/js/popper.min.js" ></script>
<script src="/js/bootstrap.min.js" ></script>