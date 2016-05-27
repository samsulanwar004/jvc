<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sejarah extends CI_Controller {

	public function index()
	{
		$data['title'] = "Sejarah";
		$this->load->view('templates/home/header', $data);
		$this->load->view('view_sejarah');
		$this->load->view('templates/home/footer');
	}
}