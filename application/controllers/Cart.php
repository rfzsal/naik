<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cart extends CI_Controller {
	// redirect home
	public function index()
	{
		redirect(base_url(),"refresh");
		die();
	}
	// checkout
	public function checkout()
	{
		if($this->session->has_userdata("totalharga")){
			$link = base_url("data/city");
			$this->load->model("data_m");
			$data["listProv"] = $this->data_m->getprov();
$data["js"] = 
"$('#province').change(function() {
var prov = $('#province').val();
var province = prov.split(',');
$.ajax({
url: '{$link}',
method: 'POST',
data: { prov : province[1] },
success: function(obj) {
$('#city').html(obj);
}
});
});";
			$this->load->view("templates/head");
			$this->load->view("templates/nav");
			$this->load->view("checkout",$data);
			$this->load->view("templates/foot");
		}
		else{
			redirect(base_url("user/cart"),"refresh");
			die();
		}
	}
	// add cart
	public function add($kodebarang = null)
	{
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			if(!empty($kodebarang)){
				if($this->session->has_userdata("loginstate") && $this->session->loginstate == "true"){
					if($this->session->has_userdata("adminmode") && $this->session->adminmode == "true"){
						$this->load->view("add");
					}
					else{
						$email = $this->session->email;
						if(empty($this->input->post("qty"))){
							$jumlah = 1;
						}
						elseif($this->input->post("qty") == 0){
							$jumlah = 1;
						}
						elseif(!preg_match("/^[0-9]*$/",$this->input->post("qty"))){
							$jumlah = 1;
						}
						else{
							$jumlah = $this->input->post("qty");
						}
						$ukuran = $this->input->post("options");
						$this->item_m->addcart($email,$kodebarang,$ukuran,$jumlah);
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
		else{
			redirect(base_url(),"refresh");
			die();
		}
	}
	// remove cart
	public function remove($kodebarang = null,$ukuran = null)
	{
		if(!empty($kodebarang)){
			if($this->session->has_userdata("loginstate") && $this->session->loginstate == "true"){
				if($this->session->has_userdata("adminmode") && $this->session->adminmode == "true"){
					$this->load->view("remove");
				}
				else{
					$email = $this->session->email;
					$this->item_m->delcart($email,$kodebarang,$ukuran);
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
	// clear cart
	public function clear()
	{
		if($this->session->has_userdata("loginstate") && $this->session->loginstate == "true"){
			if($this->session->has_userdata("adminmode") && $this->session->adminmode == "true"){
				$this->load->view("remove");
			}
			else{
				$email = $this->session->email;
				$this->item_m->clearcart($email);
				$this->session->unset_userdata("totalharga");
				$this->load->view("remove");
			}
		}
		else{
			redirect(base_url("user/login"),"refresh");
			die();
		}
	}
}
