<!DOCTYPE html>
<html>
<head>
  <title>Data Izin Atasan</title>
  <?php $this->load->view("partials/head.php") ?>
</head>
<body>

<div id="wrapper">
    <?php $this->load->view("partials/sidebarA.php") ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class="glyphicon glyphicon-file"></i> Data Izin</h1>
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
                        <th width="10%">Status Atasan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="gradeX">
                    <?php
                          $no = 1;
                           foreach ($m_perizinan as $mp) {
                           ?>
                          <td><?php echo $mp->kd_izin ?></td>
                          <td><?php echo $mp->nik_user ?></td>
                          <td><?php echo $mp->nama_karyawan ?></td>
                          <td><?php echo $mp->nama_dept ?></td>
                          <td><?php echo $mp->nama_sub_dept ?></td>
                          <td><?php echo $mp->nama_seksi ?></td>
                          <td><?php echo $mp->tanggal ?></td>
                          <td><?php echo $mp->jam ?></td>
                          <td><?php echo $mp->jenis ?></td>
                          <td><?php echo $mp->alasan ?></td>
                          <td>
                                <?php 
                                if($mp->status_atasan=='1'){
                                  ?>
                                     <i class="btn-xs btn-warning">Menunggu-Dikonfirmasi</i>

                                  <?php
                                }else if($mp->status_atasan=='2'){
                                    ?>                                
                                      <i class="btn-xs btn-success btn-icon-pg">Disetujui</i>
                                    <?php
                                }else if($mp->status_atasan=='3'){
                                      ?>
                                        <i class="btn-xs btn-danger btn-icon-pg">Ditolak</i>
                                      <?php
                        
                                }
                               ?>      
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
            