<?php 
class  coq_config_Model 
{
	private $key_2;
	private $val;
	
	// Les accesseurs
	public function get_key_2()
	{	if ( $this->IsValidAtt('key_2')) return $this->key_2; }

	public function get_val()
	{	if ( $this->IsValidAtt('val')) return $this->val; }

	// Les mutateurs
	public function set_key_2()
	{
		if(!empty($value))
			$this->key_2 = $value;
		else {
			global $ErrorAttribut[];
			$ErrorAttribut[] = 'key_2' ;
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
			"'.$this->key_2'",
			"'.$this->val'"
		)';
		mysql_query($rqt) or die (mysql_error().' sur la ligne '.__LINE__);
	}

	public function update($id)
	{
		$rqt = 
		'UPDATE coq_config SET
			key_2 = "'$this->key_2'",
			val = "'$this->val'"
		WHERE id ='.$id;
		mysql_query($rqt) or die (mysql_error().' sur la ligne '.__LINE__);
	}

	public function delete($id)
	{
		$rqt = 'DELETE FROM coq_config WHERE ID = '.$id;
		mysql_query($rqt) or die (mysql_error().' sur la ligne '.__LINE__);
	}

	public function list()
	{
		$tab = array();
		$rqt = mysql_query("SELECT * FROM coq_config");
		while($data = mysql_fetch_assoc($rqt))
			$tab[] = $data;
		return $tab;
	}

	public function list($PARAM)
	{
		$tab = array();
		$rqt = mysql_query("SELECT * FROM coq_config WHERE PARAM = ".$PARAM);
		$data = mysql_fetch_assoc($rqt);
			$tab[] = $data;
		return $tab;
	}

	public function find($PARAM)
	{
		$rqt = mysql_query("SELECT * FROM coq_config WHERE PARAM = ".$PARAM);
		$data = mysql_fetch_assoc($rqt);
		if (count($data) > 0)
		{
			$this->key_2 = $data['key_2'];
			$this->val = $data['val'];
		}
		 return $this;
	}
}
?>
