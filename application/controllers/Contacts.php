<?php
class Contacts extends CI_Controller{

	public function __construct(){
		parent::__construct();
	}
	
	public function index($error = null){
	
		$data['header'] = "Contact Us";
		$data['fullname'] = $this->session->userdata('fullname');
		$data['vendor_name'] = $this->session->userdata('vendor_name');
		$data['departments'] = $this->Admin_model->get_departments();
		$data['error'] = $error;

		$this->load->view('header',$data);
		$this->load->view('navigation',$data);
		$this->load->view('contacts',$data);
		$this->load->view('footer');
	}
/* 		public function send_mail($data){
		
		
		$config = Array(
		  //'protocol' => 'smtp',
		  'smtp_host' => '192.168.150.238',
		  'smtp_port' => 25,
		);
		
		$this->load->library('email', $config);

		$this->email->from('ernest.thumbi@tuskys.com', 'Tuskys Mattresses Ltd');
		$this->email->to('bramwelngayo@gmail.com');
		
		$this->email->subject('Authentication Code');
		
		$message = "Dear ".$data['Fullname'].",\n\n\n";
		$message .="You have been successfully authenticated by the system. \nUse the following security code to complete the login process.\n";
		$message .="\nAuthentication Code : ".$data['Code'];
		$message .="\n\nThank you. ";
		$message .="\n\nRegards, ";
		$message .="\nTuskys Team. ";

		$this->email->message($message);

		$this->email->print_debugger();
		if (!$this->email->send()) {
			show_error($this->email->print_debugger()); }
		else {
			return true;
		}
	} */
	public function send_mail(){
		
		$from = $this->session->userdata('email');
		$department = $this->input->post('department');
		$subject = $this->input->post('subject');
		$message = $this->input->post('message');
		
		$config = Array(
		 'protocol' => 'smtp',
		 'smtp_host' => '192.168.150.238',
		 'smtp_port' => 25,
		 'smtp_user' => 'peninah.kabura@tuskys.com', // change it to yours
		 'smtp_pass' => 'P3n1n4h02', // change it to yours
		 'mailtype' => 'html',
		 'charset' => 'iso-8859-1',
		 'wordwrap' => TRUE
	  );
		
		$this->load->library('email', $config);

		$this->email->from($from, $subject);
		$this->email->to($department);
		
		$this->email->subject($subject);

		$this->email->message($message);

		$this->email->print_debugger();
		if (!$this->email->send()) {
			show_error($this->email->print_debugger()); }
		else {
			$this->index("Email sent");
			
		}
	}
}