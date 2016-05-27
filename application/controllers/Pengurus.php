<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengurus extends CI_Controller {

	public function index()
	{
		$data['title'] = "Pengurus";
		$this->load->view('templates/home/header', $data);
		$this->load->view('view_pengurus');
		$this->load->view('templates/home/footer');
	}
}