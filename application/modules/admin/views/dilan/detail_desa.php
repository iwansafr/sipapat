<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="panel panel-default">
	<div class="panel-heading">
		data penduduk
	</div>
	<div class="panel-body">
		<table class="table table-responsive table-bordered">
			<tr>
				<td>Total Penduduk</td>
				<td>: <?php echo $penduduk['penduduk'] ?></td>
			</tr>
			<tr>
				<td>total KK</td>
				<td>: <?php echo $penduduk['kk'] ?></td>
			</tr>
			<tr>
				<td>total PRIA</td>
				<td>: <?php echo $penduduk['pria'] ?></td>
			</tr>
			<tr>
				<td>total WANITA</td>
				<td>: <?php echo $penduduk['wanita'] ?></td>
			</tr>
			<?php $usia_chart_data = ''; ?>
			<?php foreach ($penduduk['usia'] as $key => $value): ?>
				<?php 
				$usia_chart_data .= "
				{
	        value    : {$value},
	        color    : '#f56954',
	        highlight: '#f56954',
	        label    : '{$key}'
	      },";
				?>
				<tr>
					<td>Usia <?php echo $key ?></td>
					<td>: <?php echo $value ?></td>
				</tr>
			<?php endforeach ?>
			<tr>
				<td>total Janda</td>
				<td>: <?php echo $penduduk['janda'] ?></td>
			</tr>
		</table>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="box box-danger">
		  <div class="box-header with-border">
		    <h3 class="box-title">Gender</h3>

		    <div class="box-tools pull-right">
		      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		      </button>
		      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		    </div>
		  </div>
		  <div class="box-body">
		    <canvas id="genderChart" style="height:250px"></canvas>
		  </div>
		  <!-- /.box-body -->
		</div>
	</div>
	<div class="col-md-6">
		<div class="box box-danger">
		  <div class="box-header with-border">
		    <h3 class="box-title">Usia</h3>

		    <div class="box-tools pull-right">
		      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		      </button>
		      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		    </div>
		  </div>
		  <div class="box-body">
		    <canvas id="usiaChart" style="height:250px"></canvas>
		  </div>
		  <!-- /.box-body -->
		</div>
	</div>
</div>
<?php
$legend_template = '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>';
$script = "
$(function(){
    var pieChartCanvas = $('#genderChart').get(0).getContext('2d')
    var pieChart       = new Chart(pieChartCanvas)
    var PieData        = [
      {
        value    : {$penduduk['pria']},
        color    : '#f56954',
        highlight: '#f56954',
        label    : 'Laki-laki'
      },
      {
        value    : {$penduduk['wanita']},
        color    : '#00a65a',
        highlight: '#00a65a',
        label    : 'Perempuan'
      }
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

    var pieChartCanvas = $('#usiaChart').get(0).getContext('2d')
    var pieChart       = new Chart(pieChartCanvas)
    var PieData        = [
      {$usia_chart_data}
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

})";
$this->esg->add_script($script);
?>