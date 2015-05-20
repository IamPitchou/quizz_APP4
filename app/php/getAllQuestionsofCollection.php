<?php
    include_once("../model/coq_question_collection.php");
    $id_collec = json_encode(htmlspecialchars($_GET["collec"]));
    if (!checkVar($id_collec))
        echo ('Error unable to find the duel');
    else
    {
        $arr = array();
        $arr_data_question = array();
        $qc = new coq_question_collection();
        $data = $qc->get_questions_by_collection_id($id_collec);
        if ($data == 0)
            echo ('Error collection id invalid');
        else
        {
            foreach ($data as $d) 
                $arr_data_question[] = array("id" => $d["id"], "theme" => $d["theme"], "val" => $d["val"], "answer1" => $d["answer1"], 
                                             "answer2" => $d["answer2"], "answer3" => $d["answer3"], "answerOK" => $d["answerOK"],);
            $arr = array("questions" => $arr_data_question);
            echo (json_encode($arr));
        }
       
    }

?>