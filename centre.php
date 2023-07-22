<!Doctype html>
<html>
    <head>
        <meta charset="UTF-8" >
        <title>centre</title>
        <link rel="stylesheet" href="centre.css">
    </head>
    <body>
        <div class="cont">
        
            <div class="head">
                <h1>Centre</h1>
            </div>
            <form method="POST" action="<?php  echo $_SERVER["PHP_SELF"]; ?>">
 
            <div class="agt">
        <fieldset>
                <legend><h3>Centre</h3></legend>
                <label>Ancien code</label>
                <input type="text" name="A_code">
                <label>Nouveau code</label>
                <input type="text" name="N_code">
                <label>libéllé</label>
                <input type="text" name="libelle"><br><br>
                <label>coordonné_X</label>
                <input type="text" name="cord_X">
                <label>coordonné_Y</label>
                <input type="text" name="cord_Y"><br>
                <div class="aj">
                <input  style="margin-top: 15px;" type="submit" value="ajouter">
                <input style="margin-top: 15px;" type="reset" value="annuler">
                </div>
            </fieldset>
        </div>
            </form>
            


        <?php
            $bd = new PDO('mysql:host=localhost;dbname=stage_site', 'root', '');
            $bd->query('SET NAMES "UTF8"');
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    if (!empty($_POST['A_code']) && !empty($_POST['N_code']) && !empty($_POST['libelle']) && !empty($_POST['cord_X']) && !empty($_POST['cord_Y'])) {
            $requete = $bd->prepare('INSERT INTO centre VALUES(null,?,?,?,?,?)');                            
            $requete->bindValue(1, $_POST['A_code']);
            $requete->bindValue(2, $_POST['N_code']);
            $requete->bindValue(3, $_POST['libelle']);
            $requete->bindValue(4, $_POST['cord_X']);
            $requete->bindValue(5, $_POST['cord_Y']);
            $requete->execute();
    }

            $requete = $bd->prepare('SELECT * FROM centre');
            $requete->execute();
            $client = $requete->fetchAll(PDO::FETCH_ASSOC);
    
   

    

    echo "<h2>Liste des Centres </h2>";
    echo "<table border=2px>";
    echo "<tr>";
    echo "<th>Ancien code</th><th>Nouveau code</th><th>libéllé</th><th>coordonné_X</th> <th>coordonné_Y</th>";
    echo "</tr>";
    foreach($client as $ling){
        echo "<tr>";
        echo "<td>".$ling['A_code']."</td>";
        echo "<td>".$ling['N_code']."</td>";
        echo "<td>".$ling['libelle']."</td>";
        echo "<td>".$ling['cord_X']."</td>";
        echo "<td>".$ling['cord_Y']."</td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>

    </div>
    </body>
</html>
