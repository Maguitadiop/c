<meta charset="utf-8" />
<link rel="stylesheet" href="/css/bootstrap.min.css" >

<?php // barre de recherche pour éléves

try {
    $bdd = new PDO('mysql:host=localhost;dbname=test',"root", "admin");
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
$eleve = $bdd->query('SELECT* FROM db_personne ORDER BY id DESC');
if(isset($_GET['q']) AND !empty($_GET['q'])) {
   $q = htmlspecialchars($_GET['q']);
   $eleve = $bdd->query('SELECT* FROM db_personne WHERE prenom LIKE "%'.$q.'%" ORDER BY id DESC');
   if($eleve->rowCount() == 0) {
      $eleve = $bdd->query('SELECT * FROM db_personne WHERE CONCAT(prenom,nom,email,motdepasse,
      adresse1,adresse2,ville,codepostal,rue) LIKE "%'.$q.'%" ORDER BY id DESC');
   }
}
 if($eleve ->rowCount() > 0) { ?>
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
          <th scope="col">Mail</th>
          <th scope="col">Mot de passe</th>
          <th scope="col">Adresse1</th>
          <th scope="col">Adresse2</th>
          <th scope="col">Ville</th>
          <th scope="col">Code postal</th>
          <th scope="col">Rue</th>
          <th scope="col">Action</th>
       </tr>
       </thead>
       <?php while($a = $eleve ->fetch()) { ?>
       <tbody>
       <tr>
            <td><?php echo $a['prenom'];?></td>
            <td><?php echo $a['nom'];?></td>
            <td><?php echo $a['email'];?></td>
            <td><?php echo $a['motdepasse'];?></td>
            <td><?php echo $a['adresse1'];?></td>
            <td><?php echo $a['adresse2'];?></td>
            <td><?php echo $a['ville'];?></td>
            <td><?php echo $a['codepostal'];?></td>
            <td><?php echo $a['rue'];?></td>
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