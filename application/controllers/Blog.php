<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

	public function index()
	{
		$data['title'] = "Blog";
		$this->load->view('templates/home/header', $data);
		$this->load->view('view_blog');
		$this->load->view('templates/home/footer');
	}
}
