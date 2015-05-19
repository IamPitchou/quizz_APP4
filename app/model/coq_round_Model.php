<?php 
include_once("pdo.php");
include_once("common.php");
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
	private $pdo;

	public function coq_round($chosen_theme1_id, $chosen_theme2_id, $collection_id, $selected_theme_id, $score1, $score2, $end1, $end2)
	{ 
		$this->chosen_theme1_id = $chosen_theme1_id;
		$this->chosen_theme2_id = $chosen_theme2_id;
		$this->collection_id = $collection_id;
		$this->selected_theme_id = $selected_theme_id;
		$this->score1 = $score1;
		$this->score2 = $score2;
		$this->end1 = $end1;
		$this->end2 = $end2;
		$this->pdo = initPDOObject();
	} 

	
	// Les accesseurs
	public function get_id()
	{	
		return $this->id; 
	}

	public function get_chosen_theme1_id()
	{	
		return $this->chosen_theme1_id; 
	}

	public function get_chosen_theme2_id()
	{	
		return $this->chosen_theme2_id; 
	}

	public function get_collection_id()
	{	
		return $this->collection_id; 
	}

	public function get_selected_theme_id()
	{	
		return $this->selected_theme_id; 
	}

	public function get_score1()
	{	
		return $this->score1; 
	}

	public function get_score2()
	{	
		return $this->score2; 
	}

	public function get_end1()
	{	
		return $this->end1; 
	}

	public function get_end2()
	{	
		return $this->end2; 
	}

	// Les mutateurs
	public function set_id($value)
	{
		$this->id = $value;
	}

	public function set_chosen_theme1_id($value)
	{
		$this->chosen_theme1_id = $value;
	}

	public function set_chosen_theme2_id($value)
	{
		$this->chosen_theme2_id = $value;
	}

	public function set_collection_id($value)
	{
		$this->collection_id = $value;
	}

	public function set_selected_theme_id($value)
	{
		$this->selected_theme_id = $value;
	}

	public function set_score1($value)
	{
		$this->score1 = $value;
	}

	public function set_score2($value)
	{
		$this->score2 = $value;
	}

	public function set_end1($value)
	{
		$this->end1 = $value;
	}

	public function set_end2($value)
	{
		$this->end2 = $value;
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
		$this->pdo->request($rqt, $error);
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
		$this->pdo->request($rqt, $error);
	}

	public function list_()
	{
		$rqt = "SELECT * FROM coq_round";
		return $this->pdo->request($rqt, $error);
	}


	public function find($id)
	{
		$rqt = "SELECT * FROM coq_round WHERE id = ".$id;
		$data = $this->pdo->request($rqt, $error);
		if ($data.count > 0) return $data[0];
		else return 0;
	}
}
?>
