<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_model extends CI_Model {

	function kirim_email_pendaftaran($params = array(), $password)
	{
		$params['subject'] = "Pendaftaran Member Baru";
		$data = array(
    		'nama' => $params['nama'],
    		'email' => $params['email'],
    		'password' => $password,
    		'id' => $params['id_member'],
    		'code' => $params['active_code']
    	);
		$params['message'] = $this->load->view('templates/email/konfirmasi', $data, TRUE);
		
    	
		$this->send_email($params);		
	}

	function send_email($params = array())
	{
		
		$this->email->from($this->config->item('email'), $this->config->item('user_email'));
		$this->email->to($params['email']);

		$this->email->subject($params['subject']);
		$this->email->message($params['message']);

		$this->email->send();

	}

}