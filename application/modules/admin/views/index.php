<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->esg->check_login();
// pr($this->esg->get_esg());die();
$data = array(
						'title' => 'sipapat',
						'keyword' => 'software development',
						'description' => 'PT media nusa perkasa',
						'developer' => 'esoftgreat',
						'author' => 'esoftgreat',
						'email' => 'iwan@esoftgreat.com , iwansafr@gmail.com',
						'phone' => '6285640510460',
						'icon' => base_url('images/icon.png'),
					);
$this->esg_model->set_meta($data);
$this->load->view('templates'.DIRECTORY_SEPARATOR.$this->esg->get_esg('templates')['admin_template'].DIRECTORY_SEPARATOR.'index', $this->esg->get_esg());