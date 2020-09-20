<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Order extends CI_Controller {
	// redirect home
	public function index()
	{
		redirect(base_url("order/list"),"refresh");
		die();
	}
	// cancel order
	public function cancel($kodepesanan = null)
	{
		if($this->session->has_userdata("loginstate") && $this->session->loginstate == "true"){
			if(!empty($kodepesanan)){
				$result = $this->item_m->getorderdetail($kodepesanan);
				if(!empty($result)){
					foreach($result as $row){
						$statuspesanan = $row->status;
						if($row->status == "1"){
							$status = "6";
							if($this->session->has_userdata("adminmode") && $this->session->adminmode == "true"){
								$this->load->view("cancel");
							}
							else{
								$this->item_m->updateorder($kodepesanan,$status);
								$this->load->view("cancel");
							}
						}
						elseif($statuspesanan == "2"){
							$status = "6";
							if($this->session->has_userdata("adminmode") && $this->session->adminmode == "true"){
								$this->item_m->updateorder($kodepesanan,$status);
								$this->load->view("cancel");
							}
							else{
								$this->load->view("cancel");
							}
						}
						elseif($statuspesanan == "3"){
							$status = "6";
							if($this->session->has_userdata("adminmode") && $this->session->adminmode == "true"){
								$this->load->model("order_m");
								$this->item_m->updateorder($kodepesanan,$status);
								$this->order_m->cancel($kodepesanan);
								$this->load->view("cancel");
							}
							else{
								$this->load->view("cancel");
							}
						}
						else{
							$this->load->view("cancel");
						}
					}
				}
				else{
					$this->load->view("cancel");
				}
			}
			else{
				$this->load->view("cancel");
			}
		}
		else{
			redirect(base_url("user/login"),"refresh");
			die();
		}
	}
	// confirm order
	public function confirm($kodepesanan = null)
	{
		if($this->session->has_userdata("loginstate") && $this->session->loginstate == "true"){
			if(!empty($kodepesanan)){
				$result = $this->item_m->getorderdetail($kodepesanan);
				if(!empty($result)){
					foreach($result as $row){
						if($row->status == "1"){
							if($this->session->has_userdata("adminmode") && $this->session->adminmode == "true"){
								$this->load->view("confirm");
							}
							else{
								$status = "2";
								$this->item_m->updateorder($kodepesanan,$status);
								$this->load->view("confirm");
							}
						}
						elseif($row->status == "2"){
							if($this->session->has_userdata("adminmode") && $this->session->adminmode == "true"){
								$status = "3";
								$this->item_m->updateorder($kodepesanan,$status);
								$this->load->view("confirm");
							}
							else{
								$this->load->view("confirm");
							}
						}
						elseif($row->status == "3"){
							if($this->session->has_userdata("adminmode") && $this->session->adminmode == "true"){
								if($_SERVER["REQUEST_METHOD"] == "POST"){
									if(!empty($this->input->post("resi"))){
										$status = "4";
										$koderesi = $this->input->post("resi");
										$this->item_m->updateorder($kodepesanan,$status);
										$this->item_m->updateresi($kodepesanan,$koderesi);
										redirect(base_url("admin/orders/detail/$kodepesanan"),"refresh");
										die();
									}
									else{
										$this->session->set_flashdata("msg","Enter resi number");
										redirect(base_url("admin/orders/send/$kodepesanan"),"refresh");
										die();
									}
								}
								else{
									redirect(base_url("admin/orders/detail/$kodepesanan"),"refresh");
									die();
								}
							}
							else{
								redirect(base_url("order/detail/$kodepesanan"),"refresh");
								die();
							}
						}
						elseif($row->status == "4"){
							if($this->session->has_userdata("adminmode") && $this->session->adminmode == "true"){
								$this->load->view("confirm");
							}
							else{
								$status = "5";
								$this->item_m->updateorder($kodepesanan,$status);
								$this->load->view("confirm");
							}
						}
						else{
							$this->load->view("confirm");
						}
					}
				}
				else{
					$this->load->view("confirm");
				}
			}
			else{
				$this->load->view("confirm");
			}
		}
		else{
			redirect(base_url("user/login"),"refresh");
			die();
		}
	}
	// order detail
	public function detail($kodepesanan = null)
	{
		if($this->session->has_userdata("loginstate") && $this->session->loginstate == "true"){
			if($this->session->has_userdata("adminmode") && $this->session->adminmode == "true"){
				redirect(base_url("admin/orders"),"refresh");
				die();
			}
			else{
				if(!empty($kodepesanan)){
					$data["order"] = $this->item_m->getorderdetail($kodepesanan);
					if(!empty($data["order"])){
						$this->load->view("templates/head");
						$this->load->view("templates/nav");
						$this->load->view("orderdetail",$data);
						$this->load->view("templates/foot");
					}
					else{
						redirect(base_url("order/list"),"refresh");
						die();
					}
				}
				else{
					redirect(base_url("order/list"),"refresh");
					die();
				}
			}
		}
		else{
			redirect(base_url(),"refresh");
			die();
		}
		
	}
	// order list
	public function list()
	{
		if($_SERVER["REQUEST_METHOD"] == "GET"){
			if($this->input->get("filter") == "1"){
				$data["order"] = $this->item_m->getorder("1");
			}
			elseif($this->input->get("filter") == "2"){
				$data["order"] = $this->item_m->getorder("2");
			}
			elseif($this->input->get("filter") == "3"){
				$data["order"] = $this->item_m->getorder("3");
			}
			elseif($this->input->get("filter") == "4"){
				$data["order"] = $this->item_m->getorder("4");
			}
			elseif($this->input->get("filter") == "5"){
				$data["order"] = $this->item_m->getorder("5");
			}
			elseif($this->input->get("filter") == "6"){
				$data["order"] = $this->item_m->getorder("6");
			}
			else{
				$data["order"] = $this->item_m->getorder("0");
			}
		}
		else{
			$data["order"] = $this->item_m->getorder("0");
		}
		if(!empty($data["order"])){
			$this->load->view("templates/head");
			$this->load->view("templates/nav");
			$this->load->view("order",$data);
			$this->load->view("templates/foot");
		}
		else{
			$this->load->view("templates/head");
			$this->load->view("templates/nav");
			$this->load->view("emptyorder");
			$this->load->view("templates/foot");
		}
	}
	// process
	public function process()
	{
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			if(empty($this->input->post("name"))){
				$this->session->set_flashdata("msg","Enter name");
				redirect(base_url("cart/checkout"),"refresh");
				die();
			}
			elseif(!preg_match("/^[a-zA-Z ]*$/",$this->input->post("name"))){
				$this->session->set_flashdata("msg","Invalid name format");
				redirect(base_url("cart/checkout"),"refresh");
				die();
			}
			elseif(empty($this->input->post("phone"))){
				$this->session->set_flashdata("msg","Enter phone number");
				redirect(base_url("cart/checkout"),"refresh");
				die();
			}
			elseif(!preg_match("/^[0-9]*$/",$this->input->post("phone"))){
				$this->session->set_flashdata("msg","Invalid phone number format");
				redirect(base_url("cart/checkout"),"refresh");
				die();
			}
			elseif(strlen($this->input->post("phone")) < 10){
				$this->session->set_flashdata("msg","Invalid phone number format");
				redirect(base_url("cart/checkout"),"refresh");
				die();
			}
			elseif(strlen($this->input->post("phone")) > 15){
				$this->session->set_flashdata("msg","Invalid phone number format");
				redirect(base_url("cart/checkout"),"refresh");
				die();
			}
			elseif(empty($this->input->post("province"))){
				$this->session->set_flashdata("msg","Select province");
				redirect(base_url("cart/checkout"),"refresh");
				die();
			}
			elseif(empty($this->input->post("city"))){
				$this->session->set_flashdata("msg","Select city");
				redirect(base_url("cart/checkout"),"refresh");
				die();
			}
			elseif(empty($this->input->post("address"))){
				$this->session->set_flashdata("msg","Enter address");
				redirect(base_url("cart/checkout"),"refresh");
				die();
			}
			elseif(empty($this->input->post("bank"))){
				$this->session->set_flashdata("msg","Select bank");
				redirect(base_url("cart/checkout"),"refresh");
				die();
			}
			else{
				$total = 0;
				$email = $this->session->email;
				$bank = $this->input->post("bank");
				$nama = $this->input->post("name");
				$this->session->telepon = $telepon = $this->input->post("phone");
				$prov = explode(",",$this->input->post("province"));
				$this->session->provinsi = $provinsi = "{$prov[0]}-{$prov[1]}";
				$city = explode(",",$this->input->post("city"));
				$this->session->kota = $kota = "{$city[0]} {$city[1]}-{$city[2]}";
				$this->session->alamat = $alamat = $this->input->post("address");
				if(empty($this->input->post("postal"))){
					$this->session->kodepos = $kodepos = "";
				}
				else{
					$this->session->kodepos = $kodepos = $this->input->post("postal");
				}
				$this->load->model("user_m");
				$this->load->model("order_m");
				$this->user_m->update($email,$telepon,$provinsi,$kota,$alamat,$kodepos);
				$kode = $this->order_m->newcode($telepon);
				$this->order_m->new($kode,$email,$telepon,$total,$bank,$nama,$provinsi,$kota,$alamat,$kodepos);
				$carts = $this->item_m->getcart();
				foreach($carts as $cart){
					$total += $cart->hargabarang*$cart->jumlahbarang;
					$result1 = $this->item_m->getkategori($cart->kodebarang);
					$result2 = $this->item_m->gettipe($cart->kodebarang);
					foreach($result1 as $row1){
						$kategori = $row1->namakategori;
					}
					foreach($result2 as $row2){
						$tipe = $row2->namatipe;
					}
					$this->order_m->newdetail($kode,$cart->kodebarang,$cart->jumlahbarang,$cart->ukuran,$cart->hargabarang,$cart->namabarang,$kategori,$tipe);
				}
				$total += 50000;
				$this->order_m->update($kode,$total);
				$this->item_m->clearcart($email);
				$this->session->unset_userdata("totalharga");
				redirect(base_url("order/list"),"refresh");
				die();
			}
		}
		else{
			redirect(base_url("user/cart"),"refresh");
			die();
		}
	}
}
