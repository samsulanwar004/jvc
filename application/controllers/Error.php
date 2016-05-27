<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error extends CI_Controller {

	public function index()
	{
        $data['title'] = 'Error 404';
        $this->load->view('templates/home/header', $data);
        $this->load->view('view_error');
        $this->load->view('templates/home/footer');
	}
}