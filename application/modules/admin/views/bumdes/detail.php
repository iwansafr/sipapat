<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php if ($status): ?>
	<div class="panel panel-default card card-default">
	  <div class="card card-header panel panel-heading">
	  	detail bumdes <?php echo $data['nama']?>
	  </div>
	  <div class="card card-body panel panel-body">
	  	<div class="row">
	  		<div class="col-md-6">
			    <div class="table-responsive">
			    	<table class="table table-hover table-striped ">
			    		<thead class="bg-aqua">
			    			<td colspan="2">DETAIL</td>
			    		</thead>
			    		<tbody>
			    			<tr>
			    				<td>NAMA</td>
			    				<td>: <?php echo $data['nama'] ?></td>
			    			</tr>
			    			<tr>
			    				<td>TGL BERDIRI</td>
			    				<td>: <?php echo content_date($data['tgl_berdiri']) ?></td>
			    			</tr>
			    			<tr>
			    				<td>NO PERDES</td>
			    				<td>: <?php echo $data['no_perdes'] ?></td>
			    			</tr>
			    			<tr>
			    				<td>NO PERKADES</td>
			    				<td>: <?php echo $data['no_perkades'] ?></td>
			    			</tr>
			    			<tr>
			    				<td>NO BADAN HUKUM</td>
			    				<td>: <?php echo $data['no_bdn_hkm'] ?></td>
			    			</tr>
			    			<tr>
			    				<td>NO REK BUMDES</td>
			    				<td>: <?php echo $data['no_rek_bumdes'] ?></td>
			    			</tr>
			    			<tr>
			    				<td>JANGKA WAKTU</td>
			    				<td>: <?php echo $data['jangka_waktu'] ?></td>
			    			</tr>
			    		</tbody>
			    	</table>
			    </div>
	  		</div>
	  		<div class="col-md-6">
			    <div class="table-responsive">
			    	<table class="table table-hover table-striped ">
			    		<thead class="bg-aqua">
			    			<td colspan="2">ALAMAT</td>
			    		</thead>
			    		<tbody>
			    			<?php if (is_array($data['alamat'])): ?>
				    			<?php foreach ($data['alamat'] as $key => $value): ?>
				    				<tr>
				    					<td><?php echo $key ?></td>
				    					<td>:<?php echo $value ?></td>
				    				</tr>
				    			<?php endforeach ?>
			    			<?php endif ?>
			    		</tbody>
			    	</table>
			    </div>
	  		</div>
	  		<?php if (!empty($data['pengurus'])): ?>
	  			<div class="col-md-6">
	  				<div class="table-responsive">
				    	<table class="table table-hover table-striped ">
				    		<thead class="bg-aqua">
				    			<td colspan="2">PENGURUS</td>
				    		</thead>
				    		<tbody>
				    			<?php if (is_array($data['pengurus'])): ?>
					    			<?php foreach ($data['pengurus'] as $key => $value): ?>
					    				<?php $pengurus = $value; ?>
											<tr>
												<td>KETUA</td>
												<td>: <?php echo $pengurus['ketua'] ?></td>
											</tr>
											<tr>
												<td>no hp ketua</td>
												<td>: <?php echo $pengurus['hp_ketua'] ?></td>
											</tr>
											<tr>
												<td>sekretaris</td>
												<td>: <?php echo $pengurus['sekretaris'] ?></td>
											</tr>
											<tr>
												<td>no hp sekretaris</td>
												<td>: <?php echo $pengurus['hp_sekretaris'] ?></td>
											</tr>
											<tr>
												<td>bendahara</td>
												<td>: <?php echo $pengurus['bendahara'] ?></td>
											</tr>
											<tr>
												<td>no hp bendahara</td>
												<td>: <?php echo $pengurus['hp_bendahara'] ?></td>
											</tr>
											<tr>
												<td>penasehat</td>
												<td>: <?php echo $pengurus['penasehat'] ?></td>
											</tr>
											<tr>
												<td>pengawas</td>
												<td></td>
											</tr>
											<?php if (!empty($pengurus['pengawas'])): ?>
												<?php $pengawas = explode("\n", $pengurus['pengawas']) ?>
												<?php foreach ($pengawas as $pgwskey => $pgwsvalue): ?>
													<tr>
														<td></td>
														<td><?php echo $pgwsvalue ?></td>
													</tr>
												<?php endforeach ?>
											<?php endif ?>
											<tr>
												<td>jenis usaha</td>
												<td>: <?php echo $pengurus['jenis_usaha'] ?></td>
											</tr>
											<tr>
												<td>kategori usaha</td>
												<td>: <?php echo $kategori[$pengurus['kategori_usaha']] ?></td>
											</tr>
											<tr>
												<td>tingkat pemeringkatan</td>
												<td>: <?php echo $tingkat_pemeringkatan[$pengurus['tingkat_pemeringkatan']] ?></td>
											</tr>
											<tr>
												<td>tahun</td>
												<td>: <?php echo $pengurus['tahun'] ?></td>
											</tr>

					    			<?php endforeach ?>
				    			<?php endif ?>
				    		</tbody>
				    	</table>
				    </div>
	  			</div>
	  		<?php endif ?>
	  	</div>
	  </div>
	  <div class="card-footer panel-footer">
	  </div>
	</div>
<?php endif ?>