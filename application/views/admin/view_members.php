<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Members
        <small>Panel kendali</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url().'admin/dashboard' ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Members</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
    <?php 
      echo validation_errors('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>'); 
      echo $this->session->flashdata('success_msg');
    ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Daftar Member</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="tabelMember" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Reg</th>
                  <th>Email</th>
                  <th>Nama Lengkap</th>
                  <th>TTL</th>
                  <th>JK</th>
                  <th>Alamat</th>
                  <th>Nopol</th>
                  <th>No.HP</th>
                  <th>Jabatan</th>                  
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  foreach ($members as $member) {
                ?>
                <tr>
                  <td><?php echo $member->register; ?></td>
                  <td><?php echo $member->email; ?></td>
                  <td><?php echo $member->nama; ?></td>
                  <td><?php echo $member->tmpLahir.', '.nice_date($member->tglLahir, 'd-m-Y'); ?></td>
                  <td><?php if ($member->jnsKelamin == 'L') { echo 'Laki - Laki';} else { echo 'Perempuan';} ?></td>
                  <td><?php echo $member->alamat; ?></td>
                  <td><?php echo $member->nopol; ?></td>
                  <td><?php echo $member->noTelpon; ?></td>
                  <td><?php echo $member->jabatan; ?></td>
                  <td>
                    <?php if ($member->status == 0) { echo '<span class="label label-warning">Pending</span>';}
                      elseif ($member->status == 1) { echo '<span class="label label-success">Approved</span>';} 
                      elseif ($member->status == 2) { echo '<span class="label label-primary">Admin</span>';} 
                      else {echo '<span class="label label-danger">Denied</span>';}
                    ?>
                  </td>
                  <td>
                    <div class="tools">
                      <a href="#" id="myEditMember"><i class="fa fa-edit"></i></a>
                      <a href="#" id="myHapusMember"><i class="fa fa-trash-o"></i></a>
                    </div>
                  </td>
                </tr>
                <!--Modal Edit Member -->
                <div class="modal fade" id="myModalEditMember">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Edit Member</h4>
                      </div>
                      <div class="modal-body">
                        <?php echo form_open('admin/edit_member'); ?>
                          <div class="form-group">
                            <label for="register" class="control-label">Nomor Register</label>
                            <input type="text" class="form-control" name="register" placeholder="000" value="<?php echo $member->register; ?>">
                          </div>
                          <div class="form-group">
                            <label for="jabatan" class="control-label">Jabatan</label>
                            <select class="form-control" name="jabatan">
                            <?php echo '<option>'.$member->jabatan.'</option>' ?>
                              <option>Anggota</option>
                              <option>Ketua</option>
                              <option>Wakil Ketua</option>
                              <option>Sekretaris</option>
                              <option>Bendahara</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="status" class="control-label">Hak Akses</label>
                            <select class="form-control" name="status">
                            <?php
                            if ($member->status == 1) {echo '<option value="1">Pengguna</option>';}
                            elseif ($member->status == 2) {echo '<option value="2">Admin</option>';}
                            else {echo '<option value="3">Banned</option>';}
                            ?>
                              <option value="1">Pengguna</option>
                              <option value="2">Admin</option>
                              <option value="3">Banned</option>
                            </select>
                          </div>                      
                      </div>
                      <div class="modal-footer">
                        <input type="hidden" name="idMember" value="<?php echo $member->id_member; ?>">
                        <input type="hidden" name="security" value="<?php echo sha1($member->id_member.$key)?>">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                      </div>
                      </form>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!--Modal Hapus Member -->
                <div class="modal fade modal-warning" id="myModalHapusMember">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Peringatan!</h4>
                      </div>
                      <div class="modal-body">
                        <p>Apakah anda ingin hapus member <?php echo $member->nama; ?> ?</p>
                      </div>
                      <div class="modal-footer">
                      <?php echo form_open('admin/hapus_member'); ?>
                        <input type="hidden" name="idMember" value="<?php echo $member->id_member; ?>">
                        <input type="hidden" name="security" value="<?php echo sha1($member->id_member.$key)?>">
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
                  }
                ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Reg</th>
                  <th>Email</th>
                  <th>Nama Lengkap</th>
                  <th>TTL</th>
                  <th>JK</th>
                  <th>Alamat</th>
                  <th>Nopol</th>
                  <th>Foto</th>
                  <th>Jabatan</th>                  
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
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  