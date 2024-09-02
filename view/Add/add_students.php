<?php include('./../../include/Navbar.php') ?>

    <div class="container" style="padding: 70px;">
        <h1 class="text-center text-white">INSCRIPTION</h1>
    <form method="post">
            <div class="mb-3">
                <label  class="form-label">Nom </label>
                <input type="text" class="form-control" id=""  name="Nom" >
            </div>
            <div class="mb-3">
                <label  class="form-label">Prenoms</label>
                <input type="text" class="form-control" id="" name="prenoms" >
            </div>
            <div class="mb-3">
                <label  class="form-label">Date de Naissance</label>
                <input type="date" class="form-control" id="" name="DateN" >
            </div>
            <div class="mb-3">
                <label  class="form-label">Commune</label>
                <input type="text" class="form-control" id=""  name="commune">
            <div class="mb-3">
                <label for class="form-label">classe</label>
                <select name="classe" id="" class="form-control">
                    <?php foreach($infoclass as $r) : ?>
                        <option value="<?= $r['lib_classe'] ?>"> <?= $r['lib_classe'] ?></option>
                <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for class="form-label">Nationalité</label>
                <input type="text" class="form-control" id=""  name="nationalité">
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
  background-image: url('../../Asset/img/pieces-blue-stationery.jpg');
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
<?php include('./../../include/footer.php') ?>

