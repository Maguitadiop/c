<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css"/>
    <title>suppression d'un adhérent</title>
</head>
<body>
<?php include("entete.php"); ?>
<marquee><h2> Suppréssion d'un adhérent</h2></marquee>
<?php
$id =isset($_GET['idp'])?$_GET['idp']:0;

try {
    $dbh = new PDO('mysql:host=localhost;dbname=badminton',"root", "admin");
   
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
$idPost = isset($_POST['matriculeAdh'])?$_POST['matriculeAdh']:-1;
    if($idPost>0){
        if(isset($_POST['supprimer'])){
            if($_POST['supprimer'] == "YES"){
                $rep = $dbh->prepare('DELETE  FROM adherent WHERE matriculeAdh =? ');
                $rep->execute([$idPost]);
            }else{
            //redirection vers gestion.php
             header("Location: gestion.php");
             exit();
            }
        }
        header("Location: gestion.php");
             exit();
    } 
?>
<div align="center">
  <h4 text-align="center">Voulez-vous vraiement supprimer cet enregistrement?</h4><br>
       <form action ="supprimer.php" method="post">
          <input type="hidden" name="matriculeAdh"  value="<?php echo $id; ?>"/>
         <div id="supp" margin-left="100px">
          <button type="submit" class="btn btn-primary" name="supprimer" value="YES">YES</button>
          <button type="submit" class="btn btn-primary" name="supprimer" value="NO">NO</button>
         </div>
       </form>
</div> <br><br>
<div class="precede"><a href="gestion.php">Cliquez ici pour retourner</a></div>
       <?php include("pied.php"); ?>
     <script src="/js/jquery-3.3.1.slim.min.js" ></script>
     <script src="/js/popper.min.js" ></script>
     <script src="/js/bootstrap.min.js" ></script>
  
 </body>
</html>