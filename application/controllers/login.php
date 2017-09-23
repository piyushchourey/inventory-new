<?php
class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('email');
		//echo $this->session->userdata('adminId'); die;
		if ($this->session->userdata('adminId')==TRUE)
			redirect('home');
			$this->data = array();
			$this->load->model('login_model'); 
			$this->load->model('admin_model'); 
			$this->data['sel']='login';
	} 
	function index()
		{
			$this->load->view('signin');
		}

	public function forgotPassword()
		{
			$uname = $_POST['username'];
			$result = $this->login_model->forgotPassword($uname);
			if(empty($result))
				{
					echo "Not Found";
				}
			else if(!empty($result))
				{
					echo "Found";
					$randomPassword = random_string('alnum', 12);
					if($result[0]['type'] == "admin")
					{
							$data = array(
								'user_pswd' => $randomPassword
								);
							$this->email->clear();
					        $this->email->from('info@appsms.in', 'App SMS');
					      	$this->email->to($result[0]['email']);
					      	$this->email->subject('Forgot Password');
					      	$this->email->message('Hello '.$result[0]['email'].' Your New Password is : '.$randomPassword);
					      	if($this->email->send())
						      	{
	      		$this->login_model->updatePanelPasswrd($uname,md5($randomPassword));
					      		}
					}
				}
		}
	
	function signIn() 
	{			
		$userId = $this->input->post('userId');
		$password = $this->input->post('password');
		$result = $this->login_model->signIn($userId,md5($password));
		
		if($this->login_model->signIn($userId,md5($password)))
		{	
			$this->session->set_userdata('adminId',$result['id']);
			$this->session->set_userdata('username',$result['uname']);
			$this->session->set_userdata('password',$result['password']);
			$this->session->set_userdata('type',$result['type']);
			
			$this->session->set_userdata('user_activity',time());       
		   redirect('home');
		}
		else
		{
			$this->session->set_flashdata('login', 'false');
			$this->session->set_flashdata('msg', 'Username Or Password is invalid.');
			redirect('/');
		}
	}
}
?>
