<?php defined('BASEPATH') OR exit('No direct script access allowed');

?>
<form action="" method="post" enctype="multipart/form-data">
	<input type="file" name="doc">
	<button type="submit">Upload</button>
</form>

<?php
if(!empty($_FILES))
{
	?>
	<div class="progress progress-md active" id="dilan_load">
    <div id="dilan_pro" class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
      <span class="sr-only" id="dilan_span">0% Complete</span>
    </div>
  </div>
  <div class="progress progress-md active" id="dilan_success_load">
    <div id="dilan_success_pro" class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
      <span class="sr-only" id="dilan_span">0% Complete</span>
    </div>
  </div>
	<?php
}

?>