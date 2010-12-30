# phpMyAdmin SQL Dump
# version 2.5.2
# http://www.phpmyadmin.net
#
# Host: localhost
# Generation Time: Dec 21, 2003 at 07:49 PM
# Server version: 4.0.15
# PHP Version: 4.2.3
# 
# Database : `yourDB`
# 

# --------------------------------------------------------

#
# Table structure for table `categorisation`
#
# Creation: Dec 11, 2002 at 11:50 PM
# Last update: Nov 06, 2003 at 09:01 PM
#

DROP TABLE IF EXISTS `categorisation`;
CREATE TABLE `categorisation` (
  `category_id` varchar(50) NOT NULL default '',
  `name` varchar(20) NOT NULL default '',
  `level` char(1) default NULL,
  `related_to` varchar(50) NOT NULL default '',
  `image_off` varchar(80) default NULL,
  `image_on` varchar(80) default NULL,
  `template` varchar(80) default NULL,
  `dir_path` varchar(80) default NULL,
  `img_size` int(3) default NULL,
  `cat_image` varchar(80) default NULL,
  `priority` int(4) default NULL,
  PRIMARY KEY  (`category_id`)
) TYPE=MyISAM;

#
# Dumping data for table `categorisation`
#

INSERT INTO `categorisation` (`category_id`, `name`, `level`, `related_to`, `image_off`, `image_on`, `template`, `dir_path`, `img_size`, `cat_image`, `priority`) VALUES ('f926b87567d4affc6618d83f73c2cc87', 'admin', '0', '0', '', '', 'home.php', 'tcias_admin/', 0, '', 1);
INSERT INTO `categorisation` (`category_id`, `name`, `level`, `related_to`, `image_off`, `image_on`, `template`, `dir_path`, `img_size`, `cat_image`, `priority`) VALUES ('9102779955bd01502d7dd8f52a250709', 'categories', '1', 'f926b87567d4affc6618d83f73c2cc87', 'categories_btn.gif', 'categories_btn_o.gif', 'categories.php', 'categories/', 93, NULL, NULL);
INSERT INTO `categorisation` (`category_id`, `name`, `level`, `related_to`, `image_off`, `image_on`, `template`, `dir_path`, `img_size`, `cat_image`, `priority`) VALUES ('f247017260e44cd788d401835d88a909', 'add', '2', '9102779955bd01502d7dd8f52a250709', '', '', 'home.php', '', 0, '', NULL);
INSERT INTO `categorisation` (`category_id`, `name`, `level`, `related_to`, `image_off`, `image_on`, `template`, `dir_path`, `img_size`, `cat_image`, `priority`) VALUES ('6c2cb5aa273684d7cc48d01be49a3dd0', 'update', '2', '9102779955bd01502d7dd8f52a250709', '', '', 'home.php', '', 0, '', 2);
INSERT INTO `categorisation` (`category_id`, `name`, `level`, `related_to`, `image_off`, `image_on`, `template`, `dir_path`, `img_size`, `cat_image`, `priority`) VALUES ('f61ba7a45266c937876a31b43847702f', 'delete', '2', '9102779955bd01502d7dd8f52a250709', '', '', 'home.php', '', 0, '', NULL);
INSERT INTO `categorisation` (`category_id`, `name`, `level`, `related_to`, `image_off`, `image_on`, `template`, `dir_path`, `img_size`, `cat_image`, `priority`) VALUES ('9ce36d845efb62fe3344d187951b1d2f', 'content', '1', 'f926b87567d4affc6618d83f73c2cc87', 'content_btn.gif', 'content_btn_o.gif', 'home.php', '/', 80, NULL, NULL);
INSERT INTO `categorisation` (`category_id`, `name`, `level`, `related_to`, `image_off`, `image_on`, `template`, `dir_path`, `img_size`, `cat_image`, `priority`) VALUES ('30b980ba677972335419ec6c5a1e063f', 'add', '2', '9ce36d845efb62fe3344d187951b1d2f', '', '', 'home.php', '', 0, '', NULL);
INSERT INTO `categorisation` (`category_id`, `name`, `level`, `related_to`, `image_off`, `image_on`, `template`, `dir_path`, `img_size`, `cat_image`, `priority`) VALUES ('c2640e5a57929591f73fca38f5ac8d00', 'update', '2', '9ce36d845efb62fe3344d187951b1d2f', '', '', 'home.php', '', 0, NULL, NULL);
INSERT INTO `categorisation` (`category_id`, `name`, `level`, `related_to`, `image_off`, `image_on`, `template`, `dir_path`, `img_size`, `cat_image`, `priority`) VALUES ('9274ac68c5eddb086027081356dbe741', 'delete', '2', '9ce36d845efb62fe3344d187951b1d2f', '', '', 'home.php', '', 0, '', NULL);
INSERT INTO `categorisation` (`category_id`, `name`, `level`, `related_to`, `image_off`, `image_on`, `template`, `dir_path`, `img_size`, `cat_image`, `priority`) VALUES ('e8648d0e043eff3d08aedd19e9920533', 'publish', '2', '9ce36d845efb62fe3344d187951b1d2f', '', '', 'home.php', '', 0, '', NULL);
INSERT INTO `categorisation` (`category_id`, `name`, `level`, `related_to`, `image_off`, `image_on`, `template`, `dir_path`, `img_size`, `cat_image`, `priority`) VALUES ('90894d10d361dc8131256f12470b5315', 'resources', '1', 'f926b87567d4affc6618d83f73c2cc87', 'resources_btn.gif', 'resources_btn_o.gif', 'home.php', '', 89, '', NULL);
INSERT INTO `categorisation` (`category_id`, `name`, `level`, `related_to`, `image_off`, `image_on`, `template`, `dir_path`, `img_size`, `cat_image`, `priority`) VALUES ('15a0b60b820c68c24750180bc221c60f', 'add', '2', '90894d10d361dc8131256f12470b5315', '', '', 'home.php', '', 0, NULL, NULL);
INSERT INTO `categorisation` (`category_id`, `name`, `level`, `related_to`, `image_off`, `image_on`, `template`, `dir_path`, `img_size`, `cat_image`, `priority`) VALUES ('069de17c6e55f0ec88242774bbe9b84a', 'update', '2', '90894d10d361dc8131256f12470b5315', '', '', 'home.php', '', 0, NULL, NULL);
INSERT INTO `categorisation` (`category_id`, `name`, `level`, `related_to`, `image_off`, `image_on`, `template`, `dir_path`, `img_size`, `cat_image`, `priority`) VALUES ('74f3e657981fbc4aa9a0359fe5d4bb7a', 'delete', '2', '90894d10d361dc8131256f12470b5315', '', '', 'home.php', '', 0, NULL, NULL);
INSERT INTO `categorisation` (`category_id`, `name`, `level`, `related_to`, `image_off`, `image_on`, `template`, `dir_path`, `img_size`, `cat_image`, `priority`) VALUES ('b51bc57ac3cd7052b53a7ce9d308bf6f', 'users', '1', 'f926b87567d4affc6618d83f73c2cc87', 'users_btn.gif', 'users_btn_o.gif', 'home.php', '', 68, '', NULL);
INSERT INTO `categorisation` (`category_id`, `name`, `level`, `related_to`, `image_off`, `image_on`, `template`, `dir_path`, `img_size`, `cat_image`, `priority`) VALUES ('a712b4dfb1b99ca518e38c44a121efa0', 'add', '2', 'b51bc57ac3cd7052b53a7ce9d308bf6f', '', '', 'home.php', '', 0, NULL, NULL);
INSERT INTO `categorisation` (`category_id`, `name`, `level`, `related_to`, `image_off`, `image_on`, `template`, `dir_path`, `img_size`, `cat_image`, `priority`) VALUES ('d76ca075d56762bec415431d302d5b2b', 'update', '2', 'b51bc57ac3cd7052b53a7ce9d308bf6f', '', '', 'home.php', '', 0, NULL, NULL);
INSERT INTO `categorisation` (`category_id`, `name`, `level`, `related_to`, `image_off`, `image_on`, `template`, `dir_path`, `img_size`, `cat_image`, `priority`) VALUES ('d21dcd5fff08232f52177a6ce31a879d', 'delete', '2', 'b51bc57ac3cd7052b53a7ce9d308bf6f', '', '', 'home.php', '', 0, NULL, NULL);
INSERT INTO `categorisation` (`category_id`, `name`, `level`, `related_to`, `image_off`, `image_on`, `template`, `dir_path`, `img_size`, `cat_image`, `priority`) VALUES ('4629bc0507beb070a3799df13c0ef5ec', 'add', '2', '803b39cf2cb4918a15115940d52c41d1', '', '', 'home.php', '', 0, NULL, NULL);
INSERT INTO `categorisation` (`category_id`, `name`, `level`, `related_to`, `image_off`, `image_on`, `template`, `dir_path`, `img_size`, `cat_image`, `priority`) VALUES ('def07c2fba0176afaca8c915357f96d2', 'update', '2', '803b39cf2cb4918a15115940d52c41d1', '', '', 'home.php', '', 0, NULL, NULL);
INSERT INTO `categorisation` (`category_id`, `name`, `level`, `related_to`, `image_off`, `image_on`, `template`, `dir_path`, `img_size`, `cat_image`, `priority`) VALUES ('c2b894f25a108f1ac53817f92af02422', 'delete', '2', '803b39cf2cb4918a15115940d52c41d1', '', '', 'home.php', '', 0, NULL, NULL);
INSERT INTO `categorisation` (`category_id`, `name`, `level`, `related_to`, `image_off`, `image_on`, `template`, `dir_path`, `img_size`, `cat_image`, `priority`) VALUES ('803b39cf2cb4918a15115940d52c41d1', 'groups', '1', 'f926b87567d4affc6618d83f73c2cc87', 'groups_btn.gif', 'groups_btn_o.gif', 'home.php', '/', 74, NULL, NULL);
INSERT INTO `categorisation` (`category_id`, `name`, `level`, `related_to`, `image_off`, `image_on`, `template`, `dir_path`, `img_size`, `cat_image`, `priority`) VALUES ('7f0f5437515bd182b08004b470eaffb0', 'add type', '2', '90894d10d361dc8131256f12470b5315', '', '', 'home.php', '/', 0, '', 4);
INSERT INTO `categorisation` (`category_id`, `name`, `level`, `related_to`, `image_off`, `image_on`, `template`, `dir_path`, `img_size`, `cat_image`, `priority`) VALUES ('dcc8b090c21fa2bb7ce7c25485f6aaf9', 'update type', '2', '90894d10d361dc8131256f12470b5315', '0', '0', 'home.php', '/', 0, '', 5);
INSERT INTO `categorisation` (`category_id`, `name`, `level`, `related_to`, `image_off`, `image_on`, `template`, `dir_path`, `img_size`, `cat_image`, `priority`) VALUES ('ea121c93474420dce2fa4a11e3dc462f', 'delete type', '2', '90894d10d361dc8131256f12470b5315', '0', '0', 'home.php', '/', 0, '', 5);
INSERT INTO `categorisation` (`category_id`, `name`, `level`, `related_to`, `image_off`, `image_on`, `template`, `dir_path`, `img_size`, `cat_image`, `priority`) VALUES ('3f5d9c5159bb51ca19297aa2b6f93aae', 'rollback', '2', '9ce36d845efb62fe3344d187951b1d2f', '0', '0', 'home.php', '/', 0, '', 5);
INSERT INTO `categorisation` (`category_id`, `name`, `level`, `related_to`, `image_off`, `image_on`, `template`, `dir_path`, `img_size`, `cat_image`, `priority`) VALUES ('9a973d83d2d6b5d5cfc1acbd2b385645', 'homepage', '2', '9ce36d845efb62fe3344d187951b1d2f', '0', '0', 'home.php', '/', 0, '', 5);

# --------------------------------------------------------

#
# Table structure for table `content`
#
# Creation: Jul 16, 2003 at 07:01 PM
# Last update: Dec 19, 2003 at 07:55 AM
# Last check: Jul 16, 2003 at 07:01 PM
#

DROP TABLE IF EXISTS `content`;
CREATE TABLE `content` (
  `content_id` varchar(55) NOT NULL default '',
  `content_category_id` varchar(55) NOT NULL default '0',
  `content_teaser` text NOT NULL,
  `content_title` varchar(120) NOT NULL default '',
  `content` text NOT NULL,
  `content_type` varchar(120) NOT NULL default '',
  `published` char(1) default NULL,
  `date_written` datetime NOT NULL default '0000-00-00 00:00:00',
  `date_published` datetime NOT NULL default '0000-00-00 00:00:00',
  `date_expires` datetime NOT NULL default '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL default '0000-00-00 00:00:00',
  `author` varchar(120) default NULL,
  `checked_out` char(1) NOT NULL default '',
  `priority` tinyint(2) default '0',
  PRIMARY KEY  (`content_id`),
  FULLTEXT KEY `content` (`content`)
) TYPE=MyISAM;

#
# Dumping data for table `content`
#


# --------------------------------------------------------

#
# Table structure for table `content_archive`
#
# Creation: Dec 11, 2002 at 11:50 PM
# Last update: Dec 19, 2003 at 07:55 AM
#

DROP TABLE IF EXISTS `content_archive`;
CREATE TABLE `content_archive` (
  `archive_id` varchar(55) NOT NULL default '',
  `content_id` varchar(55) NOT NULL default '',
  `content_category_id` varchar(55) NOT NULL default '0',
  `content_teaser` text NOT NULL,
  `content_title` varchar(120) NOT NULL default '',
  `content` text NOT NULL,
  `content_type` varchar(120) NOT NULL default '',
  `published` char(1) default NULL,
  `date_written` datetime NOT NULL default '0000-00-00 00:00:00',
  `date_published` datetime NOT NULL default '0000-00-00 00:00:00',
  `date_expires` datetime NOT NULL default '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL default '0000-00-00 00:00:00',
  `author` varchar(120) default NULL,
  PRIMARY KEY  (`archive_id`)
) TYPE=MyISAM;

#
# Dumping data for table `content_archive`
#


# --------------------------------------------------------

#
# Table structure for table `files`
#
# Creation: Mar 04, 2003 at 08:11 AM
# Last update: Mar 04, 2003 at 08:11 AM
#

DROP TABLE IF EXISTS `files`;
CREATE TABLE `files` (
  `id_files` varchar(50) NOT NULL default '',
  `bin_data` longblob NOT NULL,
  `filename` varchar(50) NOT NULL default '',
  `filesize` varchar(50) NOT NULL default '',
  `filetype` varchar(50) NOT NULL default '',
  `resource_id` varchar(50) default NULL,
  PRIMARY KEY  (`id_files`)
) TYPE=MyISAM;

#
# Dumping data for table `files`
#


# --------------------------------------------------------

#
# Table structure for table `groups`
#
# Creation: Dec 11, 2002 at 11:50 PM
# Last update: Dec 11, 2002 at 11:50 PM
#

DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `group_id` varchar(50) NOT NULL default '',
  `display_name` varchar(120) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `groups`
#

INSERT INTO `groups` (`group_id`, `display_name`) VALUES ('350b0ed830e899da26070a007d0032a5', 'admin');
INSERT INTO `groups` (`group_id`, `display_name`) VALUES ('7663a48b49b225e412e80b9578a71f91', 'author');
INSERT INTO `groups` (`group_id`, `display_name`) VALUES ('c900803eec72442b4705903331fbf3e2', 'custom');

# --------------------------------------------------------

#
# Table structure for table `homepage`
#
# Creation: Dec 18, 2002 at 08:11 AM
# Last update: Aug 18, 2003 at 12:39 PM
#

DROP TABLE IF EXISTS `homepage`;
CREATE TABLE `homepage` (
  `content_id` varchar(32) NOT NULL default '',
  `pos` tinyint(3) NOT NULL default '0',
  `site_id` varchar(32) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `homepage`
#


# --------------------------------------------------------

#
# Table structure for table `locks`
#
# Creation: Dec 11, 2002 at 11:50 PM
# Last update: Dec 19, 2003 at 07:55 AM
#

DROP TABLE IF EXISTS `locks`;
CREATE TABLE `locks` (
  `lock_id` varchar(55) NOT NULL default '',
  `content_id` varchar(55) NOT NULL default '',
  `user_id` varchar(55) NOT NULL default '',
  `date_locked` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`lock_id`)
) TYPE=MyISAM;

#
# Dumping data for table `locks`
#


# --------------------------------------------------------

#
# Table structure for table `meta_data`
#
# Creation: Mar 04, 2003 at 06:49 AM
# Last update: Dec 18, 2003 at 09:29 AM
#

DROP TABLE IF EXISTS `meta_data`;
CREATE TABLE `meta_data` (
  `cat_id` varchar(55) NOT NULL default '',
  `meta_data` text NOT NULL
) TYPE=MyISAM;

#
# Dumping data for table `meta_data`
#


# --------------------------------------------------------

#
# Table structure for table `related_resources_to_content`
#
# Creation: Dec 11, 2002 at 11:50 PM
# Last update: Nov 27, 2003 at 12:28 PM
#

DROP TABLE IF EXISTS `related_resources_to_content`;
CREATE TABLE `related_resources_to_content` (
  `resource_id` varchar(50) NOT NULL default '',
  `content_id` varchar(50) NOT NULL default '',
  `type` varchar(50) default NULL
) TYPE=MyISAM;

#
# Dumping data for table `related_resources_to_content`
#


# --------------------------------------------------------

#
# Table structure for table `resources`
#
# Creation: Dec 11, 2002 at 11:50 PM
# Last update: Nov 17, 2003 at 07:28 AM
#

DROP TABLE IF EXISTS `resources`;
CREATE TABLE `resources` (
  `resource_id` varchar(50) NOT NULL default '',
  `display_name` varchar(80) NOT NULL default '',
  `value` varchar(120) default NULL,
  `resource_type` varchar(120) NOT NULL default '',
  `description` text,
  `date_added` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`resource_id`)
) TYPE=MyISAM;

#
# Dumping data for table `resources`
#


# --------------------------------------------------------

#
# Table structure for table `site_info`
#
# Creation: Dec 11, 2002 at 11:50 PM
# Last update: Sep 01, 2003 at 08:45 AM
#

DROP TABLE IF EXISTS `site_info`;
CREATE TABLE `site_info` (
  `site_id` varchar(50) NOT NULL default '',
  `site_name` varchar(80) NOT NULL default '',
  `url` varchar(120) default NULL,
  `drop_down` int(4) default NULL,
  `start_pos` int(4) default NULL,
  `left_pos` int(4) default NULL,
  `orientation` varchar(20) default NULL,
  `menu_spacing` int(4) default NULL,
  `upload_size` int(16) NOT NULL default '0',
  PRIMARY KEY  (`site_id`)
) TYPE=MyISAM;

#
# Dumping data for table `site_info`
#

INSERT INTO `site_info` (`site_id`, `site_name`, `url`, `drop_down`, `start_pos`, `left_pos`, `orientation`, `menu_spacing`, `upload_size`) VALUES ('f926b87567d4affc6618d83f73c2cc87', 'admin', 'http://www.teacupinastorm.com/tcias_admin/', 1, 86, 15, '1', 10, 1024000);


# --------------------------------------------------------

#
# Table structure for table `type`
#
# Creation: Dec 11, 2002 at 11:50 PM
# Last update: Nov 17, 2003 at 06:37 AM
#

DROP TABLE IF EXISTS `type`;
CREATE TABLE `type` (
  `type_id` varchar(50) NOT NULL default '',
  `type` varchar(40) NOT NULL default '',
  `extension` varchar(5) NOT NULL default '',
  PRIMARY KEY  (`type_id`)
) TYPE=MyISAM;

#
# Dumping data for table `type`
#

INSERT INTO `type` (`type_id`, `type`, `extension`) VALUES ('a0f001fd6491e4cdca614311cfe7f95f', 'link', '');
INSERT INTO `type` (`type_id`, `type`, `extension`) VALUES ('b08153e42a0dfd155ae5e6bf95a160c2', 'book', '');
INSERT INTO `type` (`type_id`, `type`, `extension`) VALUES ('da05fcb96d307c835559b8160ec9cf5f', 'image', 'gif');
INSERT INTO `type` (`type_id`, `type`, `extension`) VALUES ('a7985626650929b19d14ecd4842ff4f4', 'word document', 'doc');
INSERT INTO `type` (`type_id`, `type`, `extension`) VALUES ('67538bd33685314e3c48fdf9abd2d8db', 'pdf', 'pdf');
INSERT INTO `type` (`type_id`, `type`, `extension`) VALUES ('1a4f47e9676df468c53f0ba4f9193718', 'download', '');
INSERT INTO `type` (`type_id`, `type`, `extension`) VALUES ('bb4f74b892a4854e3f0bcf262acf1e09', 'article', '');
INSERT INTO `type` (`type_id`, `type`, `extension`) VALUES ('28b7e8ea66393cd33eb1ee6937f73048', 'image', 'jpg');
INSERT INTO `type` (`type_id`, `type`, `extension`) VALUES ('cc65c4d6f03e627e7f038d29e7e4655a', 'quicktime vr', 'mov');
INSERT INTO `type` (`type_id`, `type`, `extension`) VALUES ('e88c5cf2b1e96f816159bbab6a045862', 'rich text document', 'rtf');
INSERT INTO `type` (`type_id`, `type`, `extension`) VALUES ('68989546b0202d644ba506857b51ff80', 'dropplet', '');

# --------------------------------------------------------

#
# Table structure for table `user_resource_access`
#
# Creation: Dec 11, 2002 at 11:50 PM
# Last update: Jul 11, 2003 at 05:00 AM
#

DROP TABLE IF EXISTS `user_resource_access`;
CREATE TABLE `user_resource_access` (
  `user_id` varchar(50) NOT NULL default '',
  `category_id` varchar(50) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table `user_resource_access`
#

INSERT INTO `user_resource_access` (`user_id`, `category_id`) VALUES ('745b6d70df77493147f895945eb35553', '9a973d83d2d6b5d5cfc1acbd2b385645');
INSERT INTO `user_resource_access` (`user_id`, `category_id`) VALUES ('745b6d70df77493147f895945eb35553', 'ea121c93474420dce2fa4a11e3dc462f');
INSERT INTO `user_resource_access` (`user_id`, `category_id`) VALUES ('745b6d70df77493147f895945eb35553', 'dcc8b090c21fa2bb7ce7c25485f6aaf9');
INSERT INTO `user_resource_access` (`user_id`, `category_id`) VALUES ('745b6d70df77493147f895945eb35553', '7f0f5437515bd182b08004b470eaffb0');
INSERT INTO `user_resource_access` (`user_id`, `category_id`) VALUES ('745b6d70df77493147f895945eb35553', '3f5d9c5159bb51ca19297aa2b6f93aae');
INSERT INTO `user_resource_access` (`user_id`, `category_id`) VALUES ('745b6d70df77493147f895945eb35553', '803b39cf2cb4918a15115940d52c41d1');
INSERT INTO `user_resource_access` (`user_id`, `category_id`) VALUES ('745b6d70df77493147f895945eb35553', 'c2b894f25a108f1ac53817f92af02422');
INSERT INTO `user_resource_access` (`user_id`, `category_id`) VALUES ('745b6d70df77493147f895945eb35553', 'def07c2fba0176afaca8c915357f96d2');
INSERT INTO `user_resource_access` (`user_id`, `category_id`) VALUES ('745b6d70df77493147f895945eb35553', '4629bc0507beb070a3799df13c0ef5ec');
INSERT INTO `user_resource_access` (`user_id`, `category_id`) VALUES ('745b6d70df77493147f895945eb35553', 'd21dcd5fff08232f52177a6ce31a879d');
INSERT INTO `user_resource_access` (`user_id`, `category_id`) VALUES ('745b6d70df77493147f895945eb35553', 'd76ca075d56762bec415431d302d5b2b');
INSERT INTO `user_resource_access` (`user_id`, `category_id`) VALUES ('745b6d70df77493147f895945eb35553', 'a712b4dfb1b99ca518e38c44a121efa0');
INSERT INTO `user_resource_access` (`user_id`, `category_id`) VALUES ('745b6d70df77493147f895945eb35553', 'b51bc57ac3cd7052b53a7ce9d308bf6f');
INSERT INTO `user_resource_access` (`user_id`, `category_id`) VALUES ('745b6d70df77493147f895945eb35553', '74f3e657981fbc4aa9a0359fe5d4bb7a');
INSERT INTO `user_resource_access` (`user_id`, `category_id`) VALUES ('745b6d70df77493147f895945eb35553', '069de17c6e55f0ec88242774bbe9b84a');
INSERT INTO `user_resource_access` (`user_id`, `category_id`) VALUES ('745b6d70df77493147f895945eb35553', '15a0b60b820c68c24750180bc221c60f');
INSERT INTO `user_resource_access` (`user_id`, `category_id`) VALUES ('745b6d70df77493147f895945eb35553', '90894d10d361dc8131256f12470b5315');
INSERT INTO `user_resource_access` (`user_id`, `category_id`) VALUES ('745b6d70df77493147f895945eb35553', 'e8648d0e043eff3d08aedd19e9920533');
INSERT INTO `user_resource_access` (`user_id`, `category_id`) VALUES ('745b6d70df77493147f895945eb35553', '9274ac68c5eddb086027081356dbe741');
INSERT INTO `user_resource_access` (`user_id`, `category_id`) VALUES ('745b6d70df77493147f895945eb35553', 'c2640e5a57929591f73fca38f5ac8d00');
INSERT INTO `user_resource_access` (`user_id`, `category_id`) VALUES ('745b6d70df77493147f895945eb35553', '30b980ba677972335419ec6c5a1e063f');
INSERT INTO `user_resource_access` (`user_id`, `category_id`) VALUES ('745b6d70df77493147f895945eb35553', '9ce36d845efb62fe3344d187951b1d2f');
INSERT INTO `user_resource_access` (`user_id`, `category_id`) VALUES ('745b6d70df77493147f895945eb35553', 'f61ba7a45266c937876a31b43847702f');
INSERT INTO `user_resource_access` (`user_id`, `category_id`) VALUES ('745b6d70df77493147f895945eb35553', '6c2cb5aa273684d7cc48d01be49a3dd0');
INSERT INTO `user_resource_access` (`user_id`, `category_id`) VALUES ('745b6d70df77493147f895945eb35553', 'f247017260e44cd788d401835d88a909');
INSERT INTO `user_resource_access` (`user_id`, `category_id`) VALUES ('745b6d70df77493147f895945eb35553', '9102779955bd01502d7dd8f52a250709');
INSERT INTO `user_resource_access` (`user_id`, `category_id`) VALUES ('745b6d70df77493147f895945eb35553', 'f926b87567d4affc6618d83f73c2cc87');

# --------------------------------------------------------

#
# Table structure for table `users`
#
# Creation: Dec 11, 2002 at 11:50 PM
# Last update: Jul 11, 2003 at 05:00 AM
#

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` varchar(50) NOT NULL default '',
  `username` varchar(80) NOT NULL default '',
  `password` varchar(32) NOT NULL default '',
  `name` varchar(80) NOT NULL default '',
  `firstname` varchar(80) NOT NULL default '',
  `email` varchar(255) NOT NULL default '',
  `group_membership` varchar(50) default NULL,
  `department` varchar(120) NOT NULL default '',
  PRIMARY KEY  (`user_id`)
) TYPE=MyISAM;

#
# Dumping data for table `users`
#

INSERT INTO `users` (`user_id`, `username`, `password`, `name`, `firstname`, `email`, `group_membership`, `department`) VALUES ('745b6d70df77493147f895945eb35553', 'admin', 'paNRiObD/JeFo', 'User', 'Super', 'your@email.com', '350b0ed830e899da26070a007d0032a5', '');
