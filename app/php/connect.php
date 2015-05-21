<?php
	include_once("../model/coq_user.php");
    $user=json_decode(file_get_contents('php://input'));  //get user from

    $obj_user = new coq_user();
    $data = $obj_user->find_login($user->email, $user->password);

    if (is_null($data))
    {
    }
    else
    {
        session_start();
		$_SESSION['uid']=$data['id'];
		print $_SESSION['uid'];	
    }
	

?>