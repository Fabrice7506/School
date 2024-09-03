<?php include('../include/Navbar.php') ?>
<?php
    require('../Database/db.php');
     $req = $connexion -> prepare('SELECT * FROM classe ');
      $req -> execute(array());
      $infoclass = $req -> fetchAll();

      $query = $connexion -> prepare('SELECT * FROM elève WHERE Cod_El = ? ');
      $query -> execute(array($_GET['id_students']));
      $info_students = $query -> fetch();
  
  
      if(isset($_POST['Send'])){
          if( !empty($_POST['Nom']) && !empty($_POST['prenoms']) && !empty($_POST['DateN']) && !empty($_POST['commune']) && !empty($_POST['classe'] ) && !empty($_POST['nationalité']) ){
                $Modify = $connexion -> prepare('UPDATE elève set Nom_El = ? , Pren_EL = ? , DatN_El = ? , Com_El = ?, Cod_classe = ? , Nation_El = ? WHERE Cod_El = ?');
                $Modify->execute(array($_POST['Nom'],$_POST['prenoms'],$_POST['DateN'],$_POST['commune'],$_POST['classe'],$_POST['nationalité'],$_GET['id_students']));
                $Modify -> closeCursor();

                $success = 'Informations Modifier';

                header('location:students.php');
          }else{
              $champs = 'veuillez remplir tous les champs';
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
                <input type="text" class="form-control" id=""  name="Nom" value="<?= $info_students['Nom_El'] ?>" >
            </div>
            <div class="mb-3">
                <label  class="form-label">Prenoms</label>
                <input type="text" class="form-control" id="" name="prenoms" value="<?= $info_students['Pren_El'] ?>">
            </div>
            <div class="mb-3">
                <label  class="form-label">Date de Naissance</label>
                <input type="date" class="form-control" id="" name="DateN" value="<?= $info_students['DatN_El'] ?>">
            </div>
            <div class="mb-3">
                <label  class="form-label">Commune</label>
                <input type="text" class="form-control" id=""  name="commune" value="<?= $info_students['Com_El'] ?>">
            <div class="mb-3">
                <label for class="form-label">classe</label>
                <select name="classe" id="" class="form-control">
                    <?php foreach($infoclass as $r) : ?>
                        <option value="<?= $r['Cod_classe'] ?>"> <?= $r['lib_classe'] ?></option>
                <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for class="form-label">Nationalité</label>
                <input type="text" class="form-control" id=""  name="nationalité" value="<?= $info_students['Nation_El'] ?>">
            </div>
           
            <div class="button">
            <button type="submit" class="btn btn-primary" name="Send">Modifier</button>
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

