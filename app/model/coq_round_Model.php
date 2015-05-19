<?php 
class  coq_round_Model extends Model  
{
	private $id;
	private $chosen_theme1_id;
	private $chosen_theme2_id;
	private $collection_id;
	private $selected_theme_id;
	private $score1;
	private $score2;
	private $end1;
	private $end2;

	public function coq_round($chosen_theme1_id,$chosen_theme2_id,$collection_id,$selected_theme_id,$score1,$score2,$end1,$end2){ 
		$this->chosen_theme1_id=$chosen_theme1_id;
		$this->chosen_theme2_id=$chosen_theme2_id;
		$this->collection_id=$collection_id;
		$this->selected_theme_id=$selected_theme_id;
		$this->score1=$score1;
		$this->score2=$score2;
		$this->end1=$end1;
		$this->end2=$end2;
	} 

	
	// Les accesseurs
	public function get_id()
	{	if ( $this->IsValidAtt('id')) return $this->id; }

	public function get_chosen_theme1_id()
	{	if ( $this->IsValidAtt('chosen_theme1_id')) return $this->chosen_theme1_id; }

	public function get_chosen_theme2_id()
	{	if ( $this->IsValidAtt('chosen_theme2_id')) return $this->chosen_theme2_id; }

	public function get_collection_id()
	{	if ( $this->IsValidAtt('collection_id')) return $this->collection_id; }

	public function get_selected_theme_id()
	{	if ( $this->IsValidAtt('selected_theme_id')) return $this->selected_theme_id; }

	public function get_score1()
	{	if ( $this->IsValidAtt('score1')) return $this->score1; }

	public function get_score2()
	{	if ( $this->IsValidAtt('score2')) return $this->score2; }

	public function get_end1()
	{	if ( $this->IsValidAtt('end1')) return $this->end1; }

	public function get_end2()
	{	if ( $this->IsValidAtt('end2')) return $this->end2; }

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

	public function set_chosen_theme1_id($value)
	{
		if(!empty($value))
			$this->chosen_theme1_id = $value;
		else {
			global $ErrorAttribut[];
			$ErrorAttribut[] = 'chosen_theme1_id' ;
		}
	}

	public function set_chosen_theme2_id($value)
	{
		if(!empty($value))
			$this->chosen_theme2_id = $value;
		else {
			global $ErrorAttribut[];
			$ErrorAttribut[] = 'chosen_theme2_id' ;
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

	public function set_selected_theme_id($value)
	{
		if(!empty($value))
			$this->selected_theme_id = $value;
		else {
			global $ErrorAttribut[];
			$ErrorAttribut[] = 'selected_theme_id' ;
		}
	}

	public function set_score1($value)
	{
		if(!empty($value))
			$this->score1 = $value;
		else {
			global $ErrorAttribut[];
			$ErrorAttribut[] = 'score1' ;
		}
	}

	public function set_score2($value)
	{
		if(!empty($value))
			$this->score2 = $value;
		else {
			global $ErrorAttribut[];
			$ErrorAttribut[] = 'score2' ;
		}
	}

	public function set_end1($value)
	{
		if(!empty($value))
			$this->end1 = $value;
		else {
			global $ErrorAttribut[];
			$ErrorAttribut[] = 'end1' ;
		}
	}

	public function set_end2($value)
	{
		if(!empty($value))
			$this->end2 = $value;
		else {
			global $ErrorAttribut[];
			$ErrorAttribut[] = 'end2' ;
		}
	}

	public function add()
	{
		$rqt = 
		'INSERT INTO coq_round
		(
			id,
			chosen_theme1_id,
			chosen_theme2_id,
			collection_id,
			selected_theme_id,
			score1,
			score2,
			end1,
			end2
		)
		VALUES
		(
			"'.$this->id.'",
			"'.$this->chosen_theme1_id.'",
			"'.$this->chosen_theme2_id.'",
			"'.$this->collection_id.'",
			"'.$this->selected_theme_id.'",
			"'.$this->score1.'",
			"'.$this->score2.'",
			"'.$this->end1.'",
			"'.$this->end2.'"
		)';
		mysql_query($rqt) or die (mysql_error().' sur la ligne '.__LINE__);
	}

	public function update($id)
	{
		$rqt = 
		'UPDATE coq_round SET
			id = "'.$this->id.'",
			chosen_theme1_id = "'.$this->chosen_theme1_id.'",
			chosen_theme2_id = "'.$this->chosen_theme2_id.'",
			collection_id = "'.$this->collection_id.'",
			selected_theme_id = "'.$this->selected_theme_id.'",
			score1 = "'.$this->score1.'",
			score2 = "'.$this->score2.'",
			end1 = "'.$this->end1.'",
			end2 = "'.$this->end2.'"
		WHERE id ='.$id;
		mysql_query($rqt) or die (mysql_error().' sur la ligne '.__LINE__);
	}

	public function delete($id)
	{
		$rqt = 'DELETE FROM coq_round WHERE ID = '.$id;
		mysql_query($rqt) or die (mysql_error().' sur la ligne '.__LINE__);
	}

	public function list()
	{
		$tab = array();
		$rqt = mysql_query("SELECT * FROM coq_round");
		while($data = mysql_fetch_assoc($rqt))
			$tab[] = $data;
		return $tab;
	}

	public function list_p($PARAM)
	{
		$tab = array();
		$rqt = mysql_query("SELECT * FROM coq_round WHERE PARAM = ".$PARAM);
		$data = mysql_fetch_assoc($rqt);
			$tab[] = $data;
		return $tab;
	}

	public function find($PARAM)
	{
		$rqt = mysql_query("SELECT * FROM coq_round WHERE PARAM = ".$PARAM);
		$data = mysql_fetch_assoc($rqt);
		if (count($data) > 0)
		{
			$this->id = $data['id'];
			$this->chosen_theme1_id = $data['chosen_theme1_id'];
			$this->chosen_theme2_id = $data['chosen_theme2_id'];
			$this->collection_id = $data['collection_id'];
			$this->selected_theme_id = $data['selected_theme_id'];
			$this->score1 = $data['score1'];
			$this->score2 = $data['score2'];
			$this->end1 = $data['end1'];
			$this->end2 = $data['end2'];
		}
		 return $this;
	}
}
?>
