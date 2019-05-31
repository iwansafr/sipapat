<?php defined('BASEPATH') OR exit('No direct script access allowed');

class HtmlPdf
{
	public function __construct()
	{
		include_once APPPATH.'/third_party/fpdf/html2pdf.php';
	}
}