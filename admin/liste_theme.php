<?php 
    session_start(); 
    if (!isset($_SESSION['id']) || !isset($_SESSION['admin'])) { 
        echo 'non admin';
    }
    require_once('./../app/model/coq_question.php');
    require_once('./../app/model/coq_theme.php');
	$error = "";
?> 
    
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<script src="http://maps.google.com/maps/api/js?sensor=true" type="text/javascript"></script>
	<!--<script type="text/javascript" src="js/geolocation.js"></script> -->
	 <title>Liste des Questions</title>
</head>
    
    <?php 
        if (isset($_POST['new_theme'])) {
        
        $q = new coq_theme;
        $q->init($_POST['new_theme']);
        $q->add();
        }
    ?>
    
    <body>
        <p><a href="./index.php">Accueil back office</a> <a href="./liste_theme.php">Rafraichir la page</a> </p>
        
          <div class="container marketing">
          <form method="post" action="./liste_theme.php">
            <hr>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Ajouter th√®me</h3>
                </div>
                
                <div class="panel-body">
                    <div class="row">
    
                        <div class="">

                            <div id="div_new_theme" class="form-group">
                                <label for="new_theme">Nom du th√®me :<br/></label>
                                <input type="text" name="new_theme" id="new_theme" style="width: 300px;" required/>
                            </div>

                        </div>
                        
                    
                    </div><!-- /.row -->

                </div><!-- /.panel-body -->
                <input type="submit" value="Ajouter le th√®me" style="display:block; margin: auto;"/>
                
            </div><!-- /.panel panel-default -->
            <hr>
            
          </form>
          </div><!-- /.container marketing -->
        

        
        <?php        
            $q = new coq_theme;
            $reponse = $q->list_();
        ?>
        <h1>Liste Questions</h1> 
        <hr /> 
        <table border="1"> 
            <th> Id </th>
            <th> Nom </th>


            <?php
            // On affiche chaque entrÈe une ‡ une
            foreach($reponse as $donnees)
            {
                echo "<tr>";  
                echo " <td>" . $donnees['id'] . "</td>";  
                echo " <td>" . $donnees['val'] . "</td>"; 
                ?>
                <td><a href="liste-theme.php?id_modif=<?php echo $donnees['id']; ?>"> Modifier </a></td> <?php
                echo "</tr>";
            }
            ?>
        </table>
        <p><a href="./index.php">Accueil back office</a> </p>
    </body>
</html>