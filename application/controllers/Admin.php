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
		$session = $this->session->userdata('logged_in_admin');
		if (isset($session)? $session : null)
		{
			redirect('admin/dashboard');
		}
		else
		{
			$data['title'] = "Admin JVC"; 
			$this->load->view('admin/view_login', $data);
		}
	}

	public function dashboard()
	{
		$session = $this->session->userdata('logged_in_admin');
		if (isset($session)? $session : null)
		{
			$data['title'] = "Dashboard";
			$this->load->view('templates/admin/header', $data);
			$this->load->view('admin/view_dashboard');
			$this->load->view('templates/admin/footer');
		}
		else
		{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Anda belum login</div>');
			redirect('admin');
		}
	}

	public function kalender()
	{
		$session = $this->session->userdata('logged_in_admin');
		if (isset($session)? $session : null)
		{
			$jadwal = $this->proses_model->get_jadwal();
			$data = array(
				'title' => "Kalender",
				'jadwal'=> $jadwal,
				'key'	=> $this->config->item('encryption_key')
			);
			$this->load->view('templates/admin/header', $data);
			$this->load->view('admin/view_kalender');
			$this->load->view('templates/admin/footer');
		}
		else
		{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Anda belum login</div>');
			redirect('admin');
		}
	}

	public function email()
	{
		$session = $this->session->userdata('logged_in_admin');
		if (isset($session)? $session : null)
		{
			$data['title'] = "Email";
			$this->load->view('templates/admin/header', $data);
			$this->load->view('admin/view_email');
			$this->load->view('templates/admin/footer');
		}
		else
		{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Anda belum login</div>');
			redirect('admin');
		}
	}

	public function members()
	{
		$session = $this->session->userdata('logged_in_admin');
		if (isset($session)? $session : null)
		{
			$members = $this->members_model->get_all_member();
			$jabatan = $this->proses_model->get_jabatan();
			$data = array(
				'title'		=> "Members",
				'members' 	=> $members,
				'jabatan'	=> $jabatan,
				'key'		=> $this->config->item('encryption_key')
			);
			$this->load->view('templates/admin/header', $data);
			$this->load->view('admin/view_members');
			$this->load->view('templates/admin/footer');
		}
		else
		{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Anda belum login</div>');
			redirect('admin');
		}
	}

	public function edit_member()
	{
		$session = $this->session->userdata('logged_in_admin');
		if (isset($session)? $session : null)
		{
			$this->form_validation->set_rules('register', 'Nomor Register', 'trim|required|min_length[3]|max_length[3]|numeric|callback__cek_reg');
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
		else
		{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Anda belum login</div>');
			redirect('admin');
		}
	}

	public function hapus_member()
	{
		$session = $this->session->userdata('logged_in_admin');
		if (isset($session)? $session : null)
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
		else
		{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Anda belum login</div>');
			redirect('admin');
		}
	}

	public function simpan_jadwal()
	{
		$session = $this->session->userdata('logged_in_admin');
		if (isset($session)? $session : null)
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
		else
		{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Anda belum login</div>');
			redirect('admin');
		}
	}

	public function edit_jadwal()
	{
		$session = $this->session->userdata('logged_in_admin');
		if (isset($session)? $session : null)
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
		else
		{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Anda belum login</div>');
			redirect('admin');
		}
	}

	public function hapus_jadwal()
	{
		$session = $this->session->userdata('logged_in_admin');
		if (isset($session)? $session : null)
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
		else
		{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Anda belum login</div>');
			redirect('admin');
		}
	}

	public function jabatan()
	{
		$session = $this->session->userdata('logged_in_admin');
		if (isset($session)? $session : null)
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
		else
		{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Anda belum login</div>');
			redirect('admin');
		}
	}

	public function simpan_jabatan()
	{
		$session = $this->session->userdata('logged_in_admin');
		if (isset($session)? $session : null)
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
		else
		{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Anda belum login</div>');
			redirect('admin');
		}
	}

	public function edit_jabatan()
	{
		$session = $this->session->userdata('logged_in_admin');
		if (isset($session)? $session : null)
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
		else
		{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Anda belum login</div>');
			redirect('admin');
		}
	}

	public function hapus_jabatan()
	{
		$session = $this->session->userdata('logged_in_admin');
		if (isset($session)? $session : null)
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
		else
		{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Anda belum login</div>');
			redirect('admin');
		}
	}

	public function noreg()
	{
		$session = $this->session->userdata('logged_in_admin');
		if (isset($session)? $session : null)
		{
			$noreg = $this->proses_model->get_noreg();
			$data = array(
				'title' 	=> "Noreg",
				'noreg' 	=> $noreg,
				'key'		=> $this->config->item('encryption_key')
			);
			$this->load->view('templates/admin/header', $data);
			$this->load->view('admin/view_noreg');
			$this->load->view('templates/admin/footer');
		}
		else
		{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Anda belum login</div>');
			redirect('admin');
		}
	}

	public function simpan_noreg()
	{
		$session = $this->session->userdata('logged_in_admin');
		if (isset($session)? $session : null)
		{
			$this->form_validation->set_rules('jumlah', 'Jumlah Register', 'trim|required|max_length[3]|numeric');
			if ($this->form_validation->run() == FALSE)
	        {
	        	$this->noreg();
	        }
	        else
	        {
	        	$jumlah		= $this->input->post('jumlah');
	        	$noAkhir	= $this->proses_model->get_max_noreg();
	        	$urut 		= substr($noAkhir->noreg, 1);
	        	$reg 		= (int) $urut;
	        	$i 			= $reg+1;
	        	$jum 		= $jumlah+$reg;

	        	for ($i=$i; $i <= $jum; $i++) { 
		        	$i		= str_pad($i, 3, "0", STR_PAD_LEFT);
	        		$params = array(
		        		'noreg' 		=> $i,
		        		'status'		=> 0
	        		);
	        		$this->proses_model->simpan_noreg($params);
	        	}
	        	
	        	$this->session->set_flashdata('success_msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Berhasil buat nomor register</div>');
	        	redirect('admin/noreg');
	        	$this->session->unset_userdata('success_msg');
	        }
	    }
		else
		{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Anda belum login</div>');
			redirect('admin');
		}
	}

	public function edit_noreg()
	{
		$session = $this->session->userdata('logged_in_admin');
		if (isset($session)? $session : null)
		{
			$this->form_validation->set_rules('noreg', 'No Reg', 'required|callback__cek_noreg_status');
			$this->form_validation->set_rules('security', 'Key Security', 'required|callback__cek_noreg');

			if ($this->form_validation->run() == FALSE)
	        {
	        	$this->session->unset_userdata('success_msg');
	        	$this->noreg();
	        }
	        else
	        {
	        	$id_reg 	= $this->input->post('idNoreg');
	        	$status		= $this->input->post('status');

	        	$params = array(
	        		'id_reg' 	=> $id_reg,
	        		'status' 	=> $status,
	        		'id_member' => NULL
	        	);

	        	$this->proses_model->update_noreg($params);
	        	$this->session->set_flashdata('success_msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Berhasil update status nomor register</div>');
	        	redirect('admin/noreg');
	        	$this->session->unset_userdata('success_msg');
	        }
	    }
		else
		{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Anda belum login</div>');
			redirect('admin');
		}
	}

	public function galeri()
	{
		$session = $this->session->userdata('logged_in_admin');
		if (isset($session)? $session : null)
		{
			$banner = $this->proses_model->get_banner();
			$galeri = $this->proses_model->get_galeri();
			$data = array(
				'title' => "Galeri",
				'banner'=> $banner,
				'galeri'=> $galeri,
				'key'	=> $this->config->item('encryption_key')
			);
			$this->load->view('templates/admin/header', $data);
			$this->load->view('admin/view_galeri');
			$this->load->view('templates/admin/footer');
		}
		else
		{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Anda belum login</div>');
			redirect('admin');
		}
	}

	public function simpan_banner()
	{
		$this->form_validation->set_rules('judul_banner', 'Judul', 'trim|required|min_length[3]|max_length[20]');
		if ($this->form_validation->run() == FALSE)
		{
			$this->galeri();
		}
		else
		{
			$judul 		= $this->input->post('judul_banner');
        	$id_banner1	= date('Ymd');
        	$id_banner2	= $this->proses_model->get_idbanner();
        	$id_banner 	= sprintf("%06d%04d",intval($id_banner1),intval($id_banner2['id']));

        	$config['upload_path']		= './upload_banner/';
	        $config['allowed_types']	= 'gif|jpg|png|jpeg';
	        $config['file_name']		= $id_banner;
	        $config['max_size']			= 500;
	        $config['overwrite']		= TRUE;

	        $this->load->library('upload', $config);

	        if ( ! $this->upload->do_upload('image'))
	        {
	                $error = $this->upload->display_errors();
	                $this->session->set_flashdata('success_msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$error.'</div>');
	                redirect('admin/galeri');
	        }
	        else
	        {
	        	$image  = $this->upload->data();
	        	$params = array(
	        		'id_banner' => $id_banner,
	        		'judul' 	=> ucfirst($judul),
	        		'image' 	=> $image['file_name'],
	        		'created_at'=> date('Y-m-d H:i:s')
	        	);

	        	$this->proses_model->simpan_banner($params);
	        	$this->session->set_flashdata('success_msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Berhasil upload banner</div>');
	        	redirect('admin/galeri');
	        	$this->session->unset_userdata('success_msg');
        	}
		}
	}

	public function hapus_banner()
	{

		$this->form_validation->set_rules('security', 'Key Security', 'required|callback__cek_banner');

		if ($this->form_validation->run() == FALSE)
        {
        	$this->session->unset_userdata('success_msg');
        	$this->galeri();
        }
        else
        {
        	$id_banner 	= $this->input->post('idBanner');
        	$banner 	= $this->proses_model->get_banner_by_id($id_banner);
        	if ($banner->image == TRUE)
        	{
        		unlink("upload_banner/".$banner->image);
        	}
        	$this->proses_model->hapus_banner($id_banner);
        	$this->session->set_flashdata('success_msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Berhasil hapus banner</div>');
        	redirect('admin/galeri');
        	$this->session->unset_userdata('success_msg');
        }
	}

	public function simpan_galeri()
	{
		$this->form_validation->set_rules('judul_galeri', 'Judul', 'trim|required|min_length[3]|max_length[20]');
		if ($this->form_validation->run() == FALSE)
		{
			$this->galeri();
		}
		else
		{
			$judul 		= $this->input->post('judul_galeri');
        	$id_galeri1	= date('Ymd');
        	$id_galeri2	= $this->proses_model->get_idbanner();
        	$id_galeri 	= sprintf("%06d%04d",intval($id_galeri1),intval($id_galeri2['id']));

        	$config['upload_path']		= './upload_galeri/';
	        $config['allowed_types']	= 'gif|jpg|png|jpeg';
	        $config['file_name']		= $id_galeri;
	        $config['max_size']			= 500;
	        $config['overwrite']		= TRUE;

	        $this->load->library('upload', $config);

	        if ( ! $this->upload->do_upload('image'))
	        {
	                $error = $this->upload->display_errors();
	                $this->session->set_flashdata('success_msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$error.'</div>');
	                redirect('admin/galeri');
	        }
	        else
	        {
	        	$image  = $this->upload->data();
	        	$params = array(
	        		'id_galeri' => $id_galeri,
	        		'judul' 	=> ucfirst($judul),
	        		'image' 	=> $image['file_name'],
	        		'created_at'=> date('Y-m-d H:i:s')
	        	);

	        	$this->proses_model->simpan_galeri($params);
	        	$this->session->set_flashdata('success_msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Berhasil upload galeri</div>');
	        	redirect('admin/galeri');
	        	$this->session->unset_userdata('success_msg');
        	}
		}
	}

	public function hapus_galeri()
	{

		$this->form_validation->set_rules('security', 'Key Security', 'required|callback__cek_galeri');

		if ($this->form_validation->run() == FALSE)
        {
        	$this->session->unset_userdata('success_msg');
        	$this->galeri();
        }
        else
        {
        	$id_galeri 	= $this->input->post('idGaleri');
        	$galeri 	= $this->proses_model->get_galeri_by_id($id_galeri);
        	if ($galeri->image == TRUE)
        	{
        		unlink("upload_galeri/".$galeri->image);
        	}
        	$this->proses_model->hapus_galeri($id_galeri);
        	$this->session->set_flashdata('success_msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Berhasil hapus galeri</div>');
        	redirect('admin/galeri');
        	$this->session->unset_userdata('success_msg');
        }
	}

	public function _cek_reg($str)
	{

	   if (preg_match('#[0-9]#', $str) && strpos($str, " ") == false) {
	   		$id_member = $this->input->post('idMember');
			$cek_noreg = $this->proses_model->get_noreg_by_idmember($str, $id_member);
			if ($cek_noreg == TRUE)
			{
				return TRUE;
			}
			else
			{
		   		$noreg = $this->proses_model->get_noreg_by_noreg($str);
		   		if ($noreg == TRUE)
		   		{
		   			$params = array(
		   			'noreg' 	=> $str,
		   			'status' 	=> 1,
		   			'id_member' => $id_member
		   			);
			   		$this->proses_model->update_noreg_by_reg($params);
			     	return TRUE;
		   		}
		   		else
		   		{
		   			$this->form_validation->set_message('_cek_reg', 'Nomor Registrasi belum terdaftar atau sudah terpakai');
			   		return FALSE;
		   		}	
		   	}
	   } 
	   else
	   {
		   $this->form_validation->set_message('_cek_reg', 'Nomor Registrasi tidak sesuai format');
		   return FALSE;
		}
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

	public function _cek_noreg($str)
	{
		$id 	= $this->input->post('idNoreg');
		$enkrip = sha1($id.$this->config->item('encryption_key'));
		if ($str === $enkrip)
		{
			return TRUE;
		}
		$this->form_validation->set_message('_cek_noreg', 'Key Security tidak benar');
	   	return FALSE;
	}

	public function _cek_noreg_status($str)
	{
		$noreg = $this->proses_model->get_member_by_reg($str);
		if ($noreg == FALSE)
		{
			return TRUE;
		}
		$this->form_validation->set_message('_cek_noreg_status', 'Register masih terpakai di member');
	   	return FALSE;
	}

	public function _cek_banner($str)
	{
		$id 	= $this->input->post('idBanner');
		$enkrip = sha1($id.$this->config->item('encryption_key'));
		if ($str === $enkrip)
		{
			return TRUE;
		}
		$this->form_validation->set_message('_cek_banner', 'Key Security tidak benar');
	   	return FALSE;
	}

	public function _cek_galeri($str)
	{
		$id 	= $this->input->post('idGaleri');
		$enkrip = sha1($id.$this->config->item('encryption_key'));
		if ($str === $enkrip)
		{
			return TRUE;
		}
		$this->form_validation->set_message('_cek_galeri', 'Key Security tidak benar');
	   	return FALSE;
	}
}