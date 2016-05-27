<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Program extends CI_Controller {

	public function index()
	{
		$data['title'] = "Program";
		$this->load->view('templates/home/header', $data);
		$this->load->view('view_program');
		$this->load->view('templates/home/footer');
	}
}