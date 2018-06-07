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

// Configuration Settings
 header('Content-Type: text/html; charset=UTF-8');
  	ini_set('display_errors', 'Off');
	error_reporting(E_ALL ^ E_STRICT);
	
// phpDirectorySourcer Version
$config['pds_ver'] = "1.1.08";

//----------------------------------------------------------
// mysql Database Connection
//----------------------------------------------------------

$db_host = "inforeshatech.globatmysql.com"; 		//mySQL Database Host
$db_name = "elgg_inforesha";				//mySQL Database Name
$db_user = "elgg_inforesha";				//mySQL Database User
$db_password = "elgg_inforesha";		//mySQL Database Password

// Table Names
$pds_admin = "pds_admin";
$pds_user = "pds_user";
$pds_list = "pds_list";
$pds_category = "pds_category";
$pds_listcat = "pds_listcat";
$pds_locsel = "pds_locsel";
$pds_loclevel = "pds_loclevel";
$pds_us_zip = "pds_us_zip";
$pds_level = "pds_level";
$pds_exp = "pds_exp";
$pds_lang = "pds_lang";
$pds_liststats = "pds_liststats";
$pds_cronjob = "pds_cronjob";
$pds_mods = "pds_mods";
$pds_locrelate = "pds_locrelate";

// Default language set
$lang_set = 'en';

//----------------------------------------------------------
// Main Configuration
//----------------------------------------------------------

// Absolute path to directory
$config['root'] = dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR;//$_SERVER['DOCUMENT_ROOT']."/business_listing/business_listing/";	//includes trailing slash

// Main Location
$config['mainurl'] = "http://inforeshatech.globat.com/dev/elgg/mod/business_listing/business_listing";			//no trailing slash

// Admin Email
$config['admin_email'] = "sangram@inforeshatech.com";

// Admin Email Name
$config['admin_name'] = "Admin";

// Paypal Account Email
$config['paypal_email'] = "";

// Paypal Currency
$config['paypal_currency'] = "USD";

// Default Template
$config['deftpl'] = "default";

// Add listings in any category
$config['add_any_cat'] = false; //true or false

// Show admin link on site menu
$config['show_admin'] = true; //true or false

// Cateogry select width
$config['cat_sel_w'] = 220;

// Category select boxes per row
$config['cat_col'] = 2;

// Number of categories per page to display
$config['cats_page'] = 20;

// Number of listings per page to display
$config['lists_page'] = 10;

// Number of users per page to display
$config['users_page'] = 20;

// Number of search results per page to display
$config['search_page'] = 10;

// Auto Approve Listings
$config['auto_approve'] = true; //true or false

// Auto Approve Updated Listings
$config['auto_update'] = true; //true or false

// Free Listing Level ID
$config['free_level'] = "1";

// Max Logo Width
$config['logo_w'] = "240";

// Max Logo Height
$config['logo_h'] = "120";

// Light Background on sub listings
$config['bg_light'] = "#FFFFFF";

// Dark Background on sub listings
$config['bg_dark'] = "#EEEEEE";

// Target when visit website clicked
$config['web_target'] = "target = _blank"; //_self for same window, _blank for new window

// Allow admin to change user password
$config['admin_chg_pw'] = false;	//true or false

// Disble empty categories
$config['disable_empty_cat'] = false;	//true or false

// Enable mod rewrite pages
$config['rewrite'] = false;	//true or false

//Site to use for mapping
$config['map_site'] = 'google';	//google or mapquest

// tags to allow in user input
$allow_tags = array();

// attributes to allow in user input
$allow_attr = array();

//----------------------------------------------------------
// Enable / Setup Locations
//----------------------------------------------------------

//Use admin configured location selects
$config['use_loc_sel'] = false;

// Primary Location Level
$config['prim_loc_level'] = 1;

//Use zip code limits by range on site search
$config['use_zip_limit'] = true;

//Distance is in kilometeres otherwise distance is miles
$config['convert_kilometer'] = false;	//true or false

//----------------------------------------------------------
// Enable Listing Fields
//----------------------------------------------------------

$enabled['description'] = true; //true or false
$enabled['address'] = true; //true or false
$enabled['loc1'] = true; //true or false
$enabled['loc2'] = false; //true or false
$enabled['loc3'] = false; //true or false
$enabled['zip'] = true; //true or false
$enabled['contact'] = true; //true or false
$enabled['phone'] = true; //true or false
$enabled['fax'] = true; //true or false
$enabled['mobile'] = true; //true or false
$enabled['listmail'] = true; //true or false
$enabled['website'] = true; //true or false
$enabled['xtra_1'] = false; //true or false
$enabled['xtra_2'] = false; //true or false
$enabled['xtra_3'] = false; //true or false
$enabled['xtra_4'] = false; //true or false
$enabled['xtra_5'] = false; //true or false
$enabled['xtra_6'] = false; //true or false

//----------------------------------------------------------
// Enable Membership Custom Fields
//----------------------------------------------------------

$enabled['custom_1'] = false; //true or false
$enabled['custom_2'] = false; //true or false
$enabled['custom_3'] = false; //true or false
$enabled['custom_4'] = false; //true or false
$enabled['custom_5'] = false; //true or false
$enabled['custom_6'] = false; //true or false

//----------------------------------------------------------
// Require Listing Fields
//----------------------------------------------------------

$required['description'] = true; //true or false
$required['address'] = false; //true or false
$required['loc1'] = false; //true or false
$required['loc2'] = false; //true or false
$required['loc3'] = false; //true or false
$required['zip'] = false; //true or false
$required['contact'] = false; //true or false
$required['phone'] = false; //true or false
$required['fax'] = false; //true or false
$required['mobile'] = false; //true or false
$required['listmail'] = false; //true or false
$required['wewbsite'] = false; //true or false
$required['xtra_1'] = false; //true or false
$required['xtra_2'] = false; //true or false
$required['xtra_3'] = false; //true or false
$required['xtra_4'] = false; //true or false
$required['xtra_5'] = false; //true or false
$required['xtra_6'] = false; //true or false

//----------------------------------------------------------
// Email notifications
//----------------------------------------------------------

// Notify admin of new user
$notify['admin_user'] = true; //true or false

// Notify admin of new listing
$notify['admin_list'] = true; //true or false

// Notify user of new listing submitted
$notify['user_submit'] = true; //true or false

// Notify user of new listing approved
$notify['user_approved'] = true; //true or false

// Notify user when cron job downgrades listing
$notify['user_downgrade'] = true; //true or false

//----------------------------------------------------------
// Smarty Template Setup
//----------------------------------------------------------

// Smarty Libs Directory Definition
define('SMARTY_DIR', $config[root].'smarty/libs/');

require(SMARTY_DIR . 'Smarty.class.php');

class Smarty_PDS extends Smarty {

	function Smarty_PDS() {
	
		$this->Smarty();
		$this->template_dir = $config['root'] . 'templates/';
		$this->compile_dir = $config['root'] . 'templates_c/';
		$this->config_dir = $config['root'] . 'configs/';
		$this->cache_dir = $config['root'] . 'cache/';
	}
}
?>
