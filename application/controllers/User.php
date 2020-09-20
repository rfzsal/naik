<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller {
	// profile
	public function index()
	{
		if($this->session->has_userdata("loginstate") && $this->session->loginstate == "true"){
			if($this->session->has_userdata("adminmode") && $this->session->adminmode == "true"){
				redirect(base_url("admin"),"refresh");
				die();
			}
			else{
				$this->load->view("profile");
			}
		}
		else{
			redirect(base_url(),"refresh");
			die();
		}
	}
	// login user
	public function login()
	{
		if($this->session->has_userdata("loginstate") && $this->session->loginstate == "true"){
			redirect(base_url(),"refresh");
			die();
		}
		else{
			$this->load->model("login_m");
			$this->load->view("loginuser");
		}
	}
	// register
	public function register()
	{
		if($this->session->has_userdata("loginstate") && $this->session->loginstate == "true"){
			redirect(base_url(),"refresh");
			die();
		}
		else{
			$data["adm"] = "false";
			if($this->input->get("adm") == "true"){
				$data["adm"] = "true";
			}
			$this->load->model("register_m");
			$this->load->view("register",$data);
		}
	}
	// wishlist
	public function wishlist()
	{
		if($this->session->has_userdata("loginstate") && $this->session->loginstate == "true"){
			$this->load->view("templates/head");
			$this->load->view("templates/nav");
			$this->load->view("wishlist");
			$this->load->view("templates/foot");
		}
		else{
			redirect(base_url(),"refresh");
			die();
		}
	}
	// cart
	public function cart()
	{
		if($this->session->has_userdata("loginstate") && $this->session->loginstate == "true"){
			$result = $this->item_m->getcart();
			if(empty($result)){
				$this->load->view("templates/head");
				$this->load->view("templates/nav");
				$this->load->view("emptycart");
				$this->load->view("templates/foot");
			}
			else{
				$this->load->view("templates/head");
				$this->load->view("templates/nav");
				$this->load->view("cart");
				$this->load->view("templates/foot");
			}
		}
		else{
			redirect(base_url(),"refresh");
			die();
		}
	}
}
