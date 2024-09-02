<?php include('../include/Navbar.php') ?>
<?php
    require('../Database/db.php');
    $req = $connexion -> prepare('SELECT * FROM scolarité ');
      $req -> execute(array());
      $infoscolarité = $req -> fetchAll();
  
      if(isset($_POST['Send'])){
          if( !empty($_POST['Nom_classe'])){
            try{
              $Verify_teacher = $connexion -> prepare('SELECT lib_classe FROM classe WHERE  lib_classe = ? ');
              $Verify_teacher -> execute(array($_POST['Nom_classe']));
              $resultat = $Verify_teacher -> fetchAll();
              $Verify_teacher -> closeCursor();
            }catch(PDOException $e){
              $UserExist =  "cet classe existe déja";
            }
  
              if(empty($resultat)){
                  $add_teacher = $connexion ->prepare('INSERT INTO classe(lib_classe,Cod_SC) VALUES ( ? , ? )');
                  $add_teacher -> execute(array($_POST['Nom_classe'],$_POST['scolarité']));
                  $result =  $add_teacher ->fetchAll();
                  
                  $success = 'Ajoute réussi';
              }
          }else{
              $champs = 'veuillez remplir tous les champs';
          }
      }  
?>
    <div class="container" style="padding: 30px;">
        <h1 class="text-center text-white my-3">CLASSE</h1>
       <?php if(!empty($champs)){?> <div class="alert alert-danger"> <?= $champs; ?> </div> <?php } ?>
       <?php if(!empty($success)){?> <div class="alert alert-success"> <?= $success; ?> </div> <?php } ?>
    <form method="post">
            <div class="mb-3">
                <label  class="form-label">Nom de la classe </label>
                <input type="text" class="form-control" id=""  name="Nom_classe"  placeholder="Entrez votre Nom...">
            </div>
            <div class="mb-3">
                <label for class="form-label">Scolarité</label>
                <select name="scolarité" id="" class="form-control">
                    <?php foreach($infoscolarité as $r) : ?>
                        <option value="<?= $r['Cod_SC'] ?>"> <?= $r['Montant_SC'] ?> FCFA</option>
                <?php endforeach; ?>
                </select>
            </div>
            <div class="button">
            <button type="submit" class="btn btn-primary" name="Send">Ajouter</button>
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

