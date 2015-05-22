<?php 
include_once("pdo.php");
include_once("common.php");
class coq_theme
{
	private $id;
	private $val;

	public function init($val)
	{ 
		$this->val = $val;
		$this->pdo = initPDOObject();
	} 

	
	// Les accesseurs
	public function get_id()
	{	
		return $this->id; 
	}

	public function get_val()
	{	
		return $this->val; 
	}

	// Les mutateurs
	public function set_id($value)
	{
		$this->id = $value;
	}

	public function set_val($value)
	{
		$this->val = $value;
	}

	public function add()
	{
		$rqt = 
		'INSERT INTO coq_theme
		(
			id,
			val
		)
		VALUES
		(
			"'.$this->id.'",
			"'.$this->val.'"
		)';
		$this->pdo = initPDOObject();
		$this->pdo->request($rqt, $error);
	}

	public function update($id)
	{
		$rqt = 
		'UPDATE coq_theme SET
			val = "'.$this->val.'"
		WHERE id ='.$id;
		$this->pdo = initPDOObject();
		$this->pdo->request($rqt, $error);
	}

	public function list_()
	{
		$rqt = "SELECT * FROM coq_theme";
		$this->pdo = initPDOObject();
		return $this->pdo->request($rqt, $error);
	}

	public function find($id)
	{
		$rqt = "SELECT * FROM coq_theme WHERE id = ".$id;
		$this->pdo = initPDOObject();
		$data = $this->pdo->request($rqt, $error);
		if (count($data) > 0) return $data[0];
		else return 0;
	}
	public function JSON ()
	{
		return json_encode(array("id" => $this->id, "value" => $this->val));
	}
}
?>
