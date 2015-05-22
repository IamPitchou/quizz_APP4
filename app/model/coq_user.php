<?php 
include_once("pdo.php");
include_once("common.php");
class  coq_user
{
	private $id;
	private $login;
	private $pwd;
	private $pseudo;
	private $rights;

	public function init($login, $pwd, $pseudo, $rights)
	{ 
		$this->login = $login;
		$this->pwd = $pwd;
		$this->pseudo = $pseudo;
		$this->rights = $rights;
	} 

	
	// Les accesseurs
	public function get_id()
	{	 
		return $this->id;
	}

	public function get_login()
	{	
		return $this->login; 
	}

	public function get_pwd()
	{	
		return $this->pwd; 
	}

	public function get_pseudo()
	{	
		return $this->pseudo; 
	}

	public function get_rights()
	{	
		return $this->rights; 
	}

	// Les mutateurs
	public function set_id($value)
	{
		$this->id = $value;
	}

	public function set_login($value)
	{
		$this->login = $value;
	}

	public function set_pwd($value)
	{
		$this->pwd = $value;
	}

	public function set_pseudo($value)
	{
		$this->pseudo = $value;
	}

	public function set_rights($value)
	{
		$this->rights = $value;
	}

	public function add()
	{
		$rqt = 
		'INSERT INTO coq_user
		(
			id,
			login,
			pwd,
			pseudo,
			rights
		)
		VALUES
		(
			"'.$this->id.'",
			"'.$this->login.'",
			"'.$this->pwd.'",
			"'.$this->pseudo.'",
			"'.$this->rights.'"
		)';
		$this->pdo = initPDOObject();
		$this->pdo->request($rqt, $error);
	}

	public function update($id)
	{
		$rqt = 
		'UPDATE coq_user SET
			login = "'.$this->login.'",
			pwd = "'.$this->pwd.'",
			rights = "'.$this->rights.'"
		WHERE id ='.$id;
		$this->pdo = initPDOObject();
		$this->pdo->request($rqt, $error);
	}

	public function list_()
	{
		$rqt = "SELECT * FROM coq_user";
		$this->pdo = initPDOObject();
		return $this->pdo->request($rqt, $error);
	}

	public function get_duels_of_user ($id_user)
	{
		$rqt = "SELECT cu1.pseudo as pseudo1, cu2.pseudo as pseudo2, cd.score1, cd.score2 
			    FROM coq_duel as cd, coq_user as cu1, coq_user as cu2 
			    WHERE cu1.id = ".$id_user." AND user1_id = cu1.id AND user2_id = cu2.id 
			   	  OR cu2.id = ".$id_user." AND user2_id = cu2.id AND user1_id = cu1.id";
		$this->pdo = initPDOObject();
		$answ = $this->pdo->request($rqt, $error);
		if (count($answ) > 0) return $answ;
		else return 0;   	  
	}
	public function get_pseudo_req ($id_user)
	{
		$rqt = "SELECT pseudo
				FROM coq_user as cu 
				WHERE cu.id = ".$id_user."";
		$this->pdo = initPDOObject();
		$answ = $this->pdo->request($rqt, $error);
		if (count($answ) > 0) return $answ;
		else return 0;   
	}
	public function get_allDuelsOfUser($id_user)
	{
		$rqt = "SELECT cd.id, cu2.pseudo, cd.score1, cd.score2, cd.current_round_number
				FROM coq_duel as cd, coq_user as cu1, coq_user as cu2
				WHERE cd.user1_id = ".$id_user." 
				AND cd.user1_id = cu1.id
				AND cd.user2_id = cu2.id
				UNION
				SELECT cd.id, cu1.pseudo, cd.score1, cd.score2, cd.current_round_number
				FROM coq_duel as cd, coq_user as cu1, coq_user as cu2
				WHERE cd.user2_id = ".$id_user." 
				AND cd.user1_id = cu1.id
				AND cd.user2_id = cu2.id";
		$this->pdo = initPDOObject();
		$answ = $this->pdo->request($rqt, $error);
		if (count($answ) > 0) return $answ;
		else return 0;   
	}
	public function get_AllUsers ($id_user)
	{
		$rqt = "SELECT id, pseudo
				FROM coq_user
				WHERE id <> ".$id_user."";
		$this->pdo = initPDOObject();
		$answ = $this->pdo->request($rqt, $error);
		if (count($answ) > 0) return $answ;
		else return 0;   		
	}

	public function find($id)
	{
		$rqt = "SELECT * FROM coq_user WHERE id = ".$id;
		$this->pdo = initPDOObject();
		$data = $this->pdo->request($rqt, $error);
		if (count($data) > 0) return $data[0];
		else return 0;
	}

	public function find_login($email, $password)
	{
		$rqt = "SELECT * FROM coq_user WHERE login = '".$email."' AND pwd = '".$password."'";
		$this->pdo = initPDOObject();
		$data = $this->pdo->request($rqt, $error);
		if (count($data) > 0) return $data[0];
		else return NULL;
	}

	public function JSON ()
	{
		return json_encode(array("id" => $this->id, "login" => $this->login, "password" => $this->pwd, "pseudo" => $this->pseudo, "rights" => $this->rights));
	}
}
?>
