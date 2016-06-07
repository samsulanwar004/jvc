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

	function konfirmasi_reset_password($params = array())
	{
		$params['subject'] = "Konfirmasi Reset Password";
		$data = array(
    		'id' => $params['id_member'],
    		'code' => $params['active_code']
    	);
		$params['message'] = $this->load->view('templates/email/konfirmasi_reset_password', $data, TRUE);

		$this->send_email($params);	
	}

	function kirim_password($params = array())
	{
		$params['subject'] = "Reset Password";
		$data = array(
    		'password' => $params['password']
    	);
		$params['message'] = $this->load->view('templates/email/kirim_password', $data, TRUE);

		$this->send_email($params);	
	}

}