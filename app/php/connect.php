<?php
if ($_SERVER["REQUEST_METHOD"] === "POST")
{
	if (isset($_GET["user"]))
	{
		// AJAX form submission
		$user = json_decode($_GET["user"]);

		$result = json_encode(array(
			"receivedUser" => $user->email,
			"receivedPassword" => $user->password));
	}
	else
	{
		$result = "INVALID REQUEST DATA";
	}

	echo $result;
}
?>