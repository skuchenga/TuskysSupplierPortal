<?php
class Returns_model extends CI_Model{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function get_records($from, $to){
		
		$vendor = $this->session->userdata('vendor_no');
		
		if(isset($from) && isset($to)){
			
			$from = date('Y-m-d',strtotime($from))." 00:00:00";
			$to = date('Y-m-d',strtotime($to))." 23:59:59";
		
			$sql =  'SELECT D.[No_],D.[Posting Date],[Return Reason Code],D.[Return Order No_],[Store No_],[Quantity],E.[Description],[Name],[Direct Unit Cost]	
					  FROM [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Return Shipment Header] as D
					  JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Return Shipment Line] as E ON D.[No_]= E.[Document No_]
					  JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Store] as S ON S.[No_]= D.[Store No_]
					  WHERE D.[Buy-from Vendor No_]='.$vendor.' AND D.[Posting Date] BETWEEN \''.$from.'\' and \''.$to.'\' ORDER BY D.[Posting Date]';
		}
		else{
			$from = date('Y-m-d')." 00:00:00";
			$to = date('Y-m-d')." 23:59:59";
			$sql =  'SELECT D.[No_],D.[Posting Date],[Return Reason Code],D.[Return Order No_],[Store No_],[Quantity],E.[Description],[Name],[Direct Unit Cost]	
					  FROM [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Return Shipment Header] as D
					  JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Return Shipment Line] as E ON D.[No_]= E.[Document No_]
					  JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Store] as S ON S.[No_]= D.[Store No_]
					  WHERE D.[Buy-from Vendor No_]='.$vendor.' AND D.[Posting Date] BETWEEN \''.$from.'\' and \''.$to.'\' ORDER BY D.[Posting Date]';
					  
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
		
			$sql =  'SELECT D.[No_],D.[Posting Date],[Return Reason Code],D.[Return Order No_],[Store No_],[Quantity],E.[Description],[Name]	
					  FROM [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Return Shipment Header] as D
					  JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Return Shipment Line] as E ON D.[No_]= E.[Document No_]
					  JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Store] as S ON S.[No_]= D.[Store No_]
					  WHERE D.[Buy-from Vendor No_]='.$vendor.' ORDER BY D.[Posting Date]';
		}
		else{
			$sql =  'SELECT D.[No_],D.[Posting Date],[Return Reason Code],D.[Return Order No_],[Store No_],[Quantity],E.[Description],[Name]
					  FROM [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Return Shipment Header] as D
					  JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Return Shipment Line] as E ON D.[No_]= E.[Document No_]
					  JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Store] as S ON S.[No_]= D.[Store No_]
					  WHERE D.[Buy-from Vendor No_]='.$vendor.' ORDER BY D.[Posting Date]';
					  
		}
		
		$query = $this->db->query($sql);

		return $query;
		
	}
}
?>