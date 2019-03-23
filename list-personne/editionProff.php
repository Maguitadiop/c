
<?php
$id =isset($_GET['idp'])?$_GET['idp']:0;
try {
    $dbh = new PDO('mysql:host=localhost;dbname=test',"root", "admin");
   
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

$idPost =isset($_POST['id'])?$_POST['id']:-1;

if($idPost>=0){

  $prenomProff=$_POST['prenomProff'];
  $nomProff=$_POST['nomProff'];
  $matiere=$_POST['matiere'];
 

  if($idPost>0):
    $stmt = $dbh->prepare('UPDATE  professeur SET prenomProff = ? , nomProff = ? , matiere = ? WHERE id =? ');
    $stmt->execute([$prenomProff, $nomProff,$matiere, $idPost]); 
  else:
    $stmt = $dbh->prepare('INSERT INTO  professeur VALUES(NULL,?,?,?) ');
    $stmt->execute([$prenomProff, $nomProff,$matiere]); 
  endif;
 
 
//redirection vers edition.php
  header("Location: proff.php");
  exit();
}


if($id>0){
  $stmt = $dbh->prepare('SELECT * FROM professeur WHERE id = ? ');
  $stmt->execute([$id]);
  $personne = $stmt->fetch();

  if(!$personne)  die("cette personne est introuvable");
}else {
  $personne = array(
'prenomProff'=>"",
'nomProff'=>"",
'matiere'=>"",
  );
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>liste proff</title>
        <link rel="stylesheet" href="/css/bootstrap.min.css" >

    </head>
<body>
 
     <div class="container">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link active" href="/proff.php">retour</a>
          </li>
        </ul>
   

  <form action ="/editionProff.php" method="post">
  <input type="hidden" name="id"  value="<?php echo $id; ?>"/>
  <div class="form-group">
    <label for="exampleInputEmail1">Prenom</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="prenomProff" value="<?php echo $personne['prenomProff']; ?>" placeholder="Enter prenom"/>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Nom</label>
    <input type="text" class="form-control" id="exampleInputPass" placeholder="nom" name="nomProff" value="<?php echo $personne['nomProff']; ?>"  />
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">matiere</label>
      <input type="text" class="form-control" id="inputEmail4" placeholder="matiere" name="matiere" value="<?php echo $personne['matiere']; ?>"/>
    </div>
  </div>
    <button type="submit" class="btn btn-primary">Ajouter</button>
</form>
</div>

 
<script src="/js/jquery-3.3.1.slim.min.js" ></script>
<script src="/js/popper.min.js" ></script>
<script src="/js/bootstrap.min.js" ></script>
    </body>
</html>