<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Page Content -->
    <div class="container main-content">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Galeri Dokumentasi
                    <small>Subheading</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>">Home</a>
                    </li>
                    <li class="active">Galeri Dokumentasi</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- Projects Row -->
        <div class="row">
        <?php 
            foreach ($galeri as $value) {
                echo '<div class="col-md-3 img-portfolio">
                        <a href="#">
                            <img class="img-responsive img-hover" src="'.base_url().'upload_galeri/'.$value->image.'" style="width: 250px; height: 150px;">
                        </a>
                    </div>';
            }
        ?>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Pagination -->
        
        <div class="row text-center">
            <div class="col-lg-12">
                <?php echo $links; ?>
            </div>
        </div>
        <!-- /.row -->

        <hr>