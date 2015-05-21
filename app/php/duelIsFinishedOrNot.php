<?php
    include_once("../model/coq_duel.php");
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
            if ($data["end1"] == 1 && $data["end2"] == 1)
                return 1;
            else
                return 0;
        }
       
    }

?>