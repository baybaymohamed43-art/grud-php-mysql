<?php
require "connexion.php";
session_start();
if (!isset($_SESSION['role']) || !isset($_SESSION['nom']) || $_SESSION['role']!="admin") {
    header("Location: login.php");
    exit();
}
 
$sql = "SELECT * FROM categorie";
$result = $connexion->query($sql);
 if (isset($_POST["Deconnexion"])) {
    header("Location: deconnexion.php");
    exit();
}
?>
<html>
<head>
    <title></title>
</head>
<body>
 
<h2>Gestion des categories</h2>
<?php 
if(isset($_GET['message']))
{
    echo "<p>" . $_GET['message'] . "</p>";
}

?>
 
<table border="1" >
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Actions</th>
    </tr>
 
    <?php while($cat = $result->fetch(PDO::FETCH_ASSOC)) { ?>
    <tr>
        <td><?php echo $cat['id']; ?></td>
        <td><?php echo $cat['nom']; ?></td>
        <td>
            <a href="modifier.php?id=<?php echo $cat['id']; ?>">Modifier</a>
            <a href="supprimer.php?id=<?php echo $cat['id']; ?>"
               onclick="return confirm(' voulez vous vraiment Supprimer cette catégorie ?')">
               Supprimer
            </a>
            <a href="produit.php?id=<?php echo $cat['id']; ?>">
               Voir les produits
            </a>
        </td>
    </tr>
    <?php } ?>
 
</table>
  <br>
 <input type="submit" name="deconnixion" value="deconnexion">
</body>
</html>
if hobby in ['sport',swim,]