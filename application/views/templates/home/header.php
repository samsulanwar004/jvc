<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="web jvc" content="">
    <meta name="samrock" content="">

    <title><?php echo $title; ?> - JVC</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url().'assets/css/bootstrap.min.css' ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url().'assets/css/modern-business.css' ?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url().'assets/font-awesome/css/font-awesome.min.css' ?>" rel="stylesheet" type="text/css">

    <!--Event Calender-->
      <link rel="stylesheet" href="<?php echo base_url().'assets/css/eventCalendar.css' ?>">
      <link rel="stylesheet" href="<?php echo base_url().'assets/css/eventCalendar_theme_responsive.css' ?>">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" id="navbar-custom" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url().'assets/images/logo_jvc.png' ?>" id="logo" class="img-responsive" title="Jogjakarta V-ixion Community"></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">JVC<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="<?php echo base_url().'sejarah' ?>">Sejarah</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url().'visi_misi' ?>">Visi dan Misi</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url().'program' ?>">Program</a>
                            </li>
                        </ul>
                    </li>                    
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">KEGIATAN<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="<?php echo base_url().'jadwal' ?>">Jadwal</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo base_url().'blog' ?>">BLOG</a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">ORGANISASI <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="<?php echo base_url().'pengurus' ?>">Pengurus</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url().'sekretariat' ?>">Sekretariat</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url().'galery' ?>">Galery</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">INFORMASI <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="<?php echo base_url().'kontak' ?>">Kontak Kami</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url().'download' ?>">Download</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url().'tentang' ?>">Tentang Kami</a>
                            </li>
                        </ul>
                    </li>
                    <?php 
                        $logged_in = $this->session->userdata('logged_in');
                        if (isset($logged_in)? $logged_in : null)
                        {
                            echo '<li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> '.strtoupper($logged_in['nama']).' <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="'.base_url().'profil'.'"><span class="glyphicon glyphicon-pencil"></span> Profil</a>
                                        </li>
                                        <li>
                                            <a href="'.base_url().'login/logout'.'"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                                        </li>
                                    </ul>
                                </li>';
                        }
                        else
                        {
                    ?>
                    <li>
                        <a href="#" id="myLogin">LOGIN</a>
                    </li>
                    <?php
                        }
                    ?>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    
    <!-- Modal Login-->
    <div class="modal fade" id="myModalLogin" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="padding:35px 50px;">
                  <h1><span class="glyphicon glyphicon-lock"></span> Login</h1>
                </div>
                <div class="modal-body" style="padding:40px 50px;">
                  <?php echo form_open('login/member', array('role' => 'form')); ?>
                    <div class="form-group">
                      <label for="username"><span class="glyphicon glyphicon-user"></span> Username</label>
                      <input type="email" class="form-control" name="email" id="email" placeholder="Email" autocomplete="off">
                    </div>
                    <div class="form-group">
                      <label for="password"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
                      <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    </div>
                      <button type="submit" class="btn btn-default btn-block"><span class="glyphicon glyphicon-off"></span> Login</button>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Batal</button>
                  <p>Bukan Member? <a href="<?php echo base_url().'pendaftaran'?>">Daftar Sekarang</a></p>
                  <p>Lupa <a href="<?php echo base_url().'members/lupa_password'?>">Password?</a></p>
                </div>
            </div> 
        </div>
    </div> 