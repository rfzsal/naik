<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Wishlist extends CI_Controller {
	// redirect home
	public function index()
	{
		redirect(base_url(),"refresh");
		die();
	}
	// add wishlist
	public function add($kodebarang = null)
	{
		if(!empty($kodebarang)){
			if($this->session->has_userdata("loginstate") && $this->session->loginstate == "true"){
				if($this->session->has_userdata("adminmode") && $this->session->adminmode == "true"){
					$this->load->view("add");
				}
				else{
					$email = $this->session->email;
					$this->item_m->wishlist($email,$kodebarang);
					$this->load->view("add");
				}
			}
			else{
				redirect(base_url("user/login"),"refresh");
				die();
			}
		}
		else{
			redirect(base_url(),"refresh");
			die();
		}
	}
	// remove wishlist
	public function remove($kodebarang = null)
	{
		if(!empty($kodebarang)){
			if($this->session->has_userdata("loginstate") && $this->session->loginstate == "true"){
				if($this->session->has_userdata("adminmode") && $this->session->adminmode == "true"){
					$this->load->view("remove");
				}
				else{
					$email = $this->session->email;
					$this->item_m->wishlist($email,$kodebarang);
					$this->load->view("remove");
				}
			}
			else{
				redirect(base_url("user/login"),"refresh");
				die();
			}
		}
		else{
			redirect(base_url(),"refresh");
			die();
		}
	}
}
