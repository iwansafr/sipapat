SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


DROP TABLE IF EXISTS `admin_menu`;
CREATE TABLE `admin_menu` (
  `id` int(11) NOT NULL,
  `par_id` int(11) DEFAULT NULL,
  `user_role_ids` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `icon` varchar(45) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT '1',
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `admin_menu` (`id`, `par_id`, `user_role_ids`, `title`, `icon`, `link`, `sort_order`, `created`, `updated`) VALUES
(1, 0, ',1,2,3,', 'Dashboard', 'fa fa-tachometer-alt', '/', 1, '2019-03-30 03:05:59', '2019-03-30 03:29:18'),
(2, 0, ',1,2,3,', 'Content', 'fa fa-file-alt', '/content', 2, '2019-03-30 03:24:19', '2019-03-31 23:06:51'),
(3, 2, ',1,2,3,', 'Category', 'fa fa-list', '/content/category', 21, '2019-03-30 03:26:22', '2019-04-01 05:48:07'),
(4, 2, ',1,2,3,', 'Add Content', 'fa fa-pencil-alt', '/content/edit', 22, '2019-03-30 03:35:27', '2019-04-01 05:48:07'),
(5, 2, ',1,2,3,', 'Content List', 'fa fa-list', '/content/list', 23, '2019-03-30 03:35:44', '2019-04-01 05:48:07'),
(6, 2, ',1,2,3,', 'Tag', 'fa fa-list', '/content/tag', 24, '2019-03-30 03:36:06', '2019-04-01 05:48:07'),
(7, 0, ',1,2,3,', 'Gallery', 'fa fa-images', '/gallery', 3, '2019-03-31 22:53:29', '2019-04-01 05:47:53'),
(8, 7, ',1,2,3,', 'Images', 'fa fa-image', '/gallery', 31, '2019-03-31 22:53:57', '2019-04-01 06:01:57'),
(9, 0, ',1,2,', 'User', 'fa fa-user', '/user', 4, '2019-03-31 22:54:25', '2019-04-01 05:47:53'),
(10, 9, ',1,2,', 'User List', 'fa fa-dot-circle', '/user/list', 41, '2019-03-31 22:55:32', '2019-04-01 06:02:10'),
(11, 9, ',1,2,', 'User Edit', 'fa fa-dot-circle', '/user/edit', 42, '2019-03-31 22:58:48', '2019-04-01 06:02:10'),
(12, 9, ',1,', 'User Role', 'fa fa-dot-circle', '/user/role', 43, '2019-03-31 22:59:13', '2019-04-01 06:02:10'),
(13, 0, ',1,2,', 'Menu', 'fa fa-list', '/menu', 5, '2019-03-31 22:59:33', '2019-04-01 05:47:53'),
(14, 13, ',1,2,', 'Add Menu', 'fa fa-pencil-alt', '/menu/edit', 51, '2019-03-31 22:59:58', '2019-04-01 06:02:26'),
(15, 13, ',1,2,', 'Menu List', 'fa fa-pencil-alt', '/menu/list', 52, '2019-03-31 23:00:18', '2019-04-01 06:02:26'),
(16, 13, ',1,2,', 'Menu Position', 'fa fa-list', '/menu/position', 53, '2019-03-31 23:00:37', '2019-04-01 06:02:26'),
(17, 0, ',1,', 'Admin Menu', 'fa fa-list', '/admin_menu', 6, '2019-03-31 23:01:10', '2019-04-01 05:47:53'),
(18, 17, ',1,', 'Add Menu', 'fa fa-pencil-alt', '/admin_menu/edit', 61, '2019-04-01 05:45:00', '2019-04-01 06:02:42'),
(19, 17, ',1,', 'Menu List', 'fa fa-list', '/admin_menu/list', 62, '2019-04-01 05:45:20', '2019-04-01 06:02:42'),
(20, 17, ',1,', 'Menu Parent', 'fa fa-list', '/admin_menu/list?id=0', 63, '2019-04-01 05:46:00', '2019-04-01 06:02:42'),
(21, 0, ',1,2,', 'Data', 'fa fa-database', '/visitor', 7, '2019-04-01 05:46:34', '2019-04-01 05:47:53'),
(22, 21, ',1,2,', 'Visitor', 'fa fa-chart-bar', '/visitor', 71, '2019-04-01 05:46:56', '2019-04-01 06:02:51'),
(23, 0, ',1,2,', 'Configuration', 'fa fa-cog', '/config', 8, '2019-04-01 06:03:37', '2019-04-01 06:04:01'),
(24, 23, ',1,2,', 'Logo', 'fa fa-cog', '/config/logo', 81, '2019-04-01 06:04:28', '2019-04-01 06:08:52'),
(25, 23, ',1,2,', 'Site', 'fa fa-cog', '/config/site', 82, '2019-04-01 06:04:41', '2019-04-01 06:08:52'),
(26, 23, ',1,2,', 'Templates', 'fa fa-cog', '/config/templates', 83, '2019-04-01 06:04:57', '2019-04-01 06:08:52'),
(27, 23, ',1,2,', 'Contact', 'fa fa-cog', '/config/contact', 84, '2019-04-01 06:05:14', '2019-04-01 06:08:52'),
(28, 23, ',1,2,', 'Style', 'fa fa-cog', '/config/style', 86, '2019-04-01 06:06:52', '2019-04-06 01:38:22'),
(29, 23, ',1,2,', 'Script', 'fa fa-cog', '/config/script', 87, '2019-04-01 06:07:29', '2019-04-06 01:38:22'),
(30, 21, ',1,2,', 'Backup', 'fa fa-download', '/backup', 87, '2019-04-01 06:08:04', '2019-04-05 23:06:08'),
(31, 21, ',1,2,', 'Restore', 'fa fa-upload', '/restore', 88, '2019-04-01 06:08:15', '2019-04-05 23:06:14'),
(32, 21, ',1,2,', 'Delete Cache', 'fa fa-trash', '/config/delete_cache', 89, '2019-04-04 00:08:10', '2019-04-05 23:06:19'),
(33, 21, ',1,2,', 'Invoice', 'fa fa-money', '/invoice', 1, '2019-04-05 23:07:23', '2019-04-05 23:07:23'),
(34, 23, ',1,2,', 'Bank Account', 'fa fa-user', '/config/bank_account', 85, '2019-04-06 01:37:09', '2019-04-06 01:38:22'),
(35, 23, ',1,', 'Dashboard', 'fa fa-chart-bar', '/config/dashboard', 88, '2019-04-19 18:37:39', '2019-04-19 18:40:30'),
(36, 0, ',1,2,3,', 'Desa', 'fa fa-list', '/admin/desa', 1, '2019-04-25 16:43:34', '2019-04-25 16:43:34'),
(37, 36, ',1,2,3,', 'Data Desa', 'fa fa-list', '/desa/list', 1, '2019-04-25 16:44:04', '2019-04-25 16:48:00'),
(38, 36, ',1,2,3,', 'Tambah Desa', 'fa fa-plus', '/desa/edit', 1, '2019-04-25 16:44:21', '2019-04-25 16:48:16');

DROP TABLE IF EXISTS `bank_account`;
CREATE TABLE `bank_account` (
  `id` int(11) UNSIGNED NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `person_name` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `bank_number` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `bank_account` (`id`, `bank_name`, `person_name`, `icon`, `bank_number`, `created`, `updated`) VALUES
(1, 'BCA', 'Iwan Safrudin', 'icon_BCA.png', '0312609779', '2019-04-14 16:18:57', '2019-04-14 16:18:58'),
(2, 'BNI', 'Iwan Safrudin', 'icon_BNI.png', '0813920638', '2019-04-14 16:19:55', '2019-04-14 16:19:55');

DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `par_id` int(11) NOT NULL,
  `module` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=content,2=product',
  `module_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `username` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=unread, 1=read',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `value` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `config` (`id`, `name`, `value`) VALUES
(1, 'templates', '{\"public_template\":\"comodo\",\"admin_template\":\"AdminLTE\"}'),
(2, 'site', '{\"title\":\"esoftgreat\",\"link\":\"https:\\/\\/www.esoftgreat.com\",\"image\":\"image_esoftgreat_1545189785.png\",\"keyword\":\"software developmet, jasa pembuatan website, jepara, murah, mudah, cepat, ramah, aplikasi android, ios app, jasa pembuatan aplikasi android, jasa pembuatan ios app, web designer, web programmer, web developer,  web administrator, web master\",\"description\":\"jasa pembuatan berbagai macam jenis website, aplikasi android dan juga ios app, kami juga melayani konsultasi masalah bisnis anda di bidang teknologi informasi, custom sistem maupun web custom sesuai kebutuhan anda\",\"year\":\"2015\",\"lang\":\"id\"}'),
(3, 'logo', '{\"title\":\"esoftgreat\",\"image\":\"image_sarwabimbel_1546913142.png\",\"width\":\"200\",\"height\":\"50\"}'),
(4, 'one-night_widget', '{\"template\":\"one-night\",\"menu_top\":{\"content\":\"1\"},\"content_slider\":{\"content\":\"latest\",\"limit\":\"7\"},\"content_hot\":{\"content\":\"latest\",\"limit\":\"7\"},\"content_top\":{\"content\":\"latest\",\"limit\":\"7\"},\"content\":{\"content\":\"latest\",\"limit\":\"7\"},\"content_bottom\":{\"content\":\"latest\",\"limit\":\"7\"},\"right\":{\"content\":\"1\",\"limit\":\"7\"},\"menu_right\":{\"content\":\"1\"},\"right_extra\":{\"content\":\"2\",\"limit\":\"7\"},\"menu_bottom_1\":{\"content\":\"2\"},\"menu_bottom_2\":{\"content\":\"2\"},\"menu_bottom_3\":{\"content\":\"2\"},\"menu_footer\":{\"content\":\"2\"}}'),
(5, 'contact', '{\"name\":\"esoftgreat\",\"description\":\"jasa pembuatan website dan software. sesuai kebutuhan dan keinginan anda\",\"address\":\"Jl Tulakan Km 1 \\r\\nDukuh Krajan \\r\\nDesa Tulakan Rt 06\\/02 \\r\\nKec Donorojo Kab Jepara \\r\\nJawa Tengah\\r\\nKode Pos 59454\",\"phone\":\"+6285290335332\",\"wa\":\"6285290335332\",\"email\":\"info@esoftgreat.com\",\"google\":\"https:\\/\\/plus.google.com\\/115611472723876300931\",\"facebook\":\"https:\\/\\/web.facebook.com\\/esoftgreat\\/\",\"twitter\":\"https:\\/\\/twitter.com\",\"instagram\":\"https:\\/\\/instagram.com\",\"linkedin\":\"https:\\/\\/linkedin.com\",\"wordpress\":\"https:\\/\\/esoftgreat.wordrpress.com\",\"yahoo\":\"\",\"youtube\":\"https:\\/\\/www.youtube.com\\/channel\\/UC7QNxh1R6eo3mO2hRJtj6xw?view_as=subscriber\"}'),
(6, 'header', '{\"image\":\"image_Selamat_Datang_di_Esoftgreat_1547957588.jpeg\",\"title\":\"Selamat Datang di Esoftgreat\",\"description\":\"JASA PEMBUATAN WEBSITE, DESAIN, ARTIKEL SEO, SOSIAL MEDIA MARKETING\"}'),
(7, 'Avilon_widget', '{\"template\":\"Avilon\",\"menu_top\":{\"content\":\"1\"},\"content_thumbnail\":{\"content\":\"4\",\"limit\":\"3\"},\"content_hot\":{\"content\":\"5\",\"limit\":\"1\"},\"content_top\":{\"content\":\"6\",\"limit\":\"4\"},\"content\":{\"content\":\"7\",\"limit\":\"3\"},\"content_banner\":{\"content\":\"8\",\"limit\":\"1\"},\"content_bottom\":{\"content\":\"9\",\"limit\":\"4\"},\"content_brand\":{\"content\":\"10\",\"limit\":\"10\"},\"content_pricing\":{\"content\":\"11\",\"limit\":\"3\"},\"content_question\":{\"content\":\"12\",\"limit\":\"7\"},\"content_team\":{\"content\":\"13\",\"limit\":\"6\"},\"content_gallery\":{\"content\":\"14\",\"limit\":\"6\"},\"content_payment\":{\"content\":\"0\",\"limit\":\"7\"},\"menu_bottom\":{\"content\":\"0\"}}'),
(8, 'Avilon_script', '{\"script\":\"<!-- Go to www.addthis.com\\/dashboard to customize your tools -->\\r\\n<!-- <script type=\\\"text\\/javascript\\\" src=\\\"\\/\\/s7.addthis.com\\/js\\/300\\/addthis_widget.js#pubid=ra-5c2b7a98a617a916\\\"><\\/script> -->\"}'),
(9, 'Avilon_style', '{\"style\":\"<style>\\r\\n.credit{\\r\\npadding-bottom: 10px;\\r\\n}\\r\\n.product-screens img{\\r\\n border-radius: 25px;\\r\\n}\\r\\n#clients img{\\r\\n max-height: 150px;\\r\\n}\\r\\n#clients .col-md-4{\\r\\n text-align: center;\\r\\n}\\r\\n<\\/style>\\r\\n<!-- Global site tag (gtag.js) - Google Analytics -->\\r\\n<script async src=\\\"https:\\/\\/www.googletagmanager.com\\/gtag\\/js?id=UA-113848816-1\\\"><\\/script>\\r\\n<script>\\r\\n  window.dataLayer = window.dataLayer || [];\\r\\n  function gtag(){dataLayer.push(arguments);}\\r\\n  gtag(\'js\', new Date());\\r\\n\\r\\n  gtag(\'config\', \'UA-113848816-1\');\\r\\n<\\/script>\\r\\n<script async src=\\\"\\/\\/pagead2.googlesyndication.com\\/pagead\\/js\\/adsbygoogle.js\\\"><\\/script>\\r\\n<script>\\r\\n  (adsbygoogle = window.adsbygoogle || []).push({\\r\\n    google_ad_client: \\\"ca-pub-3145506515429478\\\",\\r\\n    enable_page_level_ads: true\\r\\n  });\\r\\n<\\/script>\"}'),
(10, 'dashboard', '{\"icon\":{\"bank_account\":\"fa fa-chart-bar\",\"comment\":\"fa fa-chart-bar\",\"content\":\"fa fa-chart-bar\",\"content_cat\":\"fa fa-chart-bar\",\"content_tag\":\"fa fa-chart-bar\",\"invoice\":\"fa fa-chart-bar\",\"menu\":\"fa fa-chart-bar\",\"menu_position\":\"fa fa-chart-bar\",\"message\":\"fa fa-chart-bar\",\"product\":\"fa fa-chart-bar\",\"product_cat\":\"fa fa-chart-bar\",\"product_tag\":\"fa fa-chart-bar\",\"user\":\"fa fa-chart-bar\",\"user_login\":\"fa fa-chart-bar\",\"user_role\":\"fa fa-chart-bar\",\"visitor\":\"fa fa-chart-bar\"},\"link\":{\"bank_account\":\"\\/admin\\/bank_account\",\"comment\":\"\",\"content\":\"\\/admin\\/content\\/list\",\"content_cat\":\"\\/admin\\/content\\/category\",\"content_tag\":\"\\/admin\\/content\\/tag\",\"invoice\":\"\\/admin\\/invoice\",\"menu\":\"\\/admin\\/menu\\/list\",\"menu_position\":\"\\/admin\\/menu\\/position\",\"message\":\"\\/admin\\/message\",\"product\":\"\",\"product_cat\":\"\",\"product_tag\":\"\",\"user\":\"\\/admin\\/user\\/list\",\"user_login\":\"\",\"user_role\":\"\\/admin\\/user\\/role\",\"visitor\":\"\\/admin\\/visitor\"},\"publish_row\":[\"bank_account\",\"content\",\"content_cat\",\"content_tag\",\"invoice\",\"menu\",\"menu_position\",\"message\",\"user\",\"user_role\",\"visitor\"],\"color_row\":{\"bank_account\":\"#1d53d6\",\"comment\":\"#1b27aa\",\"content\":\"#d9de35\",\"content_cat\":\"#1fd628\",\"content_tag\":\"#643f7f\",\"invoice\":\"#844465\",\"menu\":\"#347f43\",\"menu_position\":\"#9c4b95\",\"message\":\"#b55da4\",\"product\":\"#78753e\",\"product_cat\":\"#c5c560\",\"product_tag\":\"#737c29\",\"user\":\"#ad7852\",\"user_login\":\"#6d5f91\",\"user_role\":\"#27799a\",\"visitor\":\"#2b6173\"}}'),
(11, 'comodo_widget', '{\"template\":\"comodo\",\"menu_top\":{\"content\":\"1\"},\"content_top\":{\"content\":\"3\",\"limit\":\"1\"},\"content\":{\"content\":\"3\",\"limit\":\"1\"},\"content_oval\":{\"content\":\"14\",\"limit\":\"4\"},\"content_tab_1\":{\"content\":\"14\",\"limit\":\"1\"},\"content_tab_2\":{\"content\":\"3\",\"limit\":\"1\"},\"content_tab_3\":{\"content\":\"7\",\"limit\":\"1\"},\"content_gallery\":{\"content\":\"14\",\"limit\":\"6\"},\"content_testimonial\":{\"content\":\"12\",\"limit\":\"7\"},\"content_pricing\":{\"content\":\"11\",\"limit\":\"3\"},\"content_faq\":{\"content\":\"12\",\"limit\":\"7\"},\"content_blog\":{\"content\":\"19\",\"limit\":\"7\"},\"menu_bottom_1\":{\"content\":\"1\"},\"menu_bottom_2\":{\"content\":\"1\"},\"menu_bottom_3\":{\"content\":\"1\"},\"menu_bottom_4\":{\"content\":\"1\"},\"menu_footer\":{\"content\":\"1\"}}'),
(12, 'comodo_style', '{\"style\":\"<style>\\r\\n.header_area{\\r\\n background: #222d32;\\r\\n}\\r\\n<\\/style>\"}');

DROP TABLE IF EXISTS `content`;
CREATE TABLE `content` (
  `id` int(11) NOT NULL,
  `cat_ids` mediumtext NOT NULL,
  `tag_ids` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `intro` varchar(255) NOT NULL,
  `content` mediumtext NOT NULL,
  `source` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `image_link` varchar(255) NOT NULL,
  `images` text NOT NULL,
  `document` text NOT NULL,
  `author` varchar(255) NOT NULL,
  `hits` int(11) NOT NULL,
  `last_hits` datetime NOT NULL,
  `rating` varchar(255) NOT NULL,
  `params` text NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `publish` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `content` (`id`, `cat_ids`, `tag_ids`, `title`, `slug`, `description`, `keyword`, `intro`, `content`, `source`, `image`, `icon`, `image_link`, `images`, `document`, `author`, `hits`, `last_hits`, `rating`, `params`, `created`, `updated`, `publish`) VALUES
(1, ',1,', ',1,2,', 'Hello World', 'hello-world', 'Hello World\r\n', 'Hello World', 'Hello World\r\n', '<p>Hello World</p>\r\n', '', 'image_Hello_World_1541950550.png', '', '', '[\"images_Hello_World_0_1541950550.png\",\"images_Hello_World_1_1541950550.png\"]', '', 'admin', 21, '0000-00-00 00:00:00', '', '', '2018-11-11 22:35:50', '2019-04-18 00:49:34', 1),
(2, ',3,', '', 'Admin mobile view', 'admin-mobile-view', 'Admin Mobile View', 'Admin Mobile View', 'admin mobile view', '<p>admin mobile view</p>\r\n', '', 'image_Admin_mobile_view_1545795804.png', '', '', '', '', 'root', 0, '0000-00-00 00:00:00', '', '', '2018-12-26 10:36:27', '2018-12-26 10:43:24', 1),
(3, ',3,', '', 'Admin Mobile Menu', 'admin-mobile-menu', 'admin-mobile-menu', 'Admin Mobile Menu', 'admin-mobile-menu', '<p>admin-mobile-menu</p>\r\n', '', 'image_Admin_Mobile_Menu_1545795819.png', '', '', '', '', 'root', 0, '0000-00-00 00:00:00', '', '', '2018-12-26 10:40:05', '2018-12-26 10:43:39', 1),
(4, ',3,', '', 'Admin Mobile Add Content', 'admin-mobile-add-content', 'admin-mobile-add-content', 'Admin Mobile Add Content', 'admin-mobile-add-content', '<p>admin-mobile-add-content</p>\r\n', '', 'image_Admin_Mobile_Add_Content_1545795832.png', '', '', '', '', 'root', 2, '0000-00-00 00:00:00', '', '', '2018-12-26 10:40:42', '2019-04-24 21:52:23', 1),
(5, ',4,', '', 'Admin Home Mobile', 'admin-home-mobile', '', 'Admin Home Mobile', '', '', '', 'image_Admin_Home_Mobile_1545796095.png', '', '', '', '', 'root', 0, '0000-00-00 00:00:00', '', '', '2018-12-26 10:48:15', '2018-12-26 10:48:15', 1),
(6, ',4,', '', 'Admin Menu View', 'admin-menu-view', '', 'Admin Menu View', '', '', '', 'image_Admin_Menu_View_1545796116.png', '', '', '', '', 'root', 0, '0000-00-00 00:00:00', '', '', '2018-12-26 10:48:36', '2018-12-26 10:48:36', 1),
(7, ',4,', '', 'Admin Content View', 'admin-content-view', '', 'Admin Content View', '', '', '', 'image_Admin_Content_View_1545796126.png', '', '', '', '', 'root', 0, '0000-00-00 00:00:00', '', '', '2018-12-26 10:48:46', '2018-12-26 10:48:46', 1),
(8, ',5,', '', 'esoftgreat', 'esoftgreat', 'Kami membuat website yang menerapkan aplikasi-aplikasi terkini serta fitur-fitur unggul. Tim programmer, designer dan content writer kami siap membantu Anda membangun website yang tidak hanya responsive tetapi juga user friendly sesuai kebutuhan usaha And', 'esoftgreat', 'Kami membuat website yang menerapkan aplikasi-aplikasi terkini serta fitur-fitur unggul. Tim programmer, designer dan content writer kami siap membantu Anda membangun website yang tidak hanya responsi', '<p>Kami membuat website yang menerapkan aplikasi-aplikasi terkini</p>\r\n\r\n<p>serta fitur-fitur unggul.</p>\r\n\r\n<p>Tim programmer</p>\r\n\r\n<p>designer dan content writer kami siap membantu Anda</p>\r\n\r\n<p>membangun website yang tidak hanya responsive</p>\r\n\r\n<p>tetapi juga user friendly sesuai kebutuhan usaha Anda.</p>\r\n', '', 'image_esoftgreat_1545796504.jpg', '', '', '', '', 'root', 26, '0000-00-00 00:00:00', '', '', '2018-12-26 10:54:15', '2019-04-18 00:49:06', 1),
(9, ',6,', '', 'Development Apps', 'development-apps', 'Kami berpengalaman menciptakan dan menyediakan kebutuhan teknologi aplikasi berbasis Website, Mobile Android, IoS dan Windows Phone untuk bisnis Anda.\r\n', 'Development Apps', 'Kami berpengalaman menciptakan dan menyediakan kebutuhan teknologi aplikasi berbasis Website, Mobile Android, IoS dan Windows Phone untuk bisnis Anda.\r\n', '<p>Kami berpengalaman menciptakan dan menyediakan kebutuhan teknologi aplikasi berbasis Website, Mobile Android, IoS dan Windows Phone untuk bisnis Anda.</p>\r\n', '', '', 'fa-cog', '', '', '', 'root', 40, '0000-00-00 00:00:00', '', '', '2018-12-26 11:02:45', '2019-04-18 00:48:51', 1),
(10, ',6,', '', 'Outsource', 'outsource', 'Ciptakan team IT sesuai pilihan dan keinginan Anda sendiri. Kami sudah berpengalaman dalam menyediakan dedicated team yang khusus mengerjakan project yang Anda butuhkan.\r\n', 'Outsource', 'Ciptakan team IT sesuai pilihan dan keinginan Anda sendiri. Kami sudah berpengalaman dalam menyediakan dedicated team yang khusus mengerjakan project yang Anda butuhkan.\r\n', '<p>Ciptakan team IT sesuai pilihan dan keinginan Anda sendiri. Kami sudah berpengalaman dalam menyediakan dedicated team yang khusus mengerjakan project yang Anda butuhkan.</p>\r\n', '', '', 'fa-user', '', '', '', 'root', 41, '0000-00-00 00:00:00', '', '', '2018-12-26 11:04:04', '2019-04-18 00:48:49', 1),
(11, ',6,', '', 'IoT', 'iot', 'Temukan peluang bisnis dengan device yang terhubung internet. Kami memiliki tim yang handal dalam menyediakan solusi IoT mulai penyedia device, konsultasi dan implementasi.\r\n', 'IoT', 'Temukan peluang bisnis dengan device yang terhubung internet. Kami memiliki tim yang handal dalam menyediakan solusi IoT mulai penyedia device, konsultasi dan implementasi.\r\n', '<p>Temukan peluang bisnis dengan device yang terhubung internet. Kami memiliki tim yang handal dalam menyediakan solusi IoT mulai penyedia device, konsultasi dan implementasi.</p>\r\n', '', '', 'fa-fax', '', '', '', 'esoftgreat', 50, '0000-00-00 00:00:00', '', '', '2018-12-26 11:05:28', '2019-04-18 00:48:48', 1),
(12, ',6,', '', 'Digital Strategy', 'digital-strategy', 'Tim kami terdiri dari tenaga ahli yaitu management consultants, brand strategists, communication planners, service design experts, search and social strategists serta political consultants.\r\n', 'Digital Strategy', 'Tim kami terdiri dari tenaga ahli yaitu management consultants, brand strategists, communication planners, service design experts, search and social strategists serta political consultants.\r\n', '<p>Tim kami terdiri dari tenaga ahli yaitu management consultants, brand strategists, communication planners, service design experts, search and social strategists serta political consultants.</p>\r\n', '', '', 'fa-server', '', '', '', 'root', 36, '0000-00-00 00:00:00', '', '', '2018-12-26 11:07:35', '2019-04-18 00:48:44', 1),
(13, ',11,16,', '', 'Paket Complete', 'paket-complete', 'paket complete pembuatan website murah', 'Paket Complete', 'paket complete pembuatan website murah', '<h4><sup>Rp.</sup>1.550.000</h4>\r\n\r\n<ul>\r\n	<li><i class=\"ion-android-checkmark-circle\"></i>Custom Menu</li>\r\n	<li><i class=\"ion-android-checkmark-circle\"></i>Custom Aticle</li>\r\n	<li><i class=\"ion-android-checkmark-circle\"></i>Custom Color</li>\r\n	<li><i class=\"ion-android-checkmark-circle\"></i>Custom background</li>\r\n	<li><i class=\"ion-android-checkmark-circle\"></i>Custom logo</li>\r\n	<li><i class=\"ion-android-checkmark-circle\"></i>Custom slider</li>\r\n	<li><i class=\"ion-android-checkmark-circle\"></i>Custom banner</li>\r\n	<li><i class=\"ion-android-checkmark-circle\"></i>Click to WA</li>\r\n	<li><i class=\"ion-android-checkmark-circle\"></i>Custom Template</li>\r\n	<li><i class=\"ion-android-checkmark-circle\"></i>Custom Category</li>\r\n	<li><i class=\"ion-android-checkmark-circle\"></i>Custom User</li>\r\n	<li><i class=\"ion-android-checkmark-circle\"></i>SSL</li>\r\n	<li><i class=\"ion-android-checkmark-circle\"></i>email domain</li>\r\n</ul>', '<h4><sup>Rp.</sup>1.550.000</h4>\r\n\r\n<ul>\r\n	<li><i class=\"ion-android-checkmark-circle\"></i>Custom Menu</li>\r\n	<li><i class=\"ion-android-checkmark-circle\"></i>Custom Aticle</li>\r\n	<li><i class=\"ion-android-checkmark-circle\"></i>Custom Color</li>\r\n	<li><i class=\"ion-android-checkmark-circle\"></i>Custom background</li>\r\n	<li><i class=\"ion-android-checkmark-circle\"></i>Custom logo</li>\r\n	<li><i class=\"ion-android-checkmark-circle\"></i>Custom slider</li>\r\n	<li><i class=\"ion-android-checkmark-circle\"></i>Custom banner</li>\r\n	<li><i class=\"ion-android-checkmark-circle\"></i>Click to WA</li>\r\n	<li><i class=\"ion-android-checkmark-circle\"></i>Custom Template</li>\r\n	<li><i class=\"ion-android-checkmark-circle\"></i>Custom Category</li>\r\n	<li><i class=\"ion-android-checkmark-circle\"></i>Custom User</li>\r\n	<li><i class=\"ion-android-checkmark-circle\"></i>SSL</li>\r\n	<li><i class=\"ion-android-checkmark-circle\"></i>email domain</li>\r\n</ul>', '', '', '', '', '', 'esoftgreat', 28, '0000-00-00 00:00:00', '', '', '2018-12-27 08:04:16', '2019-04-18 00:49:52', 1),
(14, ',11,16,', '', 'Paket Middle End', 'paket-middle-end', 'paket menengah website murah', 'Paket Middle End', 'paket menengah website murah', '<h4><sup>Rp.</sup>1.000.000</h4>\r\n\r\n<ul>\r\n	<li>Custom Menu</li>\r\n	<li>Custom Aticle</li>\r\n	<li>Custom Color</li>\r\n	<li>Custom background</li>\r\n	<li>Custom logo</li>\r\n	<li>Custom slider</li>\r\n	<li>Custom banner</li>\r\n	<li>Click to WA</li>\r\n	<li>Custom Template</li>\r\n	<li>Custom Category</li>\r\n	<li>Custom User</li>\r\n	<li>SSL</li>\r\n	<li>email domain</li>\r\n</ul>\r\n', '<h4><sup>Rp</sup>1.000.000</h4>\r\n<ul>\r\n	<li><i class=\"ion-android-checkmark-circle\"></i>Custom Menu</li>\r\n	<li><i class=\"ion-android-checkmark-circle\"></i>Custom Aticle</li>\r\n	<li><i class=\"ion-android-checkmark-circle\"></i>Custom Color</li>\r\n	<li><i class=\"ion-android-checkmark-circle\"></i>Custom background</li>\r\n	<li><i class=\"ion-android-checkmark-circle\"></i>Custom logo</li>\r\n	<li><i class=\"ion-android-checkmark-circle\"></i>Custom slider</li>\r\n	<li><i class=\"ion-android-checkmark-circle\"></i>Custom banner</li>\r\n	<li><i class=\"ion-android-checkmark-circle\"></i>Click to WA</li>\r\n	<li><i class=\"ion-android-checkmark-circle\"></i>Custom Template</li>\r\n	<li><i class=\"ion-android-checkmark-circle\"></i>Custom Category</li>\r\n	<li><i class=\"ion-android-checkmark-circle\"></i>Custom User</li>\r\n	<li><i class=\"fa fa-close\"></i>SSL</li>\r\n	<li><i class=\"fa fa-close\"></i>email domain</li>\r\n</ul>', '', '', '', '', '', 'esoftgreat', 21, '0000-00-00 00:00:00', '', '', '2018-12-27 08:04:53', '2019-04-18 00:49:51', 1),
(15, ',11,16,', ',7,11,', 'Paket Basic', 'paket-basic', 'paket web basic murah yang ada di jepara', 'Paket Basic', 'paket basic pembuatan website murah', '<h4><sup>Rp</sup>750.000</h4>\r\n\r\n<ul>\r\n	<li>Custom Menu</li>\r\n	<li>Custom Aticle</li>\r\n	<li>Custom Color</li>\r\n	<li>Custom background</li>\r\n	<li>Custom logo</li>\r\n	<li>Custom slider</li>\r\n	<li>Custom banner</li>\r\n	<li>Click to WA</li>\r\n	<li>Custom Template</li>\r\n	<li>Custom Category</li>\r\n	<li>Custom User</li>\r\n	<li>SSL</li>\r\n	<li>email domain</li>\r\n</ul>\r\n', '<h4><sup>Rp</sup>750.000</h4>\r\n<ul>\r\n	<li><i class=\"ion-android-checkmark-circle\"></i>Custom Menu</li>\r\n	<li><i class=\"ion-android-checkmark-circle\"></i>Custom Aticle</li>\r\n	<li><i class=\"ion-android-checkmark-circle\"></i>Custom Color</li>\r\n	<li><i class=\"ion-android-checkmark-circle\"></i>Custom background</li>\r\n	<li><i class=\"ion-android-checkmark-circle\"></i>Custom logo</li>\r\n	<li><i class=\"ion-android-checkmark-circle\"></i>Custom slider</li>\r\n	<li><i class=\"ion-android-checkmark-circle\"></i>Custom banner</li>\r\n	<li><i class=\"ion-android-checkmark-circle\"></i>Click to WA</li>\r\n	<li><i class=\"fa fa-close\"></i>Custom Template</li>\r\n	<li><i class=\"fa fa-close\"></i>Custom Category</li>\r\n	<li><i class=\"fa fa-close\"></i>Custom User</li>\r\n	<li><i class=\"fa fa-close\"></i>SSL</li>\r\n	<li><i class=\"fa fa-close\"></i>email domain</li>\r\n</ul>', '', '', '', '', '', 'esoftgreat', 39, '0000-00-00 00:00:00', '', '', '2018-12-27 08:05:16', '2019-04-19 14:09:10', 1),
(22, ',5,', ',14,4,5,6,7,', 'tentang esoftgreat', 'tentang-esoftgreat', 'esoftgreat adalah sebuah software development dan sekaligus IT consultant yang menyediakan jasa pembuatan berbagai macam jenis software dari yang simpel hingga yang kompleks ataupun jasa konsultasi&nbsp;di bidang IT.\r\n\r\nkami bekerja dengan sepenuh hati, a', 'tentang esoftgreat', 'esoftgreat adalah sebuah software development dan sekaligus IT consultant yang menyediakan jasa pembuatan berbagai macam jenis software dari yang simpel hingga yang kompleks ataupun jasa konsultasi&nb', '<p><a href=\"https://www.esoftgreat.com\">esoftgreat</a> adalah sebuah software development dan sekaligus IT consultant yang menyediakan jasa pembuatan berbagai macam jenis software dari yang simpel hingga yang kompleks ataupun jasa konsultasi&nbsp;di bidang IT.</p>\r\n\r\n<p>kami bekerja dengan sepenuh hati, akurasi dan ketelitian dalam mengerjakan setiap project yang kami pegang. kami selalu mengutamakan membuat aplikasi multiplatform, setiap aplikasi yang kami buat akan bisa di akses melalui berbagai device dari handphone, tab, hingga laptop dan komputer desktop. itu semua kami terapkan guna memenuhi kebetuhan para pelaku bisnis agar fleksibel dalam memonitor usaha mereka.</p>\r\n\r\n<p><a href=\"https://www.esoftgreat.com\">esoftgreat</a> tidaklah membuat software dengan cara yang instan sekali klik jadi ataupun menggunakan software template dari internet yang gratis lalu dijual lagi.</p>\r\n\r\n<p><a href=\"https://www.esoftgreat.com\">esoftgreat</a> membangun software dari dasar. karena kami <a href=\"https://www.esoftgreat.com\">esoftgreat</a> telah menciptakan core software buatan <a href=\"https://www.esoftgreat.com\">esoftgreat</a> sendiri yang aman, fleksibel, tangguh serta mampu mengejar kemajuan teknologi di abad ini. dengan perencanaan yang matang dan penelitian yang matang pula kami menyajikan core software kami untuk menyalurkan ide anda, mimpi anda agar menjadi nyata.</p>\r\n\r\n<p>mari bermitra dengan esoftgreat. wujudkan impian anda dan kita taklukan dunia.</p>\r\n\r\n<p>kami <a href=\"https://www.esoftgreat.com\">esoftgreat</a>, <strong>lets make something great</strong></p>\r\n', '', '', '', 'https://www.master.esoftgreat.com/images/modules/content/8/image_esoftgreat_1545796504.jpg', '', '', 'esoftgreat', 63, '0000-00-00 00:00:00', '', '', '2018-12-29 09:28:02', '2019-04-18 00:48:43', 1),
(23, ',8,', ',8,9,10,1,', 'Blogger to Website', 'blogger-to-website', 'punya blogspot ingin merubah linknya ke website seperti .com .co.id .org .id dsb tapi tetap blogger admin&nbsp;? serahkan pada esoftgreat\r\n', 'Blogger to Website', 'punya blogspot ingin merubah linknya ke website seperti .com .co.id .org .id dsb tapi tetap blogger admin&nbsp;? serahkan pada esoftgreat\r\n', '<p>punya blogspot ingin merubah linknya ke website seperti .com .co.id .org .id dsb tapi tetap blogger admin&nbsp;? serahkan pada esoftgreat</p>\r\n', '', '', '', 'https://www.blogger.com/about/img/social/facebook-1200x630.jpg', '', '', 'esoftgreat', 58, '0000-00-00 00:00:00', '', '', '2018-12-29 09:37:55', '2019-04-18 15:04:22', 1),
(24, ',7,', '', 'Pantau Perkembangan Website Anda', 'pantau-perkembangan-website-anda', 'Pantau perkembangan website anda dengan mudah kapanpun dan dimanapun anda berada, karena esoftgreat membuat admin panel ramah digunakan di mobile phone seperti android maupun ios, anda bisa memantau berapa banyak pengunjung hari ini, product apa saja yang', 'Pantau Perkembangan Website Anda', 'Pantau perkembangan website anda dengan mudah kapanpun dan dimanapun anda berada, karena esoftgreat membuat admin panel ramah digunakan di mobile phone seperti android maupun ios, anda bisa memantau b', '<h3><em>Pantau perkembangan website anda dengan mudah kapanpun dan dimanapun anda berada</em></h3>\r\n\r\n<br>\r\n<i class=\"fa fa-mobile-alt\"></i>\r\n<i class=\"fa fa-mobile\"></i>\r\n<br>\r\n\r\n<p>karena esoftgreat membuat admin panel ramah digunakan di mobile phone seperti android maupun ios, anda bisa memantau berapa banyak pengunjung hari ini, product apa saja yang dikunjungi dan dari mana sajakah asal para pengunjung website anda</p>\r\n', '', '', '', 'https://templates.esoftgreat.com/Avilon/img/advanced-feature-3.jpg', '', '', 'esoftgreat', 51, '0000-00-00 00:00:00', '', '', '2018-12-29 09:44:42', '2019-04-18 00:48:55', 1),
(25, ',7,', '', 'Konsultasi gratis', 'konsultasi-gratis', 'sebelum anda memulai membuat website untuk bisnis anda, kami melayani jasa konsultasi terlebih dahulu secara 100% gratis demi kenyamanan anda\r\n\r\nguna merencanakan secara matang bisnis anda nanti kita perlu melakukan diskusi terlebih dahulu hingga nanti te', 'Konsultasi gratis', 'sebelum anda memulai membuat website untuk bisnis anda, kami melayani jasa konsultasi terlebih dahulu secara 100% gratis demi kenyamanan anda\r\n\r\nguna merencanakan secara matang bisnis anda nanti kita ', '<p>sebelum anda memulai membuat website untuk bisnis anda, kami melayani jasa konsultasi terlebih dahulu secara <strong>100% gratis</strong> demi kenyamanan anda</p>\r\n\r\n<p>guna merencanakan secara matang bisnis anda nanti, kita perlu melakukan diskusi terlebih dahulu, hingga nanti terwujudlah perencanaan yang matang untuk bisnis anda</p>\r\n\r\n<p>anda pasti tidak ingin membuat website dan membuang-buang uang anda tanpa perencanaan terlebih dahulu bukan ?</p>\r\n\r\n<p>disitulah esoftgreat datang untuk memenuhi kebutuhan itu, sekali lagi kami esoftgreat menyediakan konsultasi secara <strong>100% gratis</strong></p>\r\n', '', '', '', 'https://templates.esoftgreat.com/Avilon/img/advanced-feature-2.jpg', '', '', 'esoftgreat', 48, '0000-00-00 00:00:00', '', '', '2018-12-29 09:54:29', '2019-04-18 00:48:53', 1),
(26, ',7,', '', 'Munculkan Usaha Anda di google map', 'munculkan-usaha-anda-di-google-map', 'esoftgreat&nbsp;tidak hanya menyediakan layanan pembuatan software saja, tapi kami juga menyediakan jasa untuk anda yang usahanya tidak ada atau belum muncul di google map.\r\n\r\nkami akan membantu anda agar usaha anda muncul ketika orang-orang mencari usaha', 'Munculkan Usaha Anda di google map', 'esoftgreat&nbsp;tidak hanya menyediakan layanan pembuatan software saja, tapi kami juga menyediakan jasa untuk anda yang usahanya tidak ada atau belum muncul di google map.\r\n\r\nkami akan membantu anda ', '<p><a href=\"https://www.esoftgreat.com\">esoftgreat</a>&nbsp;tidak hanya menyediakan layanan pembuatan software saja, tapi kami juga menyediakan jasa untuk anda yang usahanya tidak ada atau belum muncul di google map.</p>\r\n\r\n<p>kami akan membantu anda agar usaha anda muncul ketika orang-orang mencari usaha anda di google, kemudian muncul usaha anda terpampang besar di halaman utama google beserta websitenya</p>\r\n\r\n<p>dan layanan ini <strong>gratis 100% </strong>jika anda bermitra dengan kami dalam urusan pembuatan website untuk usaha anda.</p>\r\n', '', '', '', 'https://templates.esoftgreat.com/Avilon/img/advanced-feature-1.jpg', '', '', 'esoftgreat', 54, '0000-00-00 00:00:00', '', '', '2018-12-29 09:58:39', '2019-04-19 13:48:12', 1),
(27, ',9,', '', 'Analisa Bisnis', 'analisa-bisnis', 'sebelum anda memulai website anda, kami akan menganalisa terlebih dahulu secara matang bagaimana nantinya strategi agar usaha anda berkembang melalui dunia digital\r\n', 'Analisa Bisnis', 'sebelum anda memulai website anda, kami akan menganalisa terlebih dahulu secara matang bagaimana nantinya strategi agar usaha anda berkembang melalui dunia digital\r\n', '<p>sebelum anda memulai website anda, kami akan menganalisa terlebih dahulu secara matang bagaimana nantinya strategi agar usaha anda berkembang melalui dunia digital</p>\r\n', '', '', 'ion-ios-analytics-outline', '', '', '', 'esoftgreat', 39, '0000-00-00 00:00:00', '', '', '2018-12-29 10:05:56', '2019-04-18 00:49:03', 1),
(28, ',9,', '', 'Melayani dengan Cinta', 'melayani-dengan-cinta', 'esoftgreat melayani anda dengan cinta dan sepenuh hati kami, kami tidak pandang bulu, anda pengusaha besar pengusaha kecil. kami menerima anda dengan sepenuh hati kami', 'Melayani dengan Cinta', 'esoftgreat melayani anda dengan cinta dan sepenuh hati kami, kami tidak pandang bulu, anda pengusaha besar pengusaha kecil. kami menerima anda dengan sepenuh hati kami', '<p>esoftgreat melayani anda dengan cinta dan sepenuh hati kami, kami tidak pandang bulu, anda pengusaha besar pengusaha kecil. kami menerima anda dengan sepenuh hati kami</p>\r\n', '', '', 'ion-ios-heart-outline', '', '', '', 'esoftgreat', 39, '0000-00-00 00:00:00', '', '', '2018-12-29 10:11:47', '2019-04-18 00:49:02', 1),
(29, ',9,', '', 'Data Aman Tersimpan', 'data-aman-tersimpan', 'demi kenyamanan dan keamanan data bisnis anda, kami menggunakan sistem cloud dan tersebar diberbagai tempat dengan teknologi server yang tangguh untuk menyimpan data anda secara rapi dan aman', 'Data Aman Tersimpan', 'demi kenyamanan dan keamanan data bisnis anda, kami menggunakan sistem cloud dan tersebar diberbagai tempat dengan teknologi server yang tangguh untuk menyimpan data anda secara rapi dan aman', '<p>demi kenyamanan dan keamanan data bisnis anda, kami menggunakan sistem cloud dan tersebar diberbagai tempat dengan teknologi server yang tangguh untuk menyimpan data anda secara rapi dan aman</p>\r\n', '', '', 'ion-ios-bookmarks-outline', '', '', '', 'esoftgreat', 41, '0000-00-00 00:00:00', '', '', '2018-12-29 10:15:17', '2019-04-18 00:49:01', 1),
(30, ',9,', '', 'Layanan Tak Kenal Waktu', 'layanan-tak-kenal-waktu', 'demi kenyaman para pelaku usaha bisnis yang jamnya sangat padat sekali, kami melayani anda selama 24 jam tanpa mengenal waktu, karena bagi kami bukan hanya kepuasan pelanggan saja tapi kenyamanan pelanggan juga kami utamakan\r\n', 'Layanan Tak Kenal Waktu', 'demi kenyaman para pelaku usaha bisnis yang jamnya sangat padat sekali, kami melayani anda selama 24 jam tanpa mengenal waktu, karena bagi kami bukan hanya kepuasan pelanggan saja tapi kenyamanan pela', '<p>demi kenyaman para pelaku usaha bisnis yang jamnya sangat padat sekali, kami melayani anda selama 24 jam tanpa mengenal waktu, karena bagi kami kenyamanan pelanggan adalah yang paling utama</p>\r\n', '', '', 'ion-ios-stopwatch-outline', '', '', '', 'esoftgreat', 41, '0000-00-00 00:00:00', '', '', '2018-12-29 10:17:14', '2019-04-18 00:48:58', 1),
(31, ',10,', '', 'esoftgreat corp', 'esoftgreat-corp', '', 'esoftgreat corp', '', '', '', '', '', 'https://www.esoftgreat.com/images/logo.png', '', '', 'esoftgreat', 0, '0000-00-00 00:00:00', '', '', '2018-12-29 10:25:03', '2018-12-29 10:25:03', 1),
(32, ',10,', '', 'esoftplay', 'esoftplay', 'esoftplay', 'esoftplay', 'esoftplay', '<p>esoftplay</p>\r\n', '', 'image_esoftplay_1547449238.png', '', '', '', '', 'esoftgreat', 0, '0000-00-00 00:00:00', '', '', '2018-12-29 10:27:33', '2019-01-14 14:00:38', 1),
(33, ',10,', '', 'sentra kaligrafi jepara', 'sentra-kaligrafi-jepara', '', 'sentra kaligrafi jepara', '', '', '', '', '', 'https://sentrakaligrafijepara.com/images/modules/config/logo/image_Sentra_Kaligrafi_Jepara_1541475406.jpg', '', '', 'esoftgreat', 0, '0000-00-00 00:00:00', '', '', '2018-12-29 10:29:07', '2018-12-29 10:29:07', 1),
(34, ',10,', '', 'esoftdream', 'esoftdream', 'esoftdream', 'esoftdream', 'esoftdream', '<p>esoftdream</p>\r\n', '', 'image_esoftdream_1547449218.png', '', '', '', '', 'esoftgreat', 0, '0000-00-00 00:00:00', '', '', '2018-12-29 10:29:29', '2019-01-14 14:00:18', 1),
(35, ',10,', '', 'meubel cendana', 'meubel-cendana', '', 'meubel cendana', '', '', '', '', '', 'https://www.meubelcendana.com/images/modules/config/logo/image_Meubel_Cendana_1545210378.png', '', '', 'esoftgreat', 0, '0000-00-00 00:00:00', '', '', '2018-12-29 10:29:55', '2018-12-29 10:29:55', 1),
(36, ',12,', '', 'saya ingin membuat website tapi saya tidak tahu sama sekali tentang website ?', 'saya-ingin-membuat-website-tapi-saya-tidak-tahu-sama-sekali-tentang-website', 'kami melayani 24 jam konsultasi dan kami juga akan memberikan pelatihan dan bimbingan untuk mengelola website anda\r\n', 'saya ingin membuat website tapi saya tidak tahu sama sekali tentang website ?', 'kami melayani 24 jam konsultasi dan kami juga akan memberikan pelatihan dan bimbingan untuk mengelola website anda\r\n', '<p>kami melayani 24 jam konsultasi dan kami juga akan memberikan pelatihan dan bimbingan untuk mengelola website anda</p>\r\n', '', '', '', '', '', '', 'esoftgreat', 0, '0000-00-00 00:00:00', '', '', '2018-12-29 11:02:47', '2018-12-29 11:02:47', 1),
(37, ',12,', '', 'bisakah esoftgreat mengelola website saya agar saya bisa fokus dalam bisnis saya ?', 'bisakah-esoftgreat-bisa-mengelola-website-saya-agar-saya-bisa-fokus-dalam-bisnis-saya', 'sangat bisa, esoftgreat dapat menghandel website anda jadi nanti anda bisa fokus pada bisnis anda\r\n', 'bisakah esoftgreat bisa mengelola website saya agar saya bisa fokus dalam bisnis saya ?', 'sangat bisa, esoftgreat dapat menghandel website anda jadi nanti anda bisa fokus pada bisnis anda\r\n', '<p>sangat bisa, esoftgreat dapat menghandel website anda jadi nanti anda bisa fokus pada bisnis anda</p>\r\n', '', '', '', '', '', '', 'esoftgreat', 0, '0000-00-00 00:00:00', '', '', '2018-12-29 11:04:28', '2018-12-29 12:08:59', 1),
(38, ',12,', '', 'apakah web dari esoftgreat bisa di akses dengan hp ?', 'apakah-web-dari-esoftgreat-bisa-di-akses-dengan-hp', 'esoftgreat menggunakan desain yang responsive jadi tampilan dari web anda akan menyesuaikan pada device yang digunakan oleh pengunjung\r\n', 'apakah web dari esoftgreat bisa di akses dengan hp ?', 'esoftgreat menggunakan desain yang responsive jadi tampilan dari web anda akan menyesuaikan pada device yang digunakan oleh pengunjung\r\n', '<p>esoftgreat menggunakan desain yang responsive jadi tampilan dari web anda akan menyesuaikan pada device yang digunakan oleh pengunjung</p>\r\n', '', '', '', '', '', '', 'esoftgreat', 0, '0000-00-00 00:00:00', '', '', '2018-12-29 11:05:21', '2018-12-29 11:05:21', 1),
(39, ',12,', '', 'saya sudah punya website dari wordpress bisakah esoftgreat memindahkannya ke web yang baru ?', 'saya-sudah-punya-website-dari-wordpress-bisakah-esoftgreat-memindahkannya-ke-web-yang-baru', 'bisa, kami menyediakan jasa transfer dari web sebelumnya ke web yang akan kami berikan pada anda tanpa merubah link yang sudah banyak di kunjungi orang\r\n', 'saya sudah punya website dari wordpress bisakah esoftgreat memindahkannya ke web yang baru ?', 'bisa, kami menyediakan jasa transfer dari web sebelumnya ke web yang akan kami berikan pada anda tanpa merubah link yang sudah banyak di kunjungi orang\r\n', '<p>bisa, kami menyediakan jasa transfer dari web sebelumnya ke web yang akan kami berikan pada anda tanpa merubah link yang sudah banyak di kunjungi orang</p>\r\n', '', '', '', '', '', '', 'esoftgreat', 1, '0000-00-00 00:00:00', '', '', '2018-12-29 11:07:16', '2019-04-05 23:50:50', 1),
(40, ',13,', '', 'Rizky Arif Nur Choir', 'rizky-arif-nur-choir', 'fullstack developer\r\n', 'Rizky Arif Nur Choir', 'fullstack developer\r\n', '<p>fullstack developer</p>\r\n', '', 'image_Rizky_Arif_Nur_Choir_1546056947.jpg', '', '', '', '', 'esoftgreat', 13, '0000-00-00 00:00:00', '', '', '2018-12-29 11:12:15', '2019-02-23 09:18:29', 1),
(41, ',13,', '', 'Mawaddan Ahmad', 'mawaddan-ahmad', 'mawaddan-ahmad', 'Mawaddan Ahmad', 'mawaddan-ahmad', '<p>front end developer</p>\r\n', '', 'image_Mawaddan_Ahmad.jpg', '', '', '', '', 'sabil', 11, '0000-00-00 00:00:00', '', '', '2018-12-29 11:26:12', '2019-03-05 19:45:44', 1),
(42, ',13,', '', 'Fivit Octavia', 'fivit-octavia', 'Customer Service\r\n', 'Fivit Octavia', 'Customer Service\r\n', '<p>Customer Service</p>\r\n', '', 'image_Fivit_Octavia_1546057746.jpg', '', '', '', '', 'esoftgreat', 16, '0000-00-00 00:00:00', '', '', '2018-12-29 11:29:06', '2019-02-18 05:02:51', 1),
(43, ',13,', '', 'Iwan Safrudin', 'iwan-safrudin', 'Founder + Programmer\r\n', 'Iwan Safrudin', 'Founder + Programmer\r\n', '<p>Founder + Programmer</p>\r\n', '', 'image_Iwan_Safrudin_1546057882.jpg', '', '', '', '', 'esoftgreat', 11, '0000-00-00 00:00:00', '', '', '2018-12-29 11:31:22', '2019-02-17 01:25:21', 1),
(44, ',14,', '', 'Land Page', 'land-page', '', 'Land Page', '', '', '', 'image_Land_Page_1546058308.png', '', '', '', '', 'esoftgreat', 11, '0000-00-00 00:00:00', '', '', '2018-12-29 11:38:28', '2019-02-09 18:24:12', 1),
(45, ',14,', '', 'Grid', 'grid', '', 'Grid', '', '', '', 'image_Grid_1546058327.png', '', '', '', '', 'esoftgreat', 16, '0000-00-00 00:00:00', '', '', '2018-12-29 11:38:47', '2019-04-21 06:36:09', 1),
(46, ',14,', '', 'Green Leafe', 'green-leafe', '', 'Green Leafe', '', '', '', 'image_Green_Leafe_1546058347.png', '', '', '', '', 'esoftgreat', 16, '0000-00-00 00:00:00', '', '', '2018-12-29 11:39:07', '2019-04-21 06:36:09', 1),
(47, ',14,', '', 'Colid', 'colid', '', 'Colid', '', '', '', 'image_Colid_1546058400.png', '', '', '', '', 'esoftgreat', 18, '0000-00-00 00:00:00', '', '', '2018-12-29 11:40:00', '2019-04-21 06:36:09', 1),
(48, ',14,', '', 'Avilon', 'avilon', '', 'Avilon', '', '', '', 'image_Avilon_1546058422.png', '', '', '', '', 'esoftgreat', 12, '0000-00-00 00:00:00', '', '', '2018-12-29 11:40:22', '2019-02-18 04:59:06', 1),
(49, ',14,', '', 'Admin', 'admin', '', 'Admin', '', '', '', 'image_Admin_1546058454.png', '', '', '', '', 'esoftgreat', 5, '0000-00-00 00:00:00', '', '', '2018-12-29 11:40:54', '2019-01-31 11:20:48', 1),
(50, ',12,', '', 'apakah esoftgreat bisa membuat aplikasi toko ?', 'apakah-esoftgreat-bisa-membuat-aplikasi-toko', 'bisa, bahkan kami membuatnya data terpusat jadi anda bisa memantau alur keuangan toko anda dan produk anda dimanapun anda berada menggunakan smartphone anda\r\n', 'apakah esoftgreat bisa membuat aplikasi toko ?', 'bisa, bahkan kami membuatnya data terpusat jadi anda bisa memantau alur keuangan toko anda dan produk anda dimanapun anda berada menggunakan smartphone anda\r\n', '<p>bisa, bahkan kami membuatnya data terpusat jadi anda bisa memantau alur keuangan toko anda dan produk anda dimanapun anda berada menggunakan smartphone anda</p>\r\n', '', '', '', '', '', '', 'esoftgreat', 0, '0000-00-00 00:00:00', '', '', '2018-12-29 12:23:09', '2018-12-29 12:23:09', 1),
(51, ',15,16,', '', 'Paket website profile', 'paket-website-profile', 'paket-website-profile', 'Paket website profile', 'paket-website-profile', '<p>paket-website-profile</p>\r\n', '', '', '', '', '', '', 'esoftgreat', 17, '0000-00-00 00:00:00', '', '', '2018-12-29 18:27:25', '2019-04-18 00:49:49', 1),
(52, ',15,16,', '', 'Paket website murah', 'paket-website-murah', 'paket-website-murah', 'Paket website murah', 'paket-website-murah', '<p>paket-website-murah</p>\r\n', '', '', '', '', '', '', 'esoftgreat', 24, '0000-00-00 00:00:00', '', '', '2018-12-29 18:27:44', '2019-04-18 00:49:47', 1),
(54, ',17,', '', 'Contact', 'contact', 'esoftgreat adalah software development atau software house yang lahir dan berkembang di pedesaan namun kami tetap tidak ketinggalan dalam perkembangan teknologi\r\n\r\nesoftgreat beralamatkan di\r\nJl Tulakan Km 1\r\nDukuh Krajan\r\nDesa Tulakan Rt 06/02\r\nKec Donor', 'Contact', 'esoftgreat adalah software development atau software house yang lahir dan berkembang di pedesaan namun kami tetap tidak ketinggalan dalam perkembangan teknologi\r\n\r\nesoftgreat beralamatkan di\r\nJl Tulak', '<p>esoftgreat adalah software development atau software house yang lahir dan berkembang di pedesaan namun kami tetap tidak ketinggalan dalam perkembangan teknologi</p>\r\n\r\n<p>esoftgreat beralamatkan di<br />\r\nJl Tulakan Km 1<br />\r\nDukuh Krajan<br />\r\nDesa Tulakan Rt 06/02<br />\r\nKec Donorojo Kab Jepara<br />\r\nJawa Tengah<br />\r\nKode Pos 59454</p>\r\n\r\n<p>email :&nbsp;info@esoftgreat.com</p>\r\n\r\n<p>hp :&nbsp;+6285290335332</p>\r\n\r\n<p><a href=\"https://wa.me/6285290335332\">wa :&nbsp;+6285290335332</a></p>\r\n', '', '', '', '', '', '', 'esoftgreat', 314, '0000-00-00 00:00:00', '', '', '2019-01-01 19:27:09', '2019-04-19 12:01:02', 1),
(55, ',18,', '', 'Iwan Safrudin', 'iwan-safrudin-55', 'Bank BCA\r\n\r\n0312609779\r\n\r\nUnit Kudus\r\n', 'Iwan Safrudin', 'Bank BCA\r\n\r\n0312609779\r\n\r\nUnit Kudus\r\n', '<p>Bank BCA<br>0312609779<br>Unit Kudus</p>\r\n', '', '', '', 'https://www.bca.co.id/~/media/Images/logo-bca.ashx', '', '', 'esoftgreat', 2, '0000-00-00 00:00:00', '', '', '2019-01-01 22:19:33', '2019-04-24 21:53:20', 1),
(56, ',19,', '', 'Template Admin XII RPL 2', 'template-admin-xii-rpl-2', 'Kelompok Ulil (Star Admin), kelompok Fara (Novus), kelompok eki (ultra modern), kelompok marlia (argon), kelompok vivin (kia alap)', 'Template Admin XII RPL 2, kelompok, tugas pemrograman, smkn 1 bangsri, rpl, rekayasa perangkat lunak', 'Kelompok Ulil (Star Admin), kelompok Fara (Novus), kelompok eki (ultra modern), kelompok marlia (argon), kelompok vivin (kia alap)', '<p>Kelompok Ulil (Star Admin)</p>\r\n\r\n<p><img alt=\"\" class=\"img-responsive\" src=\"https://www.esoftgreat.com/images/modules/content/gallery/56/images_Template_Admin_XII_RPL_2_0_1547381989.jpeg\" style=\"width:350px\" /></p>\r\n\r\n<p>kelompok Fara (Novus)</p>\r\n\r\n<p><img alt=\"\" class=\"img-responsive\" src=\"https://www.esoftgreat.com/images/modules/content/gallery/56/images_Template_Admin_XII_RPL_2_1_1547533468.jpg\" style=\"width:350px\" /></p>\r\n\r\n<p>kelompok eki (ultra modern)</p>\r\n\r\n<p><img alt=\"\" class=\"img-responsive\" src=\"https://www.esoftgreat.com/images/modules/content/gallery/56/images_Template_Admin_XII_RPL_2_0_1547533712.jpeg\" style=\"height:167px; width:350px\" /></p>\r\n\r\n<p>kelompok marlia (argon)</p>\r\n\r\n<p><img alt=\"\" class=\"img-responsive\" src=\"https://www.esoftgreat.com/images/modules/content/gallery/56/images_Template_Admin_XII_RPL_2_1_1547533712.jpeg\" style=\"height:195px; width:350px\" /></p>\r\n\r\n<p>kelompok vivin (kia alap)</p>\r\n\r\n<p><img alt=\"\" class=\"img-responsive\" src=\"https://www.esoftgreat.com/images/modules/content/gallery/56/images_Template_Admin_XII_RPL_2_2_1547533712.jpeg\" style=\"height:191px; width:350px\" /></p>\r\n\r\n<p>kelompok ratna (admin lte)</p>\r\n\r\n<p><img alt=\"\" class=\"img-responsive\" src=\"https://www.esoftgreat.com/images/modules/content/gallery/56/images_Template_Admin_XII_RPL_2_0_1547534328.jpg\" style=\"height:175px; width:350px\" /></p>\r\n\r\n<p>kelompok ika (creative tim)</p>\r\n\r\n<p><img alt=\"\" class=\"img-responsive\" src=\"https://www.esoftgreat.com/images/modules/content/gallery/56/images_Template_Admin_XII_RPL_2_0_1547558197.jpg\" style=\"height:164px; width:350px\" /></p>\r\n', '', '', '', '', '[\"images_Template_Admin_XII_RPL_2_0_1547558197.jpg\",\"images_Template_Admin_XII_RPL_2_0_1547534328.jpg\",\"images_Template_Admin_XII_RPL_2_0_1547533712.jpeg\",\"images_Template_Admin_XII_RPL_2_1_1547533712.jpeg\",\"images_Template_Admin_XII_RPL_2_2_1547533712.jpeg\",\"images_Template_Admin_XII_RPL_2_0_1547533468.jpeg\",\"images_Template_Admin_XII_RPL_2_1_1547533468.jpg\"]', '', 'esoftgreat', 90, '0000-00-00 00:00:00', '', '', '2019-01-13 19:18:56', '2019-03-16 13:18:35', 1),
(58, ',22,', ',1,12,13,', 'Negosiasikan Harga sesuai budget', 'negosiasikan-harga-sesuai-budget', 'anda memiliki budget lebih dari yg kami tawarkan ?\r\n\r\natau budget anda kurang dari opsi yang kami tawarkan ?\r\n\r\natau anda ingin mengurangi harga atau menambah harga dengan mengurangi atau menamabah fitur yang ada ?\r\n\r\ndi esoftgreat semua bisa dibicarakan.', 'Negosiasikan Harga sesuai budget', 'anda memiliki budget lebih dari yg kami tawarkan ?\r\n\r\natau budget anda kurang dari opsi yang kami tawarkan ?\r\n\r\natau anda ingin mengurangi harga atau menambah harga dengan mengurangi atau menamabah fi', '<p>anda memiliki budget lebih dari yg kami tawarkan ?</p>\r\n\r\n<p>atau budget anda kurang dari opsi yang kami tawarkan ?</p>\r\n\r\n<p>atau anda ingin mengurangi harga atau menambah harga dengan mengurangi atau menambah fitur yang ada ?</p>\r\n\r\n<p>di esoftgreat semua bisa dibicarakan. bisa dinegosiasikan.</p>\r\n\r\n<p>karena setiap orang setiap usaha memiliki porsinya masing-masing. tunggu apa lagi silahkan anda bisa menegosiasikan sebelum membuat website atau aplikasi yang anda inginkan&nbsp;</p>\r\n', '', 'image_Negosiasikan_Harga_sesuai_budget_1548590720.jpeg', '', '', '', '', 'esoftgreat', 14, '0000-00-00 00:00:00', '', '', '2019-01-27 19:05:20', '2019-04-18 00:49:33', 1),
(59, ',10,', '', 'SMK Wisudha Karya Kudus', 'smk-wisudha-karya-kudus', '', 'SMK Wisudha Karya Kudus', '', '', '', 'image_SMK_Wisudha_Karya_Kudus_1549250611.jpg', '', '', '', '', 'esoftgreat', 1, '0000-00-00 00:00:00', '', '', '2019-02-04 10:23:31', '2019-04-12 14:52:50', 1),
(60, ',10,', '', 'Bimbel Sarwa', 'bimbel-sarwa', '', 'Bimbel Sarwa', '', '', '', '', '', 'https://www.sarwabimbel.com/images/modules/config/logo/image_sarwabimbel_1547974120.png', '', '', 'esoftgreat', 0, '0000-00-00 00:00:00', '', '', '2019-02-04 10:30:39', '2019-02-04 10:30:39', 1),
(61, ',10,', '', 'Ameera Semarang', 'ameera-semarang', '', 'Ameera Semarang', '', '', '', '', '', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQE-kUI-l_oahyC_2C03Kl6x2j_oHUQqbSmbuWYkrqRE6fbJA7w', '', '', 'esoftgreat', 0, '0000-00-00 00:00:00', '', '', '2019-02-04 10:32:40', '2019-02-04 10:32:40', 1),
(62, ',10,', '', 'SMK N 1 Bangsri', 'smk-n-1-bangsri', '', 'SMK N 1 Bangsri', '', '', '', 'image_SMK_N_1_Bangsri.png', '', '', '', '', 'esoftgreat', 3, '0000-00-00 00:00:00', '', '', '2019-02-04 10:34:22', '2019-03-19 08:10:04', 1),
(63, ',13,', '', 'Edo', 'edo', 'Designer\r\n', 'Edo', 'Designer\r\n', '<p>Designer</p>\r\n', '', 'image_Edo.jpg', '', '', '', '', 'esoftgreat', 1, '0000-00-00 00:00:00', '', '', '2019-03-05 13:27:33', '2019-03-21 21:25:20', 1),
(64, ',10,', '', 'Nasya Transportation', 'nasya-transportation', '', 'Nasya Transportation', '', '', '', 'image_Nasya_Transportation.jpeg', '', '', '', '', 'esoftgreat', 0, '0000-00-00 00:00:00', '', '', '2019-03-26 18:54:55', '2019-03-26 18:54:55', 1);

DROP TABLE IF EXISTS `content_cat`;
CREATE TABLE `content_cat` (
  `id` int(11) NOT NULL,
  `par_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `description` mediumtext NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `content_cat` (`id`, `par_id`, `title`, `slug`, `image`, `icon`, `description`, `publish`, `created`, `updated`) VALUES
(1, 0, 'Uncategorized', 'uncategorized', '', '', '', 1, '2018-11-11 22:23:38', '2018-11-11 22:23:38'),
(2, 0, 'Profile', 'profile', '', '', '', 1, '2018-11-11 23:09:20', '2018-11-11 23:09:20'),
(3, 0, 'thumbnail', 'thumbnail', '', '', '', 1, '2018-12-26 10:34:02', '2018-12-26 10:34:02'),
(4, 0, 'Admin Mobile View', 'admin-mobile-view', '', '', '', 1, '2018-12-26 10:47:48', '2018-12-26 10:47:48'),
(5, 0, 'About Us', 'about-us', '', '', 'transformasi era digital implementasi tepat di saat yang tepat', 1, '2018-12-26 10:52:56', '2018-12-26 10:57:32'),
(6, 0, 'Features', 'features', 'image_Features_1545796878.png', '', '', 1, '2018-12-26 11:00:26', '2018-12-26 11:01:18'),
(7, 0, 'Advance Features', 'advance-features', '', '', '', 1, '2018-12-26 11:09:53', '2018-12-26 11:09:53'),
(8, 0, 'Banner', 'banner', '', '', '', 1, '2018-12-26 11:10:42', '2018-12-26 11:10:43'),
(9, 0, 'More Features', 'more-features', '', '', '', 1, '2018-12-26 11:10:57', '2018-12-26 11:10:57'),
(10, 0, 'Brand', 'brand', '', '', '', 1, '2018-12-26 11:11:03', '2018-12-26 11:11:03'),
(11, 0, 'Pricing', 'pricing', '', '', 'pilihlah sesuai kebutuhan anda', 1, '2018-12-26 11:11:10', '2018-12-29 10:56:01'),
(12, 0, 'Frequently Asked Questions', 'frequently-asked-questions', '', '', 'pertanyaan yang sering muncul', 1, '2018-12-26 11:11:22', '2018-12-29 10:56:31'),
(13, 0, 'Our Team', 'our-team', '', '', '', 1, '2018-12-26 11:11:33', '2018-12-26 11:11:33'),
(14, 0, 'Gallery', 'gallery', '', '', 'Begitu banyak pilihan template yang bisa anda pilih', 1, '2018-12-26 11:11:41', '2018-12-29 11:39:43'),
(15, 0, 'website', 'website', '', '', '', 1, '2018-12-29 18:22:25', '2018-12-29 18:22:25'),
(16, 0, 'popular product', 'popular-product', '', '', '', 1, '2018-12-29 18:23:04', '2018-12-29 18:23:05'),
(17, 0, 'contact', 'contact', '', '', '', 1, '2018-12-29 18:23:31', '2018-12-29 18:23:31'),
(18, 0, 'Payment', 'payment', '', '', '', 1, '2019-01-01 22:16:53', '2019-01-01 22:16:53'),
(19, 0, 'news', 'news', '', '', '', 1, '2019-01-13 19:17:15', '2019-01-13 19:17:15'),
(21, 0, 'undangan', 'undangan', '', '', 'undangan online', 1, '2019-01-25 18:54:02', '2019-01-25 18:54:02'),
(22, 0, 'Promo', 'promo', '', '', '', 1, '2019-01-27 18:57:21', '2019-01-27 18:57:21');

DROP TABLE IF EXISTS `content_tag`;
CREATE TABLE `content_tag` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `total` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `content_tag` (`id`, `title`, `total`, `created`) VALUES
(1, 'esoftgreat', 3, '2018-11-11 22:27:01'),
(2, 'hello world', 1, '2018-11-11 22:27:01'),
(3, 'software development', 1, '2018-12-29 09:28:02'),
(4, 'software', 1, '2018-12-29 09:28:02'),
(5, 'development', 1, '2018-12-29 09:28:02'),
(6, 'web', 1, '2018-12-29 09:28:02'),
(7, 'murah', 2, '2018-12-29 09:28:02'),
(8, 'blogspot', 1, '2018-12-29 09:37:55'),
(9, 'blogger', 1, '2018-12-29 09:37:55'),
(10, 'blogspot to website', 1, '2018-12-29 09:37:55'),
(11, 'paket', 1, '2018-12-29 18:25:11'),
(12, 'promo', 1, '2019-01-27 19:05:20'),
(13, 'negosiasi', 1, '2019-01-27 19:05:20'),
(14, 'software-development', 1, '2019-01-27 20:13:30');

DROP TABLE IF EXISTS `desa`;
CREATE TABLE `desa` (
  `id` int(11) UNSIGNED NOT NULL,
  `kode` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kecamatan` varchar(255) NOT NULL,
  `kabupaten` varchar(255) NOT NULL,
  `kode_pos` int(11) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `invoice`;
CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `receiver` varchar(255) NOT NULL,
  `payment_method` tinyint(1) NOT NULL DEFAULT '1',
  `notes` varchar(255) NOT NULL,
  `items` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `ppn` int(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `invoice` (`id`, `code`, `receiver`, `payment_method`, `notes`, `items`, `status`, `ppn`, `created`, `updated`) VALUES
(1, 'IN0001', 'PT Era Sistem Global', 1, 'website = 1500000, hosting = 750000', 'website = 1500000, hosting = 750000', 0, 1, '2019-04-04 20:37:20', '2019-04-04 20:37:20');

DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `par_id` int(11) NOT NULL DEFAULT '0',
  `position_id` int(11) NOT NULL DEFAULT '0',
  `sort_order` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `link` mediumtext NOT NULL,
  `tpl` varchar(255) NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `menu` (`id`, `par_id`, `position_id`, `sort_order`, `title`, `link`, `tpl`, `publish`) VALUES
(3, 0, 2, 0, 'youtube', 'utube', '0', 1),
(4, 0, 2, 0, 'blogspot', 'blog', '0', 1),
(17, 0, 1, 1, 'Home', '#intro', '0', 1),
(18, 0, 1, 2, 'About Us', 'category/about-us.html', '', 1),
(19, 0, 1, 3, 'Features', 'category/features.html', 'content_top', 0),
(24, 0, 1, 8, 'Contact', 'contact.html', '0', 0),
(25, 0, 1, 7, 'Contact Us', 'contact-us.html', '0', 0),
(26, 0, 1, 6, 'Gallery', 'category/gallery.html', 'content_gallery', 1),
(27, 0, 1, 5, 'Team', 'category/our-team.html', 'content_team', 1),
(28, 0, 1, 4, 'Pricing', 'category/pricing.html', 'content_pricing', 1),
(29, 0, 1, 9, 'Blog', 'https://blog.esoftgreat.com', '', 1);

DROP TABLE IF EXISTS `menu_position`;
CREATE TABLE `menu_position` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `menu_position` (`id`, `title`, `created`, `updated`) VALUES
(1, 'Top Menu', '2018-11-12 02:16:02', '2018-11-12 02:16:02'),
(2, 'Bottom Menu', '2018-11-15 12:39:27', '2018-11-15 12:39:27');

DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=unread,2=read',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `perangkat_desa`;
CREATE TABLE `perangkat_desa` (
  `id` int(11) NOT NULL,
  `desa_id` int(11) NOT NULL,
  `kelompok` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=perangkat desa, 2=bpd,3=lpmp,4=pkk,5=karang taruna,6=rt,7=rw',
  `nama` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `kelamin` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=wanita,1=laki-laki',
  `agama` tinyint(1) NOT NULL COMMENT '1=islam,2=kristen,3=katholik,4=hindu,5=budha,6=khonghucu,7=kepercayaan terhadap tuhan yang maha esa lainnya',
  `status_perkawinan` tinyint(1) NOT NULL COMMENT '0=belum kawin,1=sudah kawin',
  `pendidikan_terakhir` tinyint(2) NOT NULL COMMENT '1=akademi/diploma iii/s.muda,2=belum tamat sd/sederajat,3=diploma i/ii,4=diploma iv/strata i,5=slta/sederajat,6=sltp/sederajat,7=strata ii,8=strata iii,9=tamat sd/sederajat,10=tidak/belum sekolah',
  `jamkes` varchar(255) NOT NULL COMMENT 'jaminan kesehatan',
  `jabatan` tinyint(2) NOT NULL COMMENT 'perangkat desa(1=kepala desa,2=sekretaris desa,3=kepala dusun 1,4=kepala dusun ii,5=kepala dusun iii,6=kepala dusun iv,7=kepala dusun v,8=kaur administrasi dan umum,9=kaur keuangan,10=kasi pemerintahan,11=kasi pembangunan,12=kasi kesra,13=staf kaur keuangan,14=staf kasi pemerintahan,15=staf kasi pembangunan,16=staf kasi kesra),bpd(1=ketua , 2=wakil ketua, 3=sekretaris, 4=anggota),lpmp(1=ketua, 2=seksi agama, 3=seksi pemuda, 4=anggota),pkk(1=ketua,2=sekretaris i,3=sekretaris ii,4=bendahara i,5=bendahara ii,6=pokja i,7=pokja ii),karang taruna(1=ketua,2=wakil ketua,3=sekretaris i,4=sekretaris ii,5=bendahara i,6=bendahara ii,7=anggota)',
  `no_sk` varchar(100) NOT NULL,
  `sk_penetapan_kembali` varchar(255) NOT NULL,
  `tgl_pelantikan` date NOT NULL,
  `akhir_masa_jabatan` date NOT NULL,
  `pelantik` varchar(255) NOT NULL COMMENT 'pejabat pelantik',
  `bengkok` varchar(50) NOT NULL COMMENT 'luas  bengkok',
  `penghasilan` int(11) NOT NULL COMMENT 'penghasilan tetap',
  `riwayat_pendidikan` text NOT NULL,
  `riwayat_diklat` text NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `cat_ids` text NOT NULL,
  `tag_ids` text NOT NULL,
  `image` varchar(11) NOT NULL,
  `images` text NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` varchar(255) NOT NULL,
  `discount` double NOT NULL,
  `qty` int(11) NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 = not publish, 1 = publish',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `product_cat`;
CREATE TABLE `product_cat` (
  `id` int(11) NOT NULL,
  `par_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `product_tag`;
CREATE TABLE `product_tag` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `total` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `user_role_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = active, 0 = not active',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `user` (`id`, `username`, `password`, `email`, `image`, `user_role_id`, `active`, `created`, `updated`) VALUES
(1, 'root', '$2y$10$iN3I64zsXAyy9MCEVAPe3uqv1ygazlJgKFYEc2aNCiu2VDe/ZTKjO', 'root@esoftgreat.com', '', 1, 1, '2018-11-03 07:36:32', '2018-11-03 07:36:32'),
(2, 'admin', '$2y$10$jdpCJJsaAfx1hv0EXyQpjOce6kqeffl9X/cOJvJYuSnG4/aFLwb7C', 'admin@esoftgreat.com', '', 2, 1, '2018-11-04 19:27:55', '2018-11-04 19:27:55'),
(6, 'sabil', '$2y$10$tiM9lqis8SiY1wnfzMd0uO0BpGj09BOX.v00nU/n6o3gD2Bu1pz1u', 'sabil@esoftgreat.com', '', 2, 1, '2018-12-26 11:41:41', '2018-12-26 11:41:41'),
(7, 'esoftgreat', '$2y$10$8gCi1lmoWGc6aM1kRPkLjedUEO9tgkZlF6b1tdujtbH34MpJ4Osdi', 'iwan@esoftgreat.com', '', 1, 1, '2018-12-29 09:10:05', '2018-12-29 09:10:05');

DROP TABLE IF EXISTS `user_login`;
CREATE TABLE `user_login` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `browser` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0=failed, 1=success',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user_login` (`id`, `user_id`, `ip`, `browser`, `status`, `created`) VALUES
(1, 1, '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', 1, '2019-04-25 23:39:50');

DROP TABLE IF EXISTS `user_role`;
CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `level` tinyint(2) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user_role` (`id`, `level`, `title`, `description`, `created`, `updated`) VALUES
(1, 1, 'root', 'super user', '2018-11-02 22:57:22', '2018-11-02 22:57:22'),
(2, 2, 'admin', 'the administrator', '2018-11-02 22:57:22', '2018-11-02 22:57:22'),
(3, 5, 'Member', 'User member yang hanya berlangganan saja', '2018-11-04 12:59:26', '2018-11-04 12:59:26');

DROP TABLE IF EXISTS `visitor`;
CREATE TABLE `visitor` (
  `id` int(11) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `visited` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `region` varchar(50) NOT NULL,
  `country` varchar(10) NOT NULL,
  `browser` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `visitor` (`id`, `ip`, `visited`, `city`, `region`, `country`, `browser`, `created`) VALUES
(1, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-25 21:26:33'),
(2, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-25 23:39:50'),
(3, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-25 23:42:12'),
(4, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-25 23:42:55'),
(5, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-25 23:43:34'),
(6, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-25 23:43:39'),
(7, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-25 23:43:44'),
(8, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-25 23:43:46'),
(9, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-25 23:44:05'),
(10, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-25 23:44:21'),
(11, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-25 23:44:23'),
(12, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-25 23:47:43'),
(13, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-25 23:47:47'),
(14, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-25 23:47:49'),
(15, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-25 23:47:55'),
(16, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-25 23:48:00'),
(17, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-25 23:48:04'),
(18, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-25 23:48:06'),
(19, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-25 23:48:10'),
(20, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-25 23:48:16'),
(21, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-25 23:49:07'),
(22, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-25 23:49:09'),
(23, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-25 23:49:21'),
(24, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-25 23:49:26'),
(25, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-25 23:49:28'),
(26, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-25 23:49:30'),
(27, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-25 23:49:34'),
(28, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-25 23:49:38'),
(29, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-25 23:49:46'),
(30, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-25 23:49:49'),
(31, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-25 23:49:55'),
(32, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-25 23:51:31'),
(33, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-25 23:51:37'),
(34, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-25 23:53:07'),
(35, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-25 23:53:09'),
(36, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-25 23:53:32'),
(37, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-25 23:55:22'),
(38, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-25 23:56:20'),
(39, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-25 23:56:32'),
(40, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-25 23:56:36'),
(41, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-25 23:56:47'),
(42, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-25 23:57:40'),
(43, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:03:10'),
(44, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:03:14'),
(45, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:03:16'),
(46, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:03:21'),
(47, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:03:27'),
(48, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:03:37'),
(49, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:03:39'),
(50, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:03:43'),
(51, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:03:45'),
(52, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:03:50'),
(53, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:03:58'),
(54, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:03:59'),
(55, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:04:10'),
(56, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:04:24'),
(57, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:04:50'),
(58, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:04:53'),
(59, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:04:56'),
(60, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:04:58'),
(61, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:05:15'),
(62, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:05:19'),
(63, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:05:34'),
(64, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:05:37'),
(65, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:06:06'),
(66, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:07:14'),
(67, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:07:19'),
(68, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:07:23'),
(69, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:07:26'),
(70, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:07:34'),
(71, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:07:36'),
(72, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:07:38'),
(73, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:07:41'),
(74, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:08:31'),
(75, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:08:34'),
(76, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:08:43'),
(77, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:08:58'),
(78, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:09:01'),
(79, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:09:02'),
(80, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:09:04'),
(81, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:09:33'),
(82, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:09:45'),
(83, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:09:46'),
(84, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:10:16'),
(85, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:11:15'),
(86, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:13:28'),
(87, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:13:34'),
(88, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:13:39'),
(89, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:13:45'),
(90, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:13:50'),
(91, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:14:19'),
(92, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:14:35'),
(93, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:18:37'),
(94, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:18:40'),
(95, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:19:44'),
(96, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:19:46'),
(97, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:19:56'),
(98, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:19:59'),
(99, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:21:38'),
(100, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:21:54'),
(101, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:22:25'),
(102, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:23:47'),
(103, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:23:54'),
(104, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:24:08'),
(105, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:24:21'),
(106, '::1', 'http://localhost/sipapat/images/ajax-loader.gif', '', '', '', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36', '2019-04-26 00:25:13');


ALTER TABLE `admin_menu`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `bank_account`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `content`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `content_cat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

ALTER TABLE `content_tag`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `desa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_kode` (`kode`);

ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `menu_position`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `perangkat_desa`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `product_cat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

ALTER TABLE `product_tag`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `id` (`id`);

ALTER TABLE `user_login`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `visitor`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `admin_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
ALTER TABLE `bank_account`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
ALTER TABLE `content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
ALTER TABLE `content_cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
ALTER TABLE `content_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
ALTER TABLE `desa`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
ALTER TABLE `menu_position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `perangkat_desa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `product_cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `product_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
ALTER TABLE `user_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
ALTER TABLE `visitor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
