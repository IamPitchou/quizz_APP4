<?php
	include_once("../model/coq_duel.php");
	$id_duel = json_encode(htmlspecialchars($_GET["duel"]));
	if (!checkVar($id_duel))
	    echo ('Error unable to find the duel');
	else
	{
	    $arr = array();
	    $duel = new coq_duel();
	    $data = $duel->get_score($id_duel);
	    if ($data == 0)
	        echo ('Error duel id invalid');
	    else
	    {
	        $arr = array("score1" => $data["score1"], "score2" => $data["score2"],);
	        echo (json_encode($arr));
	    }
	   
	}

?>