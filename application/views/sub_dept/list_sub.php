<!DOCTYPE html>
<html>
<head>
  <title>Data Sub Departemen</title>
  <?php $this->load->view("partials/head.php") ?>
</head>
<body>

<div id="wrapper">
    <?php $this->load->view("partials/sidebarA.php") ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Data Sub Departemen</h1>
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
                    <a href="<?php echo site_url('admin/addSub') ?>" class="btn btn-outline btn-primary"><i class="fa fa-plus fw"> Add Sub Departemen </i></a>
                        <div class="table-responsive"><br>

                        <table width="100%" class="table table-striped table-bordered table-hover dataTables js-exportable">
								<thead>
									<tr class = "success">
                                        <th style="text-align:center">No</th>
										<th style="text-align:center">ID</th>
										<th style="text-align:center">Sub Departemen</th>
										<th style="text-align:center">Departemen</th>
										<th style="text-align:center">Aksi</th>
									</tr>
								</thead>
								<tbody>
                                <?php 
                                    $no = 1;
									foreach ($sub as $s): ?>
									<tr style="text-align:center">
                                        <td width="50">
											<?php echo $no++; ?>
										</td>
                                        <td width="80">
											<?php echo $s->id_sub_dept ?>
										</td>
										<td>
											<?php echo $s->nama_sub_dept ?>
                                        </td>	
                                        <td>
											<?php echo $s->nama_dept ?>
										</td>
										
                                        <td>
											<!-- <a href="<?php echo site_url('Personalia/editPersonalia/'.$s->id_sub_dept) ?>"
											 class="btn btn-primary btn-circle" type="submit" name="btn"><i class="glyphicon glyphicon-pencil"></i></a>
											 &nbsp &nbsp -->
                                            <a onclick="deleteConfirm('<?php echo site_url('Admin/deleteSub/'.$s->id_sub_dept) ?>')"
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
            