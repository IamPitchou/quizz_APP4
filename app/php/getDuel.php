<?php
    include_once("../model/coq_duel.php");
    include_once("../model/coq_user.php");
    include_once("../model/coq_round.php");
    include_once("../model/coq_collection.php");
    include_once("../model/coq_question.php");
    include_once("../model/coq_question_collection.php");
    include_once("../model/coq_theme.php");
    
    if(checkVar(htmlspecialchars($_GET["duel"])))
    {
        $id_duel = json_encode(htmlspecialchars($_GET["duel"]));
        if (!checkVar($id_duel))
            echo ('Error unable to find the duel');
        else
        {
            $arr = array();
            $arr_data_question = array();
            $duel = new coq_duel();
            $data = $duel->get_duels($id_duel);
            if ($data == 0)
                echo('Error invalid duel id');
            else
            {
                foreach ($data as $d) 
                {
                    $arr_data_qestion[] = array("val" => htmlspecialchars($d["question"]), "answer1" => htmlspecialchars($d["answer1"]), "answer2" => htmlspecialchars($d["answer2"]), 
                                                   "answer3" => htmlspecialchars($d["answer3"]), "answerOK" => htmlspecialchars($d["answerOK"]));
                }
                $arr = array("user1" => htmlspecialchars($data[0]["pseudo1"]), "user2" => htmlspecialchars($data[0]["pseudo2"]), 
                             "current_round_number" => htmlspecialchars($data[0]["current_round_number"]), "round" => array("score1" => $data[0]["score1"], 
                             "score2" => $data[0]["score2"], "collection" => array("theme" => htmlspecialchars($data[0]["theme"]), 
                             "questions" => $arr_data_qestion)));
                echo (json_encode($arr));
            }
        }
    }
?>