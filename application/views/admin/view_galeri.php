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