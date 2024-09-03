<?php include('../include/Navbar.php') ?>
<?php
    require('../Database/db.php');

      $query = $connexion -> prepare('SELECT * FROM cours WHERE Cod_Cours = ? ');
      $query -> execute(array($_GET['id_cours']));
      $info_cours = $query -> fetch();
  
  
      if(isset($_POST['Send'])){
          if( !empty($_POST['Mat'])){
                $Modify = $connexion -> prepare('UPDATE cours set Nom_cours = ?  WHERE Cod_cours = ?');
                $Modify->execute(array($_POST['Mat'],$_GET['id_cours']));
                $Modify -> closeCursor();

                $success = 'Informations Modifier';

                header('location:Cours.php');
          }else{
              $champs = 'veuillez remplir tous les champs';
          }
      }  
?>
 <div class="container" style="padding: 30px;">
        <h1 class="text-center text-white my-3">MATIERE</h1>
       <?php if(!empty($champs)){?> <div class="alert alert-danger"> <?= $champs; ?> </div> <?php } ?>
       <?php if(!empty($success)){?> <div class="alert alert-success"> <?= $success; ?> </div> <?php } ?>
    <form method="post">
            <div class="mb-3">
                <label  class="form-label">Matière </label>
                <input type="text" class="form-control" id=""  name="Mat"  placeholder="Entrez votre Nom..." value="<?=$info_cours['Nom_cours'] ?>">
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

