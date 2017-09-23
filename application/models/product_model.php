<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class  Product_Model Extends CI_Model {
	
	public function getLevelCategory($tableName,$level=0)
	{
		$this->db->where('parentCategory_id',$level);
		$result=$this->db->get($tableName)->result_array();
		return $result;
	}
	public function upload($tableName)
	{
		$url = base_url()."files/";
		$data=$this->input->post();
		$string ="";
		for($i=0;$i<sizeof($data['gaurav']);$i++)
		{
			$path=$url.$data['gaurav'][$i];
			$images=array('path'=>$path);  
			$result=$this->db->insert($tableName,$images);
			$imageString = $this->db->insert_id();
			$string.= $imageString.",";
		}
		return rtrim($string,',');
	}
	public function insert($tableName, $data)
	{
		$stock_arr = array("qty"=>$data['qty'],"created_date"=>ymddate($data['created_date']));
		unset($data['qty']); unset($data['created_date']);
		//insert query for product..
		$this->db->insert($tableName, $data);
		$product_id = $this->db->insert_id();

		//insert query for stock..
		$stock_arr['product_id'] = $product_id;
		$this->db->insert("stock", $stock_arr);
		return $this->db->insert_id();
	}

	//get all product data in ajax method..
	public function getallproductAjax()
	{
		$requestData= $_REQUEST;
		$columns = array( 
			0=> 'product.name',
			1=>'product.name',
			2=>'product.price',
			3=>'category.name',
			4=>'stock.qty'
		);
		$totalData = $this->db->get('product')->num_rows();
		
		$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

		if( !empty($requestData['search']['value']) )
		{  
			foreach ($columns as $c) {
				//echo $c;
				$this ->db->or_like($c,$requestData['search']['value'],'after');  
				//echo $this->db->last_query(); 
			}
		}
		//echo $requestData['order'][0]['column']."..".$requestData['order'][0]['dir']; 
		//$this->db->order_by($columns[$requestData['order'][0]['column']],$requestData['order'][0]['dir']); 
		$this->db->limit($requestData['length'],$requestData['start']);
		$this->db->select('product.name as pName,product.price,category.name as catname,SUM( stock.qty ) AS qty,product.id');
		$this->db->from('product');
		$this->db->join('category','category.id = product.category_id');
		$this->db->join('stock','stock.product_id = product.id');
		$this->db->group_by('stock.product_id');
		$array = $this->db->get()->result_array();
		//echo $this->db->last_query();  die;
		$data = array();
		foreach($array as $d)
		{
			
		$data1 = array();
			$data1[] = ++$requestData['start'];
			$data1[] ='<input type="checkbox" class="checkbox1"  value="'.$d['id'].'" id="id" name="id[]">';
			
			$data2=array_values($d);
			$data1= array_merge($data1,$data2);
			array_push($data,$data1);
		}
		//print_r($data); die;
		$totalFiltered = $this->db->get('product')->num_rows();

		$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);
		//echo "<pre>";print_r($json_data); die;
		return $json_data;
	}

	public function delete($id)
	{
		if($id!="")
		{
			$idArray = explode(",",$id);
			{
				foreach($idArray as $id)
				{
					$this->db->select('image_id');
					$this->db->from('product');
					$this->db->where('id',$id);
					$result = $this->db->get()->result();
					$image = $result[0]->image_id;
					if($image!="")
					{
						$imageArray = explode(",", $image);
						foreach ($imageArray  as $value) 
						{
							$this->db->where('id',$value);
							$this->db->delete('product_image');
						}
					}
					
					$this->db->where('id',$id);
					$this->db->delete('product');
				}
			}
		}
		return $this->db->affected_rows() > 0 ;
	}

	public function getall($tableName,$id="")
	{
		if($id!="")
		{
			$this->db->or_where('id',$id);
		}
		$result=$this->db->get($tableName)->result_array();
		return $result;
	}
	public function update($tableName,$id,$data)
	{
		$this->db-> where('id', $id);
		$this->db->update($tableName, $data);
		return $this->db->affected_rows() > 0;
	}

	public function getsearchproduct($tableName,$keyword)
	{
		$this->db->like('name', $keyword);
		$result=$this->db->get($tableName)->result_array();
		if(!empty($result))
		{
			$newarr = array();
			foreach ($result as $value) {
				$arr['id'] = $value['id'];
				$arr['label'] = $value['name'];
				$arr['value'] = $value['name'];
				array_push($newarr,$arr);
			}
			return $newarr;
		}
		else
		{
			return false;
		}
	}
	
	public function tax_insert($tableName,$data)
	{
		$this->db->insert($tableName, $data);
		return $this->db->insert_id();
	}
	public function checkCategoryExist($tableName,$category)
	{
		$this->db->where('category',$category);
		$result=$this->db->get($tableName)->result_array();
		if(!empty($result))
			return false;
		else
			return true;
	}
	
	public function delete_tax($tableName,$wherefield,$id)
	{
		$this->db->where($wherefield,$id);
		$this->db->delete($tableName);
	}
	
	public function getAll_tax($tableName)
	{
		$this->db->order_by('gst');
		$result=$this->db->get($tableName)->result_array();
		return $result;
	}
	public function getcities($tableName,$wherefield,$id)
	{
		$this->db->where($wherefield,$id);
		$result=$this->db->get($tableName)->result_array();
		return $result;
	}
}