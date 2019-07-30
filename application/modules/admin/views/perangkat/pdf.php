<?php
pr($_SESSION);
if($pdf->Output()){
	msg('terima kasih sudah mendownload data dari sipapat');
}