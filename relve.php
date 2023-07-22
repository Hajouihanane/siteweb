<!Doctype html>
<html>
    <head>
        <meta charset="UTF-8" >
        <title>relve</title>
        <link rel="stylesheet" href="relve.css">
    </head>
    <body>
        <div class="cont">
        
            <div class="head">
                <h1>Relvé d'energie</h1>
            </div>
            <form method="POST" action="<?php  echo $_SERVER["PHP_SELF"]; ?>">
 
            <div class="agt">
        <fieldset>
        <legend><h3>Relvé d'energie</h3></legend>
                <label>Contrat</label>
                <input type="text" name="contrat_eng">
                <label>Mois</label>
                <input type="text" name="mois">
                <label>An</label>
                <input type="text" name="an">
                <label>Index</label>
                <input type="text" name="index">
                <div class="aj">
                <input style="margin-top: 15px;" type="submit" value="ajouter">
                <input style="margin-top: 15px;" type="reset" value="annuler">
                </div>
            </fieldset>
        </div>
            </form>
            


        <?php
            $bd = new PDO('mysql:host=localhost;dbname=stage_site', 'root', '');
            $bd->query('SET NAMES "UTF8"');
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    if (!empty($_POST['contrat_eng']) && !empty($_POST['mois'])&& !empty($_POST['an'])&& !empty($_POST['index'])) {
            $requete = $bd->prepare('INSERT INTO relve_energie VALUES(null,?,?,?,?)');                            
            $requete->bindValue(1, $_POST['contrat_eng']);
            $requete->bindValue(2, $_POST['mois']);
            $requete->bindValue(3, $_POST['an']);
            $requete->bindValue(4, $_POST['index']);
            $requete->execute();
    }

            $requete = $bd->prepare('SELECT * FROM relve_energie');
            $requete->execute();
            $client = $requete->fetchAll(PDO::FETCH_ASSOC);
    
   

    

    echo "<h2> Affichage du tableau </h2>";
    echo "<table border=2px>";
    echo "<tr>";
    echo "<th>Contrat</th><th>Mois</th><th>An</th><th>Index</th>";
    echo "</tr>";
    foreach($client as $ling){
        echo "<tr>";
        echo "<td>".$ling['contrat_eng']."</td>";
        echo "<td>".$ling['mois']."</td>";
        echo "<td>".$ling['an']."</td>";
        echo "<td>".$ling['index']."</td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>

    </div>
    </body>
</html>
