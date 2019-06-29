<?php defined('BASEPATH') OR exit('No direct script access allowed');
if (!empty($msg)) 
{
	msg($msg['msg'],$msg['status']);
}
?>

<form action="" method="post">
	<div class="panel panel-default card card-default">
		<div class="panel-heading card-heding">
			radar survey
		</div>
		<div class="panel-body card-body">

			<div class="card-group panel-group">
				<div class="panel panel-default card card-default">
					<div class="panel-heading card-header">
						<h6 class="card-title panel-title m-0 font-weight-bold text-primary">
							<a data-toggle="collapse" href="#laptop" class="collapsed" aria-expanded="false">PERTANYAAN LAPTOP KHUSUS SID</a>
						</h6>
					</div>
					<div id="laptop" class="card-collapse panel-collapse collapse" aria-expanded="false" style="height: 0px;">
						<div class="card-body panel-body">
							<div class="form-group">
								<label for="laptop">APAKAH OPERATOR SID SUDAH PUNYA LEPTOP ?</label>
								<select name="laptop" class="form-control">
									<option value="0" <?php echo (empty(@$data['laptop'])) ? 'selected' : ''; ?>>BELUM</option>
									<option value="1" <?php echo (!empty(@$data['laptop'])) ? 'selected' : ''; ?>>SUDAH</option>
								</select>
							</div>
							<div class="form-group">
								<label for="anggaran">APAKAH SUDAH DI ANGGARAN LEPTOP DI TAHUN ANGGARAN 2019 ?</label>
								<select name="anggaran" class="form-control">
									<option value="0" <?php echo (empty(@$data['anggaran'])) ? 'selected' : ''; ?>>BELUM</option>
									<option value="1" <?php echo (!empty(@$data['anggaran'])) ? 'selected' : ''; ?>>SUDAH</option>
								</select>
							</div>
							<div class="form-group">
								<label for="surat">APAKAH OPERATOR SID SUDAH TAU KALO ADA SURAT KOORDINASI DARI DINAS TERKAIT KEPADA DESA, BAHWA OPERATOR SID DI WAJIBKAN UNTUK DI ANGGARKAN LEPTOP DI TAHUN ANGGARAN 2019???</label>
								<select name="surat" class="form-control">
									<option value="0" <?php echo (empty(@$data['surat'])) ? 'selected' : ''; ?>>BELUM</option>
									<option value="1" <?php echo (!empty(@$data['surat'])) ? 'selected' : ''; ?>>SUDAH</option>
								</select>
							</div>
							<div class="card-footer panel-footer">Panel Footer</div>
						</div>
					</div>
				</div>
			</div>

			<div class="card-group panel-group">
				<div class="panel panel-default card card-default">
					<div class="panel-heading card-header">
						<h6 class="card-title panel-title m-0 font-weight-bold text-primary">
							<a data-toggle="collapse" href="#wifi" class="collapsed" aria-expanded="false">PERTANYAAN WIFI SID</a>
						</h6>
					</div>
					<div id="wifi" class="card-collapse panel-collapse collapse" aria-expanded="false" style="height: 0px;">
						<div class="card-body panel-body">
							<div class="form-group">
								<label for="wifi">APAKAH DESA SUDAH MEMPUNYAI WIFI?</label>
								<select name="wifi" class="form-control">
									<option value="1" <?php echo (!empty(@$data['wifi'])) ? 'selected' : ''; ?>>SUDAH</option>
									<option value="0" <?php echo (empty(@$data['wifi'])) ? 'selected' : ''; ?>>BELUM</option>
								</select>
							</div>
							<div class="form-group">
								<label for="letak_jaringan">DIMANA LETAK JARINGAN WIFI ?</label>
								<select name="letak_jaringan" class="form-control">
									<option value="kantor kepala desa" <?php echo (@$data['letak_jaringan']=='kantor kepala desa') ? 'selected' : ''; ?>>KANTOR KEPALA DESA</option>
									<option value="rumah operator sid" <?php echo (@$data['letak_jaringan']=='rumah operator sid') ? 'selected' : ''; ?>>RUMAH OPERATOR SID</option>
								</select>
							</div>
							<div class="form-group">
								<label for="sumber_biaya">DARI MANA BIAYA WIFI ?</label>
								<select name="sumber_biaya" class="form-control">
									<option value="anggaran desa" <?php echo (@$data['sumber_biaya']=='anggaran desa') ? 'selected' : ''; ?>>ANGGARAN DESA</option>
									<option value="anggaran pribadi" <?php echo (@$data['sumber_biaya']=='anggaran pribadi') ? 'selected' : ''; ?>>ANGGARAN PRIBADI</option>
								</select>
							</div>
							<div class="card-footer panel-footer">Panel Footer</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="card-group panel-group">
				<div class="panel panel-default card card-default">
					<div class="panel-heading card-header">
						<h6 class="card-title panel-title m-0 font-weight-bold text-primary">
							<a data-toggle="collapse" href="#honor" class="collapsed" aria-expanded="false">PERTANYAAN HONOR SID</a>
						</h6>
					</div>
					<div id="honor" class="card-collapse panel-collapse collapse" aria-expanded="false" style="height: 0px;">
						<div class="card-body panel-body">
							<div class="form-group">
								<label for="honor">APAKAH OPERATOR SID DAPAT HONOR DARI DESA ?</label>
								<select name="honor" class="form-control">
									<option value="0" <?php echo (empty(@$data['honor'])) ? 'selected' : ''; ?>>BELUM</option>
									<option value="1" <?php echo (!empty(@$data['honor'])) ? 'selected' : ''; ?>>SUDAH</option>
								</select>
							</div>
							<div class="form-group">
								<label for="skema">SKEMA LEGAL APAKAH YANG DI PAKE UNTUK HONOR OPERATOR SID ?</label>
								<select name="skema" class="form-control">
									<option value="perdes" <?php echo (@$data['skema']=='perdes') ? 'selected' : ''; ?>>PERDES</option>
									<option value="belum ada sk" <?php echo (@$data['skema']=='belum ada sk') ? 'selected' : ''; ?>>BELUM ADA SK</option>
								</select>
							</div>
							<div class="card-footer panel-footer">Panel Footer</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<label for="nb">
					NB : METODE SURVE INI DI JAWAB DENGAN SEBENAR-BENAR’NYA OLEH
				</label>
			</div>
			<div class="form-group">
				<label for="desa">DESA</label>
				<input type="text" name="desa" disabled class="form-control" value="<?php echo @$desa['nama'] ?>">
			</div>
			<div class="form-group">
				<label for="kecamatan">KECAMATAN</label>
				<input type="text" name="kecamatan" disabled class="form-control" value="<?php echo @$desa['kecamatan'] ?>">
			</div>
			<div class="form-group">
				<label for="nama">NAMA</label>
				<input type="text" name="nama" class="form-control" placeholder="NAMA OPERATOR" value="<?php echo @$data['nama'] ?>">
			</div>
			<div class="form-group">
				<label for="jabatan">JABATAN</label>
				<input type="text" name="jabatan" class="form-control" placeholder="JABATAN PENGISI SURVEY" value="<?php echo @$data['jabatan'] ?>">
			</div>

		</div>
		<div class="panel-footer card-footer">
			<div class="form-inline">
				<button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Submit</button>
				<button type="reset" class="btn btn-warning"><i class="fa fa-undo"></i> Reset</button>
			</div>
		</div>
	</div>
</form>