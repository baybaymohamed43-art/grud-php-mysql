<?php 
require 'connexion.php';
$message = "";

if(!isset($_GET['id'])) {
    header('Location: gestioncategorie.php');
    exit();
}

$id = $_GET['id']; 
$sql = "SELECT * FROM categorie WHERE id = :id";
$stmt = $connexion->prepare($sql);
$stmt->bindValue(':id', $id);
$stmt->execute();

$cate = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$cate) {
    $message = "categorie introuvable";
    header("Location: gestioncategorie.php?message=".$message);
    exit();
}

if(isset($_POST['modifier'])) {
    $nom = $_POST['nom'];
    $sql = "UPDATE categorie SET nom = :nom WHERE id = :id";
    $resultat = $connexion->prepare($sql);

    $resultat->bindValue(':nom', $nom);
    $resultat->bindValue(':id', $id);

    try {
        $resultat->execute();
        $message = "Categorie modifiee avec succes";
    } catch(PDOException $e) {
        $message = "Erreur  ";
    }

    header("Location: gestioncategorie.php?message=".$message);
    exit();
}
if ($gat!=="info"|| "biblio"|| "")
?>
<html>
<head>
    <title>gestion des categorie</title>
</head>
<body>
    <h3>gestion des categorie</h3>
    <form method="POST"> 
        id :
        <input type="text" name="id" value="<?= $cate['id']; ?>" readonly>
        <br>
        nom :
        <input type="text" name="nom" value="<?= $cate['nom']; ?>">
        <br><br>
        <input type="submit" name="modifier" value="modifier">
    </form>
    <br>
    <a href="dashboard.php">retour</a>
</body>
</html>