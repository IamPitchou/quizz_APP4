<?php
	include_once("../model/coq_user.php");
    include_once("../model/common.php");

	$login      = htmlspecialchars($_POST["login"]);
    $pseudo     = htmlspecialchars($_POST["name"]);
    $password   = htmlspecialchars($_POST["password"]);

    if (!checkVar($login))
        echo ('Error unable to find the login');
    else
    {
        if (!checkVar($pseudo))
            echo ('Error unable to find the name');
        else
        {
            $user = new coq_user();
            $user->init($login, $password, $pseudo,  0);
            $user->add();
        }
    }

    var_dump($login);
    var_dump($pseudo);
    var_dump($password);

    header('Location: ../../');

?>