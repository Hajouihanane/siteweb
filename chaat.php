<!DOCTYPE html>
<html>
    <head>
        <title>ONIP</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="onip.css">
    </head>
    <body>
    <div class="container">
        
    <div class="head">
        <h1>L’Office National de l’Electricité et de l’Eau Potable (ONEE) -Branche Eau </h1>
    </div>
     
    <main class="main">
    <section class="section">
        <!-- Formulaire d'ajout d'un client -->
        <form action="traitement_connexion.php" method="post">
            <h2 class="titreFormulaire">Connexion</h2> 
            <div class="fromGroup">
                <label for="identifiant">Identifiant :</label>
                <input id="identifiant" name="identifiant" type="text" size="20" required>
            </div>                           
            <div class="fromGroup">
                <label for="motdepasse">Mot de passe :</label>
                <input id="motdepasse" name="motdepasse" type="password" size="20" required>
            </div> 
            <br>
            <div class="boutton">
                <input type="submit" value="Se connecter">
                <input type="reset" value="Annuler">
            </div>
        </form>
    </section>
    <section class="section">
        <!-- Votre code existant pour afficher le tableau des clients -->
        <!-- ... -->
    </section>
</main>



<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

            $bd = new PDO('mysql:host=localhost;dbname=stage_site', 'root', '');
            $bd->query('SET NAMES "UTF8"');
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// Étape 1: Récupération des données de l'utilisateur depuis le formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Étape 2: Validation des données (vous pouvez ajouter des validations supplémentaires ici)

    // Étape 3: Requête à la base de données pour récupérer les informations de l'utilisateur
    // Remplacez 'votre_table_utilisateurs' par le nom de votre table dans la base de données
    // Assurez-vous d'échapper les données pour éviter les attaques d'injection SQL
    $query = "SELECT id, username, password FROM connexion WHERE username = :username";
    $requete = $bd->prepare($query);
    $requete->execute(array(':username' => $username));
    $result = $requete->fetch(PDO::FETCH_ASSOC);    

    // Étape 4: Comparaison des informations
    if ($result && password_verify($password, $result['password'])) {
        // Les informations de connexion sont correctes
        // Étape 6: Création de la session
        session_start();
        $_SESSION["user_id"] = $result["id"];
        $_SESSION["username"] = $result["username"];

        // Étape 7: Redirection vers la page d'accueil ou autre
        header("http://127.0.0.1/stage_site/onip/site.php");
       
        exit();
    } else {
        // Les informations de connexion sont incorrectes
        $error_message = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>

    </div>              
    </body>
</html>