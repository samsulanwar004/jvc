<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Header Carousel -->
    <header id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <?php 
                $no = 0;
                foreach ($banner as $value) {
                    echo '<li data-target="#myCarousel" data-slide-to="'.$no.'"';
                    if ($no == 0) {echo 'class="active"';}
                    echo '></li>';
                    $no++;
                }
            ?>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <?php
                $no = 0;
                foreach ($banner as $value) {
                    echo '<div class="item ';
                    if ($no == 0){echo 'active';}
                    echo '">
                            <div class="fill" style="background-image:url(\''.base_url()."upload_banner/".$value->image.'\');"></div>
                            <div class="carousel-caption">
                                <h2>'.$value->judul.'</h2>
                            </div>
                        </div>';
                    $no++;
                }
            ?>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>
    </header>
    
    <!-- Page Content -->
    <div class="container">

        <!-- Sambutan -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Selamat Datang di Official Website Jogjakarta V-ixion Community</h1>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="portfolio-item.html">
                    <img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="portfolio-item.html">
                    <img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="portfolio-item.html">
                    <img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="portfolio-item.html">
                    <img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="portfolio-item.html">
                    <img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="portfolio-item.html">
                    <img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">
                </a>
            </div>
        </div>
        <!-- /.row -->

        <!-- Features Section -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Fitur ID Card</h2>
            </div>
            <div class="col-md-6">
                <p>Template ID Card Berisi:</p>
                <ul>
                    <li>Nama Lengkap</li>
                    <li>Nomor Registrasi</li>
                    <li>Tempat dan Tanggal Lahir</li>
                    <li>Alamat</li>
                    <li>Nomor Polisi</li>
                </ul>
                <p>Syarat dan Ketentuan:</p>
                <ul>
                    <li>Kartu ini adalah milik Anggota Jogjakarta V-ixion Community</li>
                    <li>Dengan digunakannya kartu ini, pemegang kartu tunduk dan mengikat kepada syarat dan ketentuan yang berlaku</li>
                    <li>Kartu ini tidak diperjual belikan dan tidak dipindah tangankan</li>
                    <li>Apabila kartu ini hilang segera melapor ke sekretariat Jogjakarta V-ixion Community</li>
                    <li>Bagi yang menemukan kartu ini, harap mengembalikan ke sekretariat Jogjakarta V-ixion Community</li>
                </ul>
            </div>
            <div class="col-md-6">
                <img class="img-responsive" src="http://placehold.it/700x450" alt="">
            </div>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Call to Action Section -->
        <div class="well">
            <div class="row">
                <div class="col-md-8">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias, expedita, saepe, vero rerum deleniti beatae veniam harum neque nemo praesentium cum alias asperiores commodi.</p>
                </div>
                <div class="col-md-4">
                    <a class="btn btn-lg btn-default btn-block" href="<?php echo base_url().'pendaftaran' ?>">Daftar Sekarang</a>
                </div>
            </div>
        </div>

        <hr>