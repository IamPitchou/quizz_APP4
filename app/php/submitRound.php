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
    		if (!empty($score))
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
    				$data_duel = $duel->find($id_duel);
    				if ($data_duel == 0)
    					echo('Unable to find the curent round number');
    				else
    				{
    					$crn = $data_duel["current_round_number"];
    					// VERIFIER QUE LE ROUND COURANT < ROUND MAX
                        if ($crn < $nb_round_duel)
    					{
    						// USER 1
                            if ($data_duel["user1_id"] == $user_id)
    						{
    							// UPDATE DUEL
                                $duel->init($data_duel["user1_id"], $data_duel["user2_id"], $data_duel["current_round_id"], 
    										$crn, $data_duel["score1"] + $score, $data_duel["score2"]);
    							$duel->update($id_duel);
    							$round = new coq_round();
    							$data_round = $round->find($data_duel["current_round_id"]);
    							if ($data_round == 0)
    								echo('Unable to find the current round');
    							else
    							{
	    							// UPDATE ROUND
                                    $round->init($data_round["chosen_theme1_id"], $data_round["chosen_theme2_id"], $data_round["collection_id"],
	    										 $data_round["selected_theme_id"], $score, $data_round["score2"], 1, 
	    										 $data_round["end2"]);
	    							$round->update($data_duel["current_round_id"]);
	    							if ($data_round["end2"] == 1)
	    							{
	    								// UPDATE DUEL
                                        $duel->set_current_round_id($data_duel["current_round_id"] + 1);
	    								$duel->set_current_round_number($data_duel["current_round_number"] + 1);
	    								$duel->update($id_duel);
	    							}
	    						}

    						}
                            // USER2
    						else
    						{
    							// UPDATE DUEL
                                $duel->init($data_duel["user1_id"], $data_duel["user2_id"], $data_duel["current_round_id"], 
    										$crn, $data_duel["score1"], $data_duel["score2"] + $score);
    							$duel->update($id_duel);
    							$round = new coq_round();
    							$data_round = $round->find($data_duel["current_round_id"]);
    							if ($data_round == 0)
    								echo('Unable to find the current round');
    							else
    							{
	    							// UPDATE ROUND
                                    $round->init($data_round["chosen_theme1_id"], $data_round["chosen_theme2_id"], $data_round["collection_id"],
	    										 $data_round["selected_theme_id"], $data_round["score1"], $score, $data_round["end1"], 
	    										 1);
	    							$round->update($data_duel["current_round_id"]);
	    							if ($data_round["end1"] == 1)
	    							{
	    								// UPDATE DUEL
                                        $duel->set_current_round_id($data_duel["current_round_id"] + 1);
	    								$duel->set_current_round_number($data_duel["current_round_number"] + 1);
	    								$duel->update($id_duel);
	    							}
	    						}
    						}
    					}
    				}
    			}
    		}
    	}
    }
?>