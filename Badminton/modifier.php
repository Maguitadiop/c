
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css"/>
    <title>modifier d'un adhérent</title>
</head>
<body>
<?php include("entete.php"); ?>

 <marquee><h2>Modification d'un adhérent</h2></marquee>
<?php
$id =isset($_GET['idp'])?$_GET['idp']:0;

try {
    $dbh = new PDO('mysql:host=localhost;dbname=badminton',"root", "admin");
   
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

$idPost = isset($_POST['matriculeAdh']) ? $_POST['matriculeAdh']:-1;
 if($idPost>=0){

    $prenom=$_POST['nomAdh'];
    $nom=$_POST['prenomAdh'];
    $sexe=$_POST['sexe'];
    $adresse=$_POST['adresseAdh'];
    $ville=$_POST['villeAdh'];
    $code_postal=$_POST['cpAdh'];
    $niveau=$_POST['niveauAdh'];
    $type=$_POST['typeAdh'];
    
    if($idPost>0){

       $stmt = $dbh->prepare('UPDATE adherent SET nomAdh = ? , prenomAdh = ? , sexe = ?, adresseAdh = ? , villeAdh = ? , cpAdh = ?
       , niveauAdh = ?,typeAdh = ?  WHERE matriculeAdh =? ');
       $stmt->execute([$nom, $prenom, $sexe,$adresse,$ville,$code_postal,$niveau,$type, $idPost]); 
    }

       //redirection vers gestion.php
        header("Location: gestion.php");
        exit();

  }

  if($id>0){
    $stmt = $dbh->prepare('SELECT * FROM adherent WHERE matriculeAdh = ? ');
    $stmt->execute([$id]);
    $personne = $stmt->fetch();
    if(!$personne)  die("cette personne est introuvable");
  }else {
    $personne = array(
  'nomAdh'=>"",
  'prenomAdh'=>"",
  'sexe'=>"",
  'adresseAdh'=>"",
  'villeAdh'=>"",
  'cpAdh'=>"",
  'niveauAdh'=>"",
  'libelleType'=>"",
  
    );
  }
  ?>
  <div align="center">
    <form action ="modifier.php" method="post">
    <input type="hidden" name="matriculeAdh"  value="<?php echo $id; ?>"/>
    <div class="col-md-4 mb-3">
      <label for="nom">Nom :</label>
      <input type="text" class="form-control" id="nom" name="nomAdh" value="<?php echo $personne['nomAdh']; ?>" placeholder="Enter votre nom ici">
    </div>
    <div class="col-md-4 mb-3">
      <label for="prenom">Prenom :</label>
      <input type="text" class="form-control" id="prenom" placeholder="prenom" name="prenomAdh" value="<?php echo $personne['prenomAdh']; ?>"  />
    </div>
    <div class="col-md-4 mb-3">
      <label for="sexe">Sexe :</label>
      <input type="text" class="form-control" id="sexe" placeholder="sexe" name="sexe" value="<?php echo $personne['sexe']; ?>"  />
    </div>
      <div class="col-md-4 mb-3">
        <label for="inputadresse">Adresse :</label>
        <input type="text" class="form-control" id="inputadresse4" placeholder="adresse" name="adresseAdh" value="<?php echo $personne['adresseAdh'];?>" />
      </div>
      <div class="col-md-4 mb-3">
        <label for="inputville4">Ville :</label>
        <input type="text" class="form-control" id="inputville4" placeholder="ville" name="villeAdh" value="<?php echo $personne['villeAdh'];?>" />
      </div>
    <div class="col-md-4 mb-3">
      <label for="inputcp">Code postal :</label>
      <input type="text" class="form-control" id="inputcp" placeholder="Ex : 12345" name="cpAdh" value="<?php echo $personne['cpAdh'];?>" />
    </div>
      <div class="col-md-4 mb-3">
        <label for="inputadresse">Niveau :</label>
        <input type="text" class="form-control" id="inputniveau4" placeholder="niveau" name="niveauAdh" value="<?php echo $personne['niveauAdh'];?>" />
      </div>
      <div class="col-md-4 mb-3">
        <label for="inputville4">Type adhérent :</label>
        <input type="text" class="form-control" id="inputlibelle4" placeholder="1 ou 2 ou 3" name="typeAdh" value="<?php echo $personne['typeAdh'];?>" />
      </div>
    </div>
    <button type="submit" name="send" class="btn btn-primary">Modifier</button>
    </form>
</div><br>

  <div class="precede"><a href="gestion.php">Cliquez ici pour retourner </a></div>

    <?php include("pied.php"); ?>

    <script src="/js/jquery-3.3.1.slim.min.js" ></script>
    <script src="/js/popper.min.js" ></script>
    <script src="/js/bootstrap.min.js" ></script>

    </body>
    </html>


