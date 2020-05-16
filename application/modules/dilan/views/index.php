<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sistem Terintergrasi Kabupaten Pati</title>
	<?php $this->load->view('meta') ?>
	<style>
		/*#myVideo {
		  position: fixed;
		  right: 0;
		  bottom: 0;
		  min-width: 100%;
		  min-height: 100%;
		  z-index: -9;
		}*/
	</style>
</head>
<body>
	<!-- <video autoplay muted loop id="myVideo">
	  <source src="<?php echo base_url('images/tech_play.mp4') ?>" type="video/mp4">
	  Your browser does not support HTML5 video.
	</video> -->
	<?php
	$data = [];
	$user = $this->session->userdata(base_url('_logged_in'));
	if(!empty($user))
	{
		$data['user'] = $user;
	}
	$mod['name'] = $this->router->fetch_class();
	$mod['task'] = $this->router->fetch_method();
	$mod['content'] = $mod['name'].'/'.$mod['task'] == 'dilan/index' ? 'home' : $mod['name'].'/'.$mod['task'];
	if($mod['content'] != 'home')
	{
		$this->load->view('menu_top',$data);
	}
	$this->load->view($mod['content'],$data);
	?>
	<?php $this->load->view('js') ?>
</body>
</html>