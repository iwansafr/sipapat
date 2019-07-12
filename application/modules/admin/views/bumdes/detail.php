<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
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
		    			<tr>
		    				<td>PENASEHAT</td>
		    				<td>: <?php echo $data['penasehat'] ?></td>
		    			</tr>
		    			<tr>
		    				<td>JENIS USAHA</td>
		    				<td>: <?php echo $data['jenis_usaha'] ?></td>
		    			</tr>
		    			<tr>
		    				<td>KATEGORI USAHA</td>
		    				<td>: <?php echo $kategori_usaha[$data['kategori_usaha']] ?></td>
		    			</tr>
		    			<tr>
		    				<td>TINGKAT PEMERINGKATAN</td>
		    				<td>: <?php echo $tingkat_pemeringkatan[$data['tingkat_pemeringkatan']] ?></td>
		    			</tr>
		    			<tr>
		    				<td>TAHUN</td>
		    				<td>: <?php echo $data['tahun'] ?></td>
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
		    <div class="table-responsive">
		    	<table class="table table-hover table-striped ">
		    		<thead class="bg-aqua">
		    			<td colspan="2">PENGURUS</td>
		    		</thead>
		    		<tbody>
		    			<?php if (is_array($data['pengurus'])): ?>
			    			<?php foreach ($data['pengurus'] as $key => $value): ?>
			    				<tr>
			    					<td><?php echo $key ?></td>
			    					<td>:<?php echo $value ?></td>
			    				</tr>
			    			<?php endforeach ?>
		    			<?php endif ?>
		    		</tbody>
		    	</table>
		    </div>
		    <div class="table-responsive">
		    	<table class="table table-hover table-striped ">
		    		<thead class="bg-aqua">
		    			<td colspan="2">PENGAWAS</td>
		    		</thead>
		    		<tbody>
		    			<?php if (is_array($data['pengawas'])): ?>
			    			<?php foreach ($data['pengawas'] as $key => $value): ?>
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
  	</div>
  </div>
  <div class="card-footer panel-footer">
  </div>
</div>