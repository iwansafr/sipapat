<?php
$this->load->view('admin/statistik/menu');
$this->esg->add_js(base_url('templates/AdminLTE/bower_components/chart.js/Chart.js'));
$statistik = $this->statistik_model->getStatistikFasPem();
?>
<div class="box">
    <div class="box-header with-border">
      <h5 class="box-title">Statistik</h5>
    </div>
    <div class="box-body">
        <table class="table table-responsive table-striped">
            <?php
            $chart_data = '';
            $color =
					[
						'#f44336',
						'#e91e63',
						'#9c27b0',
						'#673ab7',
						'#3f51b5',
						'#2196f3',
						'#03a9f4',
						'#00bcd4',
						'#009688',
						'#4caf50',
						'#cddc39',
						'#ffeb3b',
						'#ffc107',
						'#ff9800'
					];
            $i = 0;
            foreach ($statistik as $data) {
                foreach ($data as $key => $value) {
                    $chart_data .= "
						{
                            value    : {$value},
                            color    : '{$color[$i]}',
                            highlight: '{$color[$i]}1',
                            label    : '{$key}'
                        },";
                    $i++;
                    ?>
                    <tr>
                        <td><?php echo $key;?></td>
                        <td><?php echo $value;?></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class="box-header with-border">
            <h3 class="box-title">Statistik Fasilitas Pemerintahan</h3>
    
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
            </div>
            <div class="box-body">
            <canvas id="dataChart" style="height:250px"></canvas>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
<?php
$legend_template = '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>';
$script = "
$(function(){
    var pieChartCanvas = $('#dataChart').get(0).getContext('2d')
    var pieChart       = new Chart(pieChartCanvas)
    var PieData        = [
      {$chart_data}
    ]
    var pieOptions     = {
      segmentShowStroke    : true,
      segmentStrokeColor   : '#fff',
      segmentStrokeWidth   : 2,
      percentageInnerCutout: 50,
      animationSteps       : 100,
      animationEasing      : 'easeOutBounce',
      animateRotate        : true,
      animateScale         : false,
      responsive           : true,
      maintainAspectRatio  : true,
      legendTemplate       : '{$legend_template}'
    }
    pieChart.Doughnut(PieData, pieOptions);

})
";
$this->esg->add_script($script);