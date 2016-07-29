<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('proses_model');
		$this->load->library('pagination');
	}

	public function index()
	{
		$banner = $this->proses_model->get_banner();
		$data = array(
			'title' => "Beranda",
			'banner'=> $banner
		);
		$this->load->view('templates/home/header', $data);
		$this->load->view('view_home');
		$this->load->view('templates/home/footer');
	}

	public function sejarah()
	{
		$data['title'] = "Sejarah";
		$this->load->view('templates/home/header', $data);
		$this->load->view('view_sejarah');
		$this->load->view('templates/home/footer');
	}

	public function visi_misi()
	{
		$data['title'] = "Visi dan Misi";
		$this->load->view('templates/home/header', $data);
		$this->load->view('view_visi_misi');
		$this->load->view('templates/home/footer');
	}

	public function program()
	{
		$data['title'] = "Program";
		$this->load->view('templates/home/header', $data);
		$this->load->view('view_program');
		$this->load->view('templates/home/footer');
	}

	public function jadwal()
	{
		$data['title'] = "Jadwal";
		$this->load->view('templates/home/header', $data);
		$this->load->view('view_jadwal');
		$this->load->view('templates/home/footer');
	}

	public function blog()
	{
		$data['title'] = "Blog";
		$this->load->view('templates/home/header', $data);
		$this->load->view('view_blog');
		$this->load->view('templates/home/footer');
	}

	public function pengurus()
	{
		$data['title'] = "Pengurus";
		$this->load->view('templates/home/header', $data);
		$this->load->view('view_pengurus');
		$this->load->view('templates/home/footer');
	}

	public function sekretariat()
	{
		$data['title'] = "Sekretariat";
		$this->load->view('templates/home/header', $data);
		$this->load->view('view_sekretariat');
		$this->load->view('templates/home/footer');
	}

	public function kontak()
	{
		$data['title'] = "Kontak Kami";
		$this->load->view('templates/home/header', $data);
		$this->load->view('view_kontak');
		$this->load->view('templates/home/footer');
	}

	public function galeri($start = NULL)
	{
		$rows 	= $this->proses_model->get_count_galeri();
		$config['base_url'] = base_url('home/galeri/');
		$config['total_rows'] = $rows->count;
		$config['per_page'] = 6;
		$this->pagination->initialize($config);
		$galeri = $this->proses_model->get_galeri_by_pag($config['per_page'], $start);
		$pagination = $this->pagination->create_links();
		
		$data = array(
			'title' => "Galeri",
			'galeri'=> $galeri,
			'links'	=> $pagination
		);
		$this->load->view('templates/home/header', $data);
		$this->load->view('view_galeri');
		$this->load->view('templates/home/footer');
	}

	public function tentang()
	{
		$data['title'] = "Tentang Kami";
		$this->load->view('templates/home/header', $data);
		$this->load->view('view_tentang');
		$this->load->view('templates/home/footer');
	}

	public function download()
	{
		$data['title'] = "Download";
		$this->load->view('templates/home/header', $data);
		$this->load->view('view_download');
		$this->load->view('templates/home/footer');
	}

	public function persetujuan()
	{
		$data['title'] = "Kebijakan";
		$this->load->view('templates/home/header', $data);
		$this->load->view('view_kebijakan');
		$this->load->view('templates/home/footer');
	}

}
