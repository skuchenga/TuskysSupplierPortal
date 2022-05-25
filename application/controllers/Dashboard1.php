<?php
class Dashboard extends CI_Controller{

	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
	
		$data['header'] = "Dashboard";
		$data['fullname'] = $this->session->userdata('fullname');
		$data['vendor_name'] = $this->session->userdata('vendor_name');
		$data['previous'] = $this->Dashboard_model->get_records(1);
		$data['current'] = $this->Dashboard_model->get_records(0);

		$this->load->view('header',$data);
		$this->load->view('navigation',$data);
		$this->load->view('dashboard',$data);
		$this->load->view('footer');
	}
	
	public function departments(){
	
		$data['header'] = "Dashboard";
		$data['fullname'] = $this->session->userdata('fullname');
		$data['vendor_name'] = $this->session->userdata('vendor_name');
		$data['previous'] = $this->Dashboard_model->get_records(1);
		$data['current'] = $this->Dashboard_model->get_records(0);

		$this->load->view('header',$data);
		$this->load->view('navigation',$data);
		$this->load->view('departmental',$data);
		$this->load->view('footer');
	}
	
	public function categories(){
	
		$data['header'] = "Category Analysis";
		$data['fullname'] = $this->session->userdata('fullname');
		$data['vendor_name'] = $this->session->userdata('vendor_name');		
		$data['categories'] = $this->Dashboard_model->get_categories();
		
		$this->load->view('header',$data);
		$this->load->view('navigation',$data);
		$this->load->view('category',$data);
		$this->load->view('footer');
		
	}
	
	public function get_records(){
		
		$res['previous'] = $this->Dashboard_model->get_records(1);
		$res['current'] = $this->Dashboard_model->get_records(0);
	//var_dump($res);exit;
		echo json_encode($res);
	}
	
	public function get_category_records(){
		
		$category = $this->input->post('category');
		//var_dump($category);exit;

		$data['previous'] = $this->Dashboard_model->get_category_records($category);
	$data['vendor'] = ["vendorname"=>$this->session->userdata('vendor_name'),"vendorno"=>$this->session->userdata('vendor_no')];
		//$data['current'] = $this->Dashboard_model->get_category_records(0,$category);
	
		echo json_encode($data);
	}
}
?>