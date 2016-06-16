<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('members_model');
	}

	public function index()
	{
		$this->load->view('admin/view_login');
	}

	public function dashboard()
	{
		$data['title'] = "Dashboard";
		$this->load->view('templates/admin/header', $data);
		$this->load->view('admin/view_dashboard');
		$this->load->view('templates/admin/footer');
	}

	public function kalender()
	{
		$data['title'] = "Kalender";
		$this->load->view('templates/admin/header', $data);
		$this->load->view('admin/view_kalender');
		$this->load->view('templates/admin/footer');
	}

	public function email()
	{
		$data['title'] = "Email";
		$this->load->view('templates/admin/header', $data);
		$this->load->view('admin/view_email');
		$this->load->view('templates/admin/footer');
	}

	public function members()
	{
		$members = $this->members_model->get_all_member();
		$data = array(
			'title'		=> "Members",
			'members' 	=> $members
		);
		$this->load->view('templates/admin/header', $data);
		$this->load->view('admin/view_members');
		$this->load->view('templates/admin/footer');
	}
}