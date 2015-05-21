<?php
	include_once("../model/coq_user.php");
	$id_user = json_encode(htmlspecialchars($_GET["user"]));
	if (!checkVar($id_user))
	    echo ('Error unable to find the duel');
	else
	{
	    $arr = array();
	    $arr_data = array();
	    $user = new coq_user();
	    $data = $user->get_allDuelsOfUser($id_user);
	    if ($data == 0)
	        echo ('Error user id invalid');
	    else
	    {
	        foreach ($data as $d) 
	        {
	        	$arr_data[] = array("id" => $d["id"], "name" => $d["pseudo"], 
	        						"score1" => $d["score1"], "score2" => $d["score2"], 
	        						"current_round_number" => $d["current_round_number"]);
	        }
	        $arr = array("duels" => $arr_data);
	        echo (json_encode($arr));
	    }
	   
	}

?>