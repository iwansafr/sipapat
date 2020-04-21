<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="panel panel-default">
  <div class="panel-heading">
    rekap data Perangkat Desa
  </div>
  <div class="panel-body">
    <div class="table-responsive">
      <table class="table table-hover">
      	<tr>
      		<td>usia > 45 Tahun</td>
      		<td>:</td>
      		<td style="text-align: right;"><span style="font-weight: bold;"><?php echo number_format($data['old'],0,'.','.'); ?></span> Orang</td>
      	</tr>
      	<tr>
      		<td>usia < 46 Tahun</td>
      		<td>:</td>
      		<td style="text-align: right;"><span style="font-weight: bold;"><?php echo number_format($data['young'],0,'.','.'); ?></span> Orang</td>
      	</tr>
      	<tr>
      		<td>usia Tidak Valid</td>
      		<td>:</td>
      		<td style="text-align: right;"><span style="font-weight: bold;"><?php echo number_format($data['age_n_valid'],0,'.','.'); ?></span> Orang</td>
      	</tr>
      	<tr>
      		<td>Tidak Sekolah</td>
      		<td>:</td>
      		<td style="text-align: right;"><span style="font-weight: bold;"><?php echo number_format($data['tidak_sekolah'],0,'.','.'); ?></span> Orang</td>
      	</tr>
      	<tr>
      		<td>Sekolah</td>
      		<td>:</td>
      		<td style="text-align: right;"><span style="font-weight: bold;"><?php echo number_format($data['sekolah'],0,'.','.'); ?></span> Orang</td>
      	</tr>
      </table>
    </div>
  </div>
  <div class="panel-footer">
    
  </div>
</div>