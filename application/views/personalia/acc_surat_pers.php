<!DOCTYPE html>
<html>
<head>
  <title>Acc Surat Izin Personalia</title>
  <?php $this->load->view("partials/head.php") ?>
</head>
<body>

<div id="wrapper">
    <?php $this->load->view("partials/sidebarA.php") ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Acc Surat Izin Personalia</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
		<div id="wrapper">
		<div id="content-wrapper">
			<div class="container-fluid">
                <?php $this->load->view("partials/breadcrumb.php") ?>
            </div>
        </div>
        </div>
    </div>

    <div class="panel panel-default">
        <!-- <div class="panel-heading">
            Table Data
        </div> -->
                        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="row">
                <div id="wrapper">
                <div id="content-wrapper">
                    <div class="container-fluid">
                    	<div class="table-responsive"><br>
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead >
                    <tr class = "success">
                        <th width="5%">No</th>
                        <th width="5%">NIK</th>
                        <th width="5%">Nama</th>
                        <th width="10%">Departemen</th>
                        <th width="5%">Sub Departemen</th>
                        <th width="15%">Seksi</th>
                        <th width="15%">Tanggal</th>
                        <th width="10%">Jam</th>
                        <th width="20%">Jenis Izin</th>
                        <th width="20%">Alasan</th>
                        <th width="10%">Status Personalia</th>
                        <th width="10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="gradeX">
                          <?php
                          $no = 1;
                           foreach ($tbl_perizinan as $tbl_perizinan) {
                           ?>
                          <td><?php echo $no++; ?></td>
                          <td><?php echo $tbl_perizinan->nik ?></td>
                          <td><?php echo $tbl_perizinan->nama ?></td>
                          <td><?php echo $tbl_perizinan->departemen ?></td>
                          <td><?php echo $tbl_perizinan->sub_departemen ?></td>
                          <td><?php echo $tbl_perizinan->seksi ?></td>
                          <td><?php echo $tbl_perizinan->waktu_izin ?></td>
                          <td><?php echo $tbl_perizinan->jamsd ?></td>
                          <td><?php echo $tbl_perizinan->jenis_izin ?></td>
                          <td><?php echo $tbl_perizinan->alasan ?></td>
                          <td>
                                <?php 
                                if($tbl_perizinan->status_personalia=='1'){
                                  ?>
                                     <i class="btn-xs btn-warning">Menunggu-Dikonfirmasi</i>

                                  <?php
                                }else if($tbl_perizinan->status_personalia=='2'){
                                    ?>                                
                                      <i class="btn-xs btn-success btn-icon-pg">Disetujui</i>
                                    <?php
                                }else if($tbl_perizinan->status_personalia=='3'){
                                      ?>
                                        <i class="btn-xs btn-danger btn-icon-pg">Ditolak</i>
                                      <?php
                        
                                }
                               ?>      
                          </td>
                          <td align="center">
                            <form class="form-horizontal" method="post" action="<?php echo site_url('Personalia/change_status_pers');?>">
                            <!-- <form action="<?php site_url('Personalia/change_status_pers'); ?>" method="post" enctype="multipart/form-data" > -->

                                <div class="form-group">
                                    <!-- <label for="kd_surat">No Surat*</label> -->
                                    <input type="hidden" class="form-control" value="<?php echo $tbl_perizinan->kd_surat; ?>" readonly
                                    type="text" name="kd" placeholder="KDSURAT" />
                                    <div class="invalid-feedback">
                                        <?php echo form_error('kd') ?>
                                    </div>
                                </div>

                                <button class="btn btn-circle btn-primary" type="submit" name="btn"><i class="glyphicon glyphicon-ok"></i></button>
                            </form>

                            <form class="form-horizontal" method="post" action="<?php echo site_url('Personalia/change_status_pers_t');?>">
                        
                                <div class="form-group">
                                    <!-- <label for="kd_surat">No Surat*</label> -->
                                    <input type="hidden" class="form-control" value="<?php echo $tbl_perizinan->kd_surat; ?>" readonly
                                    type="text" name="kd" placeholder="KDSURAT" />
                                    <div class="invalid-feedback">
                                        <?php echo form_error('kd') ?>
                                    </div>
                                </div>

                                <button class="btn btn-circle btn-danger" type="submit" name="btn"><i class="glyphicon glyphicon-remove"></i></button>
                                <br>
                            </form>
                          </td>
                    </tr>
                          <?php
                              /*$no++;*/
                              }
                           ?>
                </tbody>
                
              </table>
                            <!-- /.table-responsive-->
                        </div>
                        <!-- /.container-fluid-->
                    </div>
                    <!-- /.content-wrapper -->
                </div>
                <!-- /.wrapper -->
                </div>
                <!-- /.rpw -->              
            </div>
        </div>
                                <!-- /.panel-footer -->
                                		<!-- Sticky Footer -->
		<?php $this->load->view("partials/footer.php") ?>
    </div>                   
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Morris Charts JavaScript -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/raphael/raphael.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/morrisjs/morris.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/data/morris-data.js"></script>

<!-- Custom Theme JavaScript -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/js/sb-admin-2.js"></script>

<!-- jQuery -->
<script src="../vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../vendor/metisMenu/metisMenu.min.js"></script>

<!-- DataTables JavaScript -->
<script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
<script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../dist/js/sb-admin-2.js"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
$(document).ready(function() {
	$('#dataTables-example').DataTable({
		responsive: true
	});
});
</script>

<!-- < ?php $this->load->view("admin/_partials/scrolltop.php") ?> -->
<?php $this->load->view("partials/modal.php") ?>

<?php $this->load->view("partials/js.php") ?>

<script>
function deleteConfirm(url){
	$('#btn-delete').attr('href', url);
	$('#deleteModal').modal();
}
</script>


</body>

</html>
            