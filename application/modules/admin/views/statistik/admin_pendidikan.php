<?php
$this->esg->add_js(base_url('templates/AdminLTE/bower_components/chart.js/Chart.js'));
$form = new Zea();
$form->init('roll');
$form->setTable('statistik_penduduk');
$form->addInput('id','plaintext');
$form->addInput('desa_id','dropdown');
$form->tableOptions('desa_id','desa','id','nama');
$form->setLabel('desa_id','desa');
$form->setAttribute('desa_id','disabled');

$form->addInput('tidak_belum_sekolah','plaintext');
$form->setLabel('tidak_belum_sekolah','Jumlah Warga Tidak / Belum Sekolah');

$form->addInput('tidak_tamat_sd','plaintext');
$form->setLabel('tidak_tamat_sd','Jumlah Warga Tidak Tamat SD');

$form->addInput('tamat_sd','plaintext');
$form->setLabel('tamat_sd','Jumlah Warga Tamat / Lulus SD');

$form->addInput('sltp','plaintext');
$form->setLabel('sltp','Jumlah Warga Tamat / Lulus SLTP');

$form->addInput('slta','plaintext');
$form->setLabel('slta','Jumlah Warga Tamat / Lulus SLTA');

$form->addInput('d1_d2','plaintext');
$form->setLabel('d1_d2','Jumlah Warga Tamat / Lulus D1 - D2');

$form->addInput('d3','plaintext');
$form->setLabel('d3','Jumlah Warga Tamat / Lulus D3 / Sarjana Muda');

$form->addInput('s1','plaintext');
$form->setLabel('s1','Jumlah Warga Sarjana');

$form->addInput('s2','plaintext');
$form->setLabel('s2','Jumlah Warga Pasca Sarjana');

$form->addInput('s3','plaintext');
$form->setLabel('s3','Jumlah Warga Dengan Gelar S3 / Doktor');

$form->setDataTable();
$form->form();

$statistik = $this->statistik_model->getStatistikPendidikan();
?>
<div class="box">
    <div class="box-header with-border">
      <h5 class="box-title">Statistik</h5>
    </div>
    <div class="box-body">
        <table class="table table-responsive">
            <?php
            $pendidikan_chart_data = '';
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
                    $pendidikan_chart_data .= "
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
            <h3 class="box-title">Statistik Pendidikan</h3>
    
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
            </div>
            <div class="box-body">
            <canvas id="pendidikanChart" style="height:250px"></canvas>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
<?php
$legend_template = '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>';
$script = "
$(function(){
    var pieChartCanvas = $('#pendidikanChart').get(0).getContext('2d')
    var pieChart       = new Chart(pieChartCanvas)
    var PieData        = [
      {$pendidikan_chart_data}
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