<?php
	function IsValidAtt ($var)
	{
		if (isset($var) && !empty($var))
			return true;
		else
			return false;
	}
	function initPDOObject ()
	{
		return new PDOObject("localhost", "coq", "root", "", $error);
	}
?>