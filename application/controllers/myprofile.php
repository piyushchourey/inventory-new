<?php

class Myprofile extends CI_Controller {

	function __construct() 
	{
		parent::__construct();
		$this->session_model->checkSession('admin');
		$this->load->model('category_model');
		$this->load->model('login_model'); 
		$this->load->model('product_model'); 
		$this->data = array();
		$this->data['sel']='dashboard';
	}
	
	public function index()
	{
		$this->data['result']=$this->product_model->getall('myprofile');
		$this->data['body'] = 'admin/myprofile';	
		$this->load->view('structure', $this->data);
	}
	public function edit()
	{
		$this->data['result']=$this->product_model->getall('myprofile');
		$this->data['state']=$this->product_model->getall('states');
		$this->data['cities']=$this->product_model->getall('cities');
		$this->data['body'] = 'admin/editprofile';	
		$this->load->view('structure', $this->data);
	}
	public function update()
	{
		//p($_FILES);
		if(!empty($_FILES) && !empty($_FILES['clogo']) && $_FILES['clogo']['name']!="")
		{
			$path =  "upload";
			$imagenm = imageupload('clogo',$path);
			$_POST['logo'] = $imagenm; 
		}
		else
		{
			$_POST['logo'] = $_POST['old_path'];
			unset($_POST['old_path']); 
		}
		if($this->login_model->profileUpdate('myprofile'))
		{
			$res = true;
		}
		else
		{
			$res = false;
		}
		echo json_encode($res);
		
	}
}
?>