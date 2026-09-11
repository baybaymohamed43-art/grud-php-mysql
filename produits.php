<?php
require "connexion.php";
session_start();

$sql = "SELECT * FROM produit";
$result = $connexion->query($sql);
?>
<html>
<head>

<title>Produits</title>

<style>
.container{
    display:flex;
    flex-wrap:wrap;
    gap:20px;
}

.card{
    width:250px;
    border:1px solid gray ;
    border-radius:10px;
    padding:10px;
    text-align:center;
}

.card img{
    width:100%;
    height:180px;
    border-radius:5px;
}

.prix{
    color:green;
    font-weight:bold;
}
</style>

</head>
<body>

<h2>Liste des produits</h2>

<div class="container">

<?php while($produit = $result->fetch(PDO::FETCH_ASSOC)) { ?>

    <div class="card">

        <img src="images/<?php echo $produit['image']; ?>" alt="<?php echo $produit['nom']; ?>">

        <h3><?php echo $produit['nom']; ?></h3>

        <p><?php echo $produit['description']; ?></p>

        <p class="prix">
            <?php echo $produit['prix']; ?> DH
        </p>

    </div>

<?php } ?>

</div>

<br>
<a href="dashboard.php">Retour Dashboard</a>

</body>
</html>