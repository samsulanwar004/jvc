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
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Daftar Member</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
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