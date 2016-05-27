<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Download extends CI_Controller {

	public function index()
	{
		$data['title'] = "Download";
		$this->load->view('templates/home/header', $data);
		$this->load->view('view_download');
		$this->load->view('templates/home/footer');
	}
}
