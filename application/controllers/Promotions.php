<?php
class Promotions extends CI_Controller{

	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
	
		$promo = strtoupper($this->input->get('promo'));
		
		$data['header'] = "Promotions";
		$data['fullname'] = $this->session->userdata('fullname');
		$data['vendor_name'] = $this->session->userdata('vendor_name');
		
		$data['records'] = $this->Promotions_model->get_records($promo);
		$data['promo_header'] = $this->Promotions_model->get_header($promo);
		
		$this->load->view('header',$data);
		$this->load->view('navigation',$data);
		$this->load->view('promotions',$data);
		$this->load->view('footer');
	}
	
	function generate_pdf()
	{
		$promo = strtoupper($this->input->get('promo'));
	
		$vendor = $this->session->userdata('vendor_name');
		
		$header = $this->Promotions_model->get_header($promo);
		
		$data = $this->Promotions_model->get_records($promo);
		
		$this->load->library('cezpdf');
		 
		$this->cezpdf->ezText('Tusker Mattresses Ltd.', 12, array('justification' => 'center'));
		$this->cezpdf->ezSetDy(-10);
		 
		$this->cezpdf->ezText('Promotions Report.', 10, array('justification' => 'center'));
		$this->cezpdf->ezSetDy(-10);
		
		$this->cezpdf->ezText($vendor, 10, array('justification' => 'center'));
		$this->cezpdf->ezSetDy(-20);
			
		$db_header[] = array('Group' => $header[0]['Price Group'], 'Promotion Code' => $header[0]['No_'], 'Description' => $data[0]['Description'], 
				'Status' =>  $header[0]['Status'], 'Start Date' =>'','End Date' => '','Days' => '');
		
		$format = array('width'=>550 ,
						 'fontSize'=>'8', 
						 'showLines'=>'0',
						);
						
		$this->cezpdf->ezTable($db_header, '', '',$format);
		
		$this->cezpdf->ezSetDy(-30);
		
		$y=count($data);
		
		$db_data = array();
				
		for($i=0; $i < $y; $i++){
		
			$db_data[] = array('Store No_' => $data[$i]['Store No_'], 'Store' => $data[$i]['Store'], 'ItemCode' => $data[$i]['ItemCode'], 'Description' => $data[$i]['Description'], 
					'Quantity' =>  number_format($data[$i]['Quantity'],2), 'NetAmount' =>number_format($data[$i]['NetAmount'],2),'VATAmount' => number_format($data[$i]['VATAmount'],2));
			
		}
    
		$formats = array('width'=>550 ,
						 'fontSize'=>'8', 
						 'showLines'=>'1', 
						 'cols' =>array('Price Including VAT'=> array('justification'=>'right'),
									    'Discount Amount'=> array('justification'=>'right'),
										'Offer Price Including VAT'=>array('justification'=>'right')));
		
		$this->cezpdf->ezTable($db_data, '', '', $formats);

		$filename="Promotion Report_".$promo."_".date('d M y').".pdf";

		$this->cezpdf->ezStream(array('Content-Disposition'=>$filename));
	
		
	}
	
	public function generate_excel(){
		
		$promo = strtoupper($this->input->get('promo'));
		
		$query = $this->Promotions_model->get_records_query($promo);
		
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
        header('Content-Disposition: attachment;filename="Promotions Data_'.$promo."_".date('d M y').'.xls"');
        header('Cache-Control: max-age=0');
		
		$objWriter->save('php://output');
       
	}
	

}
?>