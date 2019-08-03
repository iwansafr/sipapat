<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!is_kecamatan())
{
	?>
	<div class="container">
		<a class="btn btn-warning" href="<?php echo base_url('admin/posyantekdes') ?>"><i class="fa fa-backward"></i> kembali</a>
		<div class="panel panel-default card card-default">
			<div class="panel-heading card-header">
				detail posyantekdes
			</div>
			<div class="panel-body card-header">
				<div class="col-md-12">
					<div class="col-md-6">
						<div class="panel panel-success card card-success">
							<div class="panel-heading card-header">
								<h5>posyantekdes</h5>
							</div>
							<div class="panel-body card-body">
								<table class="table table-hover">
									<?php
									foreach ($posyantekdes as $key => $value)
									{
										?>
										<tr>
											<td><?php echo str_replace('_',' ',$key) ?></td>
											<td>: <?php echo $value ?></td>
										</tr>
										<?php
									}?>
								</table>
							</div>
							<div class="panel-footer card-footer">
								
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="panel panel-success card card-success">
							<div class="panel-heading card-header">
								<h5>Alamat</h5>
							</div>
							<div class="panel-body card-body">
								<table class="table table-hover">
									<?php
									foreach ($alamat as $key => $value)
									{
										?>
										<tr>
											<td><?php echo str_replace('_',' ',$key) ?></td>
											<td>: <?php echo $value ?></td>
										</tr>
										<?php
									}?>
								</table>
							</div>
							<div class="panel-footer card-footer">
								
							</div>
						</div>
					</div>					
				</div>
				<div class="col-md-12">
					<div class="panel panel-warning card card-warning">
						<div class="panel-heading card-heading">
							<h5>pengurus</h5>
						</div>
						<div class="panel-body card-body">
							<?php foreach ($pengurus as $key => $value): ?>
								<div class="col-md-6">
									<div class="panel panel-primary card card-primary">
										<div class="panel-heading">
											<h5><?php echo $jabatan[$value['jabatan']] ?></h5>
										</div>
										<div class="panel-body card-body">
											<table class="table table-hover">
												<tr>
													<td>nama</td>
													<td>: <?php echo $value['nama'] ?></td>
												</tr>
												<tr>
													<td>no hp</td>
													<td>: <?php echo $value['hp'] ?></td>
												</tr>
												<tr>
													<td>domisili</td>
													<td>: <?php echo $value['domisili'] ?></td>
												</tr>
												<tr>
													<td>sk</td>
													<td>:<?php echo $value['sk'] ?></td>
												</tr>
											</table>
										</div>
										<div class="panel-footer card-footer">
											
										</div>
									</div>
								</div>
							<?php endforeach ?>
						</div>
						<div class="panel-footer card-footer">
							
						</div>
					</div>
				</div>
			</div>
			<div class="panel-footer card-footer">
				
			</div>
		</div>
	</div>
	<?php
}
