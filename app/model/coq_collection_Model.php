<?php 
include_once("pdo.php");
include_once("common.php");
class  coq_collection_Model  
{
	private $id;
	private $title;
	private $difficulty;
	private $pdo;

	public function coq_collection($title,$difficulty)
	{ 
		$this->title = $title;
		$this->difficulty= $difficulty;
		$this->pdo = initPDOObject();
	} 

	
	// Les accesseurs
	public function get_id()
	{	if ( IsValidAtt('id')) return $this->id; }

	public function get_title()
	{	if ( IsValidAtt('title')) return $this->title; }

	public function get_difficulty()
	{	if ( IsValidAtt('difficulty')) return $this->difficulty; }

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

	public function set_title($value)
	{
		if(!empty($value))
			$this->title = $value;
		else {
			global $ErrorAttribut;
			$ErrorAttribut[] = 'title' ;
		}
	}

	public function set_difficulty($value)
	{
		if(!empty($value))
			$this->difficulty = $value;
		else {
			global $ErrorAttribut;
			$ErrorAttribut[] = 'difficulty' ;
		}
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
		$this->pdo->request($rqt, $error);
		echo ("error = ". $error);
	}

	public function update($id)
	{ 
		$rqt = 
		'UPDATE coq_collection SET
			id = "'.$this->id.'",
			title = "'.$this->title.'",
			difficulty = "'.$this->difficulty.'"
		WHERE id ='.$id;
		$this->pdo->request($rqt, $error);
		echo ("error = ". $error);
	}

	public function find($id)
	{
		$rqt = "SELECT * FROM coq_collection WHERE id = ".$id;
		$data = $this->pdo->request($rqt, $error);
		return $data[0];
	}
}
?>
