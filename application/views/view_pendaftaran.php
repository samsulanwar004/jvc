<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Page Content -->
    <div class="container main-content">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Pendaftaran
                    <small>Subheading</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>">Home</a>
                    </li>
                    <li class="active">Pendaftaran</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
<?php echo validation_errors('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>'); ?>
        <!-- Content Row -->
        <div class="row">
            <div class="col-lg-12">
                <?php echo form_open('pendaftaran/daftar', array('class' => 'form-horizontal')); ?>
                    <div class="form-group">
                        <label class="control-label col-xs-3" for="lblEmail">Email:</label>
                        <div class="col-xs-5">
                            <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="<?php echo set_value('email'); ?>">
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label class="control-label col-xs-3" for="lblNama">Nama Lengkap:</label>
                        <div class="col-xs-4">
                            <input type="text" name="namaDepan" class="form-control" id="nama-depan" placeholder="Nama Depan" value="<?php echo set_value('namaDepan'); ?>">
                        </div>
                        <div class="col-xs-5">
                            <input type="text" name="namaBelakang" class="form-control" id="nama-belakang" placeholder="Nama Belakang" value="<?php echo set_value('namaBelakang'); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3" for="lblJekel">Jenis Kelamin:</label>
                        <div class="col-xs-2">
                            <label class="radio-inline">
                                <input type="radio" name="jnsKelamin" value="L" <?php if (set_value('jnsKelamin') == 'L'){echo 'checked'; } ?>> Laki-laki
                            </label>
                        </div>
                        <div class="col-xs-2">
                            <label class="radio-inline">
                                <input type="radio" name="jnsKelamin" value="P" <?php if (set_value('jnsKelamin') == 'P'){echo 'checked'; } ?> > Perempuan
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3" for="lblTelp">No. Telp:</label>
                        <div class="col-xs-5">
                            <input type="text" name="noTelpon" class="form-control" id="nomor-telpon" placeholder="Nomor Telepon / Handphone" value="<?php echo set_value('noTelpon'); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3" for="lblTglLahir">Tempat dan Tanggal Lahir</label>
                        <div class="col-xs-3">
                            <input type="text" name="tmpLahir" class="form-control" id="tempat-lahir" placeholder="Tempat Lahir" value="<?php echo set_value('tmpLahir'); ?>">
                        </div>
                        <div class="col-xs-2">
                            <select class="form-control" name="tglLahir">
                                <option value="<?php if (set_value('tglLahir')){echo set_value('tglLahir'); } ?>"><?php if (set_value('tglLahir')){echo set_value('tglLahir'); } else {echo "Tanggal";} ?></option> 
                                <?php
                                for ($i=1; $i <= 31; $i++) { 
                                    echo "<option value='$i'>$i</option>"; 
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-2">
                            <select class="form-control" name="blnLahir">
                                <option value="<?php if (set_value('blnLahir')){echo set_value('blnLahir'); } ?>"><?php if (set_value('blnLahir')){echo set_value('blnLahir'); } else {echo "Bulan";} ?></option> 
                                <?php
                                for ($i=1; $i <= 12; $i++) { 
                                    echo "<option value='$i'>$i</option>"; 
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-2">
                            <select class="form-control" name="thnLahir">
                                <option value="<?php if (set_value('thnLahir')){echo set_value('thnLahir'); } ?>"><?php if (set_value('thnLahir')){echo set_value('thnLahir'); } else {echo "Tahun";} ?></option> 
                                <?php
                                $tahun = date('Y');
                                $awal = $tahun - 60;
                                $akhir = $tahun - 15;
                                for ($i=$awal; $i <= $akhir; $i++) { 
                                    echo "<option value='$i'>$i</option>"; 
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3" for="lblAlamat">Alamat:</label>
                        <div class="col-xs-9">
                            <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Masukan alamat lengkap" value="<?php echo set_value('alamat'); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3" for="lblPlatno">Nomor Polisi:</label>
                        <div class="col-xs-3">
                            <input type="text" name="nopol" class="form-control" id="nopol" placeholder="Contoh : AB1234J" value="<?php echo set_value('nopol'); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3" for="lblPassword">Password:</label>
                        <div class="col-xs-4">
                            <input type="password" name="password" class="form-control" id="password" placeholder="Masukan Password" value="<?php echo set_value('password'); ?>">
                        </div>
                        <div class="col-xs-5">
                            <input type="password" name="passwordUlang" class="form-control" id="password-ulang" placeholder="Ulangi Password">
                        </div>
                    </div>                   
                    <div class="form-group">
                        <div class="col-xs-offset-3 col-xs-9">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="setuju" name="persetujuan" <?php if (set_value('persetujuan')){echo 'checked'; } ?>>  Saya Setuju dengan <a href="<?php echo base_url().'persetujuan' ?>">Kebijakan dan Ketentuan</a> yang berlaku.
                            </label>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="col-xs-offset-3 col-xs-9">
                            <input type="submit" class="btn btn-primary" value="Daftar">
                            <input type="reset" class="btn btn-default" value="Reset">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.row -->

        <hr>