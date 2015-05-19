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

	public function coq_user($login, $pwd, $pseudo, $rights)
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
			rights
		)
		VALUES
		(
			"'.$this->id.'",
			"'.$this->login.'",
			"'.$this->pwd.'",
			"'.$this->rights.'"
		)';
		$this->pdo = initPDOObject();
		$this->pdo->request($rqt, $error);
	}

	public function update($id)
	{
		$rqt = 
		'UPDATE coq_user SET
			id = "'.$this->id.'",
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
		return $this->pdo->request($rqt, $error);
	}

	public function find($id)
	{
		$rqt = "SELECT * FROM coq_user WHERE id = ".$id;
		$this->pdo = initPDOObject();
		$data = $this->pdo->request($rqt, $error);
		if (count($data) > 0) return $data[0];
		else return 0;
	}

	public function JSON ()
	{
		return json_encode(array("id" => $this->id, "login" => $this->login, "password" => $this->pwd, "pseudo" => $this->pseudo, "rights" => $this->rights));
	}
}
?>
