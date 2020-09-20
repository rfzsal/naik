<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Category extends CI_Controller {
	// redirect home
	public function index()
	{
		redirect(base_url(),"refresh");
		die();
	}
	// edit type
	public function edit()
	{
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			if(empty($this->input->post("catname"))){
				$this->session->set_flashdata("msg","Enter category name");
				redirect(base_url("admin/categories/edit"),"refresh");
				die();
			}
			else{
				$kodetipe = $this->input->post("hidid");
				$namatipe = $this->input->post("catname");
				$this->item_m->edittipe($kodetipe,$namatipe);
				redirect(base_url("admin/categories"),"refresh");
				die();
			}
		}
		else{
			redirect(base_url("admin/categories"),"refresh");
			die();
		}
	}
	// delete type
	public function delete($kodetipe = null)
	{
		if($this->session->has_userdata("loginstate") && $this->session->loginstate == "true"){
			if($this->session->has_userdata("adminmode") && $this->session->adminmode == "true"){
				$result = $this->item_m->deletetipe($kodetipe);
				if($result == false){
					$namatipe = $this->db->select('namatipe')->from('tipe')->where('kodetipe',$kodetipe)->get()->result();
					foreach($namatipe as $nama){
						$this->session->set_flashdata("msg","{$nama->namatipe} category is being used by one or more items");
					}
					$this->load->view("remove");
				}
				else{
					$this->session->set_flashdata("msgscs","Category deleted successfully");
					$this->load->view("remove");
				}
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
	// add type
	public function add()
	{
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			if(empty($this->input->post("catname"))){
				$this->session->set_flashdata("msg","Enter category name");
				redirect(base_url("admin/categories/add"),"refresh");
				die();
			}
			elseif(!preg_match("/^[a-zA-Z]*$/",$this->input->post("catname"))){
				$this->session->set_flashdata("msg","Invalid category name format");
				redirect(base_url("admin/categories/add"),"refresh");
				die();
			}
			else{
				$namatipe = $this->input->post("catname");
				$this->item_m->newtipe($namatipe);
				redirect(base_url("admin/categories"),"refresh");
				die();
			}
		}
		else{
			redirect(base_url("admin/categories"),"refresh");
			die();
		}
	}
}
