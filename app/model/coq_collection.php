<?php 
include_once("pdo.php");
include_once("common.php");
class  coq_collection
{
	private $id;
	private $title;
	private $difficulty;

	public function init($title, $difficulty)
	{ 
		$this->title = $title;
		$this->difficulty= $difficulty;
	} 

	
	// Les accesseurs
	public function get_id()
	{	
		return $this->id; 
	}

	public function get_title()
	{	
		return $this->title; 
	}

	public function get_difficulty()
	{	
		return $this->difficulty; 
	}

	// Les mutateurs
	public function set_id($value)
	{
		$this->id = $value;
	}

	public function set_title($value)
	{
		$this->title = $value;
	}

	public function set_difficulty($value)
	{
		$this->difficulty = $value;
	}

	public function add()
	{
		$rqt = 
		'INSERT INTO coq_collection
		(
			id,
			title,
			difficulty
		)
		VALUES
		(
			"'.$this->id.'",
			"'.$this->title.'",
			"'.$this->difficulty.'"
		)';
		$this->pdo = initPDOObject();
		$this->pdo->request($rqt, $error);
		echo ("error = ". $error);
	}

	public function update($id)
	{ 
		$rqt = 
		'UPDATE coq_collection SET
			title = "'.$this->title.'",
			difficulty = "'.$this->difficulty.'"
		WHERE id ='.$id;
		$this->pdo = initPDOObject();
		$this->pdo->request($rqt, $error);
		echo ("error = ". $error);
	}
	public function list_()
	{
		$rqt = "SELECT * FROM coq_collection";
		$this->pdo = initPDOObject();
		return $this->pdo->request($rqt, $error);
	}
	public function get_collection_by_theme ()
	{
		$rqt =	"SELECT distinct cc.id,  cc.title, cc.difficulty, ct.val
				FROM coq_collection as cc, coq_question_collection as cqc, coq_question as cq, coq_theme as ct
				WHERE cc.id = cqc.collection_id
				AND cqc.question_id = cq.id
				AND cq.theme_id = ct.id";
		$this->pdo = initPDOObject();
		return $this->pdo->request($rqt, $error);
	}
	public function get_all_ids ($id_collec)
	{
		$rqt = "SELECT id
				FROM coq_collection
				WHERE id <> ".$id_collec."";
		$this->pdo = initPDOObject();
		$data = $this->pdo->request($rqt, $error);
		if (count($data) > 0) return $data;
		else return 0;
	}

	public function find($id)
	{
		$rqt = "SELECT * FROM coq_collection WHERE id = ".$id;
		$this->pdo = initPDOObject();
		$data = $this->pdo->request($rqt, $error);
		if (count($data) > 0) return $data[0];
		else return 0;
	}
	public function JSON ()
	{
		return json_encode(array("id" => $this->$id, "title" => $this->title, "difficulty" => $this->difficulty));
	}
}
?>
