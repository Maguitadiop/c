
<?php
try {
   $dbh = new PDO('mysql:host=localhost;dbname=test',"root", "admin");
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
$limite = 5;
$listPersonneReq= $dbh->query('SELECT id FROM professeur');
$nbr = $listPersonneReq->rowCount();
$pageTotale = ceil($nbr/$limite);

if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page']>0){
   $_GET['page'] = intval($_GET['page']);
   $pageCourant = $_GET['page'];
   if($pageCourant > $pageTotale){
     $pageCourant = $pageTotale;
   }
}else{
   $pageCourant = 1;
}

$depart = ($pageCourant-1)*$limite;
?>
<!DOCTYPE html>
<html>
    <head>
        <title>liste professeur</title>
        <link rel="stylesheet" href="/css/bootstrap.min.css" >
    </head>
<body>
   <?php 
      $listPersonne = $dbh->query('SELECT * FROM professeur ORDER BY id DESC LIMIT '.$depart.', '.$limite);
    
   ?>
 
     <div class="container">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link active" href="/editionProff.php">Ajouter un professeur</a>
          </li>
        </ul>
        <form method="GET" action ="/veriform.php">
          <input type="search" name="q" placeholder="Recherche..." />
          <input type="submit" value="Valider" />
        </form><br>
     <table class="table">
       <thead>
         <tr>
          <th scope="col">#</th>
          <th scope="col">Prenom</th>
          <th scope="col">Nom</th>
          <th scope="col">Matiere</th>
          <th scope="col">Action</th>
          
       </tr>
       </thead>
       <tbody>
       <?php   foreach($listPersonne as $key => $personne) : ?>
    <tr>
      <th scope="row"><?php echo $key+1; ?></th>
      <td><?php echo $personne['prenomProff'];?></td>
      <td><?php echo $personne['nomProff'];?></td>
      <td><?php echo $personne['matiere'];?></td>
      <td>
      <a href="/editionProff.php?idp=<?php echo $personne['id'];?>" class="badge badge-success">Modifier</a>
      <a href="/supprimerProff.php?idp=<?php echo $personne['id'];?>" class="badge badge-danger">Supprimer</a>
      </td>
    </tr>
        <?php   endforeach; ?>
  </tbody>
</table>
<?php
  for($i=1; $i<=$pageTotale; $i++){
      ?>
 <div>
 <nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="proff.php?page=<?php echo $i-1; ?>" aria-label="Previous">
        <span aria-hidden="true"><?php echo $i-1;?></span>
      </a>
    </li>
    <li class="page-item"><a class="page-link" href="proff.php?page=<?php echo $i; ?>"><?php echo $i;?></a></li>
    <li class="page-item"> <a class="page-link" href="proff.php?page=<?php echo $i+1; ?>" aria-label="Next">
        <span aria-hidden="true"><?php echo $i+1;?></span>
      </a>
    </li>
  </ul>
  <?php 
  }
 ?>
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