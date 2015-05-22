<?php 
    session_start(); 
    if (!isset($_SESSION['id']) || !isset($_SESSION['admin'])) { 
        echo 'non admin';
    }
    require_once('./../app/model/coq_theme.php');
    require_once('./../app/model/coq_user.php');
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
        if (isset($_POST['login'])) {
        
        $q = new coq_user;
        $q->init($_POST['login'], $_POST['pwd'],$_POST['pseudo'],$_POST['droit']);
        $q->add();
        }
    ?>
    
    <body>
        <p><a href="./index.php">Accueil back office</a> <a href="./liste_utilisateur.php">Rafraichir la page</a> </p>
        
          <div class="container marketing">
          <form method="post" action="./liste_utilisateur.php">
            <hr>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Ajouter un utilisateur</h3>
                </div>
                
                <div class="panel-body">
                    <div class="row">
                        
                        <p> Entrez les informations utilisateurs :<p />
                        <div class="">

                            <div id="div_login" class="form-group">
                                <label for="login">Identifiant (email) :<br/></label>
                                <input type="text" name="login" id="login" style="width: 300px;" required/>
                            </div>
                            
                            <div id="div_pwd" class="form-group">
                                <label for="reponse_2">Mot de passe :<br/></label>
                                <input type="password" name="pwd" id="pwd" style="width: 300px;" required/>
                            </div>
                            
                            <div id="div_pseudo" class="form-group">
                                <label for="pseudo">Pseudonyme :<br/></label>
                                <input type="text" name="pseudo" id="pseudo" style="width: 300px;" required/>
                            </div>
                            
                            <div id="div_droit" class="form-group">
                                <label for="droit">Sélectionnez les droits :<br/></label>
                                <select name="droit" id="droit" style="width: 300px;">
                                    <option value=0>Utilisateur</option>
                                    <option value=1>Administrateur</option>
                                </select>
                            </div>

                               

                        </div>
                        
                        <div class="">

                        </div>
                    
                    </div><!-- /.row -->

                </div><!-- /.panel-body -->
                <input type="submit" value="Ajouter l'utilisateur" style="display:block; margin: auto;"/>
                
            </div><!-- /.panel panel-default -->
            <hr>
            
          </form>
          </div><!-- /.container marketing -->
        

        
        <?php        
            $q = new coq_user;
            $reponse = $q->list_();
        ?>
        <h1>Liste Utilisateurs</h1> 
        <hr /> 
        <table border="1"> 
            <th> Id </th>
            <th> Identifiant </th>
            <th> Mot de passe </th>
            <th> Pseudonyme </th>
            <th> Droits </th>

            <?php
            // On affiche chaque entree une a une
            foreach($reponse as $donnees)
            {
                echo "<tr>";  
                echo " <td>" . $donnees['id'] . "</td>";  
                echo " <td>" . $donnees['login'] . "</td>"; 
                echo " <td>" . $donnees['pwd'] . "</td>"; 
                echo " <td>" . $donnees['pseudo'] . "</td>"; 
                echo " <td>" . $donnees['rights'] . "</td>";  
                ?>
                <td><a href="modifier_question.php?id_modif=<?php echo $donnees['id']; ?>"> Modifier </a></td> <?php
                echo "</tr>";
            }
            ?>
        </table>
        <p><a href="./index.php">Accueil back office</a> </p>
    </body>
</html>