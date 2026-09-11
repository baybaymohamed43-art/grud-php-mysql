<?php

require 'connexion.php';

if(!isset($_GET['id']))
{
    header('Location: gestioncategorie.php');
    exit();
}

$id = $_GET['id'];

$rqt = "DELETE FROM categorie WHERE id = :id";

$resultat = $connexion->prepare($rqt);

$resultat->bindValue(':id', $id);

try
{
    $resultat->execute();
    $message = "Categorie supprimee avec succes";
}
catch(PDOException $e)
{
    $message = "Erreur  ";
}

header("Location: gestioncategorie.php?message=".$message);
exit();

?>