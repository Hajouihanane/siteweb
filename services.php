<!Doctype html>
<html>
    <head>
        <meta charset="UTF-8" >
        <title>service</title>
        <link rel="stylesheet" href="services.css">
    </head>
    <body>
        <div class="cont">
        
            <div class="head">
                <h1>Service</h1>
            </div>
            <form method="POST" action="<?php  echo $_SERVER["PHP_SELF"]; ?>">
 
            <div class="agt">
        <fieldset>
        <legend><h3>Services</h3></legend>
                <label>libéllé</label>
                <input type="text" name="libelle_service">
                <label>Code</label>
                <input type="text" name="code_service">
                <div class="aj">
                <input style="margin-top: 15px;" type="submit" value="ajouter">
                <input  style="margin-top: 15px;"type="reset" value="annuler">
                </div>
            </fieldset>
        </div>
            </form>
           


        <?php
            $bd = new PDO('mysql:host=localhost;dbname=stage_site', 'root', '');
            $bd->query('SET NAMES "UTF8"');
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    if (!empty($_POST['libelle_service']) && !empty($_POST['code_service'])) {
            $requete = $bd->prepare('INSERT INTO Services VALUES(null,?,?)');                            
            $requete->bindValue(1, $_POST['libelle_service']);
            $requete->bindValue(2, $_POST['code_service']);
            $requete->execute();
    }

            $requete = $bd->prepare('SELECT * FROM Services');
            $requete->execute();
            $client = $requete->fetchAll(PDO::FETCH_ASSOC);
    
   

    

    echo "<h2> Liste des services</h2>";
    echo "<table border=2px>";
    echo "<tr>";
    echo "<th>libéllé</th><th>Code</th>";
    echo "</tr>";
    foreach($client as $ling){
        echo "<tr>";
        echo "<td>".$ling['libelle_service']."</td>";
        echo "<td>".$ling['code_service']."</td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>

    </div>
    </body>
</html>
