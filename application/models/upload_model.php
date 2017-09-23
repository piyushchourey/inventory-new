<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class  Upload_Model Extends CI_Model {

	public function upload()
	{
		$data=$this->input->post();
		$string ="";
		for($i=0;$i<sizeof($data['gaurav']);$i++)
		{
			$path="files/".$data['gaurav'][$i];
			$images=array('Address'=>$path); 
			$result=$this->db->insert('media',$images);
			$imageString = $this->db->insert_id();
			$string.= $imageString.",";
		}
		return rtrim($string,',');
	}

	public function addStore($tableName,$data)
	{
		$this->db->insert($tableName, $data);
		return $this->db->insert_id();
	}
	
	//get all store data in ajax method..
	public function getallStoreAjax()
	{
		$requestData= $_REQUEST;
		$columns = array( 
			0=> 'storeName',
			1=>'storeName',
			2=>'ownerName',
			3=>'email',
			4=>'address',
			5=>'discount'
		);
		$totalData = $this->db->get('store')->num_rows();
		
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
		$this->db->order_by($columns[$requestData['order'][0]['column']],$requestData['order'][0]['dir']); 
		$this->db->limit($requestData['length'],$requestData['start']);
		$this->db->select('store.storeName,store.ownerName,store.email,store.address,store.discount,store.id,store.status');
		$this->db->from('store');
		$array = $this->db->get()->result_array();
		$data = array();
		foreach($array as $d)
		{
			$data1 = array();
			$data1[] = ++$requestData['start'];
			$data2=array_values($d);
			$data1= array_merge($data1,$data2);
			array_push($data,$data1);
		}
		//print_r($data); die;
		$totalFiltered = $this->db->get('store')->num_rows();

		$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);
		//echo "<pre>";print_r($json_data); die;
		return $json_data;
	}

	//get all offer data in ajax method..
	public function getallOfferAjax()
	{
		$requestData= $_REQUEST;
		$columns = array( 
			0=> 'storeName',
			1=>'storeName',
			2=>'offerName',
			3=>'discount',
			4=>'coupan',
			5=>'offer_status'
		);
		$totalData = $this->db->get('offer')->num_rows();
		
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
		$this->db->order_by($columns[$requestData['order'][0]['column']],$requestData['order'][0]['dir']); 
		$this->db->limit($requestData['length'],$requestData['start']);
		$this->db->select('offer.storeName,offer.offerName,offer.discount,offer.coupan,offer.offer_status,offer.id,offer.status');
		$this->db->from('offer');
		$array = $this->db->get()->result_array();
		$data = array();
		foreach($array as $d)
		{
			$data1 = array();
			$data1[] = ++$requestData['start'];
			$data2=array_values($d);
			$data1= array_merge($data1,$data2);
			array_push($data,$data1);
		}
		//print_r($data); die;
		$totalFiltered = $this->db->get('offer')->num_rows();

		$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);
		//echo "<pre>";print_r($json_data); die;
		return $json_data;
	}

	//get all offer data in ajax method..
	public function getallDealAjax()
	{
		$requestData= $_REQUEST;
		$columns = array( 
			0=> 'category.name',
			1=>'category.name',
			2=>'store.storeName',
			3=>'deal_nm',
			4=>'point',
			5=>'discount'
		);
		$totalData = $this->db->get('deal')->num_rows();
		
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
		$this->db->order_by($columns[$requestData['order'][0]['column']],$requestData['order'][0]['dir']); 
		$this->db->limit($requestData['length'],$requestData['start']);
		$this->db->select('store.storeName as sname,category.name as cname,deal_nm,deal.point,deal.discount,deal.id');
		$this->db->from('deal');
		$this->db->join('category','deal.category_id = category.id');
		$this->db->join('store','deal.storeName = store.id');
		$array = $this->db->get()->result_array();
		$data = array();
		foreach($array as $d)
		{
			$data1 = array();
			$data1[] = ++$requestData['start'];
			$data2=array_values($d);
			$data1= array_merge($data1,$data2);
			array_push($data,$data1);
		}
		//print_r($data); die;
		$totalFiltered = $this->db->get('deal')->num_rows();

		$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);
		//echo "<pre>";print_r($json_data); die;
		return $json_data;
	}


	//delete store 
	public function deleteStore($id,$tableName)
	{
		$this->db->where('id',$id);
		$this->db->delete($tableName);
		return $this->db->affected_rows() > 0 ;
	}
	//store informatio in popup
	public function ViewStore($id)
	{
		$this->db->select('*,countries.name as cname,states.name as sname,cities.name as ctname,locality.name as lname');
		$this->db->from('store');
		$this->db->join('countries','store.country_id = countries.id');
		$this->db->join('states','store.state_id = states.id');
		$this->db->join('cities','store.city_id = cities.id');
		$this->db->join('locality','store.locality_id = locality.id');
		$this->db->where('store.id',$id);
		$result3 = $this->db->get()->result_array();
		//echo $this->db->last_query(); die;
		//echo "<pre>"; print_r($result3); die;
		$result=array();
		if(!empty($result3))
		{
			$result['store_info']=$result3[0];
			$image = $result3[0]['image_id'];
			$imageArray = explode(",", $image);
			//echo "<pre>"; print_r($imageArray); die;
			if(!empty($imageArray)){
				foreach ($imageArray  as &$value) 
				{
					$this->db->where('id',$value);
					$result1 = $this->db->select('Address')->get('media')->result_array();
					$result['image'][] = $result1[0];
				}

			}
			//echo "<pre>"; print_r($result3); die;
		}
		//print_r($result);die;
		return $result;
	}
	//offer information in popup
	public function ViewOffer($id)
	{	
		$this->db->select('*');
		$this->db->from('offer');
		$this->db->where('offer.id',$id);
		$result3 = $this->db->get()->result_array();
		//echo $this->db->last_query(); die;
		//echo "<pre>"; print_r($result3); die;
		$result=array();
		if(!empty($result3))
		{
			$result['offer_info']=$result3[0];
			$image = $result3[0]['image_id'];
			$imageArray = explode(",", $image);
			//echo "<pre>"; print_r($imageArray); die;
			if(!empty($imageArray)){
				foreach ($imageArray  as &$value) 
				{
					$this->db->where('id',$value);
					$result1 = $this->db->select('Address')->get('media')->result_array();
					$result['image'][] = $result1[0];
				}

			}
			//echo "<pre>"; print_r($result3); die;
		}
		//print_r($result);die;
		return $result;
	}

	//Deal informatio in popup
	public function ViewDeal($id)
	{
		$this->db->select('deal.*,category.name as cname,store.storeName as sname');
		$this->db->from('deal');
		$this->db->join('category','deal.category_id = category.id');
		$this->db->join('store','deal.storeName = store.id');
		$this->db->where('deal.id',$id);
		$result3 = $this->db->get()->result_array();
		//echo $this->db->last_query(); die;
		//echo "<pre>"; print_r($result3); die;
		$result=array();
		if(!empty($result3))
		{
			$result['deal_info']=$result3[0];
			$image = $result3[0]['image_id'];
			$imageArray = explode(",", $image);
			//echo "<pre>"; print_r($imageArray); die;
			if(!empty($imageArray)){
				foreach ($imageArray  as &$value) 
				{
					$this->db->where('id',$value);
					$result1 = $this->db->select('Address')->get('media')->result_array();
					$result['image'][] = $result1[0];
				}

			}
			//echo "<pre>"; print_r($result3); die;
		}
		//print_r($result);die;
		return $result;
	}
	public function approve_disapprove($id,$tableName)
	{
		$this->db->where('id',$id);
		$result = $this->db->select('status')->get($tableName)->result_array();
		$status = $result[0]['status'];
		if($status==0)
		{
			$this->db-> where('id', $id);
			$this->db->update($tableName, array('status' => 1));
			return 2;
		}
		else
		{
			$this->db-> where('id', $id);
			$this->db->update($tableName, array('status' => 0));
			return 3;
		}
	}
}
?>