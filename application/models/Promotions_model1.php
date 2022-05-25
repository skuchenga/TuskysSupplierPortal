<?php
class Promotions_model extends CI_Model{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function get_records($promo){
		
		$vendor = $this->session->userdata('vendor_no');
		
		if(isset($promo)){
		
			$sql =  'SELECT [No_],[Description],[Standard Price Including VAT],[Discount Amount],[Offer Price Including VAT]		
					  FROM [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Offer Line] as L
					  WHERE L.[Offer No_]= \''.$promo.'\'';
					  
			$query = $this->db->query($sql);

			if($query->num_rows() > 0)
				return $query->result_array();
		}
		
	}
	
	
	public function get_header($promo){
		
		$vendor = $this->session->userdata('vendor_no');
		
		if(isset($promo)){
		
			$sql =  'SELECT [No_],[Description],[Status],[Price Group]		
					  FROM [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Offer] as L
					  WHERE L.[No_]= \''.$promo.'\'';
					  
			$query = $this->db->query($sql);

			if($query->num_rows() > 0)
				return $query->result_array();
		}
		
	}
	
	
	public function get_records_query($promo){
		
		$vendor = $this->session->userdata('vendor_no');
		
		if(isset($promo)){
			
			$sql =  'SELECT [No_],[Description],[Standard Price Including VAT],[Discount Amount],[Offer Price Including VAT]		
					  FROM [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Offer Line] as L
					  WHERE L.[Offer No_]= \''.$promo.'\'';
			$query = $this->db->query($sql);

			return $query;
		}
		
	}
}
?>