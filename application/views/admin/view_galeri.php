<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Galeri
        <small>Panel kendali</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url().'admin/dashboard' ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Galeri</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <?php 
      echo validation_errors('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>'); 
      echo $this->session->flashdata('success_msg');
    ?>
      <div class="row">
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Input Banner</h3>
            </div>
            <div class="box-body">
              <?php echo form_open_multipart('admin/simpan_banner'); ?>
              <!-- text input -->
              <div class="form-group">
                <label>Judul</label>
                <input type="text" name="judul_banner" class="form-control" placeholder="Judul" value="<?php echo set_value('judul_banner'); ?>">
              </div>
               <!-- textarea -->
              <div class="form-group">
                <label>Image</label>
                <input type="file" name="image" class="form-control">
              </div>
              <br><br>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
              </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Daftar Banner</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="tabelBanner" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Judul</th>
                  <th>Image</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no = 1;
                  foreach ($banner as $value) {
                ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $value->judul; ?></td>
                  <td><?php echo '<img class="img-responsive img-thumbnail img-hover" src="'.base_url().'upload_banner/'.$value->image.'" style="height: 250px;">' ?></td>
                  <td>
                    <div class="tools">
                      <a href="#" data-toggle="modal" data-target="#myModalHapusBanner<?php echo $no; ?>"><i class="fa fa-trash-o"></i></a>
                    </div>
                  </td>
                </tr>
                <!--Modal Hapus Kalender -->
                <div class="modal fade modal-warning" id="myModalHapusBanner<?php echo $no; ?>">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Peringatan!</h4>
                      </div>
                      <div class="modal-body">
                        <p>Apakah anda ingin hapus banner <?php echo $value->judul; ?> ?</p>
                      </div>
                      <div class="modal-footer">
                      <?php echo form_open('admin/hapus_banner'); ?>
                        <input type="hidden" name="idBanner" value="<?php echo $value->id_banner; ?>">
                        <input type="hidden" name="security" value="<?php echo sha1($value->id_banner.$key)?>">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-outline">Hapus</button>
                      </form>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <?php
                  $no++;
                  }
                ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>No</th>
                  <th>Judul</th>
                  <th>Image</th>
                  <th>Aksi</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col (left) -->
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Input Galeri</h3>
            </div>
            <div class="box-body">
              <?php echo form_open_multipart('admin/simpan_galeri'); ?>
              <!-- text input -->
              <div class="form-group">
                <label>Judul</label>
                <input type="text" name="judul_galeri" class="form-control" placeholder="Judul" value="<?php echo set_value('judul_galeri'); ?>">
              </div>
               <!-- textarea -->
              <div class="form-group">
                <label>Image</label>
                <input type="file" name="image" class="form-control">
              </div>
              <div class="form-group">
                <input type="radio" name="tipe" value="1"> Logo
                <input type="radio" name="tipe" checked="checked" value="2"> Non Logo
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
              </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Daftar Galeri</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="tabelGaleri" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Judul</th>
                  <th>Image</th>
                  <th>Tipe</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $nom = 1;
                  foreach ($galeri as $value2) {
                ?>
                <tr>
                  <td><?php echo $nom; ?></td>
                  <td><?php echo $value2->judul; ?></td>
                  <td><?php echo '<img class="img-responsive img-thumbnail img-hover" src="'.base_url().'upload_galeri/'.$value2->image.'" style="height: 250px;">' ?></td>
                  <td><?php if ($value2->tipe == 1) { echo 'Logo';} else { echo 'Non Logo'; } ?></td>
                  <td>
                    <div class="tools">
                      <a href="#" data-toggle="modal" data-target="#myModalHapusGaleri<?php echo $nom; ?>"><i class="fa fa-trash-o"></i></a>
                    </div>
                  </td>
                </tr>
                <!--Modal Hapus Kalender -->
                <div class="modal fade modal-warning" id="myModalHapusGaleri<?php echo $nom; ?>">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Peringatan!</h4>
                      </div>
                      <div class="modal-body">
                        <p>Apakah anda ingin hapus galeri <?php echo $value2->judul; ?> ?</p>
                      </div>
                      <div class="modal-footer">
                      <?php echo form_open('admin/hapus_galeri'); ?>
                        <input type="hidden" name="idGaleri" value="<?php echo $value2->id_galeri; ?>">
                        <input type="hidden" name="security" value="<?php echo sha1($value2->id_galeri.$key)?>">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-outline">Hapus</button>
                      </form>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <?php
                  $nom++;
                  }
                ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>No</th>
                  <th>Judul</th>
                  <th>Image</th>
                  <th>Tipe</th>
                  <th>Aksi</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
    <!-- /.content-wrapper -->