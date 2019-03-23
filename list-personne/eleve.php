
<?php
try {
   $dbh = new PDO('mysql:host=localhost;dbname=test',"root", "admin");
   $listPersonne= $dbh->query('SELECT * from db_personne');
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>liste personne</title>
        <link rel="stylesheet" href="/css/bootstrap.min.css" >
    </head>
<body>
 
     <div class="container">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link active" href="/edition.php">Ajouter un éléve </a>
          </li>
        </ul>
        <form method="GET" action ="/rechEleve.php">
          <input type="search" name="q" placeholder="Recherche..." />
          <input type="submit" value="Valider" />
        </form><br>
     <table class="table">
       <thead>
         <tr>
          <th scope="col">#</th>
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
       <tbody>
       <?php   foreach($listPersonne as $key => $personne) : ?>
    <tr>
      <th scope="row"><?php echo $key+1; ?></th>
      <td><?php echo $personne['prenom'];?></td>
      <td><?php echo $personne['nom'];?></td>
      <td><?php echo $personne['email'];?></td>
      <td><?php echo $personne['motdepasse'];?></td>
      <td><?php echo $personne['adresse1'];?></td>
      <td><?php echo $personne['adresse2'];?></td>
      <td><?php echo $personne['ville'];?></td>
      <td><?php echo $personne['codepostal'];?></td>
      <td><?php echo $personne['rue'];?></td>
      <td>
      <a href="/edition.php?idp=<?php echo $personne['id'];?>" class="badge badge-success">Modifier</a>
      <a href="/supprimer.php?idp=<?php echo $personne['id'];?>" class="badge badge-danger">Supprimer</a>
      </td>
    </tr>
        <?php   endforeach; ?>
  </tbody>
</table>

<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
  <div class="container">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link active" href="/index.php">cliquez ici pour retourner</a>
          </li>
        </ul>
  </div>
</nav>
</div>

<script src="/js/jquery-3.3.1.slim.min.js" ></script>
<script src="/js/popper.min.js" ></script>
<script src="/js/bootstrap.min.js" ></script>
    </body>
</html>