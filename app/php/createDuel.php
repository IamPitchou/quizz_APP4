<?php
	include_once("../model/coq_duel.php");
    include_once("../model/coq_round.php");
	$user1_id = htmlspecialchars($_GET["user1"]);
    $user2_id = htmlspecialchars($_GET["user2"]);
    if (!checkVar($user1_id))
        echo ('Error unable to find the user1');
    else
    {
        if (!checkVar($user2_id))
            echo ('Error unable to find the user2');
        else
        {
            $duel = new coq_duel();
            $round = new coq_round();
            $round->init(1, 1, 1, 1, 0, 0, 0, 0);
            $round->add();
            $id_round = $round->get_last_round_created();
            if ($id_round < 1)
                echo ("Unable to find the last round id");
            else
            {
                $duel->init($user1_id, $user2_id, $id_round,  0, 0, 0);
                $duel->add();
                $id_duel = $duel->get_last_duel_created();
                if ($id_duel < 1)
                    echo ("Unable to find the last duel id");
                else
                    echo($id_duel);
            }
        }
    }
?>