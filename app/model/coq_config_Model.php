<?php 
include_once("pdo.php");
include_once("common.php");
class  coq_config_Model extends Model  
{
	private $key_2;
	private $val;
	private $pdo;

	public function coq_config($key_2,$val)
	{ 
		$this->key_2 = $key_2;
		$this->val = $val;
		$this->pdo = initPDOObject();
	} 

	
	// Les accesseurs
	public function get_key_2()
	{	
		return $this->key_2; 
	}

	public function get_val()
	{	
		return $this->val; 
	}

	// Les mutateurs
	public function set_key_2($value)
	{
		$this->key_2 = $value;
	}

	public function set_val($value)
	{
		$this->val = $value;
	}

	public function add()
	{
		$rqt = 
		'INSERT INTO coq_config
		(
			key_2,
			val
		)
		VALUES
		(
			"'.$this->key_2.'",
			"'.$this->val.'"
		)';
		$this->pdo->request($rqt, $error);
	}

	public function update($id)
	{
		$rqt = 
		'UPDATE coq_config SET
			key_2 = "'.$this->key_2.'",
			val = "'.$this->val.'"
		WHERE id ='.$id;
		$this->pdo->request($rqt, $error);
	}
	public function list_()
	{
		$rqt = "SELECT * FROM coq_config";
		return $this->pdo->request($rqt, $error);
	}

	public function delete($id)
	{
		$rqt = 'DELETE FROM coq_config WHERE ID = '.$id;
		$this->pdo->request($rqt, $error);
	}

	public function find($key)
	{
		$rqt = "SELECT * FROM coq_config WHERE key_2 = ".$key;
		$data = $this->pdo->request($rqt, $error);
		if ($data.count >= 0) return $data[0];
		else return 0;
	}
}
?>
