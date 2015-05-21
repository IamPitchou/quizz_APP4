<?php
	include_once("../model/common.php");
	include_once("../model/coq_config.php");
	include_once("../model/coq_duel.php");
	include_once("../model/coq_round.php");
	$id_duel = htmlspecialchars($_GET["duel"]);
	$user_id = htmlspecialchars($_GET["user"]);
	$score = htmlspecialchars($_GET["score"]);
    if (!checkVar($id_duel))
        echo ('Error unable to find the duel');
    else
    {
    	if (!checkVar($user_id))
    		echo ('Error unable to find the user');
    	else
    	{
            if ($score < 0)
    			echo('Error unable to find the score');
    		else
    		{
    			$config = new coq_config();
    			$nb_round_duel = $config->get_nb_round_duel();
    			if($nb_round_duel == 0)
    				echo("Unable to find the nb round by duel");
    			else
    			{
    				$duel = new coq_duel();
    				$data = $duel->submit_round($id_duel);
    				if ($data == 0)
    					echo('Unable to find the curent round number');
    				else
    				{
    					$crn = $data["current_round_number"];
    					// VERIFIER QUE LE ROUND COURANT < ROUND MAX
                        if ($crn <= $nb_round_duel)
    					{
    						// USER 1
                            if ($data["user1_id"] == $user_id)
    						{
    							// UPDATE DUEL
                                $duel->init($data["user1_id"], $data["user2_id"], $data["current_round_id"], 
    										$crn, $data["cd_sc1"] + $score, $data["cd_sc2"]);
    							$duel->update($id_duel);

    							// UPDATE ROUND
                                $round = new coq_round(); 
                                $round->init($data["chosen_theme1_id"], $data["chosen_theme2_id"], $data["collection_id"],
    										 $data["selected_theme_id"], $score, $data["cr_sc2"], 1, 
    										 $data["end2"]);
    							$round->update($data["current_round_id"]);
    							if ($data["end2"] == 1)
    							{
    								// UPDATE DUEL
                                    $duel->set_current_round_id($data["current_round_id"] + 1);
    								if ($crn < $nb_round_duel)
                                        $duel->set_current_round_number($data["current_round_number"] + 1);
    								$duel->update($id_duel);
	    						}

    						}
                            // USER2
    						else
    						{
    							// UPDATE DUEL
                                $duel->init($data["user1_id"], $data["user2_id"], $data["current_round_id"], 
    										$crn, $data["cd_sc1"], $data["cd_sc2"] + $score);
    							$duel->update($id_duel);
    							// UPDATE ROUND
                                $round = new coq_round();
                                $round->init($data["chosen_theme1_id"], $data["chosen_theme2_id"], $data["collection_id"],
    										 $data["selected_theme_id"], $data["cr_sc1"], $score, $data["end1"], 
    										 1);
    							$round->update($data["current_round_id"]);
    							if ($data["end1"] == 1)
    							{
    								// UPDATE DUEL
                                    $duel->set_current_round_id($data["current_round_id"] + 1);
    								if ($crn < $nb_round_duel)
                                       $duel->set_current_round_number($data["current_round_number"] + 1);
    								$duel->update($id_duel);
    							}
						    }
    					}
    				}
    			}
    		}
    	}
    }
?>