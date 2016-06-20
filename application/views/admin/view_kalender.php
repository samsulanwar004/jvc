<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Kalender
        <small>Panel kendali</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url().'admin/dashboard' ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Kalender</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Input Jadwal Kegiatan</h3>
            </div>
            <?php 
              echo validation_errors('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');
              echo $this->session->flashdata('success_msg');
            ?>
            <div class="box-body">
              <?php echo form_open('admin/simpan_jadwal'); ?>
              <!-- text input -->
              <div class="form-group">
                <label>Judul Kegiatan</label>
                <input type="text" name="judul" class="form-control" placeholder="Judul Kegiatan" value="<?php echo set_value('judul'); ?>">
              </div>
              <!-- Date -->
              <div class="form-group">
                <label>Tanggal:</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="tglJadwal" class="form-control pull-right" id="datepicker" value="<?php echo set_value('tglJadwal'); ?>">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
              <!-- time Picker -->
              <div class="bootstrap-timepicker">
                <div class="form-group">
                  <label>Jam:</label>

                  <div class="input-group">
                    <input type="text" name="jamJadwal" class="form-control pull-right" id="timepicker" value="<?php echo set_value('jamJadwal'); ?>">

                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
              </div>
                <!-- /.form group -->
               <!-- textarea -->
              <div class="form-group">
                <label>Deskripsi</label>
                <textarea class="form-control" name="deskripsi" rows="3" placeholder="Deskripsi Kegiatan"><?php echo set_value('deskripsi'); ?></textarea>
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
              <h3 class="box-title">Daftar Kegiatan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="tabelMember" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Judul</th>
                  <th>Tanggal</th>
                  <th>Jam</th>
                  <th>Deskripsi</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  foreach ($jadwal as $value) {
                    $tglArray = explode(' ', $value->tanggal);
                ?>
                <tr>
                  <td><?php echo $value->judul; ?></td>
                  <td><?php echo nice_date($tglArray[0], 'd-m-Y'); ?></td>
                  <td><?php echo $tglArray[1]; ?></td>
                  <td><?php echo $value->deskripsi; ?></td>
                  <td>
                    <div class="tools">
                      <a href="#"><i class="fa fa-edit"></i></a>
                      <a href="#"><i class="fa fa-trash-o"></i></a>
                    </div>
                  </td>
                </tr>
                <?php
                  }
                ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Judul</th>
                  <th>Tanggal</th>
                  <th>Jam</th>
                  <th>Deskripsi</th>
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
              <h3 class="box-title">Jadwal Kegiatan</h3>
            </div>
            <div class="box-body">
              <div id="eventCalendarHumanDate"></div>
            </div>
          </div>
        </div>
        <!-- /.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
    <!-- /.content-wrapper -->