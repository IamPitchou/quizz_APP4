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
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<!--<script type="text/javascript" src="js/geolocation.js"></script> -->
	 <title>Liste des Questions</title>
</head>
    
    <?php 
        if (isset($_POST['question'])) {
        
        $q = new coq_question;
        $q->init($_POST['theme'], $_POST['question'],$_POST['reponse_1'],$_POST['reponse_2'],$_POST['reponse_3'],$_POST['reponse_correcte']);
        $q->add();
        }
    ?>
    
    <body>
        <div class="container marketing">
        <p><a href="./index.php">Accueil back office</a> <a href="./liste_question.php">Rafraichir la page</a> </p>
          
          <form method="post" action="./liste_question.php">
            <hr>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Ajouter une question</h3>
                </div>
                
                <div class="panel-body">
                    <div class="row">
                    
                        <div class="">
                            <div id="div_theme" class="form-group">
                                
                                <?php $c = new coq_theme; $reponse = $c->list_();?>
                                
                                <label for="theme">Sélectionnez le thème :<br/></label>
                                <select name="theme" id="theme" style="width: 300px;">
                                    <?php foreach($reponse as $donnees){ ?>
                                        <option value=<?php echo $donnees['id']; ?>><?php echo $donnees['val']; ?></option>
                                    <?php } ?>
                                    

                               </select>
                            </div>
                        </div>
                        <br/>
                    
                        <div class="">
                            
                            <div id="div_question" class="form-group">
                                <label for="question">Ecrivez la question :<br/></label>
                                <textarea name="question" id="question" cols="40" rows="2" style="width: 300px;" required></textarea>
                            </div>
                        </div>
                        
                        <p> Ecrivez les réponses :<p />
                        <div class="">

                            <div id="div_reponse_1" class="form-group">
                                <label for="reponse_1">Réponse 1 :<br/></label>
                                <input type="text" name="reponse_1" id="reponse_1" style="width: 300px;" required/>
                            </div>
                            
                            <div id="div_reponse_2" class="form-group">
                                <label for="reponse_2">Réponse 2 :<br/></label>
                                <input type="text" name="reponse_2" id="reponse_2" style="width: 300px;" required/>
                            </div>
                            
                            <div id="div_reponse_3" class="form-group">
                                <label for="reponse_3">Réponse 3 :<br/></label>
                                <input type="text" name="reponse_3" id="reponse_3" style="width: 300px;" required/>
                            </div>
                            
                            <div id="div_reponse_correcte" class="form-group">
                                <label for="reponse_correcte">Réponse Correcte :<br/></label>
                                <input type="text" name="reponse_correcte" id="reponse_correcte" style="width: 300px;" required/>
                            </div>

                        </div>
                        
                        <div class="">

                        </div>
                    
                    </div><!-- /.row -->

                </div><!-- /.panel-body -->
                <input type="submit" value="Ajouter la question" style="display:block; margin: auto;"/>
                
            </div><!-- /.panel panel-default -->
            <hr>
            
          </form>

        

        
        <?php        
            $q = new coq_question;
            $reponse = $q->list_();
        ?>
        <h1>Liste Questions</h1> 
        <hr /> 
        <table class="table table-hover"> 
            <th> Id </th>
            <th> Question </th>
            <th> Réponse 1 </th>
            <th> Réponse 2 </th>
            <th> Réponse 3 </th>
            <th> Réponse Correcte </th>

            <?php
            // On affiche chaque entrée une à une
            foreach($reponse as $donnees)
            {
                echo "<tr>";  
                echo " <td>" . $donnees['id'] . "</td>";  
                echo " <td>" . $donnees['val'] . "</td>"; 
                echo " <td>" . $donnees['answer1'] . "</td>"; 
                echo " <td>" . $donnees['answer2'] . "</td>"; 
                echo " <td>" . $donnees['answer3'] . "</td>"; 
                echo " <td>" . $donnees['answerOK'] . "</td>"; 
                ?>
                <td><a href="modifier_question.php?id_modif=<?php echo $donnees['id']; ?>"> Modifier </a></td> <?php
                echo "</tr>";
            }
            ?>
        </table>
        <p><a href="./index.php">Accueil back office</a> </p>
        </div><!-- /.container marketing -->
        
    </body>
</html>