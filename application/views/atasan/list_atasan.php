<!DOCTYPE html>
<html>
<head>
  <title>View Surat Izin Atasan</title>
  <?php $this->load->view("partials/head.php") ?>
</head>
<body>

<div id="wrapper">
    <?php $this->load->view("partials/sidebarA.php") ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class="fa fa-file"></i> View Surat Izin Atasan</h1>
        </div>
        <!-- /.col-lg-12 -->
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
                        <table width="100%" class="table table-striped table-bordered table-hover dataTables js-exportable">
								<thead>
									<tr class = "success">
										<th style="text-align:center">No</th>
										<th style="text-align:center">NIK</th>
										<th style="text-align:center">Nama</th>
										<th style="text-align:center">Departemen</th>
										<th style="text-align:center">Sub Departemen</th>
										<th style="text-align:center">Seksi</th>
										<th style="text-align:center">Tanggal</th>
                                        <th style="text-align:center">Jam</th>
                                        <th style="text-align:center">Jenis Izin</th>
                                        <th style="text-align:center">Alasan</th>
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
											<?php echo $m_perizinan->departemen ?>
										</td>
                                        <td style="text-align:justify">
											<?php echo $m_perizinan->sub_departemen ?>
										</td>
                                        <td style="text-align:justify">
											<?php echo $m_perizinan->seksi ?>
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
											<input type="button" class="btn btn-primary btn-sm view_data" value="Detail" id="<?php echo $m_perizinan->kd_izin; ?>">
											&nbsp &nbsp
											<a onclick="deleteConfirm('<?php echo site_url('Personalia/deletePers/'.$m_perizinan->kd_izin) ?>')"
                                            href="#!" class="btn btn-danger btn-sm" type="submit" name="btn-delete">Hapus</a>
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

<!-- < ?php $this->load->view("admin/_partials/scrolltop.php") ?> -->
<?php $this->load->view("partials/modal.php") ?>

<?php $this->load->view("partials/js.php") ?>

<script>
function deleteConfirm(url){
	$('#btn-delete').attr('href', url);
	$('#deleteModal').modal();
}
</script>

<script>
$(document).ready(function () {
    //Exportable table
    $('.js-exportable').DataTable({
        dom: 'Blfrtip',
        responsive: true,
        buttons: [
            'copy', 'excel', 'pdf', 'print'
        ]
    });
    // $('#dataTables-example').DataTable();
});
</script>

</body>

</html>
            