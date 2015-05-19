<?php 
include_once("pdo.php");
include_once("common.php");
class  coq_question
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
	{	
		return $this->id; 
	}

	public function get_theme_id()
	{	
		return $this->theme_id; 
	}

	public function get_val()
	{	
		return $this->val; 
	}

	public function get_answer1()
	{	
		return $this->answer1; 
	}

	public function get_answer2()
	{	
		return $this->answer2; 
	}

	public function get_answer3()
	{	
		return $this->answer3; 
	}

	public function get_answerok()
	{	
		return $this->answerok; 
	}

	// Les mutateurs
	public function set_id($value)
	{
		$this->id = $value;
	}

	public function set_theme_id($value)
	{
		$this->theme_id = $value;
	}

	public function set_val($value)
	{
		$this->val = $value;
	}

	public function set_answer1($value)
	{
		$this->answer1 = $value;
	}

	public function set_answer2($value)
	{
		$this->answer2 = $value;
	}

	public function set_answer3($value)
	{
		$this->answer3 = $value;
	}

	public function set_answerok($value)
	{
		$this->answerok = $value;
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
	public function list_()
	{
		$rqt = "SELECT * FROM coq_question";
		return $this->pdo->request($rqt, $error);
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
		if ($data.count > 0) return $data[0];
		else return 0;
	}
	public function JSON ()
	{
		return json_encode(array("id" => $this->id, "theme_id" => $this->theme_id, "val" => $this->val, 
								 "answer1" => $this->answer1, "answer2" => $this->answer2, "answer3" => $this->answer3, 
								 "answerOK" => $this->answerok));
	}
}
?>
