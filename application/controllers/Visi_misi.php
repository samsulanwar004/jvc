<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visi_misi extends CI_Controller {

	public function index()
	{
		$data['title'] = "Visi dan Misi";
		$this->load->view('templates/home/header', $data);
		$this->load->view('view_visi_misi');
		$this->load->view('templates/home/footer');
	}
}