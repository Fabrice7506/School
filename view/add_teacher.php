<?php include('../include/Navbar.php') ?>
<?php
    require('../Database/db.php');
     $req = $connexion -> prepare('SELECT * FROM cours ');
      $req -> execute(array());
      $infocours = $req -> fetchAll();
  
  
      if(isset($_POST['Send'])){
          if( !empty($_POST['Nom']) && !empty($_POST['prenoms']) && !empty($_POST['contact']) && !empty($_POST['specialité']) ){
            try{
              $Verify_teacher = $connexion -> prepare('SELECT Nom_prof, Pren_prof, cont_prof FROM professeur WHERE  Nom_prof = ? AND Pren_prof = ? AND cont_prof = ? ');
              $Verify_teacher -> execute(array($_POST['Nom'],$_POST['prenoms'],$_POST['contact']));
              $resultat = $Verify_teacher -> fetchAll();
              $Verify_teacher -> closeCursor();
            }catch(PDOException $e){
              $UserExist =  "ce professeur existe déja";
            }
  
              if(empty($resultat)){
                  $add_teacher = $connexion ->prepare('INSERT INTO professeur(Nom_prof, Pren_prof, cont_prof, Cod_cours) VALUES ( ? , ?, ?, ? )');
                  $add_teacher -> execute(array($_POST['Nom'],$_POST['prenoms'],$_POST['contact'],$_POST['specialité']));
                  $result =  $add_teacher ->fetchAll();
                  
                  $success = 'Inscription réussi';
              }
          }else{
              $champs = 'veuillez remplir tous les champs';
          }
      }  
?>
    <div class="container" style="padding: 30px;">
        <h1 class="text-center text-white my-3">PROFESSEUR</h1>
       <?php if(!empty($champs)){?> <div class="alert alert-danger"> <?= $champs; ?> </div> <?php } ?>
       <?php if(!empty($success)){?> <div class="alert alert-success"> <?= $success; ?> </div> <?php } ?>
    <form method="post">
            <div class="mb-3">
                <label  class="form-label">Nom </label>
                <input type="text" class="form-control" id=""  name="Nom"  placeholder="Entrez votre Nom...">
            </div>
            <div class="mb-3">
                <label  class="form-label">Prenoms</label>
                <input type="text" class="form-control" id="" name="prenoms"  placeholder="Entrez votre prenoms...">
            </div>
            <div class="mb-3">
                <label  class="form-label">Contact</label>
                <input type="tel" class="form-control" id="" name="contact"  placeholder="Entrez votre contact...">
            </div>
           
            <div class="mb-3">
                <label for class="form-label">Specialité</label>
                <select name="specialité" id="" class="form-control">
                    <?php foreach($infocours as $r) : ?>
                        <option value="<?= $r['Cod_cours'] ?>"> <?= $r['Nom_cours'] ?></option>
                <?php endforeach; ?>
                </select>
            </div>
           
            <div class="button">
            <button type="submit" class="btn btn-primary" name="Send">Inscrire</button>
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

