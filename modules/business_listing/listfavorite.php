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

$btn_link[0] = "disabled";
//***********************************************
// Listings
//***********************************************
//..Get type of the intrseted in
if ((isset($_REQUEST['show_type'])) && ($_REQUEST['show_type']=='PR')){
	$ispromotion=1;
}else{
  	$ispromotion=0;
}


 if($ispromotion==1){
	  $sql_qry =  "SELECT Distinct l. * FROM pds_list_promotions p left outer join pds_list l on p.list_id = l.id inner join pds_list_favorites f on p.id = f.list_id WHERE f.ispromotion = 1 and p.end_date>=CURDATE() and f.user_id=".$_SESSION['userid']." ORDER BY firm";
 	$title_tag = "My Favorite Promotions";
    $bread_crumb[0] = "My Favorite Promotions";
    
}else{
    $sql_qry =  "SELECT Distinct l.* FROM pds_list l inner join pds_list_favorites f on l.id = f.list_id WHERE f.ispromotion = 0 and f.user_id=".$_SESSION['userid']." ORDER BY firm";
   	$title_tag = "My Favorite Business";
 	$bread_crumb[0] = "My Favorite Business";
}



$r_list =mysql_query($sql_qry);

$list=getMeListFromRecords($r_list,0 ," and f.user_id=".$_SESSION['userid']);

$tpl-> assign('list',$list);


//***********************************************
// Assign local variables to template
//***********************************************
$tpl-> assign('title_tag', $title_tag);
$tpl-> assign('bread_crumb', $bread_crumb);
$tpl-> assign('btn_link',$btn_link);
$tpl-> assign('ispromotion',$ispromotion);
$tpl-> assign('show_page','user');

//***********************************************
// Display Template
//***********************************************
$tpl-> display("$config[deftpl]/listfavorite.tpl");

?>
