<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_model extends CI_Model {

	function kirim_email_pendaftaran($params = array())
	{
		$params['subject'] = "Pendaftaran Member Baru";
		$params['content'] = $params['nama'];

		$this->send_email($params);		
	}

	function send_email($params = array())
	{
		$this->email->from($this->config->item('email'), $this->config->item('user_email'));
		$this->email->to($params['email']);

		$this->email->subject($params['subject']);
		$this->email->message($params['content']);

		$this->email->send();

	}

}