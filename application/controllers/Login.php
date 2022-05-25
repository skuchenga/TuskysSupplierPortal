<?php
class Login extends CI_Controller{

	public function __construct(){
		parent::__construct();
	}
	
	public function index($error = ""){
		
		$data['header'] = "Login";
		$data['error_message'] = $error;
		
		$this->load->view('header',$data);
		$this->load->view('login',$data);
	}
	
	public function lockscreen($error = ""){
		
		$data['header'] = "Expired Session";
		$data['fullname'] = $this->session->userdata('fullname');
		$data['vendor_name'] = $this->session->userdata('vendor_name');
		
		$this->load->view('header',$data);
		$this->load->view('login_new',$data);
	}
	
	public function auth_code($error = ""){
		
		$data['header'] = "Authentication Code";
		$data['error_message'] = $error;
		
		$this->load->view('header',$data);
		$this->load->view('auth_code',$data);
	}
	
	public function authenticate(){
		
		$this->form_validation->set_rules('username','username', 'required|trim|xss_clean');
		$this->form_validation->set_rules('password','password', 'required|trim|xss_clean');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		
		if($this->form_validation->run() == FALSE){
			
			$this->index("");	
			
		}
		else{
			
			$data['username'] = $this->input->post('username');
			$data['password'] = $this->input->post('password');

			$res = $this->Login_model->authenticate($data);
			
			if($res != false){
				
				$user_data['UserId'] = $res[0]['User ID'];
				$user_data['Code'] = random_string('alnum', 8);
				$user_data['Status'] = 0;
				
				$result = $this->Login_model->generate_code($user_data);
				
				$user_data['Fullname'] = $res[0]['Fullname'];
				$user_data['Email'] = $res[0]['Email'];
				$user_data['Phone'] = $res[0]['Phone'];
				
				if($result){
					
					//$done = $this->send_mail($user_data);
					$done = true;
					$this->session->set_flashdata('fullname', $res[0]['Fullname']." (Authentication Code) -> ".$user_data['Code']);//
					$this->session->set_flashdata('user', $res[0]['User ID']);
					
					if($done)
						redirect('login/auth_code/','refresh');
				}
				
			}
			else{
				$error_message = 'Invalid Username or Password';
					
				$this->index($error_message);
			}
			
		}

	}
	
	public function authenticate_code(){
		
		$this->form_validation->set_rules('auth_code','authentication code', 'required|trim|xss_clean');
		
		if($this->form_validation->run() == FALSE){
			
			$this->index("");	
			
		}
		else{
			
			$data['Code'] = $this->input->post('auth_code');

			$result = $this->Login_model->authenticate_code($data);
			
			if($result != false){
				
				$session_data['user_id'] = $result[0]['User ID'];
				
				if($result[0]['Level'] == 1){
					$session_data['vendor_no'] = "";
					$session_data['vendor_name'] = "Tuskys Mattresses Ltd";
				}
				else{
					$session_data['vendor_no'] = $result[0]['Vendor No'];
					$session_data['vendor_name'] = $result[0]['Name'];
				}
				
				$session_data['fullname'] = $result[0]['Fullname'];
				$session_data['email'] = $result[0]['Email'];
				$session_data['logged_in'] = true;
								
				$this->session->set_userdata($session_data);
				
				if($result[0]['Level'] == 2)
					redirect('sales','refresh');
				else if($result[0]['Level'] == 1)
					redirect('admin/users','refresh');
				
			}
			else{
				$error_message = 'Invalid authentication code';
					
				$this->auth_code($error_message);
			}
			
		}

	}
	
	public function send_mail($data){
		
		
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
	}
	
	public function logout(){
		$array_items = array('user_id', 'vendor_no','vendor_name','fullname','logged_in');

		$this->session->unset_userdata($array_items);
		
		$this->session->sess_destroy();
		
		redirect('login','refresh');
	}
}
?>