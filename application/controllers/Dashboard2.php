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
	
		echo json_encode($res);
	}
	
	public function get_category_records(){
		
		$category = $this->input->post('category');
		$from = $this->input->post('from');
		$to = $this->input->post('to');
		$type= $this->input->post('type');
		if ($type==1)
		{
		$data['previous'] = $this->Dashboard_model->get_category_records($category,$from,$to,0);
		$data['current'] = $this->Dashboard_model->get_category_records($category,$from,$to,1);
		$data['vendor_previous'] = $this->Dashboard_model->get_vendor_category_records($category,$from,$to,0);
		$data['vendor_current'] = $this->Dashboard_model->get_vendor_category_records($category,$from,$to,1);
		}
		else
		{
		$data['previous'] = $this->Dashboard_model->get_category_records($category,$from,$to,1);
		$data['current'] = $this->Dashboard_model->get_category_records($category,$from,$to,1);
		$data['vendor_previous'] = $this->Dashboard_model->get_vendor_category_records($category,$from,$to,1);
		$data['vendor_current'] = $this->Dashboard_model->get_vendor_category_records($category,$from,$to,1);
		}
		
	
		echo json_encode($data);
	}
}
?>