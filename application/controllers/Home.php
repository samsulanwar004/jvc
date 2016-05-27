<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$data['title'] = "Home";
		$this->load->view('templates/home/header', $data);
		$this->load->view('view_home');
		$this->load->view('templates/home/footer');
	}
}
