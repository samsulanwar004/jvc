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
		$jadwal = $this->proses_model->get_jadwal();
		$data = array(
			'title' => "Kalender",
			'jadwal' => $jadwal,
			'key'		=> $this->config->item('encryption_key')
		);
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
			'members' 	=> $members,
			'key'		=> $this->config->item('encryption_key')
		);
		$this->load->view('templates/admin/header', $data);
		$this->load->view('admin/view_members');
		$this->load->view('templates/admin/footer');
	}

	public function edit_member()
	{
		$this->form_validation->set_rules('register', 'Nomor Register', 'trim|required|min_length[3]|max_length[3]|callback__cek_reg');
		$this->form_validation->set_rules('security', 'Key Security', 'required|callback__cek_security');

		if ($this->form_validation->run() == FALSE)
        {
        	$this->session->unset_userdata('success_msg');
        	$this->members();
        }
        else
        {
        	$id_member 	= $this->input->post('idMember');
        	$register 	= $this->input->post('register');
        	$jabatan 	= $this->input->post('jabatan');
        	$status 	= $this->input->post('status');

        	$params = array(
        		'id_member' 	=> $id_member,
        		'register' 		=> $register,
        		'jabatan' 		=> $jabatan,
        		'status' 		=> $status,
        		'modified_in' 	=> date('Y-m-d H:i:s')
        	);

        	$this->members_model->update_member($params);
        	$this->session->set_flashdata('success_msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Berhasil update member</div>');
        	redirect('admin/members');
        	$this->session->unset_userdata('success_msg');
        }
	}

	public function hapus_member()
	{
		$this->form_validation->set_rules('security', 'Key Security', 'required|callback__cek_security');

		if ($this->form_validation->run() == FALSE)
        {
        	$this->session->unset_userdata('success_msg');
        	$this->members();
        }
        else
        {
        	$id_member 	= $this->input->post('idMember');
        	$member 	= $this->members_model->get_member($id_member);
        	if ($member->foto == TRUE)
        	{
        		unlink("upload_foto/".$member->foto);
        	}
        	$this->members_model->hapus_member($id_member);
        	$this->session->set_flashdata('success_msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Berhasil hapus member</div>');
        	redirect('admin/members');
        	$this->session->unset_userdata('success_msg');
        }
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
        	$tglArray	= explode('-', $tgl);
        	$id_jadwal1	= $tglArray[0].$tglArray[1].$tglArray[2];
        	$id_jadwal2 = $this->proses_model->get_idjadwal();
        	$id_jadwal 	= sprintf("%06d%04d",intval($id_jadwal1),intval($id_jadwal2['id']));

        	$params = array(
        		'judul' 	=> ucfirst($judul),
        		'tanggal' 	=> $tgl.' '.$jam,
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

	public function edit_jadwal()
	{
		$this->form_validation->set_rules('judul', 'Judul Kegiatan', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi Kegiatan', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('security', 'Key Security', 'required|callback__cek_jadwal');

		if ($this->form_validation->run() == FALSE)
        {
        	$this->session->unset_userdata('success_msg');
        	$this->kalender();
        }
        else
        {
        	$id_jadwal 	= $this->input->post('idJadwal');
        	$judul 		= $this->input->post('judul');
        	$deskripsi 	= $this->input->post('deskripsi');

        	$params = array(
        		'id_jadwal' 	=> $id_jadwal,
        		'judul' 		=> ucfirst($judul),
        		'deskripsi' 	=> ucfirst($deskripsi),
        		'modified_in' 	=> date('Y-m-d H:i:s')
        	);

        	$this->proses_model->update_jadwal($params);
        	$this->session->set_flashdata('success_msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Berhasil update kegiatan</div>');
        	redirect('admin/kalender');
        	$this->session->unset_userdata('success_msg');
        }
	}

	public function hapus_jadwal()
	{
		$this->form_validation->set_rules('security', 'Key Security', 'required|callback__cek_jadwal');

		if ($this->form_validation->run() == FALSE)
        {
        	$this->session->unset_userdata('success_msg');
        	$this->kalender();
        }
        else
        {
        	$id_jadwal 	= $this->input->post('idJadwal');
        	$this->proses_model->hapus_jadwal($id_jadwal);
        	$this->session->set_flashdata('success_msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Berhasil hapus kegiatan</div>');
        	redirect('admin/kalender');
        	$this->session->unset_userdata('success_msg');
        }
	}

	public function jabatan()
	{
		$jabatan = $this->proses_model->get_jabatan();
		$data = array(
			'title' 	=> "Jabatan",
			'jabatan' 	=> $jabatan,
			'key'		=> $this->config->item('encryption_key')
		);
		$this->load->view('templates/admin/header', $data);
		$this->load->view('admin/view_jabatan');
		$this->load->view('templates/admin/footer');
	}

	public function simpan_jabatan()
	{
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi Jabatan', 'trim|required|max_length[100]');
		if ($this->form_validation->run() == FALSE)
        {
        	$this->jabatan();
        }
        else
        {
        	$jabatan	= $this->input->post('jabatan');
        	$deskripsi 	= $this->input->post('deskripsi');
        	$id_jbtn1	= date('Ymd');
        	$id_jbtn2 	= $this->proses_model->get_idjabatan();
        	$id_jbtn 	= sprintf("%06d%04d",intval($id_jbtn1),intval($id_jbtn2['id']));

        	$params = array(
        		'jabatan' 		=> ucfirst($jabatan),
        		'deskripsi'		=> ucfirst($deskripsi),
        		'id_jabatan' 	=> $id_jbtn,
        		'created_at'	=> date('Y-m-d H:i:s')
        	);

        	$this->proses_model->simpan_jabatan($params);
        	$this->session->set_flashdata('success_msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Berhasil simpan jabatan</div>');
        	redirect('admin/jabatan');
        	$this->session->unset_userdata('success_msg');
        }
	}

	public function edit_jabatan()
	{
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi Jabatan', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('security', 'Key Security', 'required|callback__cek_jabatan');

		if ($this->form_validation->run() == FALSE)
        {
        	$this->session->unset_userdata('success_msg');
        	$this->jabatan();
        }
        else
        {
        	$id_jabatan 	= $this->input->post('idJabatan');
        	$jabatan		= $this->input->post('jabatan');
        	$deskripsi 		= $this->input->post('deskripsi');

        	$params = array(
        		'id_jabatan' 	=> $id_jabatan,
        		'jabatan' 		=> ucfirst($jabatan),
        		'deskripsi' 	=> ucfirst($deskripsi),
        		'modified_in' 	=> date('Y-m-d H:i:s')
        	);

        	$this->proses_model->update_jabatan($params);
        	$this->session->set_flashdata('success_msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Berhasil update jabatan</div>');
        	redirect('admin/jabatan');
        	$this->session->unset_userdata('success_msg');
        }
	}

	public function hapus_jabatan()
	{
		$this->form_validation->set_rules('security', 'Key Security', 'required|callback__cek_jabatan');

		if ($this->form_validation->run() == FALSE)
        {
        	$this->session->unset_userdata('success_msg');
        	$this->jabatan();
        }
        else
        {
        	$id_jabatan = $this->input->post('idJabatan');
        	$this->proses_model->hapus_jabatan($id_jabatan);
        	$this->session->set_flashdata('success_msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Berhasil hapus jabatan</div>');
        	redirect('admin/jabatan');
        	$this->session->unset_userdata('success_msg');
        }
	}

	public function _cek_reg($str)
	{
	   if (preg_match('#[0-9]#', $str) && strpos($str, " ") == false) {
	     return TRUE;
	   }
	   $this->form_validation->set_message('_cek_reg', 'Nomor Registrasi tidak sesuai format');
	   return FALSE;
	}

	public function _cek_security($str)
	{
		$id 	= $this->input->post('idMember');
		$enkrip = sha1($id.$this->config->item('encryption_key'));
		if ($str === $enkrip)
		{
			return TRUE;
		}
		$this->form_validation->set_message('_cek_security', 'Key Security tidak benar');
	   	return FALSE;
	}

	public function _cek_jadwal($str)
	{
		$id 	= $this->input->post('idJadwal');
		$enkrip = sha1($id.$this->config->item('encryption_key'));
		if ($str === $enkrip)
		{
			return TRUE;
		}
		$this->form_validation->set_message('_cek_jadwal', 'Key Security tidak benar');
	   	return FALSE;
	}

	public function _cek_jabatan($str)
	{
		$id 	= $this->input->post('idJabatan');
		$enkrip = sha1($id.$this->config->item('encryption_key'));
		if ($str === $enkrip)
		{
			return TRUE;
		}
		$this->form_validation->set_message('_cek_jabatan', 'Key Security tidak benar');
	   	return FALSE;
	}
}