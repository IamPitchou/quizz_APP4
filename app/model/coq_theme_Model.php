<?php 
include_once("pdo.php");
include_once("common.php");
class  coq_theme_Model extends Model  
{
	private $id;
	private $val;
	private $pdo;

	public function coq_theme($val)
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
		$this->pdo->request($rqt, $error);
	}

	public function update($id)
	{
		$rqt = 
		'UPDATE coq_theme SET
			id = "'.$this->id.'",
			val = "'.$this->val.'"
		WHERE id ='.$id;
		$this->pdo->request($rqt, $error);
	}

	public function list_()
	{
		$rqt = "SELECT * FROM coq_theme";
		return $this->pdo->request($rqt, $error);
	}

	public function find($id)
	{
		$rqt = "SELECT * FROM coq_theme WHERE id = ".$id;
		$data = $this->pdo->request($rqt, $error);
		if ($data.count > 0) return $data[0];
		else return 0;
	}
}
?>
