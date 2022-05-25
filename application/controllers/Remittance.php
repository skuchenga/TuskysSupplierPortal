<?php
class Remittance extends CI_Controller{

	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
	
		//$from = $this->input->get('from');
		$doc = $this->input->get('doc');
		
		$data['header'] = "Remittance";
		$data['fullname'] = $this->session->userdata('fullname');
		$data['vendor_name'] = $this->session->userdata('vendor_name');
		$reportData=array('from' => $from,
						  'to' => $to);
		$this->session->set_userdata($reportData);
		
		$data['records'] = $this->Remittance_model->get_records($doc);
		$data['header'] = $doc;
		//var_dump($data);exit;
		$this->load->view('header',$data);
		$this->load->view('navigation',$data);
		$this->load->view('remittance',$data);
		$this->load->view('footer');
	}
	
	public function get_records(){
		
		$from = $this->input->get('from');
		$to = $this->input->get('to');
		
		$from = date('Y-m-d',strtotime($from))." 00:00:00";
		$to = date('Y-m-d',strtotime($to))." 00:00:00";
		
		/*$result = $this->Remittance_model->get_records();
		
		print_r($result);*/
	}
	
	function generate_pdf()
	{
		$from=$this->session->userdata('from');
		$to=$this->session->userdata('to');
		$vendor = $this->session->userdata('vendor_name');
		
		$data = $this->Remittance_model->get_records($from,$to);

		$this->load->library('cezpdf');
		 
		$this->cezpdf->ezText('Tusker Mattresses Ltd.', 12, array('justification' => 'center'));
		$this->cezpdf->ezSetDy(-10);
		 
		$this->cezpdf->ezText('Supplier Remittance', 10, array('justification' => 'center'));
		$this->cezpdf->ezSetDy(-10);

		$this->cezpdf->ezText($vendor, 10, array('justification' => 'center'));
		$this->cezpdf->ezSetDy(-20);

		if(isset($from) && isset($to)){
			$this->cezpdf->ezText('Report period '.$from.' - '.$to, 8, array('justification' => 'center'));
			$this->cezpdf->ezSetDy(-20);
		}
		 		 
		$db_data = array();
		
		for($i=0; $i < 50; $i++){
			
			$db_data[] = array('Posting Date' => $data[$i]['Posting Date'], 'Document Type' => $data[$i]['Document Type'], 'External Document No_' => $data[$i]['External Document No_'], 
					'Amount' =>  number_format($data[$i]['Amount'],2), 'Credit' =>number_format($data[$i]['Credit'],2),'Balance' => number_format($data[$i]['Amount'] + $data[$i]['Credit'],2));
			
		}
    
		$formats = array('width'=>550 ,
						 'fontSize'=>'8', 
						 'showLines'=>'1', 
						 'cols' =>array('Amount'=> array('justification'=>'right'),
									    'Credit'=> array('justification'=>'right'),
										'Balance'=>array('justification'=>'right')));
		
		$this->cezpdf->ezTable($db_data, '', '', $formats);

		$filename="Supplier Remittance_".date('d M y').".pdf";

		$this->cezpdf->ezStream(array('Content-Disposition'=>$filename));
		
		
	}
	
	public function generate_excel(){
		
		$from=$this->session->userdata('from');
		$to=$this->session->userdata('to');
		
		$query = $this->Remittance_model->get_records_query($from,$to);
		
		if(!$query)
            return false;
 
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
 
        $objPHPExcel->setActiveSheetIndex(0);
 
        // Field names in the first row
        $fields = $query->list_fields();
        $col = 0;
        foreach ($fields as $field)
        {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
            $col++;
        }
 
        // Fetching the table data
        $row = 2;
        foreach($query->result() as $data)
        {
            $col = 0;
            foreach ($fields as $field)
            {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                $col++;
            }
 
            $row++;
        }
 
        $objPHPExcel->setActiveSheetIndex(0);
 
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
 
        // Sending headers to force the user to download the file
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Supplier Remittance_'.date('d M y').'.xls"');
        header('Cache-Control: max-age=0');
 
        
	}
	

}
?>