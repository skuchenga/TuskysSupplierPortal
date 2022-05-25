<?php
class Dashboard_model extends CI_Model{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function get_records($from){
		
		$vendor = $this->session->userdata('vendor_no');
		
		if(isset($from) && $from == 0){
		
			$sql = 'SELECT Month(T.Date),Year(T.Date) as pYear,
					(sum(T.[Quantity]*-1*P.[Direct Unit Cost])/1000) as [Sale] 
					FROM [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Trans_ Sales Entry] as T WITH (NOLOCK) 
					JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Item] as I WITH (NOLOCK) ON I.[No_] = T.[Item No_] 
					JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Purchase Price] as P WITH (NOLOCK) ON (P.[Item No_] = I.[No_] 
					AND P.[Ending Date] = \'1753-01-01 00:00:00.000\') 
					WHERE I.[Vendor No_]= '.$vendor.'  AND Year(T.[Date])=YEAR(CURRENT_TIMESTAMP) 
					GROUP BY Month(T.Date),Year(T.Date)';
  
		}
		else{
			
			$sql =  'SELECT Month(T.Date),Year(T.Date) as cYear,
					(sum(T.[Quantity]*-1*P.[Direct Unit Cost])/1000) as [Sale] 
					FROM [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Trans_ Sales Entry] as T 
					JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Item] as I ON I.[No_] = T.[Item No_] 
					JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Purchase Price] as P ON (P.[Item No_] = I.[No_] 
					AND P.[Ending Date] = \'1753-01-01 00:00:00.000\') 
					WHERE I.[Vendor No_]= '.$vendor.'  AND Year(T.[Date]) = YEAR(CURRENT_TIMESTAMP)-1
					GROUP BY MONTH([Date]),YEAR([Date])';
  
		}
		//echo $sql;exit;
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
			return $query->result();
		
	}
	
	public function get_category_records($category){
		
		//echo $from;exit;
		$vendor = $this->session->userdata('vendor_no');
		$vendor_name = $this->session->userdata('vendor_name');
		
		if(isset($category)){
				//if(isset($from) && $from == 0){
			
					$sql_ =  'SELECT YEAR([Date]) AS pYEAR,SUM([Cost Amount]*[Quantity]) Sale,Vendor=Case I.[Vendor No_] WHEN '.$vendor.' then \''.$vendor_name.'\' end 
					  FROM [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Trans_ Sales Entry] AS E
					  JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Item] AS I ON
					  I.No_ = E.[Item No_] WHERE I.[Item Category Code] = \''.$category.'\' AND YEAR([Date]) = YEAR(CURRENT_TIMESTAMP)
					  GROUP BY YEAR([Date]),I.[Vendor No_],I.[Item Category Code]';
					  
					$sql = 'SELECT TOP 10 SUM([Net Amount]*-1) Sale,I.[Vendor No_] as vnumber, 100* SUM([Net Amount]*-1) / (SUM(SUM([Net Amount]*-1)) OVER ()) "MarketShare" 
						FROM [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Trans_ Sales Entry] AS E
						JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Item] AS I ON I.No_ = E.[Item No_] 
						WHERE I.[Item Category Code] = \'FD-SNACKS\' AND ([Date]) = \'2015-10-01 00:00:00\'
						GROUP BY I.[Vendor No_],I.[Item Category Code]
						ORDER BY Sale desc';
				  
				/* }
				else{
					
					$sql_ =  'SELECT YEAR([Date]) AS pYEAR,SUM([Cost Amount]*[Quantity]) Sale,Vendor=Case I.[Vendor No_] WHEN '.$vendor.' then \''.$vendor_name.'\' end
					  FROM [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Trans_ Sales Entry] AS E
					  JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Item] AS I ON
					  I.No_ = E.[Item No_] WHERE I.[Item Category Code] =  \''.$category.'\' AND YEAR([Date]) = YEAR(CURRENT_TIMESTAMP)-1
					  GROUP BY YEAR([Date]),I.[Vendor No_],I.[Item Category Code]';
		  $sql = 'SELECT TOP 10 SUM([Net Amount]*-1) Sale,I.[Vendor No_], 100* SUM([Net Amount]*-1) / (SUM(SUM([Net Amount]*-1)) OVER ()) "MarketShare" 
						FROM [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Trans_ Sales Entry] AS E
						JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Item] AS I ON I.No_ = E.[Item No_] 
						WHERE I.[Item Category Code] = \'FD-SNACKS\' AND ([Date]) = \'2015-10-01 00:00:00\'
						GROUP BY I.[Vendor No_],I.[Item Category Code]
						ORDER BY Sale desc';
				
		} */
		}
		else
		{
			
			//if(isset($from) && $from == 0){
			
				$sql_ =  'SELECT YEAR([Date]) AS pYEAR,SUM([Cost Amount]*[Quantity]) Sale
					  FROM [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Trans_ Sales Entry] AS E
					  JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Item] AS I ON
					  I.No_ = E.[Item No_] WHERE I.[Item Category Code] = \'FD-SNACKS\' AND YEAR([Date]) = YEAR(CURRENT_TIMESTAMP)
					  GROUP BY YEAR([Date]),I.[Vendor No_],I.[Item Category Code]';
				
				$sql = 'SELECT TOP 10 SUM([Net Amount]*-1) Sale,I.[Vendor No_] as vnumber, 100* SUM([Net Amount]*-1) / (SUM(SUM([Net Amount]*-1)) OVER ()) "MarketShare" 
						FROM [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Trans_ Sales Entry] AS E
						JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Item] AS I ON I.No_ = E.[Item No_] 
						WHERE I.[Item Category Code] = \'FD-SNACKS\' AND ([Date]) = \'2015-10-01 00:00:00\'
						GROUP BY I.[Vendor No_],I.[Item Category Code]
						ORDER BY Sale desc';
			  
			/* }
			else{
				
				$sql_ =  'SELECT YEAR([Date]) AS pYEAR,SUM([Cost Amount]*[Quantity]) Sale
					  FROM [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Trans_ Sales Entry] AS E
					  JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Item] AS I ON
					  I.No_ = E.[Item No_] WHERE I.[Item Category Code] =  \'FD-SNACKS\'  AND YEAR([Date]) = YEAR(CURRENT_TIMESTAMP) - 1
					  GROUP BY YEAR([Date]),I.[Vendor No_],I.[Item Category Code]';
					  
				$sql = 'SELECT TOP 10 SUM([Net Amount]*-1) Sale,I.[Vendor No_], 100* SUM([Net Amount]*-1) / (SUM(SUM([Net Amount]*-1)) OVER ()) "MarketShare" 
						FROM [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Trans_ Sales Entry] AS E
						JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Item] AS I ON I.No_ = E.[Item No_] 
						WHERE I.[Item Category Code] = \'FD-SNACKS\' AND ([Date]) = \'2015-10-01 00:00:00\'
						GROUP BY I.[Vendor No_],I.[Item Category Code]
						ORDER BY Sale desc';	 
	  
			} */
				
		}
		
		//echo $sql;exit;
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
			return $query->result();
		
	}
	
	public function get_categories(){
		
		$sql = 'SELECT [Code],[Description] FROM [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Item Category]';
		
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
			return $query->result();
	}
	
}
?>