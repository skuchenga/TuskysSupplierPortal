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
			
			/* $sql = 'select a.[Item No_] as ItemNo from [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Item Vendor] as a where a.[Vendor No_] = \'02870\'';
			
			$query = $this->db->query($sql);
			$returnresp=$query->result_array();*/
//var_dump($returnresp);exit;			
			//foreach ($returnresp as $row){*/
				//$itemno = $returnresp;
				//echo $itemno;exit; 
				$sql =  'SELECT [Item No_] as [No_],[Store No_] as [Name]
      ,sum([SUM$Quantity]) as [Quantity]
      ,(I.[Last Direct Cost]) as [Price],
      I.[Description] as Description,C.[Description] as Category,G.Description as [Product Group],S.Name
	FROM [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Trans_ Sales Entry$VSIFT$1] as a   
	JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Item] as I ON I.[No_] = a.[Item No_] COLLATE Latin1_General_100_CS_AS
	JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Store] as S ON a.[Store No_] = S.[No_] COLLATE Latin1_General_100_CS_AS
	JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Item Category] as C ON C.[Code] = I.[Item Category Code]
	JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Product Group] as G ON G.Code = I.[Product Group Code]
	where a.Date>=\''.$from.'\' and a.Date<=\''.$to.'\' and a.[Item No_] COLLATE Latin1_General_100_CS_AS in 
	(select a.[No_]  from [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Item] as a where a.[Vendor No_] = \''.$vendor.'\')
	group by [Store No_],[Item No_],(I.[Last Direct Cost]),I.[Description],C.[Description],G.Description,S.Name';
				/*'SELECT I.No_,[Name],I.[Division Code],I.[Item Category Code],I.[Description] as Description,C.[Description] as Category,G.Code,G.Description as [Product Group],sum(T.[Quantity]*-1) as [Quantity],sum(T.[Quantity]*-1*P.[Direct Unit Cost]) as [Price]				
					  FROM [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Trans_ Sales Entry] as T
					  JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Item] as I ON I.[No_] = T.[Item No_]
					  JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Store] as S ON T.[Store No_] = S.[No_]
					  JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Item Category] as C ON C.[Code] = I.[Item Category Code]
					  JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Product Group] as G ON G.Code = T.[Product Group Code]
					  JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Purchase Price] as P ON (P.[Item No_] = I.[No_] AND P.[Ending Date] = \'1753-01-01 00:00:00.000\')
					  WHERE I.[Vendor No_]='.$vendor.' AND T.[Date] >= \''.$from.'\' AND T.[Date]<= \''.$to.'\' and I.No_= \''.$itemno.'\'
					  GROUP BY I.No_,[Name],I.[Division Code],I.[Item Category Code],I.[Description],C.[Description],G.Code,G.Description  
					  ORDER BY [Name],I.[Division Code],I.[Description],C.[Description]' ;
			 $query = $this->db->query($sql);		  
			if($query->num_rows() > 0)
			var_dump( $query->result_array() );
				 */
			
			
		}

		else{
			$from = date('Y-m-d')." 00:00:00";
			$to = date('Y-m-d')." 23:59:59";
			$sql =  'SELECT [Item No_] as [No_],[Store No_] as [Name]
      ,sum([SUM$Quantity]) as [Quantity]
      ,(I.[Last Direct Cost]) as [Price],
      I.[Description] as Description,C.[Description] as Category,G.Description as [Product Group],S.Name
		FROM [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Trans_ Sales Entry$VSIFT$1] as a   
		JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Item] as I ON I.[No_] = a.[Item No_] COLLATE Latin1_General_100_CS_AS
		JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Store] as S ON a.[Store No_] = S.[No_] COLLATE Latin1_General_100_CS_AS
		JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Item Category] as C ON C.[Code] = I.[Item Category Code]
		JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Product Group] as G ON G.Code = I.[Product Group Code]
		where a.Date>=\''.$from.'\' and a.Date<=\''.$to.'\' and a.[Item No_] COLLATE Latin1_General_100_CS_AS in 
		(select a.[No_]  from [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Item] as a where a.[Vendor No_] = \''.$vendor.'\')
		group by [Store No_],[Item No_],(I.[Last Direct Cost]),I.[Description],C.[Description],G.Description,S.Name';
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
		
			$sql =  'SELECT [Item No_] as [No_],[Store No_] as [Name]
			  ,sum([SUM$Quantity]*-1) as [Quantity]
			  ,(I.[Last Direct Cost]) as [Price],
			  I.[Description] as Description,C.[Description] as Category,G.Description as [Product Group],S.Name
			FROM [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Trans_ Sales Entry$VSIFT$1] as a   
			JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Item] as I ON I.[No_] = a.[Item No_] COLLATE Latin1_General_100_CS_AS
			JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Store] as S ON a.[Store No_] = S.[No_] COLLATE Latin1_General_100_CS_AS
			JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Item Category] as C ON C.[Code] = I.[Item Category Code]
			JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Product Group] as G ON G.Code = I.[Product Group Code]
			where a.Date>=\''.$from.'\' and a.Date<=\''.$to.'\' and a.[Item No_] COLLATE Latin1_General_100_CS_AS in 
			(select a.[No_]  from [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Item] as a where a.[Vendor No_] = \''.$vendor.'\')
			group by [Store No_],[Item No_],(I.[Last Direct Cost]),I.[Description],C.[Description],G.Description,S.Name';
				}
				else{
					$from = date('Y-m-d')." 00:00:00";
					$to = date('Y-m-d')." 23:59:59";
					$sql =  'SELECT [Item No_] as [No_],[Store No_] as [Name]
			  ,sum([SUM$Quantity]*-1) as [Quantity]
			  ,(I.[Last Direct Cost]) as [Price],
			  I.[Description] as Description,C.[Description] as Category,G.Description as [Product Group],S.Name
		  FROM [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Trans_ Sales Entry$VSIFT$1] as a   
		  JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Item] as I ON I.[No_] = a.[Item No_] COLLATE Latin1_General_100_CS_AS
		  JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Store] as S ON a.[Store No_] = S.[No_] COLLATE Latin1_General_100_CS_AS
		  JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Item Category] as C ON C.[Code] = I.[Item Category Code]
		  JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Product Group] as G ON G.Code = I.[Product Group Code]
		  where a.Date>=\''.$from.'\' and a.Date<=\''.$to.'\' and a.[Item No_] COLLATE Latin1_General_100_CS_AS in 
		 (select a.[No_]  from [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Item] as a where a.[Vendor No_] = \''.$vendor.'\')
		 group by [Store No_],[Item No_],(I.[Last Direct Cost]),I.[Description],C.[Description],G.Description,S.Name';																											
		}
		
		$query = $this->db->query($sql);

		return $query;
		
	}
}
?>