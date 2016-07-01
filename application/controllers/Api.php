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
            "description" => $value->deskripsi
        );
        array_push($arr, $temp);
    }
    $data = json_encode($arr);

		echo $data;
	}

  public function counter()
  {
    $counter_name = "counter.txt";
    // Check if a text file exists. If not create one and initialize it to zero.
    if (!file_exists($counter_name)) {
      $f = fopen($counter_name, "w");
      fwrite($f,"0");
      fclose($f);
    }
    // Read the current value of our counter file
    $f = fopen($counter_name,"r");
    $counterVal = fread($f, filesize($counter_name));
    fclose($f);
    // Has visitor been counted in this session?
    // If not, increase counter value by one
    if(!isset($_SESSION['hasVisited'])){
      $_SESSION['hasVisited']="yes";
      $counterVal++;
      $f = fopen($counter_name, "w");
      fwrite($f, $counterVal);
      fclose($f); 
    }
    echo $counterVal;
  }

  public function members()
  {
    $members = $this->proses_model->get_count_members();
    echo $members->count;
  }

  public function kalender()
  {
    $kalender = $this->proses_model->get_count_kalender();
    echo $kalender->count;
  }

  public function jabatan()
  {
    $jabatan = $this->proses_model->get_count_jabatan();
    echo $jabatan->count;
  }

  public function noreg()
  {
    $noreg = $this->proses_model->get_count_noreg();
    echo $noreg->count;
  }

  public function auto_noreg()
  {
    $noreg = $this->input->post('noreg');
    if (!empty($noreg))
    {
        $auto_noreg = $this->proses_model->get_noreg_by_like($noreg);
        if (!empty($auto_noreg)) 
        {
            echo '<ul id="noreg-list">';
            foreach ($auto_noreg as $value) {
                echo '<li onClick="selectNoreg(\''.$value->noreg.'\');">'.$value->noreg.'</li>';
            }
            echo '</ul>';
        }
    }
  }
}
