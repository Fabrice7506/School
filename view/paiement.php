<?php include('../include/Navbar.php') ?>
<?php
    require('../Database/db.php');
     $req = $connexion -> prepare('SELECT * FROM classe ');
      $req -> execute(array());
      $infoclass = $req -> fetchAll();

      $query = $connexion -> prepare('SELECT * FROM elève,classe,scolarité WHERE elève.Cod_Classe = classe.Cod_Classe AND classe.Cod_SC = scolarité.Cod_SC AND Cod_El = ? ');
      $query -> execute(array($_GET['id_students']));
      $info_students = $query -> fetch();
  
  
      if(isset($_POST['Send'])){
          if( !empty($_POST['Mont_vers'])){
                $pay = $connexion -> prepare('INSERT INTO versement(Mont_vers,Cod_El) VALUE( ?, ?)');
                $pay-> execute(array($_POST['Mont_vers'],$_GET['id_students']));
                $pay -> closeCursor();

                if($_POST['Mont_vers'] == $info_students['Montant_SC']){
                    $Modify_status = $connexion -> prepare('UPDATE elève SET statut = ? WHERE Cod_El = ?');
                    $Modify_status -> execute(array('1',$_GET['id_students']));
                    $Modify_status->closeCursor();
                }

                $success = 'PAIEMENT VERSEMENT EFFECTUER';

          }else{
              $champs = 'VEUILLEZ ENTREZ LE MONTANT DU VERSEMENT';
          }
      }  
?>
    <div class="container" style="padding: 30px;">
        <h1 class="text-center text-white my-3">INSCRIPTION</h1>
       <?php if(!empty($champs)){?> <div class="alert alert-danger"> <?= $champs; ?> </div> <?php } ?>
       <?php if(!empty($success)){?> <div class="alert alert-success"> <?= $success; ?> </div> <?php } ?>
    <form method="post">
            <div class="mb-3">
                <label  class="form-label">Nom </label>
                <input type="text" class="form-control" id=""  name="Nom" value="<?= $info_students['Nom_El'] ?>" disabled>
            </div>
            <div class="mb-3">
                <label  class="form-label">Prenoms</label>
                <input type="text" class="form-control" id="" name="prenoms" value="<?= $info_students['Pren_El'] ?>" disabled>
            </div>
            <div class="mb-3">
                <label  class="form-label">Date de Naissance</label>
                <input type="date" class="form-control" id="" name="DateN" value="<?= $info_students['DatN_El'] ?>" disabled>
            </div>
            <div class="mb-3">
                <label  class="form-label">Classe</label>
                <input type="text" class="form-control" id=""  name="classe" value="<?= $info_students['lib_classe'] ?>" disabled>
            </div>
             <div class="mb-3">
                <label for class="form-label">Scolarité</label>
                <input type="text" class="form-control" id=""  name="" value="<?= $info_students['Montant_SC'] ?>" disabled>
            </div>
            <div class="mb-3">
                <label for class="form-label">Montant versement</label>
                <input type="text" class="form-control" id=""  name="Mont_vers" value="">
            </div>
           
            <div class="button">
            <button type="submit" class="btn btn-primary" name="Send">PAIEMENT</button>
            </div>
        </form>
    </div>


<style>
    body {
  min-height: 100vh;
  overflow-x: hidden;
  background-image: url('../Asset/img/pieces-blue-stationery.jpg');
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
label{
    font-family: 'Poppins', sans-serif; 
    font-weight: 500;
    font-size: 18px;
    color: white;
}
input{
    width: 40px;
}
.button{
    width: 100%;
    text-align: center;
}
.button button{
    width: 100px;
}
.button button:hover{
    background-color: red;
}
</style>
<?php include('../include/footer.php') ?>

