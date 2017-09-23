<?php

class Product extends CI_Controller {

	function __construct() 
	{
		parent::__construct();
		$this->session_model->checkSession('admin');
		$this->load->model('category_model'); 
		$this->load->model('product_model'); 
		$this->data = array();
		$this->data['sel']='Product';
		$this->load->helper('array');
	}
	
	public function index()
	{
		//$this->data['result']=$this->category_model->getData('category');
		$this->data['body'] = 'admin/product';	
		$this->load->view('structure', $this->data);
	}	
	
	public function tax()
	{
		$this->data['sel'] = "Tax";
		$this->data['result']=$this->product_model->getall('tax');
		$this->data['body'] = 'admin/tax';	
		$this->load->view('structure', $this->data);
	}

	public function server()
	{
		$this->load->library('UploadHandler');
	}

	public function delete(){
		$this->load->library('UploadHandler');
	}
	//add category page
	public function add()
	{
		$this->data['sel']='Product';
		$this->data['result']=$this->category_model->getLevelCategory('category',0);
		$this->data['all_tax']=$this->product_model->getAll_tax('tax');
		$this->data['body'] = 'admin/addProduct';	
		$this->load->view('structure', $this->data);
	}

	public function getSubcat()
	{
		$catId = $_POST['catId']; 
		$data = $this->product_model->getLevelCategory('category',$catId);
		echo json_encode($data);
	}
	
	public function create()
	{
		if(!empty($_POST))
		{
			$data = $_POST;
			$tax_arr = gettax_values($data['tax']);
			$get_tax_detail = elements(array('gst', 'sgst', 'cgst'), $tax_arr);
			$data = $data+$get_tax_detail; unset($data['tax']);
			if($this->product_model->insert('product',$data))
			{
				$this->session->set_flashdata('status','success');
				$this->session->set_flashdata('msg', 'Product Added Successfully.');
			}
			else
			{
				$this->session->set_flashdata('status','fail');
				$this->session->set_flashdata('msg', 'Product Not Added Successfully.!!!');
			}
		}
		else
		{
				$this->session->set_flashdata('status','fail');
				$this->session->set_flashdata('msg', 'Please Select Right Options!!!');
		}

		redirect('product/add');
	}
	
	
	public function add_tax()
	{
		if(!empty($_POST))
		{
			$data = $_POST;
			if(isset($data['hidden_id']) && $data['hidden_id']!="")
			{
				$id = $data['hidden_id']; unset($data['hidden_id']);
				if($this->product_model->update('tax',$id,$data))
					$res = array("type"=>"success","msg"=>"Tax Updated Successfully!!!");
				else
					$res = array("type"=>"fail","msg"=>"Tax Not Updated Successfully!!!");
			}
			else
			{
				unset($data['hidden_id']);
				if($this->product_model->tax_insert('tax',$data))
					$res = array("type"=>"success","msg"=>"Tax Added Successfully!!!");
				else
				$res = array("type"=>"fail","msg"=>"Tax Not Added Successfully!!!");
			}
		}
		else
			$res = array("type"=>"fail","msg"=>"Please Try Again!!!");

		echo json_encode($res);
	}
	
	


	public function searching()
	{
		$catId = $_POST['categoryId'];
		if($catId)
		{
			$data = $this->category_model->searching('category',$catId);
		}
		else
		{
			$data = "false";
		}
		echo json_encode($data);
	}

	public function getallproductAjax()
	{
		$data = $this->product_model->getallproductAjax();
		echo json_encode($data);
	}
	public function deleted()
	{
		$id = $_POST['id'];
		$data = $this->product_model->delete($id);
		echo json_encode($data);
	}

	public function edit()
	{
		if($_POST['id'])
		{
			$this->data['sel']='Product';
			$data=$this->product_model->getall('product',$_POST['id']);
			//p($this->data['result']);
		}
		else
		{
			$data = false;
		}
		echo json_encode($data);
	}

	public function update()
	{
		if(!empty($_POST) && $_POST['hidden_id']!="")
		{
			$id = $_POST['hidden_id']; unset($_POST['hidden_id']);
			$data = $this->product_model->update('product',$id,$_POST);
		}
		else
		{
			$data = false;
		}
		echo json_encode($data);
	}

	public function getAll()
	{
		if($_GET['term']!="")
		{
			$data=$this->product_model->getsearchproduct('product',$_GET['term']);
			echo json_encode($data);
		}
	}
	public function getPrice()
	{
		if($_POST['pid'])
		{
			$data=$this->product_model->getall('product',$_POST['pid']);
		}
		else
		{
			$data = false;
		}
		echo json_encode($data);
	}
	
	public function getcities()
	{
		if($_POST['state_id'])
		{
			$data=$this->product_model->getcities('cities','state_id',$_POST['state_id']);
		}
		else
		{
			$data = false;
		}
		echo json_encode($data);
	}
	
	
	
	public function getAjaxproduct()
	{
		$data=$this->product_model->getall('product');
		$tax=$this->product_model->getall('tax');
		$new_arr = array('type'=>"success","product"=>$data,"tax"=>$tax);
		echo json_encode($new_arr);
	}
	public function checkCategory()
	{
		if($_POST['category']!="")
		{
			$data=$this->product_model->checkCategoryExist('tax',$_POST['category']);
			echo json_encode($data);
		}
	}
	
	public function delete_tax()
	{
		$id = $_POST['tax_id'];
		if($id)
			$data = $this->product_model->delete_tax('tax','id',$id);
		else	
			$data = false;
		echo json_encode($data);
	}
	
	public function getTax_data()
	{
		if($_POST['id'])
		{
			$data=$this->product_model->getall('tax',$_POST['id']);
			$res = array("type"=>"success","html"=>$data);
		}
		else
		{
			$res = array("type"=>"fail","msg"=>"Please Try Again!!!");
		}
		echo json_encode($res);
	}
	
	
	
}