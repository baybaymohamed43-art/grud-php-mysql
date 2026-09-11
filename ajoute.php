<?php

session_start();
require "connexion.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("Location: login.php");
    exit();
}

$nom = "";
$description = "";
$prix = "";
$idcat = "";

$erreur = [];

/* Récupération des catégories */
$sqlCat = "SELECT * FROM categorie";
$resultatcat = $connexion->query($sqlCat);

/* Déconnexion */
if(isset($_POST['deconnexion'])){
    header("Location: deconnexion.php");
    exit();
}

/* Ajout produit */
if(isset($_POST['ajouter'])){

    $nom = trim($_POST['nom']);
    $description = trim($_POST['description']);
    $prix = $_POST['prix'];
    $idcat = $_POST['idcat'];

    /* Validation */

    if(empty($nom)){
        $erreur['nom'] = "Le nom du produit est obligatoire";
    }
    elseif(strlen($nom) < 3){
        $erreur['nom'] = "Le nom doit contenir au moins 3 caractères";
    }

    if(empty($description)){
        $erreur['description'] = "La description est obligatoire";
    }

    if(empty($prix) || $prix <= 0){
        $erreur['prix'] = "Le prix doit être positif";
    }

    if(empty($idcat)){
        $erreur['idcat'] = "Choisir une catégorie";
    }

    /* Vérification produit existant */

    $sqlVerif = "SELECT * FROM produit WHERE nom = :nom";

    $verif = $connexion->prepare($sqlVerif);
    $verif->bindValue(':nom', $nom);
    $verif->execute();

    if($verif->rowCount() > 0){
        $erreur['nom'] = "Ce produit existe déjà";
    }

    /* Gestion image */

    $image = "";

    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){

        $image = time() . "_" . $_FILES['image']['name'];

        $tmp = $_FILES['image']['tmp_name'];

        move_uploaded_file(
            $tmp,
            "images/" . $image
        );

    }else{
        $erreur['image'] = "Veuillez choisir une image";
    }

    /* Insertion */

    if(empty($erreur)){

        $sql = "INSERT INTO produit
                (nom, description, prix, image, id_categorie)
                VALUES
                (:nom, :description, :prix, :image, :idcat)";

        $resultat = $connexion->prepare($sql);

        $resultat->bindValue(':nom', $nom);
        $resultat->bindValue(':description', $description);
        $resultat->bindValue(':prix', $prix);
        $resultat->bindValue(':image', $image);
        $resultat->bindValue(':idcat', $idcat);

        try{

            $resultat->execute();

            header("Location: produits.php?message=Produit ajouté avec succès");
            exit();

        }catch(PDOException $e){

            echo "Erreur : " . $e->getMessage();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Ajouter Produit</title>
</head>
<body>

<h2>Ajouter un produit</h2>

<form method="post" enctype="multipart/form-data">

    Nom :
    <input type="text" name="nom" value="<?= $nom ?>">
    <span><?= $erreur['nom'] ?? '' ?></span>

    <br><br>

    Description :
    <input type="text" name="description" value="<?= $description ?>">
    <span><?= $erreur['description'] ?? '' ?></span>

    <br><br>

    Prix :
    <input type="number" step="0.01" name="prix" value="<?= $prix ?>">
    <span><?= $erreur['prix'] ?? '' ?></span>

    <br><br>

    Image :
    <input type="file" name="image">
    <span><?= $erreur['image'] ?? '' ?></span>

    <br><br>

    Catégorie :

    <select name="idcat">

        <option value="">-- Choisir une catégorie --</option>

        <?php
        while($row = $resultatcat->fetch(PDO::FETCH_ASSOC)){
        ?>

        <option
            value="<?= $row['id']; ?>"
            <?= ($idcat == $row['id']) ? 'selected' : ''; ?>
        >
            <?= $row['nom']; ?>
        </option>

        <?php } ?>

    </select>

    <span><?= $erreur['idcat'] ?? '' ?></span>

    <br><br>

    <input type="submit" name="ajouter" value="Ajouter">

    <input type="submit" name="deconnexion" value="Déconnexion">

</form>

</body>
</html>
