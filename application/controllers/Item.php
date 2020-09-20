<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Item extends CI_Controller {
	// redirect home
	public function index()
	{
		redirect(base_url(),"refresh");
		die();
	}
	// delete
	public function delete($kodebarang = null)
	{
		if($this->session->has_userdata("loginstate") && $this->session->loginstate == "true"){
			if($this->session->has_userdata("adminmode") && $this->session->adminmode == "true"){
				$result = $this->item_m->delete($kodebarang);
				if($result === 0){
					$this->session->set_flashdata("msg","Invalid item code");
					$this->load->view("remove");
				}
				elseif($result === 1){
					$this->session->set_flashdata("msg","Cannot delete ordered item");
					$this->load->view("remove");
				}
				else{
					$this->session->set_flashdata("msgscs","Item deleted successfully");
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
	// add
	public function add()
	{
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			if(empty($this->input->post("itemname"))){
				$this->session->set_flashdata("msg","Enter item name");
				redirect(base_url("admin/items/add"),"refresh");
				die();
			}
			elseif(!preg_match("/^[a-zA-Z0-9 ]*$/",$this->input->post("itemname"))){
				$this->session->set_flashdata("msg","Invalid item name format");
				redirect(base_url("admin/items/add"),"refresh");
				die();
			}
			elseif(empty($this->input->post("category"))){
				$this->session->set_flashdata("msg","Select category");
				redirect(base_url("admin/items/add"),"refresh");
				die();
			}
			elseif(empty($this->input->post("size"))){
				$this->session->set_flashdata("msg","Select size");
				redirect(base_url("admin/items/add"),"refresh");
				die();
			}
			elseif(empty($this->input->post("itemstock"))){
				$this->session->set_flashdata("msg","Enter base stock");
				redirect(base_url("admin/items/add"),"refresh");
				die();
			}
			elseif(!preg_match("/^[0-9]*$/",$this->input->post("itemstock"))){
				$this->session->set_flashdata("msg","Invalid base stock format");
				redirect(base_url("admin/items/add"),"refresh");
				die();
			}
			elseif(empty($this->input->post("itemprice"))){
				$this->session->set_flashdata("msg","Enter item price");
				redirect(base_url("admin/items/add"),"refresh");
				die();
			}
			elseif(!preg_match("/^[0-9]*$/",$this->input->post("itemprice"))){
				$this->session->set_flashdata("msg","Invalid item price format");
				redirect(base_url("admin/items/add"),"refresh");
				die();
			}
			elseif($_FILES["itempict"]["error"] != 0){
				$this->session->set_flashdata("msg","Select item picture");
				redirect(base_url("admin/items/add"),"refresh");
				die();
			}
			elseif(empty($this->input->post("description"))){
				$this->session->set_flashdata("msg","Enter description");
				redirect(base_url("admin/items/add"),"refresh");
				die();
			}
			else{
				$kodebarang = "N" . mt_rand(1111,9999);
				$namabarang = $this->input->post("itemname");
				$stokbarang = $this->input->post("itemstock");
				$hargabarang = $this->input->post("itemprice");
				$fotobarang = $this->input->post("gen");
				$kategori = $this->input->post("category");
				$deskripsi = $this->input->post("description");
				$size = $this->input->post("size");
				$this->item_m->add($kodebarang,$namabarang,$stokbarang,$hargabarang,$fotobarang,$kategori,$deskripsi);
				$this->item_m->setkategori($kodebarang,$fotobarang);
				$this->item_m->settipe($kodebarang,$kategori);
				$this->item_m->setsize($kodebarang,$size);
				redirect(base_url("admin/items"),"refresh");
				die();
			}
		}
		else{
			redirect(base_url("admin/items"),"refresh");
			die();
		}
	}
	// edit
	public function edit()
	{
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			if(empty($this->input->post("itemname"))){
				$this->session->set_flashdata("msg","Enter item name");
				redirect(base_url("admin/items/edit"),"refresh");
				die();
			}
			elseif(!preg_match("/^[a-zA-Z0-9 ]*$/",$this->input->post("itemname"))){
				$this->session->set_flashdata("msg","Invalid item name format");
				redirect(base_url("admin/items/edit"),"refresh");
				die();
			}
			elseif(empty($this->input->post("category"))){
				$this->session->set_flashdata("msg","Select category");
				redirect(base_url("admin/items/edit"),"refresh");
				die();
			}
			elseif(empty($this->input->post("size"))){
				$this->session->set_flashdata("msg","Select size");
				redirect(base_url("admin/items/edit"),"refresh");
				die();
			}
			elseif(empty($this->input->post("itemstock"))){
				$this->session->set_flashdata("msg","Enter base stock");
				redirect(base_url("admin/items/edit"),"refresh");
				die();
			}
			elseif(!preg_match("/^[0-9]*$/",$this->input->post("itemstock"))){
				$this->session->set_flashdata("msg","Invalid base stock format");
				redirect(base_url("admin/items/edit"),"refresh");
				die();
			}
			elseif(empty($this->input->post("itemprice"))){
				$this->session->set_flashdata("msg","Enter item price");
				redirect(base_url("admin/items/edit"),"refresh");
				die();
			}
			elseif(!preg_match("/^[0-9]*$/",$this->input->post("itemprice"))){
				$this->session->set_flashdata("msg","Invalid item price format");
				redirect(base_url("admin/items/edit"),"refresh");
				die();
			}
			elseif(empty($this->input->post("description"))){
				$this->session->set_flashdata("msg","Enter description");
				redirect(base_url("admin/items/edit"),"refresh");
				die();
			}
			else{
				$kodebarang = $this->input->post("hiddenid");
				$namabarang = $this->input->post("itemname");
				$stokbarang = $this->input->post("itemstock");
				$hargabarang = $this->input->post("itemprice");
				$fotobarang = $this->input->post("gen");
				$kategori = $this->input->post("category");
				$deskripsi = $this->input->post("description");
				$size = $this->input->post("size");
				$this->item_m->edit($kodebarang,$namabarang,$stokbarang,$hargabarang,$fotobarang,$kategori,$deskripsi);
				$this->item_m->setkategori($kodebarang,$fotobarang);
				$this->item_m->settipe($kodebarang,$kategori);
				$this->item_m->setsize($kodebarang,$size);
				redirect(base_url("admin/items"),"refresh");
				die();
			}
		}
		else{
			redirect(base_url("admin/items"),"refresh");
			die();
		}
	}
}
