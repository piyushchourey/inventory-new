<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class  Stock_Model Extends CI_Model {
	
	public function getall($tableName,$id="")
	{
		$this->db->select('quantity.*, `product`.`name` as pName');
		$this->db->from($tableName);
		$this->db->join('product','product.id = quantity.product_id');
		if($id!="")
		{
			$this->db->where("id",$id);
		}
		if($this->session->userdata['type']=='seller')
		{
			$this->db->where("product.created_by",$this->session->userdata['adminId']);
		}
		$result = $this->db->get()->result_array();
		return $result;
	}
	public function add($tableName,$data)
	{
		if(!empty($data))
		{
			if($this->db->insert($tableName, $data))
			{
				return $this->db->insert_id();
			}
			else
			{
				return  false;
			}
		}
		else
		{
			return  false;
		}
	}
	//stock data
	public function getallstock($tableName,$id="")
	{
		$this->db->select('product_id,'.$tableName.'.id');
		$this->db->from($tableName);
		if($id!="")
		{
			$this->db->where("id",$id);
		}
		$this->db->group_by('product_id');
		$result = $this->db->get()->result_array();
		
		return $result;
	}
	public function update($tableName,$id,$data)
	{
		$this->db-> where('id', $id);
		$this->db->update($tableName, $data);
		return $this->db->affected_rows() > 0;
	}
	
	//get order for dashboard
	public function getOrder($current_date="",$before_days="")
	{
		$this->db->select('order.*');
		$this->db->from('order');
		//$this->db->join('product_status','product_status.id = order.delivery_status');
		if($current_date!="" && $before_days!="")
		{
			$this->db->where('order_dateTime >=', $before_days);
			$this->db->where('order_dateTime <=', $current_date);
		}
		$this->db->order_by('order_dateTime','DESC');
		$result = $this->db->get()->result_array();
		//pq();p($result);
		return $result;
	}
	public function totalAmount($current_date="",$before_days="")
	{
		$this->db->select_sum('total_amount', 'Amount');
		if($current_date!="" && $before_days!="")
		{
			$this->db->where('order_dateTime >=', $before_days);
			$this->db->where('order_dateTime <=', $current_date);
		}
		$rs = $this->db->get('order')->result();
		if(!empty($rs) && !empty($rs[0])) 
		{
			return $rs[0]->Amount;
		}
		else
		{
			return false;
		}
		
	}

	public function stotalAmount($current_date="",$before_days="")
	{
		$this->db->distinct();
		$this->db->select('order_detail.order_id');
		$this->db->where('order_detail.seller_id', $this->session->userdata('adminId'));
		$rs = $this->db->get('order_detail')->result_array();
		if(!empty($rs) && !empty($rs[0]))
		{
			$total_amount = "";
			foreach ($rs as $v) 
			{
				if($current_date!="" && $before_days!="")
				{
					$this->db->where('order_dateTime >=', $before_days);
					$this->db->where('order_dateTime <=', $current_date);
				}
				$this->db->where('order.id', $v['order_id']);
				$result = $this->db->select('total_amount')->get('order')->row_array();
				if(!empty($result))
				{
					$total_amount+=$result['total_amount'];
				}
			}
			if($total_amount) return $total_amount; else return 0;
		}
		else
		{
			return false;
		}
	}


	public function getSellerproduct()
	{
		//get produc order
		$this->db->select('order_detail.*,product.name as prdctName,order.order_dateTime,order.shipping_name,order_detail.order_id as id,order_detail.prdct_cost as order_amount,order.pay_mode');
		$this->db->from('order_detail');
		$this->db->join('order', 'order.id = order_detail.order_id');
		$this->db->join('product','order_detail.prdct_id = product.id');
		if($this->session->userdata('type')=="seller")
		{
			$this->db->where("order_detail.seller_id",$this->session->userdata('adminId'));
		}
		$this->db->order_by("order.order_dateTime",'DESC');
		$result = $this->db->get()->result_array();
		//pq();
		//echo "<pre>"; print_r($result); die;
		return $result;
	}
}
?>