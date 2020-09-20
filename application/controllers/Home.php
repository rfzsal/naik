<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {
	// test
	public function test()
	{
		$this->load->view("templates/head");
		$this->load->view("templates/nav");
		$this->load->view("test");
		$this->load->view("templates/foot");
	}
	// home
	public function index()
	{
		$this->load->view("templates/head");
		$this->load->view("templates/nav");
		$this->load->view("home");
		$this->load->view("templates/foot");
	}
	// logout
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url(),"refresh");
		die();
	}
}
