<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kontak extends CI_Controller {

	public function index()
	{
		$data['title'] = "Kontak Kami";
		$this->load->view('templates/home/header', $data);
		$this->load->view('view_kontak');
		$this->load->view('templates/home/footer');
	}
}