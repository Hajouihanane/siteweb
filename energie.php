<!Doctype html>
<html>
    <head>
        <meta charset="UTF-8" >
        <title>energie</title>
        <link rel="stylesheet" href="energie.css">
    </head>
    <body>
        <div class="cont">
        
            <div class="head">
                <h1>Energie</h1>
            </div>
            <form method="POST" action="<?php  echo $_SERVER["PHP_SELF"]; ?>">
 
            <div class="agt">
        <fieldset>
        <legend><h3>Energie</h3></legend>
                <label>Contrat</label>
                <input type="text" name="contrat_eng">
                <label>Type</label>
                <select name="type" >
                    <option value="MT">MT</option>
                    <option value="BT">BT</option>
                </select>
                <label>Ouvrage</label>
                <input type="text" name="ouvrage">
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


    if (!empty($_POST['contrat_eng']) && !empty($_POST['type']) && !empty($_POST['ouvrage'])) {
            $requete = $bd->prepare('INSERT INTO energie VALUES(null,?,?,?)');                            
            $requete->bindValue(1, $_POST['contrat_eng']);
            $requete->bindValue(2, $_POST['type']);
            $requete->bindValue(3, $_POST['ouvrage']);
            $requete->execute();
    }

            $requete = $bd->prepare('SELECT * FROM energie');
            $requete->execute();
            $client = $requete->fetchAll(PDO::FETCH_ASSOC);
    
   

    

    echo "<h2>Affichage du tableau </h2>";
    echo "<table border=2px >";
    echo "<tr>";
    echo "<th>Contrat</th><th>Type</th><th>Ouvrage</th>";
    echo "</tr>";
    foreach($client as $ling){
        echo "<tr>";
        echo "<td>".$ling['contrat_eng']."</td>";
        echo "<td>".$ling['type']."</td>";
        echo "<td>".$ling['ouvrage']."</td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>

    </div>
    </body>
</html>
