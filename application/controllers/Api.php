<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once( './vendor/facebook/autoload.php' );
class Api extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->model('login_model');
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
        redirect($loginUrl);
    }

    public function login_callback_fb()
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

        // The OAuth 2.0 client handler helps us manage access tokens
        $oAuth2Client = $fb->getOAuth2Client();

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
              $response = $fb->get('/me?fields=id,name,gender,email', $accessToken);
            } catch(Facebook\Exceptions\FacebookResponseException $e) {
              echo 'Graph returned an error: ' . $e->getMessage();
              exit;
            } catch(Facebook\Exceptions\FacebookSDKException $e) {
              echo 'Facebook SDK returned an error: ' . $e->getMessage();
              exit;
            }

            $user = $response->getGraphUser();

            $result = $this->login_model->login_facebook($user['email']);

            if ($result)
            {
                foreach ($result as $row) {
                    $session = array(
                        'id_member' => $row->id_member,
                        'nama' => $row->nama
                    );
                    $this->session->set_userdata('logged_in', $session);
                }
                $data['title']      = "Berhasil Login";
                $data['content']    = "Have Fun Boskuh :)";
                $this->load->view('templates/home/header', $data);
                $this->load->view('view_notif');
                $this->load->view('templates/home/footer');
            }
            else
            {
                $data['title']      = "Gagal Login";
                $data['content']    = "Gagal login lewat FB";
                $this->load->view('templates/home/header', $data);
                $this->load->view('view_notif');
                $this->load->view('templates/home/footer');
            }       
    }
}
