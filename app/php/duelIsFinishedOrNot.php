<?php
    include_once("../model/coq_duel.php");
    include_once("../model/coq_config.php");
    $id_duel = htmlspecialchars($_GET["duel"]);
    if (!checkVar($id_duel))
        echo ('Error unable to find the duel');
    else
    {
        $duel = new coq_duel();
        $data = $duel->duel_is_finished_or_not($id_duel);
        if ($data == 0)
            echo ('Error duel id invalid');
        else
        {
            $config = new coq_config();
            $nb_round_duel = $config->get_nb_round_duel();
            if($nb_round_duel == 0)
                echo("Unable to find the nb round by duel");
            else
            {
                if ($data["end1"] == 1 && $data["end2"] == 1 && $data["current_round_number"] ==  $nb_round_duel)
                    echo '1';
                else
                    echo '0';
            }
        }
       
    }

?>