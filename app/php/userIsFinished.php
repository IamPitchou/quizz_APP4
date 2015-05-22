<?php
	include_once("../model/coq_user.php");
	include_once("../model/coq_round.php");
	$user_id = htmlspecialchars($_GET["user"]);
	$duel_id = htmlspecialchars($_GET["duel"]);
    if (!checkVar($user_id))
        echo ('Error unable to find the user');
    else
    {
    	if (!checkVar($duel_id))
        	echo ('Error unable to find the duel');
        else
        {
        	$user = new coq_user();
        	$data = $user->userIsFinished($user_id, $duel_id);
        	if ($data == 0)
        		echo('Error unable to find if the user is finished or not');
        	else 
        	{
        		echo('res '.$data["res"]);	
        	}
        }
    }
?>