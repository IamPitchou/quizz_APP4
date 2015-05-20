<?php
    $user=json_decode(file_get_contents('php://input'));  //get user from
	if($user->email=='al@ad.in' && $user->password=='aladin')
		session_start();
		$_SESSION['uid']=uniqid('coq_');
		print $_SESSION['uid'];
?>