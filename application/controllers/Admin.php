<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('members_model');
		$this->load->model('proses_model');
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

	public function simpan_jadwal()
	{
		$this->form_validation->set_rules('judul', 'Judul Kegiatan', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('tglJadwal', 'Tanggal', 'required');
		$this->form_validation->set_rules('jamJadwal', 'Jam', 'required');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi Kegiatan', 'trim|required|max_length[100]');
		if ($this->form_validation->run() == FALSE)
        {
        	$this->kalender();
        }
        else
        {
        	$judul 		= $this->input->post('judul');
        	$tgl 		= $this->input->post('tglJadwal');
        	$jam 		= $this->input->post('jamJadwal');
        	$deskripsi 	= $this->input->post('deskripsi');
        	$id_jadwal1	= date('ym');
        	$id_jadwal2 = $this->proses_model->get_idjadwal();
        	$id_jadwal 	= 'JDL'.sprintf("%06d%04d",intval($id_jadwal1),intval($id_jadwal2['id']));

        	$params = array(
        		'judul' 	=> ucfirst($judul),
        		'tanggal' 	=> $tgl,
        		'jam'		=> $jam,
        		'deskripsi'	=> ucfirst($deskripsi),
        		'id_jadwal' => $id_jadwal,
        		'created_at'=> date('Y-m-d H:i:s')
        	);

        	$this->proses_model->simpan_jadwal($params);
        	$this->session->set_flashdata('success_msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Berhasil simpan jadwal kegiatan</div>');
        	redirect('admin/kalender');
        	$this->session->unset_userdata('success_msg');
        }
	}
}