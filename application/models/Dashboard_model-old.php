<?php
class Dashboard_model extends CI_Model{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function get_records($from){
		
		$vendor = $this->session->userdata('vendor_no');
		
		if(isset($from) && $from == 0){
		
			$sql = 'SELECT Month(T.Date),Year(T.Date) as [cYear],
					(sum(T.[Quantity]*-1*P.[Direct Unit Cost])/1000) as [Sale] 
					FROM [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Trans_ Sales Entry] as T WITH (NOLOCK) 
					JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Item] as I WITH (NOLOCK) ON I.[No_] = T.[Item No_] 
					JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Purchase Price] as P WITH (NOLOCK) ON (P.[Item No_] = I.[No_] 
					AND P.[Ending Date] = \'1753-01-01 00:00:00.000\') 
					WHERE I.[Vendor No_]= '.$vendor.'  AND Year(T.[Date])=YEAR(CURRENT_TIMESTAMP) 
					GROUP BY Month(T.Date),Year(T.Date)';
  
		}
		else{
			
			$sql =  'SELECT Month(T.Date),Year(T.Date) as [pYear],
					(sum(T.[Quantity]*-1*P.[Direct Unit Cost])/1000) as [Sale] 
					FROM [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Trans_ Sales Entry] as T 
					JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Item] as I ON I.[No_] = T.[Item No_] 
					JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Purchase Price] as P ON (P.[Item No_] = I.[No_] 
					AND P.[Ending Date] = \'1753-01-01 00:00:00.000\') 
					WHERE I.[Vendor No_]= '.$vendor.'  AND Year(T.[Date]) = YEAR(CURRENT_TIMESTAMP)-1
					GROUP BY MONTH([Date]),YEAR([Date])';
  
		}
		echo $sql;exit;
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
			return $query->result();
		
	}
	
	public function get_category_records($category,$from,$to,$period){
		/* echo $period;
		echo$category;
		echo$from;
		echo$to; *///exit;
		$vendor = $this->session->userdata('vendor_no');
		$vendor_name = $this->session->userdata('vendor_name');
		
		//if(isset($category) && isset($from) && isset($to)){
		$from = date('Y-m-d',strtotime($from))." 00:00:00";
		$to = date('Y-m-d',strtotime($to))." 23:59:59";	
				
		if($period == 0){ 
		
			$from = date('Y-m-d', strtotime($from." -1 year"));
			$to = date('Y-m-d', strtotime($to." -1 year"));
			
			$sql = 'SELECT TOP 10 SUM([Net Amount]*-1) Sale,I.[Vendor No_] as vnumber, 100* SUM([Net Amount]*-1) / (SUM(SUM([Net Amount]*-1)) OVER ()) "MarketShare" 
				FROM [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Trans_ Sales Entry] AS E
				JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Item] AS I ON I.No_ = E.[Item No_] 
				WHERE I.[Product Group Code] = \''.$category.'\' AND ([Date]) >= \''.$from.'\' AND ([Date]) <= \''.$to.'\' AND Year([Date]) = YEAR(CURRENT_TIMESTAMP)-1
				GROUP BY I.[Vendor No_],I.[Item Category Code]
				ORDER BY Sale desc';
				//echo $sql;echo $period;exit;
		}else{
			
			$sql = 'SELECT TOP 10 SUM([Net Amount]*-1) Sale,I.[Vendor No_] as vnumber, 100* SUM([Net Amount]*-1) / (SUM(SUM([Net Amount]*-1)) OVER ()) "MarketShare" 
				FROM [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Trans_ Sales Entry] AS E
				JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Item] AS I ON I.No_ = E.[Item No_] 
				WHERE I.[Product Group Code] = \''.$category.'\' AND ([Date]) >= \''.$from.'\' AND ([Date]) <= \''.$to.'\' AND Year([Date]) = YEAR(CURRENT_TIMESTAMP)
				GROUP BY I.[Vendor No_],I.[Item Category Code]
				ORDER BY Sale desc';
				//echo $sql;echo $period;exit;
		}
		
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
			return $query->result();
					
		//}

		
	}
	
	public function get_vendor_category_records($category,$from,$to,$period){
		
		$vendor = $this->session->userdata('vendor_no');
		
		//if(isset($category && isset($from) && isset($to))){
		$from = date('Y-m-d',strtotime($from))." 00:00:00";
		$to = date('Y-m-d',strtotime($to))." 23:59:59";	
				
		if($period == 0){ 
			
			$from = date('Y-m-d', strtotime($from." -1 year"));
			$to = date('Y-m-d', strtotime($to." -1 year"));
			
			$sql = 'SELECT SUM([Net Amount]*-1) Sale,I.[Vendor No_] as vnumber, 100* SUM([Net Amount]*-1) / (SUM(SUM([Net Amount]*-1)) OVER ()) "MarketShare" 
				FROM [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Trans_ Sales Entry] AS E
				JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Item] AS I ON I.No_ = E.[Item No_] 
				WHERE  E.[Product Group Code] = \''.$category.'\' AND ([Date]) >= \''.$from.'\' AND ([Date]) <= \''.$to.'\' AND Year([Date]) = YEAR(CURRENT_TIMESTAMP)-1
				GROUP BY I.[Vendor No_], E.[Product Group Code]
				ORDER BY Sale desc';
		}else{
			
			$sql = 'SELECT  SUM([Net Amount]*-1) Sale,I.[Vendor No_] as vnumber, 100* SUM([Net Amount]*-1) / (SUM(SUM([Net Amount]*-1)) OVER ()) "MarketShare" 
				FROM [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Trans_ Sales Entry] AS E
				JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Item] AS I ON I.No_ = E.[Item No_] 
				WHERE   E.[Product Group Code] = \''.$category.'\' AND ([Date]) >= \''.$from.'\' AND ([Date]) <= \''.$to.'\' AND Year([Date]) = YEAR(CURRENT_TIMESTAMP)
				GROUP BY I.[Vendor No_], E.[Product Group Code]
				ORDER BY Sale desc';
			
		}
		//echo $sql;exit;
		$query = $this->db->query($sql);

		$res = array();
		
		if($query->num_rows() > 0)
			foreach($query->result_array() as $row){
				if($row['vnumber'] == $vendor){
					$row['name'] = $this->session->userdata('vendor_name');
					return $row;
				}
					
			}
			return null;
					
		//}

		
	}
	
	public function get_categories(){
		$vendor = $this->session->userdata('vendor_no');
		$sql = 'SELECT distinct [Code],P.[Description] FROM 
[TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Product Group] as P
inner join [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Item] as I
ON P.Code = I.[Product Group Code]
where I.[Vendor No_]=\''.$vendor.'\'
ORDER BY [Description] ASC';
		
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
			return $query->result();
	}
	
}
?>