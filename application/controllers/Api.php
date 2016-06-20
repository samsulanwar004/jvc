<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('proses_model');
	}
	public function jadwal()
	{
		$y = date('Y');
        $m = date('m');
        $d = date('d');
        $yy = $y+1;
        $beginDate    = $y."-".$m."-".$d." 00:00:00";
        $endDate      = $yy."-".$m."-".$d." 23:59:59";
        $params = array(
        	'tgl_awal' => $beginDate,
        	'tgl_akhir' => $endDate 
        );
        
        $jadwal = $this->proses_model->get_jadwal_by_tgl($params);

        $arr = array();
        foreach ($jadwal as $key => $value) {
            $temp = array(
                "date" => $value->tanggal,
                "title" => $value->judul,
                "description" => $value->deskripsi);
            array_push($arr, $temp);
        }
        $data = json_encode($arr);

		echo $data;
	}
}