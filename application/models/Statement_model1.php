<?php
class Statement_model extends CI_Model{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function get_records($doc){
		
		$vendor = $this->session->userdata('vendor_no');
		
		if(isset($doc)){
			
			
			$sql ='SELECT a.[Posting Date],a.[External Document No_], Document=CASE a.[Document Type] WHEN 3 THEN \'Credit Memo\'
						WHEN 2 THEN \'Invoice\' END ,a.Description,a.[Closed by Amount] FROM
						[TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Vendor Ledger Entry] as a 
						WHERE a.[Document Type] != 1 AND a.[Closed by Entry No_] in (select b.[Entry No_] FROM
						[TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Vendor Ledger Entry] as b 
						where b.[Vendor No_]='.$vendor.' and b.[Document No_]=\''.$doc.'\' ) order by a.[Document Type] desc,a.[Posting Date]';
						
			/*$sql =  'SELECT D.[Posting Date],D.[Document Type],D.[Document No_],[External Document No_],D.[Amount (LCY)] AS Amount,D.[Credit Amount]	AS Credit		
					  FROM [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Detailed Vendor Ledg_ Entry] as D
					  JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Vendor Ledger Entry] as E ON E.[Entry No_]= D.[Vendor Ledger Entry No_]
					  WHERE E.[Vendor No_]='.$vendor.' AND D.[Posting Date] BETWEEN \''.$from.'\' and \''.$to.'\' AND D.[Entry Type]=1 ORDER BY D.[Posting Date],
					  [External Document No_],[Document No_] DESC';*/
		}
		else{
			/*$sql =  'SELECT D.[Posting Date],D.[Document Type],D.[Document No_],[External Document No_],D.[Amount (LCY)] AS Amount,D.[Credit Amount]	AS Credit		
					  FROM [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Detailed Vendor Ledg_ Entry] as D
					  JOIN [TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Vendor Ledger Entry] as E ON E.[Entry No_]= D.[Vendor Ledger Entry No_]
					  WHERE E.[Vendor No_]='.$vendor.' AND D.[Entry Type]=1 ORDER BY D.[Posting Date],
					  [External Document No_],[Document No_] DESC';*/
			$sql ='SELECT a.[Posting Date],a.[External Document No_], Document=CASE a.[Document Type] WHEN 3 THEN \'Credit Memo\'
						WHEN 2 THEN \'Invoice\' END ,a.Description,a.[Closed by Amount] FROM
						[TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Vendor Ledger Entry] as a 
						WHERE a.[Document Type] != 1 AND a.[Closed by Entry No_] in (select b.[Entry No_] FROM
						[TuskysDB_Live].[dbo].[Tusker Mattresses Ltd$Vendor Ledger Entry] as b 
						where b.[Vendor No_]='.$vendor.' ) order by a.[Document Type] desc,a.[Posting Date]';
		}
		
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
}
?>