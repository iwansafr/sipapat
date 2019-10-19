<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="panel panel-default card card-default">
	<?php if (empty($_GET['s'])): ?>
		<a href="?s=print" target="_blank" class="pull-right btn btn-default btn-sm"><i class="fa fa-print"></i> Cetak</a>
	<?php endif ?>
	<div class="panel-heading card-header">
		Detail <?php echo $product['title'] ?>
	</div>
	<div class="panel-body card-body">
		<table class="table table-hovered">
			<tr>
				<td>nama</td>
				<td>: <?php echo @$product['title'] ?></td>
			</tr>
			<tr>
				<td>kategori</td>
				<td>: <?php echo @$category['title'] ?></td>
			</tr>
			<tr>
				<td>harga</td>
				<td>: <?php echo @$product['price'] ?></td>
			</tr>
			<tr>
				<td>gambar</td>
				<td>: 
					<div style="margin: 0 2% 0 2%; padding: 0 2% 0 2%;">
						<img class="img-responsive img-fluid" src="<?php echo image_module('bumdes_product', @$product['id'].'/'.@$product['image']) ?>" alt=""></td>
					</div>
			</tr>
			<tr>
				<td>nomor ijin</td>
				<td>: <?php echo @$product['license_number'] ?></td>
			</tr>
			<tr>
				<td>hp</td>
				<td>: <?php echo @$product['hp'] ?></td>
			</tr>
			<tr>
				<td>berat</td>
				<td>: <?php echo @$product['weight'] ?>Kg</td>
			</tr>
			<tr>
				<td>volume</td>
				<td>: Tinggi <?php echo $product['height'] ?> Cm, Lebar <?php echo $product['width'] ?> Cm, Panjang <?php echo $product['length'] ?> Cm</td>
			</tr>
			<tr>
				<td>deskripsi</td>
				<td>: <?php echo @$product['description'] ?></td>
			</tr>
		</table>
	</div>
	<div class="panel-footer card-footer">
		
	</div>
</div>