
<?php include('../include/header.php') ?>
<?php 
    include('../include/Navbar.php');
    include('../Database/db.php');

    $requete = $connexion -> prepare('SELECT * FROM elève,classe WHERE elève.Cod_Classe = classe.Cod_Classe');
    $requete -> execute(array());
    $reponse = $requete ->fetchAll();
    $requete->closeCursor();
    $count=0;
?>
<div class="" style="margin-top:200px;">
<table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénoms</th>
                    <th>Date de Naissance</th>
                    <th>Commune</th>
                    <th>Classe</th>
                    <th>nationalité</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($reponse as $infoStudents) : ?>
                    <?php $count = $count+1; ?>
                    <?php if($infoStudents['statut']==0){
                        $class = 'status return';
                        $text = 'Non soldé';
                    }else{
                        $class = 'status delivered';
                        $text = 'soldé';
                    } 
                    ?>
                <tr>
                    <td><?= $infoStudents['Nom_El'] ?></td>
                    <td><?= $infoStudents['Pren_El'] ?></td>
                    <td><?= $infoStudents['DatN_El'] ?></td>
                    <td><?= $infoStudents['Com_El'] ?></td>
                    <td><?= $infoStudents['lib_classe'] ?></td>
                    <td><?= $infoStudents['Nation_El'] ?></td>
                    <td><span class="<?= $class ?>"><?= $text ?></span></td>
                    <td><a href="paiement.php?id_students=<?php echo $infoStudents['Cod_El']; ?>" class="btn btn-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                         <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                        </svg>
                        </a>
                    </td>
                </tr>
                
                </div>
        <?php endforeach;  ?>
            </tbody>
        </table>
    </div>
</div>

<style>
     body {
    min-height: 100vh;
    overflow-x: hidden;
    background-image: url('../Asset/img/1000_F_315282931_3FWD5XwemMBAlzaKDJ1IHvzBE1HfmBxg.jpg');
    }
    th,td{
    color: black;
    font-family: 'Poppins', sans-serif;
     font-weight: 500;
}
.status.delivered {
  padding: 2px 4px;
  background: #8de02c;
  color: var(--white);
  border-radius: 4px;
  font-size: 14px;
  font-weight: 500;
}
.status.pending {
  padding: 2px 4px;
  background: #e9b10a;
  color: var(--white);
  border-radius: 4px;
  font-size: 14px;
  font-weight: 500;
}
.status.return {
  padding: 2px 4px;
  background: #f00;
  color: var(--white);
  border-radius: 4px;
  font-size: 14px;
  font-weight: 500;
}
.status.inProgress {
  padding: 2px 4px;
  background: #1795ce;
  color: var(--white);
  border-radius: 4px;
  font-size: 14px;
  font-weight: 500;
}

</style>
<?php include('../include/footer.php')?>