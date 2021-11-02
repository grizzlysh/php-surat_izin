<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <?php $this->load->view("partials/head.php") ?>

  <style>
#chartdiv {
  width: 100%;
  height: 500px;
}

</style>
</head>
<body>

<div id="wrapper">
<?php $this->load->view("partials/sidebarA.php") ?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12"> 
            <h1 class="page-header"><i class="glyphicon glyphicon-home"></i> Home</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-tasks fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $total ?></div>
                            <div>Month's permission!</div>
                        </div>
                    </div>
                </div>
                <!-- <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a> -->
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-file fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $aktif ?></div>
                            <div>Today's permission!</div>
                        </div>
                    </div>
                </div>
                <!-- <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a> -->
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-envelope fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $atasan ?></div>
                            <div>Waiting approval!</div>
                        </div>
                    </div>
                </div>
                <!-- <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a> -->
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-bell fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $personalia ?></div>
                            <div>Waiting approval HRD!</div>
                        </div>
                    </div>
                </div>
                <!-- <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a> -->
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> Status Atasan Hari Ini
                    <div class="pull-right">
                       
                    </div>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div id="pie-a"></div>
                </div>
                <!-- /.panel-body -->
            </div>
        </div>
        
        <div class="col-lg-6 col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> Pengajuan Izin Bulan Ini
                    <div class="pull-right">
                       
                    </div>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div id="chart-today"></div>
                    <!-- <div id="chartdiv"></div> -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>

        <div class="col-lg-3 col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> Status HRD Hari Ini
                    <div class="pull-right">
                       
                    </div>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div id="pie-h"></div>
                </div>
                <!-- /.panel-body -->
            </div>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> Perbandingan Izin Tahun Ini
                    <div class="pull-right">
                        
                    </div>
                </div>
                    <!-- /.panel-heading -->
                <div class="panel-body">
                    <div id="chartdiv"></div>
                </div>
                    <!-- /.panel-body -->
            </div>
        </div>
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

<?php $this->load->view("partials/js.php") ?>

<script>

        Morris.Area({
          element: 'chart-today',
          data: [<?php echo $row;?>],
          xkey: 'hari',
          parseTime: false,
          ykeys: ['n'],
          labels: ['Jumlah']
        });

        Morris.Donut({
            element: 'pie-a',
            data: [<?php echo $pieA;?>]
        });

        Morris.Donut({
            element: 'pie-h',
            data: [<?php echo $pieH;?>]
        });



        am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            var chart = am4core.create("chartdiv", am4charts.PieChart3D);
            chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

            chart.data = [<?php echo $chartH;?>
            ];
            

            chart.innerRadius = am4core.percent(40);
            chart.depth = 120;

            
            chart.legend = new am4charts.Legend();

            var series = chart.series.push(new am4charts.PieSeries3D());
            series.dataFields.value = "litres";
            series.dataFields.depthValue = "litres";
            series.dataFields.category = "bulan";
            series.slices.template.cornerRadius = 5;
            series.colors.step = 3;

            
            var label = series.createChild(am4core.Label);
            label.text = "{values.value.sum}";
            label.horizontalCenter = "middle";
            label.verticalCenter = "middle";
            label.fontSize = 40;

        }); // end am4core.ready()

</script>

</body>

</html>