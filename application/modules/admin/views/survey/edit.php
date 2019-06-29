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
									<option value="0">BELUM</option>
									<option value="1">SUDAH</option>
								</select>
							</div>
							<div class="form-group">
								<label for="anggaran">APAKAH SUDAH DI ANGGARAN LEPTOP DI TAHUN ANGGARAN 2019 ?</label>
								<select name="anggaran" class="form-control">
									<option value="0">BELUM</option>
									<option value="1">SUDAH</option>
								</select>
							</div>
							<div class="form-group">
								<label for="surat">APAKAH OPERATOR SID SUDAH TAU KALO ADA SURAT KOORDINASI DARI DINAS TERKAIT KEPADA DESA, BAHWA OPERATOR SID DI WAJIBKAN UNTUK DI ANGGARKAN LEPTOP DI TAHUN ANGGARAN 2019???</label>
								<select name="surat" class="form-control">
									<option value="0">BELUM</option>
									<option value="1">SUDAH</option>
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
									<option value="0">BELUM</option>
									<option value="1">SUDAH</option>
								</select>
							</div>
							<div class="form-group">
								<label for="letak_jaringan">DIMANA LETAK JARINGAN WIFI ?</label>
								<select name="letak_jaringan" class="form-control">
									<option value="kantor kepala desa">KANTOR KEPALA DESA</option>
									<option value="rumah operator sid">RUMAH OPERATOR SID</option>
								</select>
							</div>
							<div class="form-group">
								<label for="sumber_biaya">DARI MANA BIAYA WIFI ?</label>
								<select name="sumber_biaya" class="form-control">
									<option value="anggaran desa">ANGGARAN DESA</option>
									<option value="anggaran pribadi">ANGGARAN PRIBADI</option>
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
									<option value="0">BELUM</option>
									<option value="1">SUDAH</option>
								</select>
							</div>
							<div class="form-group">
								<label for="skema">SKEMA LEGAL APAKAH YANG DI PAKE UNTUK HONOR OPERATOR SID ?</label>
								<select name="skema" class="form-control">
									<option value="perdes">PERDES</option>
									<option value="belum ada sk">BELUM ADA SK</option>
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
				<input type="text" name="desa" class="form-control">
			</div>
			<div class="form-group">
				<label for="kecamatan">KECAMATAN</label>
				<input type="text" name="kecamatan" class="form-control">
			</div>
			<div class="form-group">
				<label for="nama">NAMA</label>
				<input type="text" name="nama" class="form-control" placeholder="NAMA OPERATOR">
			</div>
			<div class="form-group">
				<label for="jabatan">JABATAN</label>
				<input type="text" name="jabatan" class="form-control">
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