<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Nomor Register
        <small>Panel kendali</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url().'admin/dashboard' ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Noreg</li>
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
              <h3 class="box-title">Input Noreg</h3>
            </div>
            <div class="box-body">
              <?php echo form_open('admin/simpan_noreg'); ?>
              <!-- text input -->
              <div class="form-group">
                <label>Jumlah Register</label>
                <input type="text" name="jumlah" class="form-control" placeholder="Jumlah Register" value="<?php echo set_value('jumlah'); ?>">
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Buat</button>
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
              <h3 class="box-title">Daftar Nomor Register</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="tabelMember" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Register</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no = 1;
                  foreach ($noreg as $value) {
                ?>
                <tr>
                  <td><?php echo $value->noreg; ?></td>
                  <td>
                    <?php if ($value->status == 0) { echo '<span class="label label-primary">Belum Terpakai</span>';}
                      elseif ($value->status == 1) { echo '<span class="label label-success">Terpakai</span>';} 
                      else {echo '<span class="label label-danger">Denied</span>';}
                    ?>
                  </td>
                  <td>
                    <div class="tools">
                      <a href="#" data-toggle="modal" data-target="#myModalEditNoreg<?php echo $no; ?>"><i class="fa fa-edit"></i></a>
                    </div>
                  </td>
                </tr>
                <!--Modal Edit Noreg -->
                <div class="modal fade" id="myModalEditNoreg<?php echo $no; ?>">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Edit Noreg</h4>
                      </div>
                      <div class="modal-body">
                        <?php echo form_open('admin/edit_noreg'); ?>
                      <div class="form-group">
                        <label>Noreg</label>
                        <input type="text" class="form-control" name="noreg" readonly value="<?php echo $value->noreg; ?>">
                      </div>  
                      <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
                              <option value="0" <?php if ($value->status == 0){echo"selected";} ?>>Belum Terpakai</option>
                              <option value="1" <?php if ($value->status == 1){echo"selected";} ?>>Terpakai</option>
                            </select>
                      </div>                       
                      </div>
                      <div class="modal-footer">
                        <input type="hidden" name="idNoreg" value="<?php echo $value->id_reg; ?>">
                        <input type="hidden" name="security" value="<?php echo sha1($value->id_reg.$key)?>">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                      </div>
                      </form>
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
                  <th>Register</th>
                  <th>Status</th>
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