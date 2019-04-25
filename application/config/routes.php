<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller']               = 'admin';
$route['images']                           = 'home/e';
$route['admin/content']                    = 'admin/content/list';
$route['admin/user']                       = 'admin/user/list';
$route['admin/config']                     = 'admin/config/templates';
$route['admin/config/widget/logo']         = 'admin/config/logo';
$route['admin/config/widget/contact']      = 'admin/config/contact';
$route['admin/config/widget/header']       = 'admin/config/header';
$route['admin/content/list/edit']          = 'admin/content/edit';
$route['admin/category']                   = 'admin/content/category';
$route['admin/content/category/list']      = 'admin/content/list';
$route['admin/content/category/list/edit'] = 'admin/content/edit';
$route['search']                           = 'home/content/list';
$route['content']                          = 'home/content/list';
$route['content/popular']                  = 'home/content/list';
$route['404_override']                     = 'home/e';
$route['(:any).html']                      = 'home/content/detail';
$route['category/(:any).html']             = 'home/content/list';
$route['tag/(:any).html']                  = 'home/content/list';
$route['message/send']                     = 'home/message/send';
$route['subscribe']                        = 'home/subscribe';
$route['content/pdf/(:any)']               = 'home/content/pdf';
$route['translate_uri_dashes']             = FALSE;
