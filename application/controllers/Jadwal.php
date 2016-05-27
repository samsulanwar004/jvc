<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends CI_Controller {

	public function index()
	{
		$data['title'] = "Jadwal";
		$this->load->view('templates/home/header', $data);
		$this->load->view('view_jadwal');
		$this->load->view('templates/home/footer');
	}
}
