<?php
class PurchaseControl extends CI_Controller{

	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
	
		$from = $this->input->get('from');
		$to = $this->input->get('to');
				
		$data['header'] = "PurchaseControl";
		$data['fullname'] = $this->session->userdata('fullname');
		$data['vendor_name'] = $this->session->userdata('vendor_name');  
		
		$reportData=array('from' => $from,
						  'to' => $to);
		$this->session->set_userdata($reportData);
		
		$data['records'] = $this->PurchaseControl_model->get_records($from,$to);
		$this->load->view('header',$data);
		$this->load->view('navigation',$data);
		$this->load->view('purchaseControl',$data);
		$this->load->view('footer');
	}
	
	public function get_records(){
		
		$result = $this->PurchaseControl_model->get_records();
		
		print_r($result);
	}
	
	function generate_pdf()
	{
		$from=$this->session->userdata('from');
		$to=$this->session->userdata('to');
		$vendor = $this->session->userdata('vendor_name');
		
		$data = $this->Sales_model->get_records($from,$to);

		$this->load->library('cezpdf');
		 
		$this->cezpdf->ezText('Tusker Mattresses Ltd.', 12, array('justification' => 'center'));
		$this->cezpdf->ezSetDy(-10);
		 
		$this->cezpdf->ezText('Product Sales Movement', 10, array('justification' => 'center'));
		$this->cezpdf->ezSetDy(-10);
		
		$this->cezpdf->ezText($vendor, 10, array('justification' => 'center'));
		$this->cezpdf->ezSetDy(-20);

		if(isset($from) && isset($to)){
			$this->cezpdf->ezText('Report period '.$from.' - '.$to, 8, array('justification' => 'center'));
			$this->cezpdf->ezSetDy(-20);
		}
		
		$y=count($data);
		
		$db_data = array();
		
		for($i=0; $i < $y; $i++){
			
			$db_data[] = array('Name' => $data[$i]['Name'], 'Category' => $data[$i]['Category'], 'Product Group' => $data[$i]['Product Group'],
			'Item Number' => $data[$i]['No_'],'Description' => $data[$i]['Description'], 
					'Quantity' =>  number_format($data[$i]['Quantity']*-1,2), 'Price' =>number_format($data[$i]['Price']*-1,2));
			
		}
		
		
    
		$formats = array('width'=>550 ,
						 'fontSize'=>'8', 
						 'showLines'=>'1', 
						 'cols' =>array('Quantity'=> array('justification'=>'right'),
									    'Price'=> array('justification'=>'right')));
		
		$this->cezpdf->ezTable($db_data, '', '', $formats);

		$filename="Product Movement_".date('d M y').".pdf";

		$this->cezpdf->ezStream(array('Content-Disposition'=>$filename));
			
		
		
	}
	
	public function generate_excel(){
		
		$from=$this->session->userdata('from');
		$to=$this->session->userdata('to');
		
		$query = $this->Sales_model->get_records_query($from,$to);
		
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
        header('Content-Disposition: attachment;filename="Product Movement_'.date('d M y').'.xls"');
        header('Cache-Control: max-age=0');
		
		$objWriter->save('php://output');
	}
	
	

}
?>