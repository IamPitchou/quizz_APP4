<?php
class PDOObject 
{
	private $pdoObject;
	public function PDOObject ($host, $dbname, $user, $password, &$error)
	{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION ;
		try 
		{
			$this->pdoObject = new PDO ('mysql:host='.$host.';dbname='.$dbname.'', $user, $password, $pdo_options);
		}
		catch (Exception $e)
		{
			$error = "Unable to connect to database : " . $e->getMessage();
			return 0;
		} 
	}
	public function request ($query, &$error)
	{
		try
		{
			if (!strrpos($query, 'COUNT'))
			{
				$answ =  $this->pdoObject->query($query)->fetchAll();
				return $answ;
			}
			else if (strrpos($query, 'INSERT') || strrpos($query, 'UPDATE'))
			{
				$answ =  $this->pdoObject->query($query);
			}
			else
			{
				$answ =  $this->pdoObject->query($query)->fetchColumn();
				return $answ;
			}

		}
		catch(Exception $e)
	    {
	         $error = "Unable to do the query : " . $e->getMessage();
			 return 0;
	    }	
	}
}

?>