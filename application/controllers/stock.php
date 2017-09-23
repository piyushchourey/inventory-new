<?php

class Stock extends CI_Controller {

	function __construct() 
	{
		parent::__construct();
		$this->session_model->checkSession('admin');
		$this->load->model('category_model'); 
		$this->load->model('product_model'); 
		//$this->load->model('seller_model'); 
		//$this->load->model('subadmin_model'); 
		$this->load->model('stock_model');
		$this->data = array();
		$this->data['sel']='Stock';
	}
	public function index()
	{
		$this->data['result'] =$this->stock_model->getallstock('stock');
		$this->data['body'] = 'admin/stock';	
		$this->load->view('structure', $this->data);
	}
	
	//add category page
	public function add()
	{
		$this->data['result'] =$this->product_model->getall('product');
		$this->data['sel']='Stock';
		$this->data['body'] = 'admin/addStock';	
		$this->load->view('structure', $this->data);
	}
	//check username existance
	public function checkUsenameexistance()
	{
		$userName = $_POST['username'];
		if($userName!="")
		{
			if($this->subadmin_model->checkUsenameexistance('subadmin','username',$userName))
			{
				echo "false";
			}
			else
			{
				echo "true";
			}
		}
	}	
	//check email existance
	public function checkemailexistance()
	{
		$email = $_POST['email'];
		if($email!="")
		{
			if($this->subadmin_model->checkUsenameexistance('subadmin','email',$email))
			{
				echo "false";
			}
			else
			{
				echo "true";
			}
		}
	}	
	//check mobile existance
	public function checkmobileexistance()
	{
		$mobile = $_POST['mobile'];
		if($mobile!="")
		{
			if($this->subadmin_model->checkUsenameexistance('subadmin','mobile',$mobile))
			{
				echo "false";
			}
			else
			{
				echo "true";
			}
		}
	}
	//create seller
	public function create()
	{
		if(!empty($_POST))
		{
			$_POST['created_date'] = ymddate($_POST['created_date']); 
			if($this->stock_model->add('stock',$_POST))
			{
				$data = true;
			}
			else
			{
				$data = false;
			}
		}
		else
		{
				$data = false;
		}
		echo json_encode($data);
	}
	
	//edit get subadmin data
	public function edit($id="")
	{
		if($id!="")
		{
			$id = dec($id);
			$this->data['sel']='Stock';
			$this->data['result'] =$this->product_model->getall('product');
			$this->data['result1']=$this->product_model->getall('stock',$id);
			//p($this->data['result1']);
			$this->data['body'] = 'admin/editStock';	
			$this->load->view('structure', $this->data);
		}
		else
		{
			redirect('stock');
		}
	}
	
	public function update()
	{
		if(!empty($_POST) && $_POST['hidden_id']!="")
		{
			$id = $_POST['hidden_id']; unset($_POST['hidden_id']);
			$data = $this->stock_model->update('stock',$id,$_POST);
		}
		else
		{
			$data = false;
		}
		echo json_encode($data);
	}
	//delete seller
	public function deleted()
	{
		$id = $_POST['id'];
		$data = $this->subadmin_model->delete($id);
		echo json_encode($data);
	}	
	
	//approve seller
	public function approve()
	{
		$status = $_POST['status'];$id = $_POST['id'];
		$data = $this->seller_model->approve("seller",$status,$id);
		echo json_encode($data);
	}

	

	
	
	
	
	public function server()
	{
		$this->load->library('UploadHandler');
	}

	public function delete(){
		$this->load->library('UploadHandler');
	}


	public function getSubcat()
	{
		$catId = $_POST['catId']; 
		$data = $this->product_model->getLevelCategory('category',$catId);
		echo json_encode($data);
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
	
	function buildTree(array &$elements, $parentId = 0) {
		$branch = array();

		foreach ($elements as $element) {
			if ($element['parentCategory_id'] == $parentId) {
				$children = $this->buildTree($elements, $element['id']);
				if ($children) {
					$element['children'] = $children;
				}
				$branch[$element['id']] = $element;
				unset($elements[$element['id']]);
			}
		}
		return $branch;
	}
	
	public function getChild($row,$level=0)
	{
		foreach($row as &$r)
		{
			if($r['parentCategory_id'])
			{
				$this->db->where("parentCategory_id",$r['parentCategory_id']);
				$res = $this->db->get('category')->result_array();
				if(!empty($res))
				{
					foreach($res as $rs)
					{
						
					}
				}
			}
		}
		return $branch;
	}

}