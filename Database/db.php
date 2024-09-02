<?php

try{
    $connexion = new PDO('mysql:host=localhost;dbname=gest_etabliseement','root','');

}catch( PDOException $e){
    die('Erreur de connexion a la base de donnée '.$e->getMessage());
}