<?php 
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
	{	if ( $this->IsValidAtt('key_2')) return $this->key_2; }

	public function get_val()
	{	if ( $this->IsValidAtt('val')) return $this->val; }

	// Les mutateurs
	public function set_key_2($value)
	{
		if(!empty($value))
			$this->key_2 = $value;
		else {
			global $ErrorAttribut;
			$ErrorAttribut[] = 'key_2' ;
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

	public function delete($id)
	{
		$rqt = 'DELETE FROM coq_config WHERE ID = '.$id;
		$this->pdo->request($rqt, $error);
	}

	public function find($key)
	{
		$rqt = "SELECT * FROM coq_config WHERE key_2 = ".$key;
		$data = $this->pdo->request($rqt, $error);
		return $data[0];
	}
}
?>
