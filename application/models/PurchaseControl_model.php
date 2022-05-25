<?php
class PurchaseControl_model extends CI_Model{
	
	public function __construct(){
		parent::__construct();
	}
	
	
	public function get_records($from, $to){
		//exit;
		$vendor = $this->session->userdata('vendor_no');
		
		if(isset($from) && isset($to)){
			
			$from = date('Y-m-d',strtotime($from))." 00:00:00";
			$to = date('Y-m-d',strtotime($to))." 23:59:59";
				$sql =  'SELECT I.[No_], 
							I.[Description],
							SUM(PRL.[Item Charge Base Amount]) AS QtyPurch,
							SUM(PRL.Quantity) AS PurchAmount,
							SUM(VE.[Sales Amount (Actual)]) AS Sales,
							SUM(VE.[Cost Amount (Actual)]) As Cost ,
							SUM(VE.[Invoiced Quantity]) AS QtySold
							FROM
							[Tusker Mattresses Ltd$Item] I JOIN
							[Tusker Mattresses Ltd$Purch_ Rcpt_ Line] PRL ON I.No_=PRL.[No_] JOIN
							[Tusker Mattresses Ltd$Value Entry] VE ON PRL.[No_] = VE.[Item No_]
							WHERE PRL.[Buy-from Vendor No_] = \''.$vendor.'\' AND
									PRL.[Posting Date] BETWEEN \''.$from.'\' AND \''.$to.'\'
							GROUP BY I.[No_], I.[Description]';
			
		}

		else{
			$from = date('Y-m-d')." 00:00:00";
			$to = date('Y-m-d')." 23:59:59";
			$sql =  'SELECT I.[No_], 
							I.[Description],
							SUM(PRL.[Item Charge Base Amount]) AS QtyPurch,
							SUM(PRL.Quantity) AS PurchAmount,
							SUM(VE.[Sales Amount (Actual)]) AS Sales,
							SUM(VE.[Cost Amount (Actual)]) As Cost ,
							SUM(VE.[Invoiced Quantity]) AS QtySold
							FROM
							[Tusker Mattresses Ltd$Item] I JOIN
							[Tusker Mattresses Ltd$Purch_ Rcpt_ Line] PRL ON I.No_=PRL.[No_] JOIN
							[Tusker Mattresses Ltd$Value Entry] VE ON PRL.[No_] = VE.[Item No_]
							WHERE PRL.[Buy-from Vendor No_] = \''.$vendor.'\' AND
									PRL.[Posting Date] BETWEEN \''.$from.'\' AND \''.$to.'\'
							GROUP BY I.[No_], I.[Description]';
		}
		//echo $sql;exit;
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
			return $query->result_array();
		
	}
	
	/*
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
	*/
}
?>