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

//***********************************************
// Include Modules
//***********************************************
include ("modules/modules.php");

//***********************************************
// Include Variable Sets
//***********************************************
include ("configs/common_vs.php");

//***********************************************
// Assign Local Variables
//***********************************************
$title_tag = "Featured List";
$bread_crumb[0] = "Featured List";
$btn_link[0] = "disabled";
 		//***********************************************
		// Listings
		//***********************************************

		$r_list =mysql_query("SELECT * FROM $pds_list WHERE state='apr' and level='2' ORDER BY RAND() LIMIT 0,10;");
		for ($x=0;$x<mysql_num_rows($r_list);$x++){
			$list[$x] = mysql_fetch_assoc($r_list);
			$check_file = "sublist".$list[$x][level].".tpl";
			if (is_readable("templates/$config[deftpl]/sublist/$check_file")){
				$list[$x][subfile] = $check_file;
			}else{
				$list[$x][subfile] = "sublist0.tpl";
			}
			if($x%2){
				$list[$x][bgcolor] = $config['bg_dark'];
			}else{
				$list[$x][bgcolor] = $config['bg_light'];
			}
			$check_file = $list[$x]['id'].".".$list[$x]['logo_ext'];
			if ($list[$x]['logo_ext'] != "" AND is_readable("logo/$check_file")){
				$list[$x]['logo'] = "$config[mainurl]/logo/$check_file?".rand();
			}
			$list[$x]['mod_firm'] = str_replace(" ","_",$list[$x]['firm']);
			$list[$x]['mod_firm'] = str_replace("/","-",$list[$x]['mod_firm']);

          $list[$x]['tip_firm'] = addslashes(htmlentities($list[$x]['firm']));
          $list[$x]['tip_phone'] = addslashes(htmlentities($list[$x]['phone']));
          $list[$x]['tip_address'] = addslashes(htmlentities(str_replace("\r\n","<br>",$list[$x]['address1'])));
          $list[$x]['tip_description'] = addslashes(htmlentities(str_replace("\r\n","<br>",$list[$x]['description'])));
          $list[$x]['desc_elipsis'] = snippet($list[$x]['description']);
	$list[$x]['country'] = getCountry_name($list[$x]['country']);
			$list[$x]['states'] = getState_name($list[$x]['states_id']);
//** for Promotion End **//
include "sublist_promotion.php";
//** for Promotion End **//

//**For Favorite Listing **//
	$strsql="SELECT count( id ) FROM pds_list_favorites WHERE list_id =".$list[$x]['id']." and user_id=".$_SESSION['userid'];

    $sql =  mysql_fetch_row(mysql_query($strsql));
	$favorites_count = $sql[0];

    $list[$x]['favorites'] = $favorites_count ;
//*** For Favorite Listing **//
		}
		$tpl-> assign('feature_list',$list);
		//get unread messages


//***********************************************
// Assign local variables to template
//***********************************************
$tpl-> assign('title_tag', $title_tag);
$tpl-> assign('bread_crumb', $bread_crumb);
$tpl-> assign('btn_link',$btn_link);

$tpl-> assign('show_page','user');

//***********************************************
// Display Template
//***********************************************
$tpl-> display("$config[deftpl]/featured.tpl");

?>
