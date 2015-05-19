<?php

$html = '<table class="table table-hover">';

$json = file_get_contents('../json/getDuel.php');
$obj = json_decode($json);

$answers = array();

foreach($obj->round->collection->questions[$_GET['id']] as $key => $answer) {
	$answers[$key] = $answer;
}

$trash = array_shift($answers);

shuffle($answers);

foreach($answers as $answer) {
	if($key == 'answerOK') {
		$html .= '<tr><td ng-click="valider(1)" class="ng-binding">'.$answer.'</td></tr>';
	}
	else {
		$html .= '<tr><td ng-click="valider(0)" class="ng-binding">'.$answer.'</td></tr>';
	}
}

$html .= '</table>';

echo $html;

?>