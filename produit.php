<?php
require 'connexion.php';
$message = "";

if(!isset($_GET['id'])) {
    header('Location: categorie.php'); 
    exit();
}

$id = $_GET['id']; 

$sql = "SELECT * FROM produit WHERE id_categorie = :id";
$result = $connexion->prepare($sql);
$result->bindValue(':id', $id);
$result->execute(); 
session_start();
if (isset($_POST["Deconnexion"])) {
    header("Location: deconnexion.php");
    exit();
}
?>
<html>
<head>
    <title>Produits de la categorie</title>
</head>
<body>
 
<h2>gestion des produits </h2>
<br><br>

<?php 
if(isset($_GET['message'])) {
    echo "<p>" . $_GET['message'] . "</p>";
}
?>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Description</th>
        <th>Prix</th>
        <th>ID Catégorie</th>
        <th>image</th>
        <th>Actions</th>
    </tr>

    <?php 

    while($cat = $result->fetch(PDO::FETCH_ASSOC)) { ?>
    <tr>
        <td><?php echo $cat['id']; ?></td>
        <td><?php echo $cat['nom']; ?></td>
        <td><?php echo $cat['description']; ?></td>
        <td><?php echo $cat['prix']; ?> DH</td>
        <td><?php echo $cat['id_categorie']; ?></td>
        <td><img src="<?php echo $cat['image']; ?>" alt="<?php echo $cat['nom']; ?>" width="100"></td>
        <td>
            <a href="modifierP.php?id=<?php echo $cat['id']; ?>">Modifier</a>
            <a href="supprimerP.php?id=<?php echo $cat['id']; ?>"
               onclick="return confirm('Voulez vous vraiment Supprimer ce produit ?')">
               Supprimer
            </a>
        </td>
    </tr>
    <?php } ?>
 
</table>
 <br>
 <a href="gestioncategorie.php"> Retour</a>
  <br>
 <input type="submit" name="deconnixion" value="deconnexion">
 <br>
 <a href="ajoute.php">AJOUTE</a>
</body>
</html>