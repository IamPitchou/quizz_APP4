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
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<!--<script type="text/javascript" src="js/geolocation.js"></script> -->
	 <title>Liste des Questions</title>
</head>
    
    <?php 
        if (isset($_GET['id_modif'])) {
        
        $q = new coq_theme;
        $data = $q->find($_GET['id_modif']);
        //var_dump($data);
        //echo "<p> entry </p>";
        }
        //header('Location: ./liste_question.php');
        
        else if (isset($_POST['name']) && isset($_POST['id'])) {
        
        $q = new coq_theme;
        $q->init($_POST['name']);
        $q->update($_POST['id']);
        //echo "<p> modif </p>";
        header('Location: ./liste_theme.php');
        }
    ?>
    
    <body>
        <div class="container marketing">
        <p><a href="./index.php">Accueil back office</a> <a href="./liste_theme.php">Liste des thèmes</a> </p>
        
          
          <form method="post" action="./modifier_theme.php">
            <hr>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp Modifier un thème</h3>
                </div>
                
                <div class="panel-body">
                    <div class="row">
                        
                        <div class="">
                            <div id="div_login" class="form-group">
                                <label for="name">Nom du thème :<br/></label>
                                <input type="text" name="name" id="name" style="width: 300px;" value="<?php echo htmlspecialchars($data['val'])?>" required/>
                            </div>
                        </div>

                    </div><!-- /.row -->

                </div><!-- /.panel-body -->
                <input type="submit" value="Modifier le thème" style="display:block; margin: auto;"/>
                <input type="hidden" name="id" value=<?php echo $_GET['id_modif'] ?>>
            </div><!-- /.panel panel-default -->
            <hr>
            
          </form>

        <p><a href="./index.php">Accueil back office</a> </p>
        </div><!-- /.container marketing -->
    </body>
</html>