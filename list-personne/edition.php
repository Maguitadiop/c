
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

  $prenom=$_POST['prenom'];
  $nom=$_POST['nom'];
  $email=$_POST['email'];
  $modp=$_POST['motdepasse'];
  $adr1=$_POST['adresse1'];
  $adr2=$_POST['adresse2'];
  $ville=$_POST['ville'];
  $cp=$_POST['codepostal'];
  $rue=$_POST['rue'];

  if($idPost>0):
    $stmt = $dbh->prepare('UPDATE  db_personne SET prenom = ? , nom = ? , email = ? , motdepasse = ? , adresse1 = ?
    , adresse2 = ? , ville = ? , codepostal = ? , rue = ?  WHERE id =? ');
    $stmt->execute([$prenom, $nom,$mail,$modp,$adr1,$adr2,$ville,$cp,$rue, $idPost]); 
  else:
    $stmt = $dbh->prepare('INSERT INTO  db_personne VALUES(NULL,?,?,?,?,?,?,?,?,?) ');
    $stmt->execute([$prenom, $nom,$email,$modp,$adr1,$adr2,$ville,$cp,$rue]); 
  endif;
 
 
//redirection vers edition.php
  header("Location: eleve.php");
  exit();
}


if($id>0){
  $stmt = $dbh->prepare('SELECT * FROM db_personne WHERE id = ? ');
  $stmt->execute([$id]);
  $personne = $stmt->fetch();

  if(!$personne)  die("cette personne est introuvable");
}else {
  $personne = array(
'prenom'=>"",
'nom'=>"",
'email'=>"",
'motdepasse'=>"",
'adresse1'=>"",
'adresse2'=>"",
'ville'=>"",
'codepostal'=>"",
'ville'=>"",

  );
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
            <a class="nav-link active" href="/">retour</a>
          </li>
        </ul>
   

  <form action ="/edition.php" method="post">
  <input type="hidden" name="id"  value="<?php echo $id; ?>"/>
  <div class="form-group">
    <label for="exampleInputEmail1">Prenom</label>
    <input type="prenom" class="form-control" id="exampleInputEmail1" name="prenom" value="<?php echo $personne['prenom']; ?>" placeholder="Enter prenom">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Nom</label>
    <input type="nom" class="form-control" id="exampleInputPass" placeholder="nom" name="nom" value="<?php echo $personne['nom']; ?>"  />
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Email</label>
      <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="email" value="<?php echo $personne['email'];?>" />
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Password</label>
      <input type="password" class="form-control" id="inputPassword4" placeholder="Password" name="motdepasse" value="<?php echo $personne['motdepasse'];?>" />
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Address</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" name="adresse1" value="<?php echo $personne['adresse1'];?>" />
  </div>
  <div class="form-group">
    <label for="inputAddress2">Address 2</label>
    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor"  name="adresse2" value="<?php echo $personne['adresse2'];?>" />
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">Ville</label>
      <input type="text" class="form-control" id="inputCity"  name="ville" value="<?php echo $personne['ville'];?>" />
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">Code postal</label>
      <input type="text" class="form-control" id="inputCity"  name="codepostal">
    </div>
    <div class="form-group col-md-2">
      <label for="inputZip">Rue</label>
      <input type="text" class="form-control" id="inputZip" name="rue">
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