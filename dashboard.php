<?php
session_start();
if (!isset($_SESSION['role']) || !isset($_SESSION['nom']) || $_SESSION['role']!="admin") {
    header("Location: login.php");
    exit();
}
if (isset($_POST["Deconnexion"])) {
    header("Location: deconnexion.php");
    exit();
}
?>
 
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
 
<h1>
    Bienvenue <?php echo $_SESSION['nom']; ?>
</h1>
 
<ul>
    <li><a href="produits.php"> Gestion des produits</a></li>
    <li><a href="gestioncategorie.php">Gestion des categories</a></li>
    <li><a href="logout.php"> Déconnexion</a></li>
</ul>
 <br>
 <input type="submit" name="deconnixion" value="deconnexion">
</body>
</html>