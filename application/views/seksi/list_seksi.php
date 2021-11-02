
<!DOCTYPE html>
<html>
<head>
  <title>Data Seksi</title>
  <?php $this->load->view("partials/head.php") ?>
</head>
<body>

<div id="wrapper">
    <?php $this->load->view("partials/sidebarA.php") ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Data Seksi</h1>
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
                    <a href="<?php echo site_url('admin/addSeksi') ?>" class="btn btn-outline btn-primary"><i class="fa fa-plus fw"> Add Seksi </i></a>
                        <div class="table-responsive"><br>

                        <table width="100%" class="table table-striped table-bordered table-hover dataTables js-exportable">
								<thead>
									<tr class = "success">
                                        <th style="text-align:center">No</th>
                                        <th style="text-align:center">ID</th>
										<th style="text-align:center">Seksi</th>
										<th style="text-align:center">Aksi</th>
									</tr>
								</thead>
								<tbody>
                                <?php 
                                    $no = 1;
									foreach ($seksi as $se): ?>
									<tr style="text-align:center">
                                        <td width="50">
											<?php echo $no++; ?>
										</td>
                                        <td width="80">
											<?php echo $se->id_seksi ?>
										</td>
										<td>
											<?php echo $se->nama_seksi ?>
                                        </td>	
                                        <td>
											<!-- <a href="<?php echo site_url('Personalia/editPersonalia/'.$se->id_seksi) ?>"
											 class="btn btn-primary btn-circle" type="submit" name="btn"><i class="glyphicon glyphicon-pencil"></i></a>
											 &nbsp &nbsp -->
                                             <a onclick="deleteConfirm('<?php echo site_url('Admin/deleteSeksi/'.$se->id_seksi) ?>')"
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
		
    </div>                   
</div>
<!-- /#page-wrapper -->
<?php $this->load->view("partials/footer.php") ?>

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
            