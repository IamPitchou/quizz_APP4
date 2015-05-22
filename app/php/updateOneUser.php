<?php
    session_start();
	include_once("../model/coq_user.php");
    include_once("../model/common.php");
    $id         = htmlspecialchars($_SESSION["uid"]);
	$login      = htmlspecialchars($_POST["email"]);
    $pseudo     = htmlspecialchars($_POST["name"]);
    $password   = htmlspecialchars($_POST["new_password"]);

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
            $user->update($id);
        }
    }

    header('Location: ../../#/dashboard');

?>