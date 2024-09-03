<?php
    include('../Database/db.php');
    
if(!empty($_GET['id_classe'])){
    $req = $connexion -> prepare('DELETE FROM classe WHERE Cod_classe = ?');
    $req -> execute(array($_GET['id_classe']));
    $req->closeCursor();
    header('location:classe.php');
}
if(!empty($_GET['id_teach'])){
    $req = $connexion -> prepare('DELETE FROM professeur WHERE Mat_prof = ?');
    $req -> execute(array($_GET['id_teach']));
    $req->closeCursor();
    header('location:teacher.php');
}
if(!empty($_GET['id_cours'])){
    $req = $connexion -> prepare('DELETE FROM cours WHERE Cod_cours = ?');
    $req -> execute(array($_GET['id_cours']));
    $req->closeCursor();
    header('location:Cours.php');
}
if(!empty($_GET['id_students'])){
    $req = $connexion -> prepare('DELETE FROM elève WHERE Cod_El = ?');
    $req -> execute(array($_GET['id_students']));
    $req->closeCursor();
    header('location:students.php');
}