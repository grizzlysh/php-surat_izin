<!DOCTYPE html>
<html>
<head>
  <title>Acc Surat Izin</title>
  <?php $this->load->view("partials/head.php") ?>
</head>
<body>

<div id="wrapper">
<?php $this->load->view("partials/sidebar.php") ?>
<!-- Navigation -->

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Print Surat</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
		<div id="wrapper">
		<div id="content-wrapper">
			<div class="container-fluid">
				<?php $this->load->view("partials/breadcrumb.php") ?>
				<!-- DataTables -->
				<div class="card mb-3">
                <div id="printableArea" class="displayerBoxes txt-center" style="overflow-x:auto;">
					<div class="card-body">
                    <div class="box-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <a class="navbar-brand"><img width="120" height="35" src="<?php echo base_url('assets/img/logo.png') ?>"/></a>
                    <center><h1> Surat Izin PT. Bina Busana Internusa </h1></center>
                    </table>
            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
            <tr class = "success">
                <th style="text-align:center">NIK</th>
				<th style="text-align:center">Nama</th>
				<th style="text-align:center">Departemen</th>
				<th style="text-align:center">Sub Departemen</th>
				<th style="text-align:center">Seksi</th>
				<th style="text-align:center">Tanggal</th>
                <th style="text-align:center">Jam</th>
                <th style="text-align:center">Jenis Izin</th>
                <th style="text-align:center">Alasan</th>
				<th style="text-align:center">Status Atasan</th>
				<th style="text-align:center">Status Personalia</th>
                <th style="text-align:center">Barcode</th>
                
		    </tr>
                <?php //foreach ($tbl_perizinan as $tbl_perizinan): ?>
                <tr style="text-align:center">
                    <td><?php echo $tbl_perizinan->nik;?></td>
                    <td><?php echo $tbl_perizinan->nama;?></td>
                    <td><?php echo $tbl_perizinan->departemen;?></td>
                    <td><?php echo $tbl_perizinan->sub_departemen;?></td>
                    <td><?php echo $tbl_perizinan->seksi;?></td>
                    <td><?php echo $tbl_perizinan->waktu_izin;?></td>
                    <td><?php echo $tbl_perizinan->jamsd;?></td>
                    <td><?php echo $tbl_perizinan->jenis_izin;?></td>
                    <td style="text-align:justify"><?php echo $tbl_perizinan->alasan;?></td>
                    <td>
						<?php 
						if($tbl_perizinan->status=='1'){
						?>
						<i class="">Belum-Dikonfirmasi</i>
                    	<?php
						}else if($tbl_perizinan->status=='2'){
						?>                                
						<i class="">Disetujui</i>
						<?php
					    }else if($tbl_perizinan->status=='3'){
						?>
						<i class="">Ditolak</i>
						<?php
				    	}
						?>      
                    </td>
                    <td>
						<?php 
						if($tbl_perizinan->status_personalia=='1'){
						?>
						<i class="">Belum-Dikonfirmasi</i>
                    	<?php
						}else if($tbl_perizinan->status_personalia=='2'){
						?>                                
						<i class="">Disetujui</i>
						<?php
					    }else if($tbl_perizinan->status_personalia=='3'){
						?>
						<i class="">Ditolak</i>
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
                </tr>
            </table>
            </div>
            <button class="btn btn-warning" onclick="printDiv()"><b> PRINT </b></button>
        </div>
    </div>

    <script>
        function printDiv() {
            var printContents = document.getElementById("printableArea").innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;

            console.log("ditekan");
        }
    </script>
            </div>
					</div>
				</div>

			</div>
			<!-- /.container-fluid -->

			<!-- Sticky Footer -->
			<!-- < ?php $this->load->view("admin/_partials/footer.php") ?> -->

		</div>
		<!-- /.content-wrapper -->

	</div>
	<!-- /#wrapper -->


    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-8">
     <!-- /.panel -->
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-8 -->
        <div class="col-lg-4">
                <!-- /.panel .chat-panel -->
        </div>
        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

</div>
		<!-- /.container-fluid -->

		<!-- Sticky Footer -->
		<?php $this->load->view("partials/footer.php") ?>

</div>


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


$('#setuju').click(function() {
    var setuju = $('input[name="candidate_id"]').val();
    var url = 'Personalia/change_status_pers/';
    $.ajax({
        url: "Personalia/change_status_pers",
        type: 'POST',
        data: {'$setuju': $kd_surat},
        dataType: 'JSON',
        success: function(data) {    
             $('#setuju').text('FINISHED');
        }
    });
});

$('#tolak').click(function() {
    var tolak = $('input[name="candidate_id2"]').val();
    var url = 'Personalia/change_status_pers_pers_t/';
    $.ajax({
        url: "Personalia/change_status_pers_t",
        type: 'POST',
        data: {'$tolak': $kd_surat},
        dataType: 'JSON',
        success: function(data) {    
             $('#tolak').text('FINISHED');
        }
    });
});


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

$(function () {
    $("#table1").DataTable();
    $('#table2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });

</script>


</body>

</html>

