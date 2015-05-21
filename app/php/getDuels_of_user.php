<?php
    include_once("../model/coq_duel.php");
    include_once("../model/coq_user.php");
    $id_user = json_encode(htmlspecialchars($_GET["user"]));
    if (!checkVar($id_user))
        echo ('Error unable to find the user');
    else
    {
        $arr = array();
        $arr_users = array();
        $user_ref = new coq_user();
        $data = $user_ref->get_duels_of_user($id_user);
        $pseudo_ref = $user_ref->get_pseudo($id_user);
        if ($data == 0 || $pseudo_ref = 0)
            echo ('Error user id invalid');
        else
        {
            foreach ($data as $d) 
                ($pseudo_ref == $d["pseudo1"]) ? $arr_users[] = array("name" => $d["pseudo2"], "score1" => $d["total_score1"], "score2" => $d["total_score2"]) : $arr_users[] = array("name" => $d["pseudo1"], "score1" => $d["total_score1"], "score2" => $d["total_score2"]);
                
            $arr = array("users" => $arr_users);
       
            echo (json_encode($arr));
        }
       
    }

?>