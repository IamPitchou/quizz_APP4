<?php
	include_once('pdo.php');
	function checkVar ($var)
	{
		if (isset($var) && !empty($var))
			return true;
		else
			return false;
	}
	function initPDOObject ()
	{
		$p = new PDOObject("localhost", "coq", "root", "", $error);
		return $p;
	}
?>