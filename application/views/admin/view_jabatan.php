<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Jabatan
        <small>Panel kendali</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url().'admin/dashboard' ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Jabatan</li>
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
              <h3 class="box-title">Input Jabatan</h3>
            </div>
            <div class="box-body">
              <?php echo form_open('admin/simpan_jabatan'); ?>
              <!-- text input -->
              <div class="form-group">
                <label>Jabatan</label>
                <input type="text" name="jabatan" class="form-control" placeholder="Jabatan" value="<?php echo set_value('jabatan'); ?>">
              </div>
               <!-- textarea -->
              <div class="form-group">
                <label>Deskripsi</label>
                <textarea class="form-control" name="deskripsi" rows="3" placeholder="Deskripsi Jabatan"><?php echo set_value('deskripsi'); ?></textarea>
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
              <h3 class="box-title">Daftar Jabatan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="tabelMember" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Jabatan</th>
                  <th>Deskripsi</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no = 1;
                  foreach ($jabatan as $value) {
                ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $value->jabatan; ?></td>
                  <td><?php echo $value->deskripsi; ?></td>
                  <td>
                    <div class="tools">
                      <a href="#" data-toggle="modal" data-target="#myModalEditJabatan<?php echo $no; ?>"><i class="fa fa-edit"></i></a>
                      <a href="#" data-toggle="modal" data-target="#myModalHapusJabatan<?php echo $no; ?>"><i class="fa fa-trash-o"></i></a>
                    </div>
                  </td>
                </tr>
                <!--Modal Edit Jabatan -->
                <div class="modal fade" id="myModalEditJabatan<?php echo $no; ?>">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Edit Jabatan</h4>
                      </div>
                      <div class="modal-body">
                        <?php echo form_open('admin/edit_jabatan'); ?>
                      <div class="form-group">
                        <label>Jabatan</label>
                        <input type="text" name="jabatan" class="form-control" placeholder="Jabatan
                        " value="<?php echo $value->jabatan; ?>">
                      </div>                      
                       <!-- textarea -->
                      <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" rows="3" placeholder="Deskripsi Kegiatan"><?php echo $value->deskripsi; ?></textarea>
                      </div>
                      </div>
                      <div class="modal-footer">
                        <input type="hidden" name="idJabatan" value="<?php echo $value->id_jabatan; ?>">
                        <input type="hidden" name="security" value="<?php echo sha1($value->id_jabatan.$key)?>">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                      </div>
                      </form>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!--Modal Hapus Jabatan -->
                <div class="modal fade modal-warning" id="myModalHapusJabatan<?php echo $no; ?>">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Peringatan!</h4>
                      </div>
                      <div class="modal-body">
                        <p>Apakah anda ingin hapus jabatan <?php echo $value->jabatan; ?> ?</p>
                      </div>
                      <div class="modal-footer">
                      <?php echo form_open('admin/hapus_jabatan'); ?>
                        <input type="hidden" name="idJabatan" value="<?php echo $value->id_jabatan; ?>">
                        <input type="hidden" name="security" value="<?php echo sha1($value->id_jabatan.$key)?>">
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
                  <th>Jabatan</th>
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
        <!-- /.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
    <!-- /.content-wrapper -->