<?php
	include_once("../model/coq_user.php");
	$user_id = htmlspecialchars($_GET["user"]);
    if (!checkVar($user_id))
        echo ('Error unable to find the duel');
    else
    {
        $user = new coq_user();
        $data = $user->get_AllUsers($user_id);
        if ($data == 0)
            echo("Error id user invalid");
        else
        {
            $arr = array();
            $arr_data_user = array();
            foreach ($data as $d)
                $arr_data_user[] = array("id" => $d["id"], "pseudo" => $d["pseudo"]);
            $arr = array("users" => $arr_data_user);
            echo(json_encode($arr));
        }
    }
?>