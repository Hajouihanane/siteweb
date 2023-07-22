<!Doctype html>
<html>
    <head>
        <meta charset="UTF-8" >
        <title>agent</title>
        <link rel="stylesheet" href="agent.css">
    </head>
    <body>
        <div class="cont">
        
            <div class="head">
                <h1>Agences</h1>
            </div>
            <form method="POST" action="<?php  echo $_SERVER["PHP_SELF"]; ?>">
 
            <div class="agt">
        <fieldset>
                <legend><h3>Agent</h3></legend>
                <label>Matricule</label>
                <input type="text" name="Matricule">
                <label>Nom</label>
                <input type="text" name="nom_agt">
                <label>Prenom</label>
                <input type="text" name="prenom_agt">
                <label>CIN</label>
                <input type="text" name="CIN"><br>
                <div class="aj">
                <input  style="margin-top: 15px;" type="submit" value="ajouter">
                <input  style="margin-top: 15px;" type="reset" value="annuler">
                </div>
            </fieldset>
        </div>
            </form>
           


        <?php
            $bd = new PDO('mysql:host=localhost;dbname=stage_site', 'root', '');
            $bd->query('SET NAMES "UTF8"');
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    if (!empty($_POST['Matricule']) && !empty($_POST['nom_agt']) && !empty($_POST['prenom_agt']) && !empty($_POST['CIN'])) {
            $requete = $bd->prepare('INSERT INTO agent VALUES(null,?,?,?,?)');                            
            $requete->bindValue(1, $_POST['Matricule']);
            $requete->bindValue(2, $_POST['nom_agt']);
            $requete->bindValue(3, $_POST['prenom_agt']);
            $requete->bindValue(4, $_POST['CIN']);
            $requete->execute();
    }

            $requete = $bd->prepare('SELECT * FROM agent');
            $requete->execute();
            $client = $requete->fetchAll(PDO::FETCH_ASSOC);
    
   

    

    echo "<h2>Liste des agences </h2>";
    echo "<table border=2px>";
    echo "<tr>";
    echo "<th>Matricule</th><th>nom</th><th>prenom</th><th>CIN</th>";
    echo "</tr>";
    foreach($client as $ling){
        echo "<tr>";
        echo "<td>".$ling['Matricule']."</td>";
        echo "<td>".$ling['nom_agt']."</td>";
        echo "<td>".$ling['prenom_agt']."</td>";
        echo "<td>".$ling['CIN']."</td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>

    </div>
    </body>
</html>
