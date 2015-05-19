<?php 
include_once("pdo.php");
include_once("common.php");
class  coq_question_Model  
{
	private $id;
	private $theme_id;
	private $val;
	private $answer1;
	private $answer2;
	private $answer3;
	private $answerok;
	private $pdo;

	public function coq_question_Model ($theme, $val, $answer1, $answer2, $answer3, $answerok)
	{
		$this->theme_id = $theme;
		$this->val = $val;
		$this->answer1 = $answer1;
		$this->answer2 = $answer2;
		$this->answer3 = $answer3;
		$this->answerok = $answerok;
		$this->pdo = initPDOObject();
	}

	// Les accesseurs
	public function get_id()
	{	if (IsValidAtt('id')) return $this->id; }

	public function get_theme_id()
	{	if (IsValidAtt('theme_id')) return $this->theme_id; }

	public function get_val()
	{	if (IsValidAtt('val')) return $this->val; }

	public function get_answer1()
	{	if (IsValidAtt('answer1')) return $this->answer1; }

	public function get_answer2()
	{	if (IsValidAtt('answer2')) return $this->answer2; }

	public function get_answer3()
	{	if (IsValidAtt('answer3')) return $this->answer3; }

	public function get_answerok()
	{	if (IsValidAtt('answerok')) return $this->answerok; }

	// Les mutateurs
	public function set_id($value)
	{
		if(!empty($value))
			$this->id = $value;
		else {
			global $ErrorAttribut;
			$ErrorAttribut[] = 'id' ;
		}
	}

	public function set_theme_id($value)
	{
		if(!empty($value))
			$this->theme_id = $value;
		else {
			global $ErrorAttribut;
			$ErrorAttribut[] = 'theme_id' ;
		}
	}

	public function set_val($value)
	{
		if(!empty($value))
			$this->val = $value;
		else {
			global $ErrorAttribut;
			$ErrorAttribut[] = 'val' ;
		}
	}

	public function set_answer1($value)
	{
		if(!empty($value))
			$this->answer1 = $value;
		else {
			global $ErrorAttribut;
			$ErrorAttribut[] = 'answer1' ;
		}
	}

	public function set_answer2($value)
	{
		if(!empty($value))
			$this->answer2 = $value;
		else {
			global $ErrorAttribut;
			$ErrorAttribut[] = 'answer2' ;
		}
	}

	public function set_answer3($value)
	{
		if(!empty($value))
			$this->answer3 = $value;
		else {
			global $ErrorAttribut;
			$ErrorAttribut[] = 'answer3' ;
		}
	}

	public function set_answerok($value)
	{
		if(!empty($value))
			$this->answerok = $value;
		else {
			global $ErrorAttribut;
			$ErrorAttribut[] = 'answerok' ;
		}
	}

	public function add()
	{
		$rqt = 
		'INSERT INTO coq_question
		(
			id,
			theme_id,
			val,
			answer1,
			answer2,
			answer3,
			answerOK
		)
		VALUES
		(
			"'.$this->id.'",
			"'.$this->theme_id.'",
			"'.$this->val.'",
			"'.$this->answer1.'",
			"'.$this->answer2.'",
			"'.$this->answer3.'",
			"'.$this->answerok.'"
		)';
		
		$this->pdo->request($rqt, $error);
		echo ("error = ". $error);
	}

	public function update($id)
	{
		$rqt = 
		'UPDATE coq_question SET
			id = "'.$this->id.'",
			theme_id = "'.$this->theme_id.'",
			val = "'.$this->val.'",
			answer1 = "'.$this->answer1.'",
			answer2 = "'.$this->answer2.'",
			answer3 = "'.$this->answer3.'",
			answerOK = "'.$this->answerok.'"
		WHERE id ='.$id;
		$this->pdo->request($rqt, $error);
		echo ("error = ". $error);
	}

	public function get_question_by_theme($theme_id)
	{
		$rqt = "SELECT * FROM coq_question WHERE theme_id = ".$theme_id;
		return $this->pdo->request($rqt, $error);
	}

	public function find($id)
	{
		$rqt = "SELECT * FROM coq_question WHERE id = ".$id;
		$data = $this->pdo->request($rqt, $error);
		return $data[0];
	}
}
?>
