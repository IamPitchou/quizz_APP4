<?php 
    session_start(); 
    if (!isset($_SESSION['id']) || !isset($_SESSION['admin'])) { 
        echo 'non admin';
    }
    require_once('./../app/model/coq_collection.php');
    require_once('./../app/model/coq_question_collection.php');
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
	 <title>Liste des Séries</title>
</head>

    <?php
         
        if (isset($_POST['nb_val'])) {
        
        $collection = new coq_collection;
        $collection->init($_POST['title'], $_POST['difficulty']);
        $collection->add();
        
        var_dump($_POST['nb_val']);
        for ($i = 1; $i <= $_POST['nb_val']; $i++) {
            if (isset($_POST['question'.$i])){
                $question_coll = new coq_question_collection;
                $question_coll->init($_POST['question'.$i],$collection->get_id());
                $question_coll->add();
                echo "for ".$i;
            }
        }
        echo "sortie";
        //header('Location: ./liste_serie.php');
        }
    ?>


    <body>
        <p><a href="./index.php">Accueil back office</a> <a href="./liste_serie.php">Retour à la liste</a> </p>
        
          <div class="container marketing">
          <form method="post" action="./creer_serie.php">
            <?php        
            $q = new coq_question;
            $reponse = $q->get_question_by_theme($_POST['theme']);
        ?>
        <h1>Liste Questions</h1> 
        <hr /> 
        <table border="1"> 
            <th> Id </th>
            <th> Question </th>
            <th> Réponse 1 </th>
            <th> Réponse 2 </th>
            <th> Réponse 3 </th>
            <th> Réponse Correcte </th>

            <?php
            $i = 1;
            // On affiche chaque entrée une à une
            foreach($reponse as $donnees)
            {
                echo "<tr>";  
                echo " <td>" . $donnees['id'] . "</td>";  
                echo " <td>" . $donnees['question'] . "</td>"; 
                echo " <td>" . $donnees['answer1'] . "</td>"; 
                echo " <td>" . $donnees['answer2'] . "</td>"; 
                echo " <td>" . $donnees['answer3'] . "</td>"; 
                echo " <td>" . $donnees['answerOK'] . "</td>"; 
                ?>
                <td><input type="checkbox" name="question<?php echo $i?>" value=<?php echo $donnees['id']?>> </td> <?php
                echo "</tr>";
                $i = $i+1;
            }
            ?>
        </table> <br/>
        <input type="submit" value="Ajouter la série de questions" style="display:block; margin: auto;"/>
        <input type="hidden" name="nb_val" value=<?php echo $i ?>>
        <input type="hidden" name="title" value=<?php echo $_POST['title'] ?>>
        <input type="hidden" name="difficulty" value=<?php echo $_POST['difficulty'] ?>>
            
          </form>
          </div><!-- /.container marketing -->
    <p><a href="./index.php">Accueil back office</a> </p>
        
    </body>
</html>