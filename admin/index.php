<?php 
    session_start(); 
    if (!isset($_SESSION['id']) || !isset($_SESSION['admin'])) { 
        echo 'non admin';
    }
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

	<title>Back office</title>
</head>
<body>
    <div id="wrap">
        <!-- DEBUT CONTENU -->
        <div class="container">
            <div class="page-header">
				<h1>Page d'administration</h1>
			</div>
            <!-- <p class="lead"> Listing des Questions et Séries </p>-->
            <p><a href="./liste_question.php">Gestion des questions</a> </p>
            <p><a href="./liste_serie.php">Gestion des séries</a> </p>
            <p><a href="./liste_theme.php">Gestion des thèmes</a> </p>
        </div>
        <!-- FIN CONTENU -->
    </div>
</body>
</html>

