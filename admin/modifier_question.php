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
    
        if (isset($_GET['id_modif'])) {
        
        $q = new coq_question;
        $data = $q->find($_GET['id_modif']);
        var_dump($data);
        echo "<p> entry </p>";
        }
        //header('Location: ./liste_question.php');
        
        else if (isset($_POST['question']) && isset($_POST['id'])) {
        
        $q = new coq_question;
        $q->init($_POST['theme'], $_POST['question'],$_POST['reponse_1'],$_POST['reponse_2'],$_POST['reponse_3'],$_POST['reponse_correcte']);
        $q->update($_POST['id']);
        echo "<p> modif </p>";
        header('Location: ./liste_question.php');
        }
        
    ?>
    
    
    <body>
        <p><a href="./index.php">Accueil back office</a> <a href="./liste_question.php">Liste des Questions</a> </p>
        
          <div class="container marketing">
          <form method="post" action="./modifier_question.php">
            <hr>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Ajouter une question</h3>
                </div>
                
                <div class="panel-body">
                    <div class="row">
                    
                        <div class="">

                            <div id="div_id" class="form-group">
                                <label for="id">Id (indique la question a modifier) :<br/></label>
                                <input type="text" name="id" id="id" value=<?php echo $data['id'] ?> style="width: 300px;" required/>
                            </div>
                        </div>
                        
                        <div class="">
                    
                        <div class="">
                            <div id="div_theme" class="form-group">
                                
                                <?php $c = new coq_theme; $reponse = $c->list_();?>
                                
                                <label for="theme">Sélectionnez le thème :<br/></label>
                                <select name="theme" id="theme" style="width: 300px;">
                                    <?php foreach($reponse as $donnees){ ?>
                                        <option value=<?php echo $donnees['id']; if($donnees['id'] == $data['theme_id']) echo " selected" ?>><?php echo $donnees['val']; ?></option>
                                    <?php } ?>
                               </select>
                            </div>
                        </div>
                        <br/>
                    
                        <div class="col-sm-4 col-md-6">
                            
                            <div id="div_question" class="form-group">
                                <label for="question">Ecrivez la question :<br/></label>
                                <textarea name="question" id="question" cols="40" rows="4" required><?php echo $data['val'] ?></textarea>
                            </div>
                        </div>
                        
                        <p> Ecrivez les réponses :<p />
                        <div class="">

                            <div id="div_reponse_1" class="form-group">
                                <label for="reponse_1">Réponse 1 :<br/></label>
                                <input type="text" name="reponse_1" id="reponse_1" value="<?php echo htmlspecialchars($data['answer1'])?>" style="width: 300px;" required/>
                            </div>
                            
                            <div id="div_reponse_2" class="form-group">
                                <label for="reponse_2">Réponse 2 :<br/></label>
                                <input type="text" name="reponse_2" id="reponse_2" value="<?php echo htmlspecialchars($data['answer2'])?>" style="width: 300px;" required/>
                            </div>
                            
                            <div id="div_reponse_3" class="form-group">
                                <label for="reponse_3">Réponse 3 :<br/></label>
                                <input type="text" name="reponse_3" id="reponse_3" value="<?php echo htmlspecialchars($data['answer3'])?>" style="width: 300px;" required/>
                            </div>
                            
                            <div id="div_reponse_correcte" class="form-group">
                                <label for="reponse_correcte">Réponse Correcte :<br/></label>
                                <input type="text" name="reponse_correcte" id="reponse_correcte" value="<?php echo htmlspecialchars($data['answerOK'])?>" style="width: 300px;" required/>
                            </div>

                        </div>
                        
                        <div class="">

                        </div>
                    
                    </div><!-- /.row -->

                </div><!-- /.panel-body -->
                <input type="submit" value="Modifier la question" style="display:block; margin: auto;"/>
                
            </div><!-- /.panel panel-default -->
            <hr>
            
          </form>
          </div><!-- /.container marketing -->
        
        <p><a href="./index.php">Accueil back office</a> </p>
    </body>
</html>