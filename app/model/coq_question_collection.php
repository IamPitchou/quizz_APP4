<?php 
include_once("pdo.php");
include_once("common.php");
class  coq_question_collection
{
	private $id;
	private $question_id;
	private $collection_id;

	public function init($question_id, $collection_id)
	{ 
		$this->question_id = $question_id;
		$this->collection_id = $collection_id;
	} 

	
	// Les accesseurs
	public function get_id()
	{	
		return $this->id;
	}

	public function get_question_id()
	{	
		return $this->question_id; 
	}

	public function get_collection_id()
	{	
		return $this->collection_id; 
	}

	// Les mutateurs
	public function set_id($value)
	{
		$this->id = $value;
	}

	public function set_question_id($value)
	{
		$this->question_id = $value;
	}

	public function set_collection_id($value)
	{
		$this->collection_id = $value;
	}

	public function add()
	{
		$rqt = 
		'INSERT INTO coq_question_collection
		(
			id,
			question_id,
			collection_id
		)
		VALUES
		(
			"'.$this->id.'",
			"'.$this->question_id.'",
			"'.$this->collection_id.'"
		)';
		$this->pdo = initPDOObject();
		$this->pdo->request($rqt, $error);
	}

	public function update($id)
	{
		$rqt = 
		'UPDATE coq_question_collection SET
			question_id = "'.$this->question_id.'",
			collection_id = "'.$this->collection_id.'"
		WHERE id ='.$id;
		$this->pdo = initPDOObject();
		$this->pdo->request($rqt, $error);
	}

	public function get_questions_by_collection_id ($collection_id)
	{
		$rqt = "SELECT cq.id, ct.val as theme, cq.val, cq.answer1, cq.answer2, cq.answer3, cq.answerOK
				FROM coq_question_collection as cqc, coq_question as cq, coq_theme as ct 
				WHERE cqc.collection_id = ".$collection_id."
				AND cqc.question_id = cq.id
				AND ct.id = cq.theme_id";
		$this->pdo = initPDOObject();
		$answ = $this->pdo->request($rqt, $error);
		if (count($answ) > 0) return $answ;
		else return 0;   	
	}

	public function find($id)
	{
		$rqt = "SELECT * FROM coq_question_collection WHERE id = ".$id;
		$this->pdo = initPDOObject();
		$data = $this->pdo->request($rqt, $error);
		if (count($data) > 0) return $data[0];
		else return 0;
	}
	public function JSON ()
	{
		return json_encode(array("id" => $this->id, "question_id" => $this->question_id, "collection_id" => $this->collection_id));
	}
}
?>
