<?php 
    $id =isset($_GET['idp'])?$_GET['idp']:0;
    try {
        $dbh = new PDO('mysql:host=localhost;dbname=test',"root", "admin");
       
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
    $idPost = isset($_POST['id'])?$_POST['id']:-1;
    if($idPost>0){
        if(isset($_POST['supprimer'])){
            if($_POST['supprimer'] == "YES"){
                $rep = $dbh->prepare('DELETE FROM professeur WHERE id =? ');
                $reslt =  $rep->execute([$idPost]);
                if($reslt){
                    echo "l'enregistrement supprimè";
                }else{
                echo 'probleme dans la suppression';
                }
            }else{
            //redirection vers proff.php
             header("Location: proff.php");
             exit();
            }
        }
        header("Location: proff.php");
             exit();
     }
    
?>



<!DOCTYPE html>
<html>
    <head>
        <title>Suppression personne</title>
        <link rel="stylesheet" href="/css/bootstrap.min.css" >

    </head>
<body>
 
     <div class="container">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link active" href=""></a>
          </li>
        </ul>
    <div align="center">
        <h4>Voulez-vous vraiement supprimer cet enregistrement?</h4><br>

       <form action ="/supprimerProff.php" method="post">
          <input type="hidden" name="id"  value="<?php echo $id; ?>"/>
          <button type="submit" class="btn btn-primary" name="supprimer" value="YES">YES</button>
          <button type="submit" class="btn btn-primary" name="supprimer" value="NO">NO</button>
       </form>
     </div>
     </div>

     
     <script src="/js/jquery-3.3.1.slim.min.js" ></script>
     <script src="/js/popper.min.js" ></script>
     <script src="/js/bootstrap.min.js" ></script>
  
 </body>
</html>

