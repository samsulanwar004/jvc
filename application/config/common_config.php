<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Config Email
$config['user_email'] = "Jogjakarta V-ixion Community";
$config['email'] = "admin@jvc.or.id";

// Config FB

$config['facebook']['api_id']       = '641511549358745';
$config['facebook']['app_secret']   = '9dbd383e1acdd1fc8d437f1308cc632b';
$config['facebook']['redirect_url'] = 'http://localhost/jvc/api/login_callback_fb';
$config['facebook']['permissions']  = array(
                                        'email',
                                        'public_profile'
                                      );