<?php
class Sales_model extends CI_Model{
	
	public function __construct(){
		parent::__construct();
	}
	
	
	public function get_records($from, $to){
		//exit;
		$vendor = $this->session->userdata('vendor_no');
		
		if(isset($from) && isset($to)){
			
			$from = date('Y-m-d',strtotime($from))." 00:00:00";
			$to = date('Y-m-d',strtotime($to))." 23:59:59";
		
			$sql =  'SELECT I.No_,[Name],I.[Division Code],I.[Item Category Code],I.[Description] as Description,C.[Description] as Category,G.Code,G.Description as [Product Group],sum(T.[Quantity]*-1) as [Quantity],sum(T.[Quantity]*-1*P.[Direct Unit Cost]) as [Price]				
					  FROM [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Trans_ Sales Entry] as T
					  JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Item] as I ON I.[No_] = T.[Item No_]
					  JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Store] as S ON T.[Store No_] = S.[No_]
					  JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Item Category] as C ON C.[Code] = I.[Item Category Code]
					  JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Product Group] as G ON G.Code = T.[Product Group Code]
					  JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Purchase Price] as P ON (P.[Item No_] = I.[No_] AND P.[Ending Date] = \'1753-01-01 00:00:00.000\')
					  WHERE I.[Vendor No_]='.$vendor.' AND T.[Date] >= \''.$from.'\' AND T.[Date]<= \''.$to.'\' 
					  GROUP BY I.No_,[Name],I.[Division Code],I.[Item Category Code],I.[Description],C.[Description],G.Code,G.Description  
					  ORDER BY [Name],I.[Division Code],I.[Description],C.[Description]' ;
		}
		else{
			$from = date('Y-m-d')." 00:00:00";
			$to = date('Y-m-d')." 23:59:59";
			$sql =  'SELECT I.No_,[Name],I.[Division Code],I.[Item Category Code],I.[Description] as Description,C.[Description] as Category,G.Code,G.Description as [Product Group],sum(T.[Quantity]*-1) as [Quantity],sum(T.[Quantity]*-1*P.[Direct Unit Cost]) as [Price]				
					  FROM [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Trans_ Sales Entry] as T
					  JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Item] as I ON I.[No_] = T.[Item No_]
					  JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Store] as S ON T.[Store No_] = S.[No_]
					  JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Item Category] as C ON C.[Code] = I.[Item Category Code]
					  JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Product Group] as G ON G.Code = T.[Product Group Code]
					  JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Purchase Price] as P ON (P.[Item No_] = I.[No_] AND P.[Ending Date] = \'1753-01-01 00:00:00.000\')
					  WHERE I.[Vendor No_]='.$vendor.' AND T.[Date] >= \''.$from.'\' AND T.[Date]<= \''.$to.'\'
					  GROUP BY I.No_,[Name],I.[Division Code],I.[Item Category Code],I.[Description],C.[Description],G.Code,G.Description  
					  ORDER BY [Name],I.[Division Code],I.[Description],C.[Description]';
			//echo $from;
		}
		//echo $sql;exit;
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
			return $query->result_array();
		
	}
	
	public function get_records_query($from, $to){
		
		$vendor = $this->session->userdata('vendor_no');
		
		if(isset($from) && isset($to)){
			
			$from = date('Y-m-d',strtotime($from))." 00:00:00";
			$to = date('Y-m-d',strtotime($to))." 00:00:00";
		
			$sql =  'SELECT I.No_,[Name],I.[Division Code],I.[Item Category Code],I.[Description] as Description,C.[Description] as Category,G.Code,G.Description as [Product Group],sum(T.[Quantity]*-1) as [Quantity],sum(T.[Quantity]*-1*P.[Direct Unit Cost]) as [Price]				
					  FROM [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Trans_ Sales Entry] as T
					  JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Item] as I ON I.[No_] = T.[Item No_]
					  JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Store] as S ON T.[Store No_] = S.[No_]
					  JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Item Category] as C ON C.[Code] = I.[Item Category Code]
					  JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Product Group] as G ON G.Code = T.[Product Group Code]
					  JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Purchase Price] as P ON (P.[Item No_] = I.[No_] AND P.[Ending Date] = \'1753-01-01 00:00:00.000\')
					  WHERE I.[Vendor No_]='.$vendor.' AND T.[Date] >= \''.$from.'\' AND T.[Date]<= \''.$to.'\' 
					  GROUP BY I.No_,[Name],I.[Division Code],I.[Item Category Code],I.[Description],C.[Description],G.Code,G.Description  
					  ORDER BY [Name],I.[Division Code],I.[Description],C.[Description]';
		}
		else{
			$from = date('Y-m-d')." 00:00:00";
			$to = date('Y-m-d')." 23:59:59";
			$sql =  'SELECT I.No_,[Name],I.[Division Code],I.[Item Category Code],I.[Description] as Description,C.[Description] as Category,G.Code,G.Description as [Product Group],sum(T.[Quantity]*-1) as [Quantity],sum(T.[Quantity]*-1*P.[Direct Unit Cost]) as [Price]				
					  FROM [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Trans_ Sales Entry] as T
					  JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Item] as I ON I.[No_] = T.[Item No_]
					  JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Store] as S ON T.[Store No_] = S.[No_]
					  JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Item Category] as C ON C.[Code] = I.[Item Category Code]
					  JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Product Group] as G ON G.Code = T.[Product Group Code]
					  JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Purchase Price] as P ON (P.[Item No_] = I.[No_] AND P.[Ending Date] = \'1753-01-01 00:00:00.000\')
					  WHERE I.[Vendor No_]='.$vendor.' AND T.[Date] >= \''.$from.'\' AND T.[Date]<= \''.$to.'\' 
					  GROUP BY I.No_,[Name],I.[Division Code],I.[Item Category Code],I.[Description],C.[Description],G.Code,G.Description  
					  ORDER BY [Name],I.[Division Code],I.[Description],C.[Description]';
		}
		
		$query = $this->db->query($sql);

		return $query;
		
	}
}
?>