<?php
class Admin_model extends CI_Model{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function get_users(){		
		
		$sql ='SELECT [User ID],[Vendor No],[Fullname],[Username],[Password],[Email],[Phone],[Level],
				LevelDesc = case [Level]  WHEN 1 then \'Tuskys User\'  WHEN 2 then \'Vendor\' END 
				FROM [TuskysDB_Live].[dbo].[Supplier_Users] ORDER BY Level ASC';
						
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
			return $query->result_array();
		
	}
	
	public function get_departments(){		
		
		$sql ='SELECT [Department ID],[Department Name],[Department Email] 
				FROM [TuskysDB_Live].[dbo].[Config Departments] ORDER BY [Department Name] ASC';
						
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
			return $query->result_array();
		
	}
	
	public function get_vendors(){		
		
		$sql ='SELECT [No_],[Name] FROM [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Vendor] WHERE [No_]<>\'\' AND [Name] <> \'\' ORDER BY [Name] ASC ';
						
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
			return $query->result_array();
		
	}
	
	public function get_branches(){		
		
		$sql ='SELECT [No_],[Name] FROM [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Store] ORDER BY [Name] ASC';
						
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
			return $query->result_array();
		
	}
	
	public function get_events(){		
		
		$sql ='SELECT  C.[ID],[Start Date],[End Date],[Name],[Description],[Type]
				FROM [TuskysDB_Live].[dbo].[Marketing Calendar] AS C ORDER BY [Start Date] DESC';
						
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
			return $query->result_array();
		
	}
	
	public function get_events_c(){		
		
		$sql ='SELECT  C.[ID],[Start Date] as Startd,[End Date] as Endd ,[Name],[Description],[Type]
				FROM [TuskysDB_Live].[dbo].[Marketing Calendar] AS C ORDER BY [Start Date] DESC';
						
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
			return $query->result_array();
		
	}
	
	
	
	public function get_records_query($from, $to){
		
		$vendor = $this->session->userdata('vendor_no');
		
		if(isset($from) && isset($to)){
			
			$from = date('Y-m-d',strtotime($from))." 00:00:00";
			$to = date('Y-m-d',strtotime($to))." 00:00:00";
		
			$sql =  'SELECT D.[Posting Date],D.[Document Type],D.[Document No_],[External Document No_],D.[Amount (LCY)] AS Amount,D.[Credit Amount]	AS Credit		
					  FROM [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Detailed Vendor Ledg_ Entry] as D
					  JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Vendor Ledger Entry] as E ON E.[Entry No_]= D.[Vendor Ledger Entry No_]
					  WHERE E.[Vendor No_]='.$vendor.' AND D.[Posting Date] BETWEEN \''.$from.'\' and \''.$to.'\' AND D.[Entry Type]=1 ORDER BY D.[Posting Date],
					  [External Document No_],[Document No_] DESC';
		}
		else{
			$sql =  'SELECT D.[Posting Date],D.[Document Type],D.[Document No_],[External Document No_],D.[Amount (LCY)] AS Amount,D.[Credit Amount]	AS Credit		
					  FROM [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Detailed Vendor Ledg_ Entry] as D
					  JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Vendor Ledger Entry] as E ON E.[Entry No_]= D.[Vendor Ledger Entry No_]
					  WHERE E.[Vendor No_]='.$vendor.' AND D.[Entry Type]=1 ORDER BY D.[Posting Date],
					  [External Document No_],[Document No_] DESC';
		}
		
		$query = $this->db->query($sql);

		return $query;
		
	}
	
	public function save_user(){
		
		$data['Vendor No'] = $this->input->post("vendor");
		$data['Fullname'] = strtoupper($this->input->post("fullname"));
		$data['Email'] = $this->input->post("email");
		$data['Phone'] = $this->input->post("phone");
		$data['Username'] = $this->input->post("username");
		$data['Password'] = $this->input->post("pass");
		$data['Level'] = $this->input->post("level");
		
		$action = $this->input->post("action");
		
		if($action == 0){
			$sql = 'INSERT INTO [TuskysDB_Live].[dbo].[Supplier_Users] ("Vendor No", "Fullname", "Email","Phone","Username", "Password", "Level") 
				VALUES (?, ?, ?, ?, ?, ?, ?)';
				
			echo $sql;
		}else{
			
			$sql = 'UPDATE [TuskysDB_Live].[dbo].[Supplier_Users] SET 
			[Vendor No]=?, [Fullname]=?, Email=?,Phone=?,Username=?, Password=?, Level=? WHERE [User ID] =\''.$action.'\''	;
			
		}
					
		$query = $this->db->query($sql,$data);
		
		if($query){
			return true;
		}else{
			return false;
		}
	}
	
	public function save_dept(){
		
		$data['Department Name'] = strtoupper($this->input->post("name"));
		$data['Department Email'] = $this->input->post("email");
		
		
		$action = $this->input->post("action");
		
		if($action == 0){
			$sql = 'INSERT INTO [TuskysDB_Live].[dbo].[Config Departments] ("Department Name", "Department Email") 
				VALUES (?, ?)';
				
			
		}else{
			
			$sql = 'UPDATE [TuskysDB_Live].[dbo].[Config Departments] SET 
			[Department Name]=?, [Department Email]=? WHERE [Department ID] =\''.$action.'\''	;
			
		}
					
		$query = $this->db->query($sql,$data);
		
		if($query){
			return true;
		}else{
			return false;
		}
	}
	
	public function save_event(){
		
		$data['Start Date'] = date("Y-m-d",strtotime($this->input->post("start")));
		$data['End Date'] = date("Y-m-d",strtotime($this->input->post("end")));
		$data['Name'] = strtoupper($this->input->post("name"));
		$data['Description'] = $this->input->post("description");
		
		
		
		$action = $this->input->post("action");
		
		if($action == 0){
			$sql = 'INSERT INTO [TuskysDB_Live].[dbo].[Marketing Calendar] ("Start Date", "End Date","Name", "Description") 
				VALUES (?, ?,?, ?)';
				
			$query = $this->db->query($sql,$data);
			
			if($query){
			
				$branches = $this->input->post('branches');
				
				$branch_data['Activity ID'] = $this->db->insert_id();
				
				foreach($branches as $branch){
					$branch_data['Branch ID'] = $branch;
					
					$sql = 'INSERT INTO [TuskysDB_Live].[dbo].[Event Branches] ("Activity ID","Branch ID") 
					VALUES (?, ?)';
						
					$query = $this->db->query($sql,$branch_data);
				}
				
				return true;
			}else{
				return false;
			}
			
		}else{
			
			$sql = 'UPDATE [TuskysDB_Live].[dbo].[Marketing Calendar] SET 
			[Start Date]=?, [End Date]=?, [Name]=?, [Description]=? WHERE [ID] =\''.$action.'\''	;
			
			$query = $this->db->query($sql,$data);
			
			if($query)
				return true;
			else
				return false;
			
		}
		
		
		
		
	}
}
?>