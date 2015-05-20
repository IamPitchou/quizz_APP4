<?php
	include_once("../model/coq_user.php");
    $user=json_decode(file_get_contents('php://input'));  //get user from

    $obj_user = new coq_user();
    $data = $obj_user->find_login($user->email, $user->password);
    //var_dump($data);
    if (is_null($data))
    {
    }
    else
    {

    	//if($user->email=='al@ad.in' && $user->password=='aladin')
		session_start();
		//$_SESSION['uid']=uniqid('coq_');
		$_SESSION['uid']=$data['id'];
		print $_SESSION['uid'];	
    }
	

?>