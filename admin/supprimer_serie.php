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
    
    if(isset($_POST['id_modif'])){
        $collection = new coq_collection;
        //$collection->
    }
    
    header('Location: ./liste_serie.php');
?> 