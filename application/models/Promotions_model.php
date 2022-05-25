<?php
class Promotions_model extends CI_Model{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function get_records($promo){
		
		$vendor = $this->session->userdata('vendor_no');
		
		if(isset($promo)){
		
			$sql_ =  'SELECT [No_],[Description],[Standard Price Including VAT],[Discount Amount],[Offer Price Including VAT]		
					  FROM [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Offer Line] as L
					  WHERE L.[Offer No_]= \''.$promo.'\'';
			$sql =  'SELECT [Store No_],f.Name as Store, [Item No_] as ItemCode,d.Description,sum(e.[Quantity])*-1 as Quantity,
					sum([Net Amount])*-1 as NetAmount,sum([VAT Amount])*-1 as VATAmount
					FROM [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Trans_ Sales Entry] as e 
					inner join [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Item] as d
					on [Item No_]=d.No_
					inner join [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Store]as f
					on [Store No_]=f.No_
					where [Item No_] IN
					(select a.No_
					from [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Offer Line] as a 
					inner join [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Offer] as b
					on a.[Offer No_]=b.No_
					where a.[Offer No_]= \''.$promo.'\') 
					and [Date] between (select c.[Starting Date] from [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Offer] as b
					inner join [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Discount Validation Period] as c
					on b.[Disc_ Validation Period ID]=c.ID
					where b.No_= \''.$promo.'\') and (select c.[Ending Date] from [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Offer] as b
					inner join [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Discount Validation Period] as c
					on b.[Disc_ Validation Period ID]=c.ID
					where b.No_=\''.$promo.'\')  and [Promotion No_] <> \'\' 
					group by [Item No_],[Store No_],[Promotion No_],d.Description,f.Name 
					order by Quantity desc';
				  
			$query = $this->db->query($sql);

			if($query->num_rows() > 0)
				return $query->result_array();
		}
		
	}
	
	
	public function get_header($promo){
		
		$vendor = $this->session->userdata('vendor_no');
		
		if(isset($promo)){
		
			$sql =  'SELECT L.[No_],L.[Description],L.[Status],L.[Price Group],D.[Starting Date],D.[Ending Date]	
					  FROM [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Offer] as L
					  INNER JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Discount Validation Period] as D
					  ON L.[Disc_ Validation Period ID] = D.[ID]
					  WHERE L.[No_]= \''.$promo.'\'';
					  
			$query = $this->db->query($sql);

			if($query->num_rows() > 0)
				return $query->result_array();
		}
		
	}
	
	
	public function get_records_query($promo){
		
		$vendor = $this->session->userdata('vendor_no');
		
		if(isset($promo)){
			
			/* $sql_ =  'SELECT [No_],[Description],[Standard Price Including VAT],[Discount Amount],[Offer Price Including VAT]		
					  FROM [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Offer Line] as L
					  WHERE L.[Offer No_]= \''.$promo.'\''; */
			$sql =  'SELECT [Store No_],f.Name as Store, [Item No_] as ItemCode,d.Description,sum(e.[Quantity])*-1 as Quantity,
						sum([Net Amount])*-1 as NetAmount,sum([VAT Amount])*-1 as VATAmount
						FROM [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Trans_ Sales Entry] as e 
						inner join [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Item] as d
						on [Item No_]=d.No_
						inner join [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Store]as f
						on [Store No_]=f.No_
						where [Item No_] IN
						(select a.No_
						from [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Offer Line] as a 
						inner join [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Offer] as b
						on a.[Offer No_]=b.No_
						where a.[Offer No_]= \''.$promo.'\') 
						and [Date] between (select c.[Starting Date] from [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Offer] as b
						inner join [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Discount Validation Period] as c
						on b.[Disc_ Validation Period ID]=c.ID
						where b.No_= \''.$promo.'\') and (select c.[Ending Date] from [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Offer] as b
						inner join [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Discount Validation Period] as c
						on b.[Disc_ Validation Period ID]=c.ID
						where b.No_=\''.$promo.'\')  and [Promotion No_] <> \'\' 
						group by [Item No_],[Store No_],[Promotion No_],d.Description,f.Name 
						order by Quantity desc';

			$query = $this->db->query($sql);

			return $query;
		}
		
	}
}
?>