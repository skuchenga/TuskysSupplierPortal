<?php
class Calendar extends CI_Controller{

	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
	
		$data['header'] = "Dashboard";
		$data['fullname'] = $this->session->userdata('fullname');
		$data['vendor_name'] = $this->session->userdata('vendor_name');

		$this->load->view('header',$data);
		$this->load->view('navigation',$data);
		$this->load->view('calendar',$data);
		$this->load->view('footer');
	}
}
?>