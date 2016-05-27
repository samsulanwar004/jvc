<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Galery extends CI_Controller {

	public function index()
	{
		$data['title'] = "Galery";
		$this->load->view('templates/home/header', $data);
		$this->load->view('view_galery');
		$this->load->view('templates/home/footer');
	}
}
