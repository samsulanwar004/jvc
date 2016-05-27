<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sekretariat extends CI_Controller {

	public function index()
	{
		$data['title'] = "Sekretariat";
		$this->load->view('templates/home/header', $data);
		$this->load->view('view_sekretariat');
		$this->load->view('templates/home/footer');
	}
}
