<?php
class Sales extends CI_Controller{

	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
	
		$from = $this->input->get('from');
		$to = $this->input->get('to');
				
		$data['header'] = "Statement";
		$data['fullname'] = $this->session->userdata('fullname');
		$data['vendor_name'] = $this->session->userdata('vendor_name');
		$data['records'] = $this->Sales_model->get_records($from,$to);
		
		$this->load->view('header',$data);
		$this->load->view('navigation',$data);
		$this->load->view('sales',$data);
		$this->load->view('footer');
	}
	
	public function get_records(){
		
		$result = $this->Sales_model->get_records();
		
		print_r($result);
	}
	
	function generate_pdf()
	{
		$from = $this->input->get('from');
		$to = $this->input->get('to');
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
		 		 
		$db_data = array();
		
		for($i=0; $i < 55; $i++){
			
			$db_data[] = array('Name' => $data[$i]['Name'], 'Division Code' => $data[$i]['Division Code'], 'Description' => $data[$i]['Description'], 
					'Quantity' =>  number_format($data[$i]['Quantity'],2), 'Price' =>number_format($data[$i]['Price'],2));
			
		}
    
		$formats = array('width'=>550 ,
						 'fontSize'=>'8', 
						 'showLines'=>'1', 
						 'cols' =>array('Quantity'=> array('justification'=>'right'),
									    'Price'=> array('justification'=>'right')));
		
		$this->cezpdf->ezTable($db_data, '', '', $formats);

		$filename="Supplier Statement_".date('d M y').".pdf";

		$this->cezpdf->ezStream(array('Content-Disposition'=>$filename));
		
		
	}
	
	public function generate_excel(){
		
		$from = $this->input->get('from');
		$to = $this->input->get('to');
		
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
        header('Content-Disposition: attachment;filename="Supplier Statement_'.date('d M y').'.xls"');
        header('Cache-Control: max-age=0');
 
        $objWriter->save('php://output');
	}
	

}
?>