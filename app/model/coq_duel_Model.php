<?php 
class  coq_duel_Model 
{
	private $user1_id;
	private $user2_id;
	private $current_round_id;
	private $current_round_number;
	
	// Les accesseurs
	public function get_user1_id()
	{	if ( $this->IsValidAtt('user1_id')) return $this->user1_id; }

	public function get_user2_id()
	{	if ( $this->IsValidAtt('user2_id')) return $this->user2_id; }

	public function get_current_round_id()
	{	if ( $this->IsValidAtt('current_round_id')) return $this->current_round_id; }

	public function get_current_round_number()
	{	if ( $this->IsValidAtt('current_round_number')) return $this->current_round_number; }

	// Les mutateurs
	public function set_user1_id()
	{
		if(!empty($value))
			$this->user1_id = $value;
		else {
			global $ErrorAttribut[];
			$ErrorAttribut[] = 'user1_id' ;
		}
	}

	public function set_user2_id()
	{
		if(!empty($value))
			$this->user2_id = $value;
		else {
			global $ErrorAttribut[];
			$ErrorAttribut[] = 'user2_id' ;
		}
	}

	public function set_current_round_id()
	{
		if(!empty($value))
			$this->current_round_id = $value;
		else {
			global $ErrorAttribut[];
			$ErrorAttribut[] = 'current_round_id' ;
		}
	}

	public function set_current_round_number()
	{
		if(!empty($value))
			$this->current_round_number = $value;
		else {
			global $ErrorAttribut[];
			$ErrorAttribut[] = 'current_round_number' ;
		}
	}

	public function add()
	{
		$rqt = 
		'INSERT INTO coq_duel
		(
			user1_id,
			user2_id,
			current_round_id,
			current_round_number
		)
		VALUES
		(
			"'.$this->user1_id'",
			"'.$this->user2_id'",
			"'.$this->current_round_id'",
			"'.$this->current_round_number'"
		)';
		mysql_query($rqt) or die (mysql_error().' sur la ligne '.__LINE__);
	}

	public function update($id)
	{
		$rqt = 
		'UPDATE coq_duel SET
			user1_id = "'$this->user1_id'",
			user2_id = "'$this->user2_id'",
			current_round_id = "'$this->current_round_id'",
			current_round_number = "'$this->current_round_number'"
		WHERE id ='.$id;
		mysql_query($rqt) or die (mysql_error().' sur la ligne '.__LINE__);
	}

	public function delete($id)
	{
		$rqt = 'DELETE FROM coq_duel WHERE ID = '.$id;
		mysql_query($rqt) or die (mysql_error().' sur la ligne '.__LINE__);
	}

	public function list()
	{
		$tab = array();
		$rqt = mysql_query("SELECT * FROM coq_duel");
		while($data = mysql_fetch_assoc($rqt))
			$tab[] = $data;
		return $tab;
	}

	public function list($PARAM)
	{
		$tab = array();
		$rqt = mysql_query("SELECT * FROM coq_duel WHERE PARAM = ".$PARAM);
		$data = mysql_fetch_assoc($rqt);
			$tab[] = $data;
		return $tab;
	}

	public function find($PARAM)
	{
		$rqt = mysql_query("SELECT * FROM coq_duel WHERE PARAM = ".$PARAM);
		$data = mysql_fetch_assoc($rqt);
		if (count($data) > 0)
		{
			$this->user1_id = $data['user1_id'];
			$this->user2_id = $data['user2_id'];
			$this->current_round_id = $data['current_round_id'];
			$this->current_round_number = $data['current_round_number'];
		}
		 return $this;
	}
}
?>
