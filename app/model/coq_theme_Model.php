<?php 
class  coq_theme_Model extends Model  
{
	private $id;
	private $val;

	public function coq_theme($val){ 
		$this->val=$val;
	} 

	
	// Les accesseurs
	public function get_id()
	{	if ( $this->IsValidAtt('id')) return $this->id; }

	public function get_val()
	{	if ( $this->IsValidAtt('val')) return $this->val; }

	// Les mutateurs
	public function set_id($value)
	{
		if(!empty($value))
			$this->id = $value;
		else {
			global $ErrorAttribut[];
			$ErrorAttribut[] = 'id' ;
		}
	}

	public function set_val($value)
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
		mysql_query($rqt) or die (mysql_error().' sur la ligne '.__LINE__);
	}

	public function update($id)
	{
		$rqt = 
		'UPDATE coq_theme SET
			id = "'.$this->id.'",
			val = "'.$this->val.'"
		WHERE id ='.$id;
		mysql_query($rqt) or die (mysql_error().' sur la ligne '.__LINE__);
	}

	public function delete($id)
	{
		$rqt = 'DELETE FROM coq_theme WHERE ID = '.$id;
		mysql_query($rqt) or die (mysql_error().' sur la ligne '.__LINE__);
	}

	public function list()
	{
		$tab = array();
		$rqt = mysql_query("SELECT * FROM coq_theme");
		while($data = mysql_fetch_assoc($rqt))
			$tab[] = $data;
		return $tab;
	}

	public function list_p($PARAM)
	{
		$tab = array();
		$rqt = mysql_query("SELECT * FROM coq_theme WHERE PARAM = ".$PARAM);
		$data = mysql_fetch_assoc($rqt);
			$tab[] = $data;
		return $tab;
	}

	public function find($PARAM)
	{
		$rqt = mysql_query("SELECT * FROM coq_theme WHERE PARAM = ".$PARAM);
		$data = mysql_fetch_assoc($rqt);
		if (count($data) > 0)
		{
			$this->id = $data['id'];
			$this->val = $data['val'];
		}
		 return $this;
	}
}
?>
