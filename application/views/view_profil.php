<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Page Content -->
    <div class="container main-content">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Profil
                    <small>Subheading</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>">Home</a>
                    </li>
                    <li class="active">Profil</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <?php 
        echo validation_errors('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>'); 
        echo $this->session->flashdata('success_msg');
        ?>
        <!-- Intro Content -->
        <div class="row">
            <div class="col-xs-6 col-md-3">
            <a href="#" class="thumbnail">
                <img class="img-responsive" src="<?php echo base_url().'upload_foto/'.$foto; ?>" alt="Foto Profil" id="myFoto">
            </a>
            </div>
            <div class="col-md-6">
                <h2>Detail Profil</h2>                
                    <table class="table table-hover">
                        <tr>
                            <td>Email</td>
                            <td><?php echo $email; ?></td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td><?php echo $nama; ?></td>
                        </tr>
                        <tr>
                            <td>TTL</td>
                            <td><?php echo $ttl; ?></td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td><?php if ($gender == 'L') { echo 'Laki - Laki';} else { echo 'Perempuan';} ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td><?php echo $alamat; ?></td>
                        </tr>
                        <tr>
                            <td>No. Telpon</td>
                            <td><?php echo $nohp; ?></td>
                        </tr>
                        <tr>
                            <td>Jabatan</td>
                            <td><?php echo $jbtn; ?></td>
                        </tr>
                        <tr>
                            <td>Nomor Polisi</td>
                            <td><?php echo $nopol; ?></td>
                        </tr>
                        <tr>
                            <td>Register</td>
                            <td><?php echo $reg; ?></td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-success" id="myEdit">Edit</button>
                                <button type="button" class="btn btn-success" id="myGantiFoto">Ganti Foto</button>
                                <button type="button" class="btn btn-success" id="myGantiPassword">Ganti Password</button>                                
                            </td>
                            <td></td>
                        </tr>
                    </table>
            </div>
        </div>
        <!-- /.row -->
        <?php 
            $nama_lengkap   = explode(' ', $nama);
            $nama_depan     = $nama_lengkap[0];
            $nama_belakang  = $nama_lengkap[1];
        ?>
        <!-- Modal Login-->
        <div class="modal fade" id="myModalEdit" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header" style="padding:35px 50px;">
                      <h2><span class="glyphicon glyphicon-edit"></span> Edit Profil</h2>
                    </div>
                    <div class="modal-body" style="padding:40px 50px;">
                      <?php echo form_open('profil/edit', array('role' => 'form')); ?>
                        <div class="form-group">
                          <label for="nama">Nama Depan</label>
                          <input type="text" class="form-control" name="namaDepan" value="<?php echo $nama_depan; ?>"  placeholder="Nama Depan">
                        </div>
                        <div class="form-group">
                          <label for="nama">Nama Belakang</label>
                          <input type="text" class="form-control" name="namaBelakang" value="<?php echo $nama_belakang; ?>"  placeholder="Nama Belakang">
                        </div>
                        <div class="form-group">
                          <label for="telpon">Nomor Telepon</label>
                          <input type="text" class="form-control" name="noTelpon" value="<?php echo $nohp; ?>"  placeholder="Nomor Telepon">
                        </div>
                        <div class="form-group">
                          <label for="telpon">Nomor Polisi</label>
                          <input type="text" class="form-control" name="nopol" value="<?php echo $nopol; ?>"  placeholder="Contoh : AB1234J">
                        </div>
                        <div class="form-group">
                          <label for="alamat">Alamat</label>
                          <input type="text" class="form-control" name="alamat" value="<?php echo $alamat; ?>"  placeholder="Alamat">
                        </div>
                          <input type="hidden" name="idMember" value="<?php echo $id; ?>">
                          <input type="hidden" name="security" value="<?php echo $key; ?>">
                          <button type="submit" class="btn btn-default btn-block"><span class="glyphicon glyphicon-floppy-disk"></span> Simpan</button>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Batal</button>
                    </div>
                </div> 
            </div>
        </div> 

        <!-- Modal Login-->
        <div class="modal fade" id="myModalGantiPassword" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header" style="padding:35px 50px;">
                      <h2><span class="glyphicon glyphicon-edit"></span> Ganti Password</h2>
                    </div>
                    <div class="modal-body" style="padding:40px 50px;">
                      <?php echo form_open('profil/ganti_password', array('role' => 'form')); ?>
                        <div class="form-group">
                          <label for="password">Password Lama</label>
                          <input type="password" class="form-control" name="passwordLama" placeholder="Password Lama">
                        </div>
                        <div class="form-group">
                          <label for="password">Password Baru</label>
                          <input type="password" class="form-control" name="passwordBaru" placeholder="Password Baru">
                        </div>
                        <div class="form-group">
                          <label for="passwordUlang">Ulangi Password Baru</label>
                          <input type="password" class="form-control" name="passwordUlang" placeholder="Ulangi Password Baru">
                        </div>
                          <input type="hidden" name="idMember" value="<?php echo $id; ?>">
                          <input type="hidden" name="security" value="<?php echo $key; ?>">
                          <button type="submit" class="btn btn-default btn-block"><span class="glyphicon glyphicon-floppy-disk"></span> Simpan</button>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Batal</button>
                    </div>
                </div> 
            </div>
        </div>

        <!-- Modal Login-->
        <div class="modal fade" id="myModalGantiFoto" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header" style="padding:35px 50px;">
                      <h2><span class="glyphicon glyphicon-edit"></span> Ganti Foto</h2>
                    </div>
                    <div class="modal-body" style="padding:40px 50px;">
                        <?php echo form_open_multipart('profil/ganti_foto', array('role' => 'form'));?>
                            <div class="form-group">
                              <label for="foto">Upload Foto</label>
                              <input type="file" class="form-control" name="foto">
                              <p>Max size : 500 KB</p>
                            </div>
                          <input type="hidden" name="idMember" value="<?php echo $id; ?>">
                          <input type="hidden" name="security" value="<?php echo $key; ?>">
                          <button type="submit" class="btn btn-default btn-block"><span class="glyphicon glyphicon-upload"></span> Upload</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Batal</button>
                    </div>
                </div> 
            </div>
        </div>

        <!-- Modal Login-->
        <div class="modal fade" id="myModalFoto" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header" style="padding:35px 50px;">
                      <h2><span class="glyphicon glyphicon-pushpin"></span> Foto Profil</h2>
                    </div>
                    <div class="modal-body" style="padding:40px 50px;">
                        <center><img class="img-responsive" src="<?php echo base_url().'upload_foto/'.$foto; ?>" alt="Foto Profil" ></center>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Batal</button>
                    </div>
                </div> 
            </div>
        </div>

        <hr>