<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('members_model');
	}

	public function index()
	{
		$session = $this->session->userdata('logged_in');
		if (isset($session)? $session : null)
		{
			$member 	= $this->members_model->get_member($session['id_member']);

			$data = array(
				'title'	=> "Profil",
				'id'	=> $member->id_member,
				'email' => $member->email,
				'nama' 	=> $member->nama,
				'ttl'	=> $member->tmpLahir.', '.nice_date($member->tglLahir, 'd-m-Y'),
				'gender'=> $member->jnsKelamin,
				'alamat'=> $member->alamat,
				'nohp'	=> $member->noTelpon,
				'jbtn'	=> $member->jabatan,
				'foto'	=> $member->foto,
				'nopol'	=> $member->nopol,
				'reg'	=> $member->register,
				'key'	=> sha1($member->id_member.$this->config->item('encryption_key'))
			);
			$this->load->view('templates/home/header', $data);
			$this->load->view('view_profil');
			$this->load->view('templates/home/footer');
		}
		else
		{
			$data = array(
				'title' => "Belum Login",
				'content' => "Silahkan Boskuh login dulu jika mengakses halaman ini!"
			);
			$this->load->view('templates/home/header', $data);
			$this->load->view('view_notif');
			$this->load->view('templates/home/footer');
		}
		
	}

	public function edit()
	{
		$this->form_validation->set_rules('namaDepan', 'Nama Depan', 'trim|required');
		$this->form_validation->set_rules('noTelpon', 'Nomor Telepon', 'trim|required|min_length[11]|max_length[12]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|min_length[3]|max_length[50]');
		$this->form_validation->set_rules('nopol', 'Nomor Polisi', 'trim|required|min_length[6]|max_length[9]|callback__cek_nopol');
		$this->form_validation->set_rules('security', 'Key Security', 'required|callback__cek_security');

		if ($this->form_validation->run() == FALSE)
        {
        	$this->session->unset_userdata('success_msg');
        	$this->index();
        }
        else
        {
        	$idMember 	= $this->input->post('idMember');
        	$namaDepan 	= $this->input->post('namaDepan');
        	$namaBlkng 	= $this->input->post('namaBelakang');
        	$noTelpon 	= $this->input->post('noTelpon');
        	$alamat 	= $this->input->post('alamat');
        	$nopol		= $this->input->post('nopol');

        	$params = array(
        		'id_member' 	=> $idMember,
        		'nama' 			=> ucfirst($namaDepan).' '.ucfirst($namaBlkng),
        		'noTelpon' 		=> $noTelpon,
        		'alamat' 		=> $alamat,
        		'nopol'			=> strtoupper($nopol),
        		'modified_in'	=> date('Y-m-d H:i:s')
        	);
        	
        	$this->members_model->update_member($params);
        	$this->session->set_flashdata('success_msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Berhasil Update Profil</div>');
        	redirect('profil');
        	$this->session->unset_userdata('success_msg');
        }	
	}

	public function ganti_password()
	{
		$this->form_validation->set_rules('passwordLama', 'Password Lama', 'trim|required|callback__cek_password');
		$this->form_validation->set_rules('passwordBaru', 'Password Baru', 'trim|required|min_length[6]|max_length[12]');
		$this->form_validation->set_rules('passwordUlang', 'Ulang Password', 'trim|required|matches[passwordBaru]');
		$this->form_validation->set_rules('security', 'Key Security', 'required|callback__cek_security');

		if ($this->form_validation->run() == FALSE)
        {
        	$this->session->unset_userdata('success_msg');
        	$this->index();
        }
        else
        {
        	$id_member		= $this->input->post('idMember');
        	$passwordBaru 	= $this->input->post('passwordBaru');
        	$params = array(
        		'id_member'		=> $id_member,
        		'password' 		=> md5($passwordBaru),
        		'modified_in'	=> date('Y-m-d H:i:s')
        	);
        	$this->members_model->update_member($params);
        	$this->session->set_flashdata('success_msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Berhasil Update Password</div>');
        	redirect('profil');
        	$this->session->unset_userdata('success_msg');
        }
	}

	public function _cek_password($password)
	{
		$id_member = $this->input->post('idMember');
		$result = $this->members_model->get_member($id_member);
		if (! isset($result) || $result == NULL)
		{
			$this->form_validation->set_message('_cek_password', 'Ada Kesalahan');
			return FALSE;
		}

		if ($result->password === md5($password))
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('_cek_password', 'Password Lama Salah');
			return FALSE;
		}
	}

	public function _cek_nopol($str)
	{
	   if (preg_match('#[0-9]#', $str) && preg_match('#[a-zA-Z]#', $str) && strpos($str, " ") == false) {
	     return TRUE;
	   }
	   $this->form_validation->set_message('_cek_nopol', 'Nopol polisi tidak sesuai format');
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

	public function ganti_foto()
    {
    	$this->form_validation->set_rules('security', 'Key Security', 'required|callback__cek_security');
    	if ($this->form_validation->run() == FALSE)
        {
        	$this->session->unset_userdata('success_msg');
        	$this->index();
        }
        else
        {
	    	$id_member	= $this->input->post('idMember');
	    	$member 	= $this->members_model->get_member($id_member);
	    	$foto 		= $member->foto;

	        $config['upload_path']		= './upload_foto/';
	        $config['allowed_types']	= 'gif|jpg|png|jpeg';
	        $config['file_name']		= $id_member;
	        $config['max_size']			= 500;
	        $config['overwrite']		= TRUE;

	        $this->load->library('upload', $config);

	        if ( ! $this->upload->do_upload('foto'))
	        {
	                $error = $this->upload->display_errors();
	                $this->session->set_flashdata('success_msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$error.'</div>');
	                redirect('profil');
	        }
	        else
	        {
	        	$image  = $this->upload->data();
	        	if ($image['file_name'] != $foto)
	        	{
	        		unlink("upload_foto/".$foto);
	        	}
	        	$member = array(
		        	'id_member' 	=> $id_member,
		        	'foto'			=> $image['file_name'],
		        	'modified_in'	=> date('Y-m-d H:i:s')
		        );
		        $this->members_model->update_member($member);
	        	$this->session->set_flashdata('success_msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Berhasil Upload Foto</div>');
	            redirect('profil');
	            $this->session->unset_userdata('success_msg');
	        }
	    }
    }
}