<!DOCTYPE html>
<html>
<head>
  <title> Data Pengajuan</title>
  <?php $this->load->view("partials/head.php") ?>
</head>
<body>

<div id="wrapper">
    <?php $this->load->view("partials/sidebarA.php") ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"> Data Pengajuan</h1>
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
                    <a href="<?php echo site_url('User/add') ?>" class="btn btn-outline btn-primary"><i class="fa fa-plus fw"> Pengajuan </i></a>
                        <div class="table-responsive"><br>
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
								<thead>
									<tr class = "success">
										<th style="text-align:center">No Izin</th>
										<th style="text-align:center">NIK</th>
										<th style="text-align:center">Nama</th>
										<th style="text-align:center">Tanggal</th>
                                        <th style="text-align:center">Jam</th>
                                        <th style="text-align:center">Jenis Izin</th>
                                        <th style="text-align:center">Alasan</th>
										<th style="text-align:center">Status Atasan</th>
										<th style="text-align:center">Status Personalia</th>
										<th style="text-align:center">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									foreach ($m_perizinan as $m_perizinan): ?>
									<tr>
										<td style="text-align:justify">
											<?php echo $m_perizinan->kd_izin ?>
										</td>
                                        <td style="text-align:justify">
											<?php echo $m_perizinan->nik_user ?>
										</td>
										<td width="200">
											<?php echo $m_perizinan->nama_user ?>
										</td>
                                        <td style="text-align:justify">
											<?php echo $m_perizinan->tanggal ?>
										</td>
                                        <td style="text-align:justify">
											<?php echo $m_perizinan->jam ?>
										</td>
                                        <td style="text-align:justify">
											<?php echo $m_perizinan->jenis ?>
										</td>
                                        <td width = "250" style="text-align:justify">
											<?php echo $m_perizinan->alasan ?>
										</td>
										<td style="text-align:justify">
										<?php 
											if($m_perizinan->status_atasan=='1'){
											?>
												<i class="btn-xs btn-warning">Belum-Dikonfirmasi</i>

											<?php
											}else if($m_perizinan->status_atasan=='2'){
												?>                                
												<i class="btn-xs btn-success btn-icon-pg">Disetujui</i>
												<?php
											}else if($m_perizinan->status_atasan=='3'){
												?>
													<i class="btn-xs btn-danger btn-icon-pg">Ditolak</i>
												<?php
											}
										?>      
										</td>
										<td style="text-align:justify">
										<?php 
											if($m_perizinan->status_hrd=='1'){
											?>
												<i class="btn-xs btn-warning">Belum-Dikonfirmasi</i>

											<?php
											}else if($m_perizinan->status_hrd=='2'){
												?>                                
												<i class="btn-xs btn-success btn-icon-pg">Disetujui</i>
												<?php
											}else if($m_perizinan->status_hrd=='3'){
												?>
													<i class="btn-xs btn-danger btn-icon-pg">Ditolak</i>
												<?php
											}
										?>
										</td>
										<td>
											<?php 
											$kode = $tbl_perizinan->kd_surat;
											?>
											<img src=" <?php echo site_url('User/barcode/'.$kode); ?>" alt="">
										</td>
										<td style="text-align:justify">
											<a href="<?php echo site_url().'User/print/'.$tbl_perizinan->kd_surat?>"
											 class="btn btn-warning btn-circle" type="submit" name="btn"><i class="glyphicon glyphicon-print"></i></a>
											 
										</td>
									</tr>
									<?php endforeach; ?>

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
            