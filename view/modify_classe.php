<?php include('../include/Navbar.php') ?>
<?php
    require('../Database/db.php');
      $req = $connexion -> prepare('SELECT * FROM scolarité ');
      $req -> execute(array());
      $infoscolarité = $req -> fetchAll();

      $query = $connexion -> prepare('SELECT * FROM classe WHERE Cod_classe = ? ');
      $query -> execute(array($_GET['id_classe']));
      $info_classe = $query -> fetch();
  
  
      if(isset($_POST['Send'])){
          if( !empty($_POST['Nom_classe'])){
                $Modify = $connexion -> prepare('UPDATE classe set lib_classe = ? , Cod_SC = ? WHERE Cod_classe = ?');
                $Modify->execute(array($_POST['Nom_classe'],$_POST['scolarité'],$_GET['id_classe']));
                $Modify -> closeCursor();

                $success = 'Informations Modifier';

                header('location:classe.php');
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
                <input type="text" class="form-control" id=""  name="Nom_classe"  placeholder="Entrez votre Nom..." value="<?= $info_classe['lib_classe'] ?>">
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
            <button type="submit" class="btn btn-primary" name="Send">MODIFIER</button>
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

