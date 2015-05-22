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

            $round1 = new coq_round();
            $round1->init(1, 1, 1, 1, 0, 0, 0, 0);
            $round1->add();
            $id_round1 = $round1->get_last_round_created();

            $round2 = new coq_round();
            $round2->init(2, 2, 2, 2, 0, 0, 0, 0);
            $round2->add();
            $id_round2 = $round2->get_last_round_created();

            $round3 = new coq_round();
            $round3->init(3, 3, 3, 3, 0, 0, 0, 0);
            $round3->add();
            $id_round3 = $round3->get_last_round_created();

            if ($id_round1 < 1)
                echo ("Unable to find the last round id");
            else
            {
                $duel->init($user1_id, $user2_id, $id_round1,  1, 0, 0);
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