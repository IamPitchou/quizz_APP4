<?php 
class  coq_collection_Model  
{
	private $id;
	private $title;
	private $difficulty;
	
	// Les accesseurs
	public function get_id()
	{	if ( $this->IsValidAtt('id')) return $this->id; }

	public function get_title()
	{	if ( $this->IsValidAtt('title')) return $this->title; }

	public function get_difficulty()
	{	if ( $this->IsValidAtt('difficulty')) return $this->difficulty; }

	// Les mutateurs
	public function set_id()
	{
		if(!empty($value))
			$this->id = $value;
		else {
			global $ErrorAttribut[];
			$ErrorAttribut[] = 'id' ;
		}
	}

	public function set_title()
	{
		if(!empty($value))
			$this->title = $value;
		else {
			global $ErrorAttribut[];
			$ErrorAttribut[] = 'title' ;
		}
	}

	public function set_difficulty()
	{
		if(!empty($value))
			$this->difficulty = $value;
		else {
			global $ErrorAttribut[];
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
			"'.$this->id'",
			"'.$this->title'",
			"'.$this->difficulty'"
		)';
		mysql_query($rqt) or die (mysql_error().' sur la ligne '.__LINE__);
	}

	public function update($id)
	{
		$rqt = 
		'UPDATE coq_collection SET
			id = "'$this->id'",
			title = "'$this->title'",
			difficulty = "'$this->difficulty'"
		WHERE id ='.$id;
		mysql_query($rqt) or die (mysql_error().' sur la ligne '.__LINE__);
	}

	public function delete($id)
	{
		$rqt = 'DELETE FROM coq_collection WHERE ID = '.$id;
		mysql_query($rqt) or die (mysql_error().' sur la ligne '.__LINE__);
	}

	public function list()
	{
		$tab = array();
		$rqt = mysql_query("SELECT * FROM coq_collection");
		while($data = mysql_fetch_assoc($rqt))
			$tab[] = $data;
		return $tab;
	}

	public function list($PARAM)
	{
		$tab = array();
		$rqt = mysql_query("SELECT * FROM coq_collection WHERE PARAM = ".$PARAM);
		$data = mysql_fetch_assoc($rqt);
			$tab[] = $data;
		return $tab;
	}

	public function find($PARAM)
	{
		$rqt = mysql_query("SELECT * FROM coq_collection WHERE PARAM = ".$PARAM);
		$data = mysql_fetch_assoc($rqt);
		if (count($data) > 0)
		{
			$this->id = $data['id'];
			$this->title = $data['title'];
			$this->difficulty = $data['difficulty'];
		}
		 return $this;
	}
}
?>
