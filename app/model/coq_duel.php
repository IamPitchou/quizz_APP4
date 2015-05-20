<?php 
include_once("pdo.php");
include_once("common.php");
class  coq_duel
{
	private $user1_id;
	private $user2_id;
	private $current_round_id;
	private $current_round_number;
	private $score1;
	private $score2;

	public function _construct ()
	{
		return $this;
	}
	public function coq_duel($user1_id, $user2_id, $current_round_id, $current_round_number, $score1, $score2)
	{ 
		$this->user1_id = $user1_id;
		$this->user2_id = $user2_id;
		$this->current_round_id = $current_round_id;
		$this->current_round_number = $current_round_number;
		$this->score1 = $score1;
		$this->score2 = $score2;
	} 

	
	// Les accesseurs
	public function get_user1_id()
	{	
		return $this->user1_id; 
	}

	public function get_user2_id()
	{	
		return $this->user2_id; 
	}

	public function get_current_round_id()
	{	
		return $this->current_round_id; 
	}

	public function get_current_round_number()
	{	
		return $this->current_round_number; 
	}
	public function get_score1()
	{	
		return $this->score1; 
	}
	public function get_score2()
	{	
		return $this->score2; 
	}

	// Les mutateurs
	public function set_user1_id($value)
	{
		$this->user1_id = $value;
	}

	public function set_user2_id($value)
	{
		$this->user2_id = $value;
	}

	public function set_current_round_id($value)
	{
		$this->current_round_id = $value;
	}

	public function set_current_round_number($value)
	{
		$this->current_round_number = $value;
	}
	public function set_score1($value)
	{
		$this->score1 = $value;
	}
	public function set_score2($value)
	{
		$this->score2 = $value;
	}

	public function add()
	{
		$rqt = 
		'INSERT INTO coq_duel
		(
			user1_id,
			user2_id,
			current_round_id,
			current_round_number,
			score1, 
			score2
		)
		VALUES
		(
			"'.$this->user1_id.'",
			"'.$this->user2_id.'",
			"'.$this->current_round_id.'",
			"'.$this->current_round_number.'", 
			"'.$this->score1.'",
			"'.$this->score2.'"
		)';
		$this->pdo = initPDOObject();
		$this->pdo->request($rqt, $error);
	}

	public function update($id)
	{
		$rqt = 
		'UPDATE coq_duel SET
			user1_id = "'.$this->user1_id.'",
			user2_id = "'.$this->user2_id.'",
			current_round_id = "'.$this->current_round_id.'",
			current_round_number = "'.$this->current_round_number.'", 
			score1 = "'.$this->score1.'",
			score1 = "'.$this->score2.'"
		WHERE id ='.$id;
		$this->pdo = initPDOObject();
		$this->pdo->request($rqt, $error);
	}

	public function list_()
	{
		$rqt = "SELECT * FROM coq_duel";
		$this->pdo = initPDOObject();
		return $this->pdo->request($rqt, $error);
	}
	public function get_duels_by_player($id_user)
	{
		$rqt = "SELECT * FROM coq_duel WHERE user1_id = '.$id_user.' OR user2_id = '.$id_user.' ";
		$this->pdo = initPDOObject();
		return $this->pdo->request($rqt, $error);
	}

	public function find($id)
	{
		$rqt = "SELECT * FROM coq_duel WHERE id = ".$id;
		$this->pdo = initPDOObject();
		$data = $this->pdo->request($rqt, $error);
		if (count($data) > 0) return $data[0];
		else return 0;
	}
	public function JSON ()
	{
		return json_encode(array("user1_id" => $this->user1_id, "user2_id" => $this->user2_id, 
								 "current_round_id" => $this->current_round_id, "current_round_number" => $this->current_round_number, 
								 "score1" => $this->score1, "score2" => $this->score2));
	}
}
?>
