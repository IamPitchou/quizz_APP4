<?php
	include_once("coq_config.php");
	$config = new coq_config();
	$data = $config->get_config();
	if ($data == 0)
		echo ('Error unable to find the configuration');
	else
	{
		$arr = array();
		$arr_data_config = array();
		foreach ($data as $d) 
			$arr_data_config[] = array("key" => $d["key_2"], "value" => $d["val"]);
		$arr = array("configuration" => $arr_data_config);
		echo(json_encode($arr));
	}
?>