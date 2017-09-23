<?php

class Billing extends CI_Controller {

	function __construct() 
	{
		parent::__construct();
		$this->session_model->checkSession('admin');
		$this->load->model('category_model'); 
		$this->load->model('product_model'); 
		$this->load->model('billing_model'); 
		$this->data = array();
		$this->data['sel']='Billing';
	}
	
	public function index()
	{
		//$this->data['result']=$this->category_model->getData('category');
		$this->data['body'] = 'admin/billing';	
		$this->load->view('structure', $this->data);
	}

	public function add()
	{
		$this->data['sel'] = "Billing Records";
		$this->data['result']=$this->product_model->getAll('product');
		$this->data['all_tax']=$this->product_model->getAll_tax('tax');
		$this->data['body'] = 'admin/addbilling';	
		$this->load->view('structure', $this->data);
	}

	public function done()
	{
		if(!empty($_POST))
		{
			if(!empty($_POST['total_price']))
			{
				$order_amount =0;
				foreach ($_POST['total_price'] as $p) {
					$order_amount = $order_amount+$p;
				}
				$order_arr = array("customer_name"=>$_POST['customer_name'],"mobile_number"=>$_POST['mobile_number'],"order_amount"=>$order_amount,"order_date"=>date("y-m-d"));

				$order_id = $this->billing_model->insert('order',$order_arr);
				if($order_id)
				{
					if(!empty($_POST['product_id']))
					{
						for($i=0; $i<count($_POST['product_id']);$i++)
						{
							$gst_detail = gettax_values($_POST['gst'][0]);
							$order_detail_arr['order_id'] =  $order_id;
							$order_detail_arr['prdct_id'] =  $_POST['product_id'][$i];
							$order_detail_arr['prdct_qty'] =  $_POST['qty'][$i];
							$order_detail_arr['prdct_price'] =  $_POST['price'][$i];
							
							$order_detail_arr['gst'] =  $_POST['gst'][$i];
							if(!empty($gst_detail))
							{
								$order_detail_arr['sgst'] =  $gst_detail['sgst'];
								$order_detail_arr['cgst'] =  $gst_detail['cgst'];
							}
	
							$order_detail_id = $this->billing_model->insert('order_detail',$order_detail_arr);
						}
						if($order_detail_id)
						{
							$this->session->set_flashdata('status','success');
							$this->session->set_flashdata('msg', 'Bill Genrate Successfully.');
							redirect('billing/printing/'.inc($order_id));
						}
						else
						{
							$this->session->set_flashdata('status','fail');
							$this->session->set_flashdata('msg', 'Bill Not Genrate Successfully.');
						}
					}
					else
					{
						$this->session->set_flashdata('status','fail');
						$this->session->set_flashdata('msg', 'Please Try Again!!.');
					}
				}
				else
				{
					$this->session->set_flashdata('status','fail');
					$this->session->set_flashdata('msg', 'Please Try Again!!.');
				}
			}
		}
		else
		{
			$this->session->set_flashdata('status','fail');
			$this->session->set_flashdata('msg', 'Please Try Again!!.');
		}

		redirect('billing/add');
	}

	public function getallbillingAjax()
	{
		$data = $this->billing_model->getallbillingAjax();
		echo json_encode($data);
	}

	public function searching()
	{
		if(!empty($_POST) && $_POST['mob_number']!="")
		{
			$res = $this->billing_model->searching($_POST['mob_number'],$_POST['f_date'],$_POST['to_date']);
		}
		else
		{
			$res = false;
		}
		echo json_encode($res);
	}

	public function printing($order_id)
	{
		if($order_id)
		{
			$order_id = dec($order_id);
			$this->data['order_detail'] = $this->billing_model->getOrder_detail('order_detail','order_id',$order_id);
			$this->data['order'] = $this->billing_model->getOrder('order',$order_id);
			$this->data['myprofile'] = $this->billing_model->getOrder('myprofile');
			//p($this->data['myprofile']);
			$this->load->view('admin/billprint', $this->data);
		}
		else
		{
			redirect('billing');
		}
	}
	public function printings($order_id)
	{
		if($order_id)
		{
			$this->data['order_detail'] = $this->billing_model->getOrder_detail('order_detail','order_id',$order_id);
			$this->data['order'] = $this->billing_model->getOrder('order',$order_id);
			$this->data['myprofile'] = $this->billing_model->getOrder('myprofile');
			//p($this->data['myprofile']);
			$this->load->view('admin/billprint', $this->data);
		}
		else
		{
			redirect('billing');
		}
	}
}
?>