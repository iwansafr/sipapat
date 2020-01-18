<?php defined('BASEPATH') OR exit('No direct script access allowed');
$base_url = 'http://localhost/esg_templates/one-night/';
if(@$_SERVER['SERVER_NAME'] == 'localhost')
{
  $base_url = 'http://localhost/esg_templates/one-night/';
}else{
  $base_url = 'https://templates.esoftgreat.com/one-night/';
}
?>
<script src="<?php echo @$base_url;?>/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo @$base_url;?>/vendor/bootstrap/js/bootstrap.min.js"></script>