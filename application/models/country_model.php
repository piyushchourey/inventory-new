<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class  Country_Model Extends CI_Model {

	public function add($tableName, $data)
		{
			$this->db->insert($tableName, $data);
			return $this->db->insert_id();
		}
	//get country update data 
	public function getUpdatedata($tableName,$id)
		{
			$this->db->where('id', $id);
			$result=$this->db->get($tableName)->result();
			return $result;
		}
	//get city update data 
	public function getUpdateCitydata($tableName,$id)
		{
			$this->db->where('id', $id);
			$result=$this->db->get($tableName)->result_array();
			$state_id = $result[0]['state_id'];

			$this->db->where('id', $state_id);
			$result1=$this->db->get('states')->result_array();
			$result[0]['country_id'] = $result1[0]['country_id'];

			$this->db->where('country_id', $result[0]['country_id']);
			$result2=$this->db->select('id,name')->get('states')->result_array();
			$result['state_id'] = $result2 ;
			return $result;
		}
			//get city update data 
	public function getUpdateLocalitydata($tableName,$id)
		{
			$this->db->where('id', $id);
			$result=$this->db->get($tableName)->result_array();
			$city_id = $result[0]['city_id'];

			$this->db->where('id', $city_id);
			$result1=$this->db->get('cities')->result_array();
			$result[0]['state_id'] = $result1[0]['state_id'];
			
			$this->db->where('state_id', $result[0]['state_id']);
			$result2=$this->db->select('id,name')->get('cities')->result_array();
			$result['state_id'] = $result2 ;

			$this->db->where('id',$result[0]['state_id']);
			$result3=$this->db->get('states')->result_array();
			$result[0]['country_id'] = $result3[0]['country_id'];

			$this->db->where('country_id',$result[0]['country_id']);
			$result4=$this->db->select('id,name')->get('states')->result_array();
			$result['country_id'] = $result4 ;
			
			return $result;
		}
	public function updateCountry($id,$tableName,$data)
		{
			$this->db-> where('id', $id);
			$this->db->update($tableName, $data);
		}
	public function deleteCountry($tableName,$id)
		{
			$this->db->where('id', $id);
			$this->db->delete($tableName); 
			return $this->db->affected_rows() > 0;
		}
	public function checkUsername($tableName,$uname)
		{
			$this->db->select('*');
			$this->db->from($tableName);
			$this->db->where('username', $uname);
			$query = $this->db->get();
			return $query->result_array();
		}

	public function getAllUsers()
		{
			$reseller_id = $this->session->userdata('adminId');
			$this->db->select('*');
			$this->db->from('normal_users');
			$this->db->join('panel_login','panel_login.username = normal_users.user_uname');
			$query = $this->db->get();
			return $query->result_array();
		}

	public function getAllbrand()
		{
			$this->db->where('brand', 1);
			$result=$this->db->get('category')->result();
			return $result;
		}
	public function getAllsubCategory()
		{
			$this->db->where('subcategory_id !=', 0);
			$result=$this->db->get('category')->result();
			//echo "<pre>" ; print_r($result); die;
			return $result;
		}
	public function getAjaxsubCategory($id)
		{
			$this->db->where('subcategory_id ',$id);
			$result=$this->db->get('category')->result();
			//echo "<pre>" ; print_r($result); die;
			return $result;
		}
	public function getAllregisterMember()
		{
			$this->db->select();
			$result=$this->db->get('rm_users')->result();
			return $result;
		}

	public function deleteData($table,$table_id,$id)
		{
			$this->db->where($table_id, $id);
			$this->db->delete($table); 
		}
	public function updateCategory($id,$data)
		{

			$this->db-> where('id', $id);
			$this->db->update('category', $data);
		}
	public function getSingleData($tableName,$columnName,$uname)
		{
			$this->db->select('*');
			$this->db->from($tableName);
			$this->db->where($columnName, $uname);
			$query = $this->db->get();
			return $query->result();
		}

	public function edit($tableName,$columnName,$id)
		{
			$this->db-> where($columnName, $id);
			$result=$this->db->get($tableName)->result();
			return $result;
		}
	public function getupdateCategory($tableName,$columnName,$id)
		{
			$this->db-> where($columnName, $id);
			$result=$this->db->get($tableName)->result();
			$subcategory_id = $result[0]->subcategory_id;

			$this->db-> where('id', $subcategory_id);
			$result1=$this->db->get('category')->result();
			$result[0]->catid = $result1[0]->subcategory_id;

			$this->db-> where('subcategory_id', $result[0]->catid);
			$result2=$this->db->select('id,name')->get('category')->result();
			//echo $this->db->last_query(); die;
			//print_r($result2);die;
			$result['subcategory_data'] = $result2 ;
			return $result;
		}
	//get state  data 
	public function getStateAjax($tableName,$id)
		{
			$this->db->where('country_id', $id);
			$result=$this->db->get($tableName)->result();
			return $result;
		}
	//get  city  data 
	public function getCityAjax($tableName,$id)
		{
			$this->db->where('state_id', $id);
			$result=$this->db->get($tableName)->result();
			return $result;
		}
	//get  locality  data 
	public function getLocalityAjax($tableName,$id)
		{
			$this->db->where('city_id', $id);
			$result=$this->db->get($tableName)->result();
			return $result;
		}
	//favourite update
	public function favourite($tableName,$id)
		{
			$data = array('favourite'=>1);
			$this->db->where('id', $id);
			$this->db->update($tableName, $data);
		    return ($this->db->affected_rows()>0)? TRUE:FALSE;
		}

}
?>