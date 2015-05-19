<?php
    include_once("coq_duel.php");
    include_once("coq_user.php");
    include_once("coq_round.php");
    include_once("coq_collection.php");
    include_once("coq_question.php");
    include_once("coq_question_collection.php");
    include_once("coq_theme.php");
    $id_duel = json_encode(htmlspecialchars($_GET["duel"]));
    if (!checkVar($id_duel))
        echo ('Error unable to find the duel');
    else 
    {
        $arr = array();
        $duel = new coq_duel();
        $duel = $duel->find($id_duel);
        $id_user1 = $duel["user1_id"];
        $user1 = new coq_user ();
        $user1 = $user1->find($id_user1);
        if ($user1 == 0)
            echo ('Error unable to find user');
        else
        {
            array_push($arr, "user1" => $user1["pseudo"]);
            $id_user2 = $duel["user2_id"];
            $user2 = new coq_user ();
            $user2 = $user2->find($id_user2);
            if ($user2 == 0)
                echo ('Error unable to find user');
            else
            {
                array_push($arr, "user2" => $user2["pseudo"]);
                array_push($arr, "current_round_number" => $duel["current_round_number"]);
                $id_round = $duel["current_round_id"];
                $round = new coq_round();
                $round = $round->find($id_round);
                if ($round == 0)
                    echo ('Error unable to find round');
                else
                {
                    $id_collection = $round["id_collection"];
                    $questions = new coq_question_collection();
                    $questions = $questions->get_questions_by_collection_id($id_collection);
                    if ($questions == 0)
                        echo ('Error unable to find the questions');
                    else
                    {
                        $arr_questions = array();
                        $arr_data_qestion = array();
                        $id_theme = $questions[0]["theme_id"];
                        $theme = new coq_theme();
                        $theme = $theme->find($id_theme);
                        if ($theme == 0)
                            echo ('Error unable to find the theme');
                        else
                        {
                            foreach ($questions as $question)
                            {
                                array_push($arr_data_qestion, "val" => $q["val"], "answer1" => $q["answer1"], "answer2" => $q["answer2"], 
                                           "answer3" => $q["answer3"], "answerOK" => $q["answerOK"]);
                                array_push($arr_questions, $arr_data_qestion);
                            }
                            array_push($arr, "round" => array("score1" => $round["score1"], "score2" => $round["score2"],
                                                              "collection" => array("theme" => $theme["val"], "questions" => $arr_questions)));
                        }
                    }
                }
            }
        }
        echo (json_decode($arr));
    }

?>