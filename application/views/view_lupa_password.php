<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Page Content -->
    <div class="container main-content">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?php echo $title; ?>
                    <small>Subheading</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>">Home</a>
                    </li>
                    <li class="active"><?php echo $title; ?></li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- Content Row -->
        <div class="row">
            <div class="col-lg-12">
            <?php 
            echo validation_errors('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>'); 
            echo $this->session->flashdata('success_msg');
            ?>
                <div class="jumbotron" align="left">
                    <?php echo form_open('members/konfirmasi_reset_password', array('class' => 'form-horizontal')); ?>
                        <div class="form-group">
                            <h4>Masukan email untuk mengkonfirmasi reset password</h4>
                            <div class="col-xs-5">
                                <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                            </div>
                            <div  class="col-xs-4">
                                <input type="submit" class="btn btn-primary" value="Kirim">
                            </div>
                        </div>                                        
                    </form>
                </div>
            </div>
        </div>
        <!-- /.row -->

        <hr>