<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Product extends CI_Controller {
	// all
	public function index()
	{
		redirect(base_url("product/all"));
		die();
	}
	// type and category
	public function all($kategori = null)
	{
		if($this->input->get("sort") == "date-latest"){
			$sort = "date-latest";
		}
		elseif($this->input->get("sort") == "date-oldest"){
			$sort = "date-oldest";
		}
		elseif($this->input->get("sort") == "price-highest"){
			$sort = "price-highest";
		}
		elseif($this->input->get("sort") == "price-lowest"){
			$sort = "price-lowest";
		}
		else{
			$sort = "date-latest";
		}
		if($this->input->get("type")){
			$tipe = $this->input->get("type");
		}
		else{
			$tipe = "all";
		}
		if(!empty($kategori)){
			if($tipe == "all"){
				$data["barang"] = $this->item_m->getbykategori(ucfirst($kategori),$sort);
				if(empty($data["barang"])){
					redirect(base_url("product/all"));
					die();
				}
			}
			else{
				$data["barang"] = $this->item_m->getbykategoritipe(ucfirst($kategori),ucfirst($tipe),$sort);
				if(empty($data["barang"])){
					redirect(base_url("product/all"));
					die();
				}
			}
		}
		else{
			if($tipe == "all"){
				$data["barang"] = $this->item_m->getall($sort);
			}
			else{
				$data["barang"] = $this->item_m->getalltipe(ucfirst($tipe),$sort);
				if(empty($data["barang"])){
					redirect(base_url("product/all"));
					die();
				}
			}
		}
		if($this->input->get("search")){
			$data["barang"] = $this->item_m->getsearch(ucfirst($this->input->get("search")),$sort);
		}
		$this->load->view("templates/head");
		$this->load->view("templates/nav");
		if(empty($data["barang"])){
			$this->load->view("allempty",$data);
		}
		else{
			$this->load->view("all",$data);
		}
		$this->load->view("templates/foot");
	}
	// detail
	public function detail($kodebarang = null)
	{
		if(!empty($kodebarang)){
			$result = $this->item_m->get($kodebarang);
			if($result == false){
				redirect(base_url(),"refresh");
				die();
			}
			else{
				$data["barang"] = $result;
$data["js"] = 
"$('.materialboxed').materialbox();";
			}
			$this->load->view("templates/head");
			$this->load->view("templates/nav");
			$this->load->view("detail",$data);
			$this->load->view("templates/foot");
		}
		else{
			redirect(base_url(),"refresh");
			die();
		}
	}
}
