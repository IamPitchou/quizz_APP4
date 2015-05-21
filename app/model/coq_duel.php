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

	public function init($user1_id, $user2_id, $current_round_id, $current_round_number, $score1, $score2)
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
			score2 = "'.$this->score2.'"
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
	public function get_duels ($id_duel)
	{
		
		$rqt = "SELECT  cd.id, cu1.pseudo as pseudo1, cu2.pseudo as pseudo2, cd.current_round_number, ct.val as theme, cq.val as question, 
						cq.answer1, cq.answer2, cq.answer3, cq.answerOK, cr.score1, cr.score2
				FROM coq_duel cd, coq_user cu1, coq_user cu2, coq_round cr, coq_theme ct, coq_question cq
				WHERE cd.id = ".$id_duel."
				AND cd.user1_id = cu1.id
				AND cd.user2_id = cu2.id 
				AND cd.current_round_id = cr.id
				AND cr.selected_theme_id = ct.id
				AND cq.theme_id = ct.id";
		$this->pdo = initPDOObject();
		$data = $this->pdo->request($rqt, $error);
		if (count($data) > 0) return $data;
		else return 0;

	}
	public function get_score($id_duel)
	{
		$rqt = "SELECT cd.score1, cd.score2
				FROM coq_duel cd
				WHERE cd.id = ".$id_duel."";
		$this->pdo = initPDOObject();
		$data = $this->pdo->request($rqt, $error);
		if (count($data) > 0) return $data[0];
		else return 0;
	}
	public function submit_round ($id_duel)
	{
		$rqt = "SELECT user1_id, user2_id, current_round_id, current_round_number, cd.score1 as cd_sc1, cd.score2 as cd_sc2,
					   chosen_theme1_id, chosen_theme2_id, collection_id, selected_theme_id, cr.score1 as cr_sc1, cr.score2 as cr_sc2,
					   end1, end2
				FROM coq_duel as cd, coq_round as cr 
				WHERE cd.id = ".$id_duel." AND cd.current_round_id = cr.id";
		$this->pdo = initPDOObject();
		$data = $this->pdo->request($rqt, $error);
		if (count($data) > 0) return $data[0];
		else return 0;

	}
	public function duel_is_finished_or_not ($id_duel)
	{
		$rqt = "SELECT end1, end2, current_round_number 
				FROM coq_duel as cd, coq_round as cr 
				WHERE cd.id = ".$id_duel." AND cr.id = cd.current_round_id";
		$this->pdo = initPDOObject();
		$data = $this->pdo->request($rqt, $error);
		if (count($data) > 0) return $data[0];
		else return 0;
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
