<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Session_Model Extends CI_Model {

	public function checkSession($type)
		{
			if ($this->session->userdata('adminId')==TRUE)
			{
			    $activity=$this->session->userdata('user_activity');
	            $max_time=600;
	            $current_time=time()-$activity;
	            if($current_time>$max_time){
	            	$this->session->unset_userdata('adminId');
	            	$this->session->set_flashdata('login', 'false');
					$this->session->set_flashdata('msg', 'Session expired!');
	                redirect('/');
	            }
	            else {
	                
	                $this->session->set_userdata('user_activity',time());
	            }
        	}
        	else
        	{
        		redirect('/');
        	}
		}

	
}
?>