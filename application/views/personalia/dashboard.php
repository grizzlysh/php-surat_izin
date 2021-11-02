<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <?php $this->load->view("partials/head.php") ?>
</head>
<body>

<div id="wrapper">
<?php // $this->load->view("partials/sidebar.php") ?>

<div id="page-wrapper-u">
    <div class="row">
        <div class="col-md"> 
            <h1 class="page-header text-center"><i class="glyphicon glyphicon-home"></i> Request Izin</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <!-- <div class="row"> -->
        <div class="panel panel-default">
            <!-- <div class="panel-heading">
                Pill Tabs
            </div> -->
            <!-- /.panel-heading -->
            <div class="panel-body">
                <!-- Nav tabs -->
                <ul class="nav nav-pills nav-justified">
                    <li class="active">
                        <a href="#home-pills" data-toggle="tab"><i class="glyphicon glyphicon-edit"></i> Pengajuan </a>
                    </li>
                    <li>
                        <a href="#profile-pills" data-toggle="tab"><i class="glyphicon glyphicon-eye-open"></i> Tracking</a>
                    </li>
                    <li>
                        <a href="#messages-pills" data-toggle="tab"><i class="glyphicon glyphicon-question-sign"></i> FAQ</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="home-pills">
                        <?php $this->load->view('isi_pengajuan.php'); ?>
                    </div>
                    <div class="tab-pane fade" id="profile-pills">
                        <?php $this->load->view('isi_track.php'); ?>
                    </div>
                    
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    <!-- </div> -->
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

    <?php $this->load->view("partials/js.php") ?>

</body>
<script>

    $("#btn_izin").click(function(){

        var kd_izin = $("input[name='kd_izin']").val();
        var nik = $("input[name='nik']").val();
        var nama = $("input[name='nama']").val();
        var dept = $("input[name='dept']").val();
        var sub_dept = $("input[name='sub_dept']").val();
        var seksi = $("input[name='seksi']").val();
        var email = $("input[name='email']").val();
        var atasan = $("input[name='atasan']").val();
        var jam = $("input[name='jam']").val();
        var jenis = $("input[name='jenis']").val();
        var alasan = $("input[name='alasan']").val();

        $.ajax({
        url: 'http://localhost/s_ali/User/add',
        type: 'POST',
        data: {kd_izin: kd_izin, nik: nik, nama: nama, dept: dept, sub_dept: sub_dept, seksi: seksi,
                email: email, atasan: atasan, jam: jam, jenis: jenis, alasan: alasan},
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {
                $("tbody").append("<tr><td>"+kd_izin+"</td><td>"+nik+"</td></tr>");
                alert("Record added successfully");  
        }
        });


    });

    $("#btn_track").click(function(){

    var nizin = $("input[name='nizin']").val();

    $.ajax({
    url: 'http://localhost/s_ali/User/tracking',
    type: 'POST',
    data: {nizin: nizin},
    dataType: 'json',
    error: function() {
        alert('Something is wrong');
    },
    success: function(data) {
        // $.each(data, function(index, element) {
        //     $('#modal-body').append($('<div>', {
        //         text: element.data
        //     }));
        // });
        console.log(data);
        $("#modal-body").append(data);
    }
    });


    });
</script>
</html>