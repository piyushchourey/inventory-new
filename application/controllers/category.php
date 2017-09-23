<?php

class Category extends CI_Controller {
	
	function __construct() 
	{
		parent::__construct();

		//$this->session_model->checkSession('admin');

		$this->load->model('category_model'); 

		$this->data = array();

	}

	public function index()
	{
		$this->data['sel']='Category';
		$this->data['result']=$this->category_model->getData('category');
		$this->data['body'] = 'admin/category_new';	
		$this->load->view('structure', $this->data);
	}
	
	public function assignSpecialCategory()
	{
		$id = $this->input->post('id');
		$type = $this->input->post('type');
		if($this->category_model->update('category',array('is_special_category' => $type),$id)){
			echo json_encode(array('msg' => 'success'));
		}else{
			echo json_encode(array('msg' => 'failed'));
		}
	}

	



	//add category page

	public function add()
	{
		$this->data['sel']='Category';
		$this->data['result']=$this->category_model->getLevelCategory('category');
		$this->data['body'] = 'admin/addCategory';	
		$this->load->view('structure', $this->data);

	}

	public function getSubcat()

	{

		$catId = $_POST['catId'];

		$data = $this->category_model->getLevelCategory('category',$catId);

		echo json_encode($data);

	}

	

	public function create()
	{
		if(!empty($_POST) && $_POST['parentCategory_id']!="" && $_POST['name']!="")
		{
			$data = $_POST;
			$last_id = $this->category_model->insert('category',$data);
			if($last_id)
			{
				$this->session->set_flashdata('success','Category Added Successfully.');
			}
			else
			{
				$this->session->set_flashdata('fail','Category Not Added Successfully.!!!');
			}
		}
		else
		{
			$this->session->set_flashdata('fail','Please Select Right Options!!!');
		}
			redirect('category/add');
	}

	

	public function delete()

	{

		$id = $_POST['id']; 

		if($id)

		{

			$data = $this->category_model->delete('category',$id);

		}

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

	

		

	public function getEditdata()

	{

		$catId = $_POST['catId']; 

		$data = $this->category_model->getcatEditdata('category',$catId);

		echo json_encode($data);

	}

	public function update()
	{
		//p($_POST);
		if(!empty($_POST))
		{
			$id = $_POST['id']; unset($_POST['id']);
			$data = $_POST;
			if($this->category_model->update('category',$data,$id))
			{
				$res = true;
			}
			else
			{
				$res = false;
			}

		}
		echo json_encode($res);

	}

	//our multi vendor query//

	

	public function getCategoryTreeForParentId($parent_id = 0) 
	{

		$categories = array();

		$this->db->where('id', $parent_id);

		$result = $this->db->get('category')->result();

			foreach ($result as $mainCategory) {

				$category = array();

				$category['id'] = $mainCategory->id;

				$category['name'] = $mainCategory->name;

				$category['parentCategory_id'] = $mainCategory->parentCategory_id;

				$category['sub_categories'] = $this->getCategoryTreeForParentId($category['parentCategory_id']);

				$categories[$mainCategory->id] = $category;

		  }

		echo "<pre>"; print_r($categories); die;

		return $categories;

	}
	
	//get all hierechical get child
	public function treeView($id)
	{
		
		$resp = $this->fetchCategoryTree($id);
		p($resp);
	}

	public function fetchCategoryTree($parent, $user_tree_array = '') 
	{
		
	  if (!is_array($user_tree_array))
		$user_tree_array = array();

		$this->db->where('parentCategory_id', $parent);
		$result = $this->db->select('id,parentCategory_id,name')->get('category')->result();
		
		foreach($result as $row) {
		  $user_tree_array[] = array("id" => $row->id, "name" => $row->name);
		  $user_tree_array = $this->fetchCategoryTree($row->id, $user_tree_array);

	  }
	  return $user_tree_array;
	}
	
	
	public function tree_View()
	{
		$new_arr = array();
		$result = $this->db->select('id,parentCategory_id')->get('category')->result_array();
		foreach($result as $r)
		{
		  $key = $r['id']; 
		  $value = $r['parentCategory_id'];
		  $new_arr[$key] = $value;
		}
		
		$tree = $this->parseTree($new_arr);
		
		p($this->printTree($tree));
		$this->data['tree_cat'] = $this->printTree($tree);
		$this->data['body'] = 'admin/treeView';	
		$this->load->view('structure', $this->data);
	}
	
	public function parseTree($tree, $root = 0)
	{
		$return = array();
		# Traverse the tree and search for direct children of the root
		foreach($tree as $child => $parent) {
			# A direct child is found
			if($parent == $root) {
				# Remove item from tree (we don't need to traverse this again)
				unset($tree[$child]);
				# Append the child into result array and parse its children
				$return[] = array(
					'name' => $child,
					'children' => $this->parseTree($tree, $child)
				);
			}
		}
		return empty($return) ? null : $return;    
	}
	
	public function printTree($tree)
	{	
		if(!is_null($tree) && count($tree) > 0) {
			echo '<ul>';
			foreach($tree as $node) {
				echo '<li>'.$this->getCatnm($node['name']);
				$this->printTree($node['children']);
				echo '</li>';
			}
			echo '</ul>';
		}
	}
	
	public function getCatnm($id)
	{
		$this->db->where('id', $id);
		$catnm_arr = $this->db->select('name')->get('category')->result_array();
		if(!empty($catnm_arr))
		{
			return $catnm_arr[0]['name'];
		}
	}

	public function transactionCheck()
	{
		$data = array("name"=>"demoCat","parentCategory_id"=>1);
		=$this->category_model->transaction_model();
		
	}
}

	





?>