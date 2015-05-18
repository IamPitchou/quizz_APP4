<?php 
class  coq_question_Model  
{
	private $id;
	private $theme_id;
	private $val;
	private $answer1;
	private $answer2;
	private $answer3;
	private $answerok;
	private $timeout;
	
	// Les accesseurs
	public function get_id()
	{	if ( $this->IsValidAtt('id')) return $this->id; }

	public function get_theme_id()
	{	if ( $this->IsValidAtt('theme_id')) return $this->theme_id; }

	public function get_val()
	{	if ( $this->IsValidAtt('val')) return $this->val; }

	public function get_answer1()
	{	if ( $this->IsValidAtt('answer1')) return $this->answer1; }

	public function get_answer2()
	{	if ( $this->IsValidAtt('answer2')) return $this->answer2; }

	public function get_answer3()
	{	if ( $this->IsValidAtt('answer3')) return $this->answer3; }

	public function get_answerok()
	{	if ( $this->IsValidAtt('answerok')) return $this->answerok; }

	public function get_timeout()
	{	if ( $this->IsValidAtt('timeout')) return $this->timeout; }

	// Les mutateurs
	public function set_id()
	{
		if(!empty($value))
			$this->id = $value;
		else {
			global $ErrorAttribut[];
			$ErrorAttribut[] = 'id' ;
		}
	}

	public function set_theme_id()
	{
		if(!empty($value))
			$this->theme_id = $value;
		else {
			global $ErrorAttribut[];
			$ErrorAttribut[] = 'theme_id' ;
		}
	}

	public function set_val()
	{
		if(!empty($value))
			$this->val = $value;
		else {
			global $ErrorAttribut[];
			$ErrorAttribut[] = 'val' ;
		}
	}

	public function set_answer1()
	{
		if(!empty($value))
			$this->answer1 = $value;
		else {
			global $ErrorAttribut[];
			$ErrorAttribut[] = 'answer1' ;
		}
	}

	public function set_answer2()
	{
		if(!empty($value))
			$this->answer2 = $value;
		else {
			global $ErrorAttribut[];
			$ErrorAttribut[] = 'answer2' ;
		}
	}

	public function set_answer3()
	{
		if(!empty($value))
			$this->answer3 = $value;
		else {
			global $ErrorAttribut[];
			$ErrorAttribut[] = 'answer3' ;
		}
	}

	public function set_answerok()
	{
		if(!empty($value))
			$this->answerok = $value;
		else {
			global $ErrorAttribut[];
			$ErrorAttribut[] = 'answerok' ;
		}
	}

	public function set_timeout()
	{
		if(!empty($value))
			$this->timeout = $value;
		else {
			global $ErrorAttribut[];
			$ErrorAttribut[] = 'timeout' ;
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
			answerOK,
			timeout
		)
		VALUES
		(
			"'.$this->id'",
			"'.$this->theme_id'",
			"'.$this->val'",
			"'.$this->answer1'",
			"'.$this->answer2'",
			"'.$this->answer3'",
			"'.$this->answerok'",
			"'.$this->timeout'"
		)';
		mysql_query($rqt) or die (mysql_error().' sur la ligne '.__LINE__);
	}

	public function update($id)
	{
		$rqt = 
		'UPDATE coq_question SET
			id = "'$this->id'",
			theme_id = "'$this->theme_id'",
			val = "'$this->val'",
			answer1 = "'$this->answer1'",
			answer2 = "'$this->answer2'",
			answer3 = "'$this->answer3'",
			answerOK = "'$this->answerok'",
			timeout = "'$this->timeout'"
		WHERE id ='.$id;
		mysql_query($rqt) or die (mysql_error().' sur la ligne '.__LINE__);
	}

	public function delete($id)
	{
		$rqt = 'DELETE FROM coq_question WHERE ID = '.$id;
		mysql_query($rqt) or die (mysql_error().' sur la ligne '.__LINE__);
	}

	public function list()
	{
		$tab = array();
		$rqt = mysql_query("SELECT * FROM coq_question");
		while($data = mysql_fetch_assoc($rqt))
			$tab[] = $data;
		return $tab;
	}

	public function list($PARAM)
	{
		$tab = array();
		$rqt = mysql_query("SELECT * FROM coq_question WHERE PARAM = ".$PARAM);
		$data = mysql_fetch_assoc($rqt);
			$tab[] = $data;
		return $tab;
	}

	public function find($PARAM)
	{
		$rqt = mysql_query("SELECT * FROM coq_question WHERE PARAM = ".$PARAM);
		$data = mysql_fetch_assoc($rqt);
		if (count($data) > 0)
		{
			$this->id = $data['id'];
			$this->theme_id = $data['theme_id'];
			$this->val = $data['val'];
			$this->answer1 = $data['answer1'];
			$this->answer2 = $data['answer2'];
			$this->answer3 = $data['answer3'];
			$this->answerok = $data['answerOK'];
			$this->timeout = $data['timeout'];
		}
		 return $this;
	}
}
?>
