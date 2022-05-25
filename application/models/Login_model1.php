<?php
class Login_model extends CI_Model{
	
	public function __construct(){
		
		parent::__construct();
	}
	
	public function authenticate($data){
		
//$db1 = $this->load->database('db1', TRUE); 
//var_dump($db1);exit;
		$sql = 'SELECT [Name],[User ID],[Vendor No],[Fullname],[Email],[Phone],[Username],[Password]
					FROM [TuskysDB_Live].[dbo].[Supplier_Users] AS U
					JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Vendor] AS V ON U.[Vendor No] = V.[No_]
					WHERE LOWER([Username]) = \''.strtolower($data['username']).'\' AND [Password] = \''.$data['password'].'\'';
		//echo $sql;exit;
		$query = $this->db->query($sql);
		if($query->num_rows() > 0)
			return $query->result_array();
		else
			return false;
	}
	
	public function generate_code($data){
	//$db1 = $this->load->database('db1', TRUE);  
		
		$sql = 'INSERT INTO [TuskysDB_Live].[dbo].[Auth Codes] ("UserId", "Auth Code", "Status") VALUES (?, ?, ?)';
					
		$query = $this->db->query($sql,$data);
		
		if($query){
			return true;
		}else{
			return false;
		}
	}
	
	
	public function authenticate_code($data){
		//$db1 = $this->load->database('db1', TRUE); 
		$sql = 'SELECT [Name],[User ID],[Vendor No],[Fullname],[Email],[Phone],[Username],[Password],[Level]
					FROM [TuskysDB_Live].[dbo].[Auth Codes] AS A
					JOIN [TuskysDB_Live].[dbo].[Supplier_Users] AS U ON U.[User ID] = A.[UserId]
					LEFT JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Vendor] AS V ON U.[Vendor No] = V.[No_]
					WHERE [Auth Code] = \''.$data['Code'].'\'';
		
		$query = $this->db->query($sql);
		
		if($query->num_rows() > 0)
			return $query->result_array();
		else
			return false;
	}
	
}
?>