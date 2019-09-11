<?php

require_once('dbconfig.php');

class USER
{	

	private $conn;	
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
    
    public function getCount($sql,$rowdata){
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        while ($userRow = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $count_data = $userRow[$rowdata]; // Total Office Count
        }
		return $count_data;
        
    }
	
	/*public function register($uname,$umail,$upass)
	{
		try
		{
			$new_password = password_hash($upass, PASSWORD_DEFAULT);
			
			$stmt = $this->conn->prepare("INSERT INTO users(user_name,user_email,user_pass) 
		                                               VALUES(:uname, :umail, :upass)");
												  
			$stmt->bindparam(":uname", $uname);
			$stmt->bindparam(":umail", $umail);
			$stmt->bindparam(":upass", $new_password);										  
				
			$stmt->execute();	
			
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}*/
	
	
	public function doLogin($aname,$apass)
	{
		try
		{
			$capass=sha1($apass);
			$stmt = $this->conn->prepare("SELECT username, pwd, user_type FROM logindetails WHERE BINARY username=:aname AND BINARY pwd=:apass ");
			$stmt->execute(array(':aname'=>$aname, ':apass'=>$capass));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);		
			
				if($stmt->rowCount() == 1)
				{
					$_SESSION['admin_session'] = $userRow['username'];
					$_SESSION['admin_type'] = $userRow['user_type'];                    
					/*$_SESSION['admin_dist'] = $userRow['dist'];*/
					return true;
				}		
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function is_loggedin()
	{
		if(isset($_SESSION['admin_session']))
		{
			return true;
		}
	}
	public function redirect($url)
	{
		header("Location: $url");
	}	
	
	public function doLogout()
	{
		session_destroy();
		unset($_SESSION['admin_session']);
		unset($_SESSION['admin_type']);
        /*unset($_SESSION['admin_dist']);*/
		return true;
	}
}
?>