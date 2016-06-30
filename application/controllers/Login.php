<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once( './vendor/facebook/autoload.php' );
class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
	}

	public function member()
	{
		$session = $this->session->userdata('logged_in');
		if (isset($session)? $session : null)
		{
			$data = array(
				'title' => "Sudah Login",
				'content' => "Boskuh sudah login :)"
			);
			$this->load->view('templates/home/header', $data);
			$this->load->view('view_notif');
			$this->load->view('templates/home/footer');
		}
		else
		{
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_cek_login');

			if ($this->form_validation->run() == FALSE)
			{	

				$data['title'] = "Gagal Login";
				$data['content'] 	= "Ayo Boskuh, coba di ingat - ingat ? :)";
				$this->load->view('templates/home/header', $data);
				$this->load->view('view_notif');
				$this->load->view('templates/home/footer');

			}
			else
			{
				$data['title'] = "Berhasil Login";
				$data['content'] 	= "Have Fun Boskuh :)";
				$this->load->view('templates/home/header', $data);
				$this->load->view('view_notif');
				$this->load->view('templates/home/footer');
			}
		}
	}

	public function cek_login($password)
	{
		$email = $this->input->post('email');
		$result = $this->login_model->login_member($email, $password);

		if ($result)
		{
			foreach ($result as $row) {
				$session = array(
					'id_member' => $row->id_member,
					'nama' => $row->nama
				);
				$this->session->set_userdata('logged_in', $session);
			}
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('cek_login', 'Email/Password salah');
			return FALSE;
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('logged_in');
		$this->session->sess_destroy();

		$data['title'] 		= "Berhasil Logout";
		$data['content'] 	= "Kembali lagi nanti ya Boskuh :)";
		$this->load->view('templates/home/header', $data);
		$this->load->view('view_notif');
		$this->load->view('templates/home/footer');
	}

	public function login_facebook()
	{

		$fb = new Facebook\Facebook([
		  'app_id' => $this->config->item('facebook')['api_id'],
		  'app_secret' => $this->config->item('facebook')['app_secret'],
		  'default_graph_version' => 'v2.5',
		]);
		$helper = $fb->getRedirectLoginHelper();

		$permissions = $this->config->item('facebook')['permissions']; // Optional permissions
		$loginUrl = $helper->getLoginUrl($this->config->item('facebook')['redirect_url'], $permissions);

		echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
		//$this->load->view('view_facebook');
	}

	public function masuk()
	{
		$fb = new Facebook\Facebook([
		  'app_id' => $this->config->item('facebook')['api_id'],
		  'app_secret' => $this->config->item('facebook')['app_secret'],
		  'default_graph_version' => 'v2.5',
		]);

		$helper = $fb->getRedirectLoginHelper();

		try {
		  $accessToken = $helper->getAccessToken();
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  // When Graph returns an error
		  echo 'Graph returned an error: ' . $e->getMessage();
		  exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  // When validation fails or other local issues
		  echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  exit;
		}

		if (! isset($accessToken)) {
		  if ($helper->getError()) {
		    header('HTTP/1.0 401 Unauthorized');
		    echo "Error: " . $helper->getError() . "\n";
		    echo "Error Code: " . $helper->getErrorCode() . "\n";
		    echo "Error Reason: " . $helper->getErrorReason() . "\n";
		    echo "Error Description: " . $helper->getErrorDescription() . "\n";
		  } else {
		    header('HTTP/1.0 400 Bad Request');
		    echo 'Bad request';
		  }
		  exit;
		}

		// Logged in
		echo '<h3>Access Token</h3>';
		var_dump($accessToken->getValue());

		// The OAuth 2.0 client handler helps us manage access tokens
		$oAuth2Client = $fb->getOAuth2Client();

		// Get the access token metadata from /debug_token
		$tokenMetadata = $oAuth2Client->debugToken($accessToken);
		echo '<h3>Metadata</h3>';
		var_dump($tokenMetadata);

		// Validation (these will throw FacebookSDKException's when they fail)
		$tokenMetadata->validateAppId($this->config->item('facebook')['api_id']); // Replace {app-id} with your app id
		// If you know the user ID this access token belongs to, you can validate it here
		//$tokenMetadata->validateUserId('123');
		$tokenMetadata->validateExpiration();

		if (! $accessToken->isLongLived()) {
		  // Exchanges a short-lived access token for a long-lived one
		  try {
		    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
		  } catch (Facebook\Exceptions\FacebookSDKException $e) {
		    echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
		    exit;
		  }

		  echo '<h3>Long-lived</h3>';
		  var_dump($accessToken->getValue());
		}

		$_SESSION['fb_access_token'] = (string) $accessToken;

		try {
			  // Returns a `Facebook\FacebookResponse` object
			  $response = $fb->get('/me?fields=id,name', $accessToken);
			} catch(Facebook\Exceptions\FacebookResponseException $e) {
			  echo 'Graph returned an error: ' . $e->getMessage();
			  exit;
			} catch(Facebook\Exceptions\FacebookSDKException $e) {
			  echo 'Facebook SDK returned an error: ' . $e->getMessage();
			  exit;
			}

			$user = $response->getGraphUser();

			echo 'Name: ' . $user['name'];
			// OR
			// echo 'Name: ' . $user->getName();
			// User is logged in with a long-lived access token.
			// You can redirect them to a members-only page.
			//header('Location: https://example.com/members.php');
	}
}