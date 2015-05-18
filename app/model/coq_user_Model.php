<?php 
class  coq_user_Model
{
	private $id;
	private $login;
	private $pwd;
	private $rights;
	
	// Les accesseurs
	public function get_id()
	{	if ( $this->IsValidAtt('id')) return $this->id; }

	public function get_login()
	{	if ( $this->IsValidAtt('login')) return $this->login; }

	public function get_pwd()
	{	if ( $this->IsValidAtt('pwd')) return $this->pwd; }

	public function get_rights()
	{	if ( $this->IsValidAtt('rights')) return $this->rights; }

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

	public function set_login()
	{
		if(!empty($value))
			$this->login = $value;
		else {
			global $ErrorAttribut[];
			$ErrorAttribut[] = 'login' ;
		}
	}

	public function set_pwd()
	{
		if(!empty($value))
			$this->pwd = $value;
		else {
			global $ErrorAttribut[];
			$ErrorAttribut[] = 'pwd' ;
		}
	}

	public function set_rights()
	{
		if(!empty($value))
			$this->rights = $value;
		else {
			global $ErrorAttribut[];
			$ErrorAttribut[] = 'rights' ;
		}
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
			"'.$this->id'",
			"'.$this->login'",
			"'.$this->pwd'",
			"'.$this->rights'"
		)';
		mysql_query($rqt) or die (mysql_error().' sur la ligne '.__LINE__);
	}

	public function update($id)
	{
		$rqt = 
		'UPDATE coq_user SET
			id = "'$this->id'",
			login = "'$this->login'",
			pwd = "'$this->pwd'",
			rights = "'$this->rights'"
		WHERE id ='.$id;
		mysql_query($rqt) or die (mysql_error().' sur la ligne '.__LINE__);
	}

	public function delete($id)
	{
		$rqt = 'DELETE FROM coq_user WHERE ID = '.$id;
		mysql_query($rqt) or die (mysql_error().' sur la ligne '.__LINE__);
	}

	public function list()
	{
		$tab = array();
		$rqt = mysql_query("SELECT * FROM coq_user");
		while($data = mysql_fetch_assoc($rqt))
			$tab[] = $data;
		return $tab;
	}

	public function list($PARAM)
	{
		$tab = array();
		$rqt = mysql_query("SELECT * FROM coq_user WHERE PARAM = ".$PARAM);
		$data = mysql_fetch_assoc($rqt);
			$tab[] = $data;
		return $tab;
	}

	public function find($PARAM)
	{
		$rqt = mysql_query("SELECT * FROM coq_user WHERE PARAM = ".$PARAM);
		$data = mysql_fetch_assoc($rqt);
		if (count($data) > 0)
		{
			$this->id = $data['id'];
			$this->login = $data['login'];
			$this->pwd = $data['pwd'];
			$this->rights = $data['rights'];
		}
		 return $this;
	}
}
?>
