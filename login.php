<?php
require "connexion.php";
session_start();
$err_mss = "";

if (isset($_POST["envoi"])) {

    $email = $_POST["email"] ?? "";
    $password = $_POST["password"] ?? "";

    if (empty($email) || empty($password)) {
        $err_mss = "Tous les champs sont obligatoires";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err_mss = "Format d'email invalide";
    } else {
        $query = "SELECT * FROM utilisateur
                  WHERE email = :email
                  AND mot_de_passe = :mot_de_passe";
        $resultat = $connexion->prepare($query);
        $resultat->bindValue(":email", $email);
        $resultat->bindValue(":mot_de_passe", $password); 
        $resultat->execute();

        if ($resultat->rowCount() > 0) {
            $row = $resultat->fetch(PDO::FETCH_ASSOC);

            $_SESSION["id"] = $row["id"];
            $_SESSION["nom"] = $row["nom"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["role"] = $row["role"];

            if ($row["role"] == "admin") {
                header("Location: dashboard.php");
            } else {
                header("Location: produits.php");
            }
            exit();

        } else {
            $err_mss = "Email ou mot de passe incorrect";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>document</title>
</head>
<body>

<h2>Connexion</h2>

<form method="post">

    Email :
    <input type="email" name="email">
    <br><br>

    Mot de passe :
    <input type="password" name="password">
    <br><br>

    <input type="submit" name="envoi" value="Se connecter">
    <input type="reset" value="Annuler">

</form>

<h3>
    <?php echo $err_mss; ?>
</h3>

</body>
</html>