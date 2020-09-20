<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Bank extends CI_Controller {
	// redirect home
	public function index()
	{
		redirect(base_url(),"refresh");
		die();
	}
	// edit bank
	public function edit()
	{
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			if(empty($this->input->post("uname"))){
				$this->session->set_flashdata("msg","Enter account name");
				redirect(base_url("admin/accounts/add"),"refresh");
				die();
			}
			elseif(!preg_match("/^[a-z A-Z]*$/",$this->input->post("uname"))){
				$this->session->set_flashdata("msg","Invalid account name format");
				redirect(base_url("admin/accounts/add"),"refresh");
				die();
			}
			elseif(empty($this->input->post("bankname"))){
				$this->session->set_flashdata("msg","Enter bank name");
				redirect(base_url("admin/accounts/add"),"refresh");
				die();
			}
			elseif(!preg_match("/^[a-zA-Z]*$/",$this->input->post("bankname"))){
				$this->session->set_flashdata("msg","Invalid bank name format");
				redirect(base_url("admin/accounts/add"),"refresh");
				die();
			}
			elseif(empty($this->input->post("banknum"))){
				$this->session->set_flashdata("msg","Enter account number");
				redirect(base_url("admin/accounts/add"),"refresh");
				die();
			}
			elseif(!preg_match("/^[0-9.]*$/",$this->input->post("banknum"))){
				$this->session->set_flashdata("msg","Invalid account number format");
				redirect(base_url("admin/accounts/add"),"refresh");
				die();
			}
			else{
				$this->load->model("data_m");
				$namabank = $this->input->post("bankname");
				$namabanklama = $this->input->post("hidid");
				$rekening = $this->input->post("banknum");
				$nama = $this->input->post("uname");
				$result = $this->data_m->getbankdetail($namabank);
				if($namabanklama == $namabank){
					$this->data_m->editbank($namabanklama,$rekening,$namabank,$nama);
					redirect(base_url("admin/accounts"),"refresh");
					die();
				}
				else{
					if(empty($result)){
						$this->data_m->editbank($namabanklama,$rekening,$namabank,$nama);
						redirect(base_url("admin/accounts"),"refresh");
						die();
					}
					else{
						$this->session->set_flashdata("msg","Bank name already exist");
						redirect(base_url("admin/accounts/edit/").strtolower($namabanklama),"refresh");
						die();
					}
				}
			}
		}
		else{
			redirect(base_url("admin/accounts"),"refresh");
			die();
		}
	}
	// delete bank
	public function delete($namabank = null)
	{
		if($this->session->has_userdata("loginstate") && $this->session->loginstate == "true"){
			if($this->session->has_userdata("adminmode") && $this->session->adminmode == "true"){
				$this->load->model("data_m");
				$this->data_m->deletebank($namabank);
				$this->load->view("remove");
			}
			else{
				redirect(base_url(),"refresh");
				die();
			}
		}
		else{
			redirect(base_url(),"refresh");
			die();
		}
	}
	// enable bank
	public function enable($namabank = null)
	{
		if($this->session->has_userdata("loginstate") && $this->session->loginstate == "true"){
			if($this->session->has_userdata("adminmode") && $this->session->adminmode == "true"){
				$this->load->model("data_m");
				$this->data_m->togglebank($namabank,'1');
				if(strlen($namabank) > 3){
					$namabank = ucfirst($namabank);
				}
				else{
					$namabank = strtoupper($namabank);
				}
				$this->session->set_flashdata("msgscs","{$namabank} account enabled");
				$this->load->view("add");
			}
			else{
				redirect(base_url(),"refresh");
				die();
			}
		}
		else{
			redirect(base_url(),"refresh");
			die();
		}
	}
	// disable bank
	public function disable($namabank = null)
	{
		if($this->session->has_userdata("loginstate") && $this->session->loginstate == "true"){
			if($this->session->has_userdata("adminmode") && $this->session->adminmode == "true"){
				$this->load->model("data_m");
				$this->data_m->togglebank($namabank,'0');
				if(strlen($namabank) > 3){
					$namabank = ucfirst($namabank);
				}
				else{
					$namabank = strtoupper($namabank);
				}
				$this->session->set_flashdata("msg","{$namabank} account disabled");
				$this->load->view("remove");
			}
			else{
				redirect(base_url(),"refresh");
				die();
			}
		}
		else{
			redirect(base_url(),"refresh");
			die();
		}
	}
	// add bank
	public function add()
	{
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			if(empty($this->input->post("uname"))){
				$this->session->set_flashdata("msg","Enter account name");
				redirect(base_url("admin/accounts/add"),"refresh");
				die();
			}
			elseif(!preg_match("/^[a-z A-Z]*$/",$this->input->post("uname"))){
				$this->session->set_flashdata("msg","Invalid account name format");
				redirect(base_url("admin/accounts/add"),"refresh");
				die();
			}
			elseif(empty($this->input->post("bankname"))){
				$this->session->set_flashdata("msg","Enter bank name");
				redirect(base_url("admin/accounts/add"),"refresh");
				die();
			}
			elseif(!preg_match("/^[a-zA-Z]*$/",$this->input->post("bankname"))){
				$this->session->set_flashdata("msg","Invalid bank name format");
				redirect(base_url("admin/accounts/add"),"refresh");
				die();
			}
			elseif(empty($this->input->post("banknum"))){
				$this->session->set_flashdata("msg","Enter account number");
				redirect(base_url("admin/accounts/add"),"refresh");
				die();
			}
			elseif(!preg_match("/^[0-9.]*$/",$this->input->post("banknum"))){
				$this->session->set_flashdata("msg","Invalid account number format");
				redirect(base_url("admin/accounts/add"),"refresh");
				die();
			}
			else{
				$this->load->model("data_m");
				$nama = $this->input->post("uname");
				$namabank = $this->input->post("bankname");
				$rekening = $this->input->post("banknum");
				$result = $this->data_m->getbankdetail($namabank);
				if(empty($result)){
					$this->data_m->addbank($rekening,$namabank,$nama);
					redirect(base_url("admin/accounts"),"refresh");
					die();
				}
				else{
					$this->session->set_flashdata("msg","Bank name already exist");
					redirect(base_url("admin/accounts/add"),"refresh");
					die();
				}
			}
		}
		else{
			redirect(base_url("admin/accounts"),"refresh");
			die();
		}
	}
}
