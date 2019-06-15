<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!empty($data))
{
	$produk_desa = ['Tidak Ada','Ada'];
	?>
	<div class="panel panel-default card card-default">
		<div class="panel-heading card-header">
			Detail Potensi Desa Item <?php echo $data['item'] ?>
		</div>
		<div class="panel-body card-body">
			<div class="row">
				<div class="col-md-12">
					<div class="col-md-4">
						<table class="table table-striped table-hover">
							<tr>
								<td>Item</td>
								<td>:</td>
								<td><?php echo $data['item'] ?></td>
							</tr>
							<tr>
								<td>kategori</td>
								<td>:</td>
								<td><?php echo strtoupper($kategori[$data['kategori']]) ?></td>
							</tr>
							<tr>
								<td>produk desa</td>
								<td>:</td>
								<td><?php echo $produk_desa[$data['produk_desa']] ?></td>
							</tr>
							<tr>
								<td>Satuan</td>
								<td>:</td>
								<td><?php echo $satuan[$data['satuan']] ?></td>
							</tr>
							<tr>
								<td>volume</td>
								<td>:</td>
								<td><?php echo $data['volume']; ?></td>
							</tr>
							<tr>
								<td>waktu</td>
								<td>:</td>
								<td><?php echo $waktu[$data['waktu']];?></td>
							</tr>
						</table>
					</div>
					<div class="col-md-8">
						<div class="row">
							<div class="col-md-7">
								<table class="table table-hover table-striped">
									<!-- <thead>
										<tr>
											<th>Dokumentasi</th>
										</tr>
									</thead> -->
									<tbody>
										<tr>
											<td>
												<img src="<?php echo image_module('potensi_desa',$data['id'].'/'.$data['doc']) ?>" class="img img-responsive" style="object-fit: cover;width: 100%; min-height: 250px;">
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="panel-footer card-footer" style="text-align: right;">
			<a style="font-size: 9px;" href="https://www.dinsua.co.id">dinusa</a>
		</div>
	</div>
	<?php
}