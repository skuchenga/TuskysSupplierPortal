<?php
class Admin extends CI_Controller{

	public function __construct(){
		parent::__construct();
	}
	
	public function users(){
	
		$data['header'] = "Contact Us";
		$data['fullname'] = $this->session->userdata('fullname');
		$data['vendor_name'] = $this->session->userdata('vendor_name');
		$data['users'] = $this->Admin_model->get_users();
		$data['vendors'] = $this->Admin_model->get_vendors();

		$this->load->view('header',$data);
		$this->load->view('admin_navigation',$data);
		$this->load->view('users',$data);
		$this->load->view('footer');
	}
	
	public function departments(){
	
		$data['header'] = "Contact Us";
		$data['fullname'] = $this->session->userdata('fullname');
		$data['vendor_name'] = $this->session->userdata('vendor_name');
		$data['departments'] = $this->Admin_model->get_departments();;

		$this->load->view('header',$data);
		$this->load->view('admin_navigation',$data);
		$this->load->view('departments',$data);
		$this->load->view('footer');
	}
	
	public function calendar(){
	
		$data['header'] = "Contact Us";
		$data['fullname'] = $this->session->userdata('fullname');
		$data['vendor_name'] = $this->session->userdata('vendor_name');
		$data['branches'] = $this->Admin_model->get_branches();
		$data['records'] = $this->Admin_model->get_events();

		$this->load->view('header',$data);
		$this->load->view('admin_navigation',$data);
		$this->load->view('marketing',$data);
		$this->load->view('footer');
	}
	
	public function save_user(){
		
		$res = $this->Admin_model->save_user();
		
		if($res)
			echo "User saved successfully";
		else
			echo "User not saved";
	}
	
	public function save_dept(){
		
		$res = $this->Admin_model->save_dept();
		
		if($res)
			echo "Department saved successfully";
		else
			echo "Department not saved";
	}
	
	public function save_event(){
		
		$res = $this->Admin_model->save_event();
		
		if($res)
			echo "Event saved successfully";
		else
			echo "Event not saved";
	}
	
	public function get_events(){
		
		$data = $this->Admin_model->get_events_c();
		
		echo json_encode($data);
	}
	
}