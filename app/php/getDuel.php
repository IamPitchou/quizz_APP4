<?php
    include_once("../model/coq_duel.php");
    include_once("../model/coq_user.php");
    include_once("../model/coq_round.php");
    include_once("../model/coq_collection.php");
    include_once("../model/coq_question.php");
    include_once("../model/coq_question_collection.php");
    include_once("../model/coq_theme.php");
    $id_duel = json_encode(htmlspecialchars($_GET["duel"]));
    if (!checkVar($id_duel))
        echo ('Error unable to find the duel');
    else
    {
        $arr = array();
        $duel = new coq_duel(0, 0, 0, 0, 0, 0);
        $duel = $duel->find($id_duel);
        if ($duel == 0)
            echo ('Error unable to find the duel');
        else
        {
            $id_user1 = $duel["user1_id"];
            $user1 = new coq_user (0, 0, 0, 0);
            $user1 = $user1->find($id_user1);
            if ($user1 == 0)
                echo ('Error unable to find user1');
            else
            {
                $id_user2 = $duel["user2_id"];
                $user2 = new coq_user (0, 0, 0, 0);
                $user2 = $user2->find($id_user2);
                if ($user2 == 0)
                    echo ('Error unable to find user2');
                else
                {
                    $id_round = $duel["current_round_id"];
                    $round = new coq_round(0, 0, 0, 0, 0, 0, 0, 0);
                    $round = $round->find($id_round);
                    if ($round == 0)
                        echo ('Error unable to find round');
                    else
                    {
                        $id_collection = $round["collection_id"];
                        $questions = new coq_question_collection(0, 0, 0);
                        $questions = $questions->get_questions_by_collection_id($id_collection);
                        if ($questions == 0)
                            echo ('Error unable to find the questions associate with this collection');
                        else
                        {
                            $arr_data_qestion = array();
                            $theme = 0; 
                            foreach ($questions as $question)
                            {
                                $id_question = $question["question_id"];
                                $qu = new coq_question(0, 0, 0, 0, 0, 0);
                                $q = $qu->find($id_question);
                                if ($q == 0)
                                {
                                    echo ('Error unable to find the question');
                                    break;
                                }
                                else
                                {
                                    $id_theme = $q["theme_id"];
                                    $theme = new coq_theme(0, 0);
                                    $theme = $theme->find($id_theme);
                                    if ($theme == 0)
                                    {
                                        echo ('Error unable to find the theme');
                                        break;
                                    }
                                    else
                                        $arr_data_qestion[] = array("val" => $q["val"], "answer1" => $q["answer1"], "answer2" => $q["answer2"], 
                                               "answer3" => $q["answer3"], "answerOK" => $q["answerOK"]);
                                }
                            }
                            $arr = array("user1" => $user1["pseudo"], "user2" => $user2["pseudo"], "current_round_number" => $duel["current_round_number"], "round" => array("score1" => $round["score1"], "score2" => $round["score2"],
                                              "collection" => array("theme" => $theme["val"], "questions" => $arr_data_qestion)));
                        }
                    }
                }
            }
        }  
        echo (json_encode($arr));
    }

?>