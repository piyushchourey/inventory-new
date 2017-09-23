<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class  Billing_Model Extends CI_Model {
	
	public function insert($tableName, $data)
	{
		$this->db->insert($tableName, $data);
		return $this->db->insert_id();
	}
	//get all product data in ajax method..
	public function getallbillingAjax()
	{
		$requestData= $_REQUEST;
		$columns = array( 
			0=> 'customer_name',
			1=>'mobile_number',
			2=>'order_amount',
			3=>'order_date'
		);
		$totalData = $this->db->get('order')->num_rows();
		
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
		$this->db->select('customer_name,mobile_number,order_amount,order_date,id');
		$this->db->from('order');
		$array = $this->db->get()->result_array();
		//echo $this->db->last_query();  die;
		$data = array();
		foreach($array as $d)
		{
			
		$data1 = array();
			$data1[] = ++$requestData['start'];
			$d['customer_name'] = "<a target='_blank' href=".base_url('billing/printing')."/".inc($d['id']).">".$d['customer_name']."</a>";
			$data2=array_values($d);
			$data1= array_merge($data1,$data2);
			array_push($data,$data1);
		}
		$totalFiltered = $this->db->get('order')->num_rows();

		$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);
		//echo "<pre>";print_r($json_data); die;
		return $json_data;
	}

	public function searching($mob,$fdate,$tdate)
	{
		$cdate = date("Y-m-d");
		if($fdate!="" && $tdate=="")
		{
			$this->db->where('order_date >=', $fdate);
			$this->db->where('order_date <=', $cdate);
		}
		if($fdate!="" && $tdate!="")
		{
			$this->db->where('order_date >=', $fdate);
			$this->db->where('order_date <=', $tdate);
		}
		$this->db->where("mobile_number",$mob);
		$orders = $this->db->get('order')->result_array();
		return $orders;
	}

	public function getOrder_detail($tableName,$field_nm,$order_id)
	{
		$this->db->select('order_detail.*,product.name as pname');
		$this->db->from($tableName);
		$this->db->join('product', $tableName.'.prdct_id = product.id');
		$this->db->where($field_nm,$order_id);
		$order_detail = $this->db->get()->result_array();
		//echo $this->db->last_query();
		return $order_detail;
	}
	public function getOrder($tableName,$id="")
	{
		if($id !="")
			$this->db->where($tableName.'.id',$id);
		$order = $this->db->get($tableName)->row_array();
		return $order;
	}
}