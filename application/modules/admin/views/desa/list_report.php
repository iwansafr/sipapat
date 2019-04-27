<?php defined('BASEPATH') OR exit('No direct script access allowed');
if(empty($_GET['t']))
{
	?>
	<style type="text/css">
		#print-table{ color: #000; background: #fff; font-family: Verdana,Tahoma,Helvetica,sans-serif; font-size: 13px;}
		#print-table table tr td, #print-table table tr th{ border: 1px solid black; border-bottom: none; border-right: none; padding: 4px 8px 4px 4px}
		#print-table table{ border-bottom: 1px solid black; border-right: 1px solid black}
		#print-table table tr th{text-align: left;background: #ddd}
		#print-table table tr:nth-child(odd){background: #eee}
	</style>
	<?php
}
// header("Content-Type: application/vnd.ms-excel; charset=utf-8");
// header("Content-type: application/x-msexcel; charset=utf-8");
// header('Content-Disposition: attachment; filename=data-desa_'.time().'.xls');
// header("Expires: 0");
// header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
// header("Cache-Control: private",false);

// Redirect output to a client’s web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="data-desa_'.time().'.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0

$this->table->set_heading('no','kode','nama desa','kecamatan','kabupaten','provinsi','kode pos','nomor telepon','email','website','alamat balai desa');

$i = 1;
foreach ($desa as $key => $value) 
{
	$this->table->add_row($i,$value['kode'],$value['nama'],$value['kecamatan'],$value['kabupaten'],$value['provinsi'],$value['kode_pos'],$value['telepon'],$value['email'],$value['website'],$value['alamat']);
	$i++;
}
$template = array(
        'table_open'            => '<table width="100%" cellpadding="0" cellspacing="0">',

        'thead_open'            => '<thead>',
        'thead_close'           => '</thead>',

        'heading_row_start'     => '<tr>',
        'heading_row_end'       => '</tr>',
        'heading_cell_start'    => '<th>',
        'heading_cell_end'      => '</th>',

        'tbody_open'            => '<tbody>',
        'tbody_close'           => '</tbody>',

        'row_start'             => '<tr>',
        'row_end'               => '</tr>',
        'cell_start'            => '<td>',
        'cell_end'              => '</td>',

        'row_alt_start'         => '<tr>',
        'row_alt_end'           => '</tr>',
        'cell_alt_start'        => '<td>',
        'cell_alt_end'          => '</td>',

        'table_close'           => '</table>'
);
$this->table->set_template($template);
echo (empty($_GET['t'])) ? '<div id="print-table">' : '';
echo $this->table->generate();
echo (empty($_GET['t'])) ? '</div>' : '';