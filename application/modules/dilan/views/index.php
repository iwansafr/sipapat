<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sistem Terintergrasi Kabupaten Pati</title>
	<?php $this->load->view('meta') ?>
</head>
<body>
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
	$this->load->view('menu_top',$data);
	$this->load->view($mod['content'],$data);
	?>
	<?php $this->load->view('js') ?>
</body>
</html>