<?php
 $server = "localhost";
 $username = "root";
 $password = "1111";
 $dataBase = "gestion_produits";
 try{
  $connexion = new PDO("mysql:host=$server; dbname=$dataBase", $username, $password);
  $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connexion réussie";
 }catch(PDOException $e){
    echo "erreur lors de la connexion a la base de données:". $e->getMessage();
 }
?>