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
                <input type="text" name="judul" class="form-control" placeholder="Judul" value="<?php echo set_value('judul'); ?>">
              </div>
               <!-- textarea -->
              <div class="form-group">
              <label>Image</label>
                <input type="file" name="image" class="form-control">
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
                  <td><?php echo '<img class="img-responsive img-thumbnail img-hover" src="'.base_url().'upload_banner/'.$value->image.'" alt="">' ?></td>
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
                <input type="text" name="judul" class="form-control" placeholder="Judul" value="<?php echo set_value('judul'); ?>">
              </div>
               <!-- textarea -->
              <div class="form-group">
              <label>Image</label>
                <input type="file" name="image" class="form-control">
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
              </form>
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