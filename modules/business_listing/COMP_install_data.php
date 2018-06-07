<?PHP
/*
Copyright (c) 2005-2008, Wagon Trader (an Oregon USA business)
All rights reserved.

Redistribution and use in source and binary forms, with or without modification, 
are permitted provided that the following conditions are met:

Redistributions of source code must retain the above copyright notice, 
this list of conditions and the following disclaimer. 

Redistributions in binary form must reproduce the above copyright notice, 
this list of conditions and the following disclaimer in the documentation 
and/or other materials provided with the distribution.

All pages generated from the use of phpDirectorySource must contain the statement
"Powered by: phpDirectorySource" with an active link to http://www.phpdirectorysource.com,
unless a waiver is granted by the copyright holder.

Neither the name of Wagon Trader nor the names of its contributors may be used to endorse 
or promote products derived from this software without specific prior written permission. 

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS 
OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY 
AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR 
CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL 
DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, 
DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER 
IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT 
OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
*/

//
// Configuration
//
$admin_login = "admin";
$admin_pw = "admin";

$md5_pw = md5($admin_pw);

//
// Includes
//

// Configuration Settings
include ("configs/config.php");

// Database Connection Module
include ("modules/connect.php");

//Admin table
mysql_query("DROP TABLE IF EXISTS $pds_admin;");
mysql_query("CREATE TABLE $pds_admin (
  `login` varchar(20) default NULL,
  `pass` varchar(32) default NULL,
  `f_full` int(1) default NULL,
  `f_user` int(1) default NULL,
  `f_list` int(1) default NULL,
  `f_category` int(1) default NULL,
  `f_level` int(1) default NULL,
  `f_exp` int(1) default NULL,
  UNIQUE KEY `login` (`login`)
) TYPE=MyISAM;") or die(mysql_error());

//Admin table data
mysql_query("INSERT INTO $pds_admin VALUES ('$admin_login','$md5_pw',1,NULL,NULL,NULL,NULL,NULL);");

//Category Table
mysql_query("DROP TABLE IF EXISTS $pds_category;");
mysql_query("CREATE TABLE $pds_category (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(60) default NULL,
  `p` int(11) default NULL,
  `f_mt` int(1) default NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;");

//Cron job table
mysql_query("DROP TABLE IF EXISTS $pds_cronjob;");
mysql_query("CREATE TABLE $pds_cronjob (
  `last_run` date NOT NULL default '0000-00-00'
) TYPE=MyISAM;");

//Initialize cronjob
mysql_query("INSERT INTO $pds_cronjob VALUES(NOW());");

//Expiration Periods table
mysql_query("DROP TABLE IF EXISTS $pds_exp;");
mysql_query("CREATE TABLE $pds_exp (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(20) default NULL,
  `days` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;");

//Expiration periods data
mysql_query("INSERT INTO $pds_exp VALUES (1,'Day(s)',1);");
mysql_query("INSERT INTO $pds_exp VALUES (2,'Month(s)',30);");
mysql_query("INSERT INTO $pds_exp VALUES (3,'Year(s)',365);");

//Language table
mysql_query("DROP TABLE IF EXISTS $pds_lang;");
mysql_query("CREATE TABLE $pds_lang (
  `code_set` varchar(16) NOT NULL default '',
  `code_lang` varchar(5) NOT NULL default '',
  `code_code` varchar(32) NOT NULL default '',
  `code_desc` text NOT NULL,
  `code_order` smallint(6) NOT NULL default '0',
  `code_flag` char(1) NOT NULL default ''
) TYPE=MyISAM;");

//Membership Level table
mysql_query("DROP TABLE IF EXISTS $pds_level;");
mysql_query("CREATE TABLE $pds_level (
  `level` int(5) NOT NULL auto_increment,
  `title` varchar(30) default NULL,
  `cost` decimal(10,2) default NULL,
  `expire` int(5) default NULL,
  `expire_period` int(2) default NULL,
  `description` int(1) NOT NULL default '0',
  `addr1` int(1) NOT NULL default '0',
  `loc1` int(1) NOT NULL default '0',
  `zip` int(1) NOT NULL default '0',
  `contact` int(1) NOT NULL default '0',
  `phone` int(1) NOT NULL default '0',
  `fax` int(1) NOT NULL default '0',
  `mobile` int(1) NOT NULL default '0',
  `listmail` int(1) NOT NULL default '0',
  `website` int(1) NOT NULL default '0',
  `cats` int(5) NOT NULL default '1',
  `logo` int(1) NOT NULL default '0',
  `premium` int(1) NOT NULL default '0',
  `xtra_1` int(1) NOT NULL default '0',
  `xtra_2` int(1) NOT NULL default '0',
  `xtra_3` int(1) NOT NULL default '0',
  `xtra_4` int(1) NOT NULL default '0',
  `xtra_5` int(1) NOT NULL default '0',
  `xtra_6` int(1) NOT NULL default '0',
  `custom_1` int(1) NOT NULL default '0',
  `custom_2` int(1) NOT NULL default '0',
  `custom_3` int(1) NOT NULL default '0',
  `custom_4` int(5) NOT NULL default '0',
  `custom_5` int(5) NOT NULL default '0',
  `custom_6` int(5) NOT NULL default '0',
  PRIMARY KEY  (`level`)
) TYPE=MyISAM;");

//Membership Level data
mysql_query("INSERT INTO $pds_level VALUES (1,'Free',0.00,1,3,1,1,1,1,1,1,1,1,1,1,5,1,0,0,0,0,0,0,0,0,0,0,0,0,0);");

//Listings table
mysql_query("DROP TABLE IF EXISTS $pds_list;");
mysql_query("CREATE TABLE $pds_list (
  `id` int(11) NOT NULL auto_increment,
  `userid` int(11) default NULL,
  `state` char(3) NOT NULL default 'off',
  `level` int(5) NOT NULL default '1',
  `firm` varchar(100) default NULL,
  `address1` text,
  `address2` text,
  `loc_sel` int(11) default NULL,
  `loc1` varchar(100) default NULL,
  `loc2` varchar(100) default NULL,
  `loc3` varchar(100) default NULL,
  `zip` varchar(10) default NULL,
  `contact` varchar(60) default NULL,
  `phone` varchar(20) default NULL,
  `fax` varchar(20) default NULL,
  `mobile` varchar(20) default NULL,
  `description` text,
  `email` varchar(100) default NULL,
  `website` varchar(100) default NULL,
  `logo_ext` varchar(5) default NULL,
  `d_submit` date default NULL,
  `review_by` varchar(20) default NULL,
  `d_review` date default NULL,
  `d_update` date default NULL,
  `d_upgrade` date default NULL,
  `d_expire` date default NULL,
  `premium` int(5) NOT NULL default '0',
  `xtra_1` text,
  `xtra_2` text,
  `xtra_3` text,
  `xtra_4` text,
  `xtra_5` text,
  `xtra_6` text,
  PRIMARY KEY  (`id`),
  FULLTEXT KEY `desc` (`description`)
) TYPE=MyISAM;");

//Listing Categories table
mysql_query("DROP TABLE IF EXISTS $pds_listcat;");
mysql_query("CREATE TABLE $pds_listcat (
  `list_id` int(11) default NULL,
  `cat_id` int(11) default NULL
) TYPE=MyISAM;");

//Listing Statistics table
mysql_query("DROP TABLE IF EXISTS $pds_liststats;");
mysql_query("CREATE TABLE $pds_liststats (
  `list_id` int(11) default NULL,
  `page_views` int(11) default NULL,
  `sub_views` int(11) default NULL
) TYPE=MyISAM;");

//Location relation table
mysql_query("DROP TABLE IF EXISTS $pds_locrelate;");
mysql_query("CREATE TABLE $pds_locrelate (
  `zip` varchar(10) NOT NULL default '',
  `loc_prim` varchar(60) default NULL,
  `loc_sec` varchar(60) default NULL,
  `lat` float(10,6) NOT NULL default '0.000000',
  `lon` float(10,6) NOT NULL default '0.000000'
) TYPE=MyISAM;");

//Location Selects table
mysql_query("DROP TABLE IF EXISTS $pds_locsel;");
mysql_query("CREATE TABLE $pds_locsel (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(60) default NULL,
  `p` int(11) default NULL,
  `level` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;");

//Modifications table
mysql_query("DROP TABLE IF EXISTS $pds_mods;");
mysql_query("CREATE TABLE $pds_mods (
  `d_added` date NOT NULL default '0000-00-00',
  `title` varchar(40) NOT NULL default '',
  `ver` varchar(10) default NULL,
  `added_by` varchar(20) default NULL
) TYPE=MyISAM;");

//Users table
mysql_query("DROP TABLE IF EXISTS $pds_user;");
mysql_query("CREATE TABLE $pds_user (
  `id` int(11) NOT NULL auto_increment,
  `login` varchar(20) default NULL,
  `pass` varchar(32) default NULL,
  `usermail` varchar(100) default NULL,
  `joindate` date default NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;");

//************************************
// Code Setup (code_set)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','code_set','code set',-3,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','code_set','code',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','code_set','código',0,'');");

//************************************
// Code Admin (code_admin)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','code_admin','code admin',-1,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','code_admin','code admin',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','code_admin','cifre el admin',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_admin','en','code_admin','param=1 slave=1',0,'');");

//************************************
// Languages (code_lang)
//************************************
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','en','code_lang','language',-2,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','fr','code_lang','langue',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_set','sp','code_lang','lengua',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_lang','en','en','English',-1,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_lang','en','fr','French',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_lang','en','sp','Spanish',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_lang','fr','en','anglais',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_lang','fr','fr','français',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_lang','fr','sp','Espagnol',0,'');");

mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_lang','sp','en','Inglés',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_lang','sp','fr','Francés',0,'');");
mysql_query("INSERT INTO $pds_lang (`code_set`, `code_lang`, `code_code`, `code_desc`, `code_order`, `code_flag`) VALUES ('code_lang','sp','sp','Español',0,'');");

mysql_query("INSERT INTO $pds_mods VALUES (NOW(),'phpDirectorySource','$config[pds_ver]','System');");

echo "Update Completed";

?>
