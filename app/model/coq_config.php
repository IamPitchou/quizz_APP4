<?php 
include_once("pdo.php");
include_once("common.php");
class  coq_config 
{
	private $key_2;
	private $val;

	public function init($key_2,$val)
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
		$this->pdo = initPDOObject();
		$this->pdo->request($rqt, $error);
	}

	public function update($id)
	{
		$rqt = 
		'UPDATE coq_config SET
			key_2 = "'.$this->key_2.'",
			val = "'.$this->val.'"
		WHERE id ='.$id;
		$this->pdo = initPDOObject();
		$this->pdo->request($rqt, $error);
	}
	public function list_()
	{
		$rqt = "SELECT * FROM coq_config";
		$this->pdo = initPDOObject();
		return $this->pdo->request($rqt, $error);
	}
	public function get_nb_round_duel()
	{
		$rqt = "SELECT val FROM coq_config WHERE key_2 = \"nb_round_duel\"";
		$this->pdo = initPDOObject();
		$answ = $this->pdo->request($rqt, $error);
		if (count($answ) > 0) return $answ[0]["val"];
		else return 0;
	}
	public function get_config()
	{
		$rqt = "SELECT key_2, val FROM coq_config";
		$this->pdo = initPDOObject();
		$answ = $this->pdo->request($rqt, $error);
		if (count($answ) > 0) return $answ;
		else return 0;
	}
	public function delete($id)
	{
		$rqt = 'DELETE FROM coq_config WHERE ID = '.$id;
		$this->pdo = initPDOObject();
		$this->pdo->request($rqt, $error);
	}

	public function find($key)
	{
		$rqt = "SELECT * FROM coq_config WHERE key_2 = ".$key;
		$this->pdo = initPDOObject();
		$data = $this->pdo->request($rqt, $error);
		if (count($data) >= 0) return $data[0];
		else return 0;
	}
	public function JSON ()
	{
		return json_encode(array("key" => $this->key_2, "value" => $this->val));
	}
}
?>
