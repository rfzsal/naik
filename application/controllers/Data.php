<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Data extends CI_Controller {
	// redirect home
	public function index()
	{
		redirect(base_url(),"refresh");
		die();
	}
	// city
	public function city()
	{
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			$id = $this->input->post('prov');
			$this->load->model("data_m");
			$city = "<option value='' disabled selected>Select a city / district</option>";
			$listCity = $this->data_m->getcity($id);
			$ucity = explode(" ",$this->session->kota);
			foreach ($listCity as $data ){
				if($data->id == end($ucity)){
					$city .= "<option selected value='{$data->tipe},{$data->nama},{$data->id}'>$data->tipe $data->nama</option>";
				}
				else{
					$city .= "<option value='{$data->tipe},{$data->nama},{$data->id}'>$data->tipe $data->nama</option>";
				}
			}
			echo $city;			
		}
		else{
			redirect(base_url(),"refresh");
			die();
		}
	}
}
