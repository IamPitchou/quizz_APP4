<?php 
    session_start(); 
    if (!isset($_SESSION['id']) || !isset($_SESSION['admin'])) { 
        echo 'non admin';
    }
    require_once('./../app/model/coq_collection.php');
    require_once('./../app/model/coq_question_collection.php');
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
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<!--<script type="text/javascript" src="js/geolocation.js"></script> -->
	 <title>Liste des Séries</title>
</head>

    <body>
        <div class="container marketing">
        <p><a href="./index.php">Accueil back office</a> <a href="./liste_serie.php">Rafraichir la page</a> </p>

          <form method="post" action="./creer_serie.php">
            <hr>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Ajouter une série</h3>
                </div>
                
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-4 col-md-6">
                            
                            <div id="div_nom" class="form-group">

                                <label for="name">Titre <br/></label>
                                <input type="text" name="title" id="title" style="width: 300px;" required/>

                            </div>
                            
                            <div id="div_theme" class="form-group">
                                
                                <?php $c = new coq_theme; $reponse = $c->list_();?>
                                
                                <label for="theme">Sélectionnez le thème :<br/></label>
                                <select name="theme" id="theme" style="width: 300px;">
                                    <?php foreach($reponse as $donnees){ ?>
                                        <option value=<?php echo $donnees['id']; ?>><?php echo $donnees['val']; ?></option>
                                    <?php } ?>
                               </select>
                            </div>
                            
                            <div id="div_difficulty" class="form-group">
                                
                                <label for="difficulty">Sélectionnez la difficultée :<br/></label>
                                <select name="difficulty" id="difficulty" style="width: 300px;">
                                    <option value=1>Facile</option>
                                    <option value=2>Moyen</option>
                                    <option value=3>Difficile</option>
                               </select>
                            </div>

                        </div><!-- /.col-sm-6 col-md-6 -->

                    </div><!-- /.row -->

                </div><!-- /.panel-body -->
                <input type="submit" value="Créer une série" style="display:block; margin: auto;"/>
                
            </div><!-- /.panel panel-default -->
            <hr>
            
          </form>

        
        <?php        
            $q = new coq_collection;
            $reponse = $q->list_();
        ?>
        <h1>Liste Séries</h1> 
        <hr /> 
        <table class="table table-hover"> 
            <th> Id </th>
            <th> Theme </th>
            <th> Titre </th>
            <th> Difficultee </th>

            <?php
            // On affiche chaque entrée une a une
            foreach($reponse as $donnees)
            {
                echo "<tr>";  
                echo " <td>" . $donnees['id'] . "</td>";  
                echo " <td></td>"; //. $donnees[''] .
                echo " <td>" . $donnees['title'] . "</td>"; 
                echo " <td>" . $donnees['difficulty'] . "</td>"; 
                ?>
                <td><a href="modifier_serie.php?id_modif=<?php echo $donnees['id']; ?>"> Modifier </a></td>
                <td><a href="supprimer_serie.php?id_modif=<?php echo $donnees['id']; ?>"> Supprimer </a></td> 
                <?php echo "</tr>";
            }
            ?>
        </table>
        <p><a href="./index.php">Accueil back office</a> </p>
         </div><!-- /.container marketing -->
    </body>
</html>