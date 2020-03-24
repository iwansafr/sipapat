<?php defined('BASEPATH') OR exit('No direct script access allowed');
$public_template = $this->esg->get_esg('templates')['public_template'];
if(is_dir(FCPATH.'application/modules/home/views/templates/'.$public_template))
{
	$base_url_name = str_replace('/','_', base_url());
  $site_title = $base_url_name.'_site';
  $logo_title = $base_url_name.'_logo';
  $site['site'] = $this->esg->get_config($site_title);
  $site['logo'] = $this->esg->get_config($logo_title);
  if(!empty($site['logo'])){
  	$site['logo']['module'] = $logo_title;
    $this->esg->set_esg('logo',$site['logo']);
  }else{
  	$site['logo']['module'] = 'logo';
  }
  if(!empty($site['site']))
  {
  	$site['site']['module'] = $site_title;
    $this->esg->set_esg('site',$site['site']);
  }else{
  	$site['site']['module'] = 'site';
  }

	$this->load->view('templates'.DIRECTORY_SEPARATOR.$public_template.DIRECTORY_SEPARATOR.'index', $this->esg->get_esg());
}else{
	$this->load->view('home/error', ['msg'=>'templates not found']);
}