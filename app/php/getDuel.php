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
    {
        echo ('Error unable to find the duel');
        break;
    }
    $arr = array();
    $duel = new coq_duel(0, 0, 0, 0);
    $duel = $duel->find($id_duel);
    $id_user1 = $duel["user1_id"];
    $user1 = new coq_user (0, 0, 0, 0);
    $user1 = $user1->find($id_user1);
    if ($user1 == 0)
    {
        echo ('Error unable to find user');
        break;
    }
    $arr[] = array("user1" => $user1["pseudo"]);
    $id_user2 = $duel["user2_id"];
    $user2 = new coq_user (0, 0, 0, 0);
    $user2 = $user2->find($id_user2);
    if ($user2 == 0)
    {
        echo ('Error unable to find user');
        break;
    }
    $arr[] = array("user2" => $user2["pseudo"]);
    $arr[] = array("current_round_number" => $duel["current_round_number"]);
    $id_round = $duel["current_round_id"];
    $round = new coq_round(0, 0, 0, 0, 0, 0, 0, 0);
    $round = $round->find($id_round);
    if ($round == 0)
    {
        echo ('Error unable to find round');
        break;
    }
    $id_collection = $round["collection_id"];
    $questions = new coq_question_collection(0, 0, 0);
    $questions = $questions->get_questions_by_collection_id($id_collection);
    if ($questions == 0)
    {
        echo ('Error unable to find the questions associate with this collection');
        break;
    }
    $arr_questions = array();
    $arr_data_qestion = array();
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
        $theme = new coq_theme(0, 0);
        $id_theme = $q["theme_id"];
        $theme = $theme->find($id_theme);
        if ($theme == 0)
        {
            echo ('Error unable to find the theme');
            break;
        }
        $arr_data_qestion[] = array("val" => $q["val"], "answer1" => $q["answer1"], "answer2" => $q["answer2"], 
                   "answer3" => $q["answer3"], "answerOK" => $q["answerOK"]);
    }
    $arr[] = array("round" => array("score1" => $round["score1"], "score2" => $round["score2"],
                                      "collection" => array("theme" => $theme["val"], "questions" => $arr_data_qestion)));
    echo (json_encode($arr));

?>