<?php 
if(isset($_POST['send'])){
    if(!empty($_POST['nomAdh']) && !empty($_POST['prenomAdh']) && !empty($_POST['sexe']) && !empty($_POST['adresseAdh']) 
      &&!empty($_POST['villeAdh']) && !empty($_POST['cpAdh']) && !empty($_POST['niveauAdh'])&& !empty(['typeAdh'])){
          $nom = $_POST['nomAdh'];
          $prenom = $_POST['prenomAdh'];
          $sexe = $_POST['sexe'];
          $adresse = $_POST['adresseAdh'];
          $ville = $_POST['villeAdh'];
          $cp = $_POST['cpAdh'];
          $niveau = $_POST['niveauAdh'];
          $type = $_POST['typeAdh'];
        //connexion à la base de donnée
          try {
            $dbh = new PDO('mysql:host=localhost;dbname=badminton',"root", "admin");
           
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }

        //preparation de la requete d'insertion
        $pre = $dbh->prepare('INSERT INTO adherent(nomAdh,prenomAdh,sexe,adresseAdh,villeAdh,cpAdh,niveauAdh,typeAdh) VALUES
                             (:nom,:prenom,:sexe,:adresse,:ville,:cp,:niveau,:typ)');
        //execution de la requete
         $rep = $pre->execute(
             array(
                 ':nom' => $nom,
                 ':prenom' => $prenom,
                 ':sexe' => $sexe,
                 ':adresse' => $adresse,
                 ':ville' => $ville,
                 ':cp' => $cp,
                 ':niveau' => $niveau,
                 ':typ' => $type,
             )
         );
            if($rep){
                echo 'adhérent ajoutè';
                header("Location: gestion.php");
                exit();
                
            }else{
                echo 'probleme dans l\'ajout';
            }
    }
    else{
        echo"<script>alert('Tous les champs sont obligatoire');</script>";
    }
}
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css"/>
    <title>Ajout d'un adhérent</title>
</head>
<body>
  
  <?php include("entete.php"); ?>
  <marquee><h2>Ajouté un adhérent</h2></marquee>
  <div align="center">
    <form action ="ajout.php" method="post">
    <div class="col-md-4 mb-3">
      <label for="nom">Nom :</label>
      <input type="text" class="form-control" id="nom" name="nomAdh"  placeholder="Entez votre nom ici">
    </div>
    <div class="col-md-4 mb-3">
      <label for="prenom">Prenom :</label>
      <input type="text" class="form-control" id="prenom" placeholder=" Entez votre prenom ici" name="prenomAdh"/>
    </div>
    <div class="col-md-4 mb-3">
    <label for="sexe"> Sexe:&nbsp;&nbsp;&nbsp;&nbsp;</label>
      <label for="sexe"> Feminin</label>
      <input type="radio" name="sexe"  value="feminin"/>&nbsp;&nbsp;&nbsp;&nbsp;
      <label for="sexe"> Masculin</label>
      <input type="radio" name="sexe"  value="masculin"/>
    </div>
      <div class="col-md-4 mb-3">
        <label for="inputadresse">Adresse :</label>
        <input type="text" class="form-control" id="inputadresse4" placeholder="Entez votre adresse ici" name="adresseAdh" />
      </div>
      <div class="col-md-4 mb-3">
        <label for="inputville4">Ville :</label>
        <input type="text" class="form-control" id="inputville4" placeholder="Entez votre ville ici" name="villeAdh" />
      </div>
    <div class="col-md-4 mb-3">
      <label for="inputcp">Code postal :</label>
      <input type="text" class="form-control" id="inputcp" placeholder="Ex : 12345" name="cpAdh"  />
    </div>
    <div class="col-md-4 mb-3">
        <label for="inputville4">Niveau d'adhérent:</label>
        <select name ="niveauAdh" id="niveauAdh">
          <option  value="salarie">Debutant</option>
          <option  value="etudiant">Intermediare</option>
          <option  value="retrait">Expert</option>
        </select>
      </div>
      <div class="col-md-4 mb-3">
        <label for="inputville4">Type adhérent:</label>
        <select name ="typeAdh" id="typeAdh">
          <option  value="1">1</option>
          <option  value="2">2</option>
          <option  value="3">3</option>
        </select>
      </div>
    </div>
    <button type="submit" name="send" class="btn btn-primary">Ajouter</button>
    </form>
</div><br><br>

  <div class="precede"><a href="index.php"> Cliquez ici pour retourner </a></div>

    <?php include("pied.php"); ?>

    <script src="/js/jquery-3.3.1.slim.min.js" ></script>
    <script src="/js/popper.min.js" ></script>
    <script src="/js/bootstrap.min.js" ></script>

</body>
</html>