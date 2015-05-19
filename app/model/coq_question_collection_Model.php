<?php 
class  coq_question_collection_Model extends Model  
{
	private $id;
	private $question_id;
	private $collection_id;

	public function coq_question_collection($question_id,$collection_id){ 
		$this->question_id=$question_id;
		$this->collection_id=$collection_id;
	} 

	
	// Les accesseurs
	public function get_id()
	{	if ( $this->IsValidAtt('id')) return $this->id; }

	public function get_question_id()
	{	if ( $this->IsValidAtt('question_id')) return $this->question_id; }

	public function get_collection_id()
	{	if ( $this->IsValidAtt('collection_id')) return $this->collection_id; }

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

	public function set_question_id($value)
	{
		if(!empty($value))
			$this->question_id = $value;
		else {
			global $ErrorAttribut[];
			$ErrorAttribut[] = 'question_id' ;
		}
	}

	public function set_collection_id($value)
	{
		if(!empty($value))
			$this->collection_id = $value;
		else {
			global $ErrorAttribut[];
			$ErrorAttribut[] = 'collection_id' ;
		}
	}

	public function add()
	{
		$rqt = 
		'INSERT INTO coq_question_collection
		(
			id,
			question_id,
			collection_id
		)
		VALUES
		(
			"'.$this->id.'",
			"'.$this->question_id.'",
			"'.$this->collection_id.'"
		)';
		mysql_query($rqt) or die (mysql_error().' sur la ligne '.__LINE__);
	}

	public function update($id)
	{
		$rqt = 
		'UPDATE coq_question_collection SET
			id = "'.$this->id.'",
			question_id = "'.$this->question_id.'",
			collection_id = "'.$this->collection_id.'"
		WHERE id ='.$id;
		mysql_query($rqt) or die (mysql_error().' sur la ligne '.__LINE__);
	}

	public function delete($id)
	{
		$rqt = 'DELETE FROM coq_question_collection WHERE ID = '.$id;
		mysql_query($rqt) or die (mysql_error().' sur la ligne '.__LINE__);
	}

	public function list()
	{
		$tab = array();
		$rqt = mysql_query("SELECT * FROM coq_question_collection");
		while($data = mysql_fetch_assoc($rqt))
			$tab[] = $data;
		return $tab;
	}

	public function list_p($PARAM)
	{
		$tab = array();
		$rqt = mysql_query("SELECT * FROM coq_question_collection WHERE PARAM = ".$PARAM);
		$data = mysql_fetch_assoc($rqt);
			$tab[] = $data;
		return $tab;
	}

	public function find($PARAM)
	{
		$rqt = mysql_query("SELECT * FROM coq_question_collection WHERE PARAM = ".$PARAM);
		$data = mysql_fetch_assoc($rqt);
		if (count($data) > 0)
		{
			$this->id = $data['id'];
			$this->question_id = $data['question_id'];
			$this->collection_id = $data['collection_id'];
		}
		 return $this;
	}
}
?>
