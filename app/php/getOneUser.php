<?php

	include_once("../model/coq_user.php");

    $user_id = htmlspecialchars($_GET["user"]);
    if (!checkVar($user_id))
        echo ('Error unable to find the user');
    else
    {
        $user = new coq_user();
        $data = $user->find($user_id);
        if ($data == 0)
            echo("Error id user invalid");
        else
        {

            $user->init
            (
                $data['login'],
                $data['pwd'],
                $data['pseudo'],
                $data['rights']
            );

            echo $user->JSON();
        }
    }


?>

