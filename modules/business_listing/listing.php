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
$title_tag = "All Listings";
$bread_crumb[0] = "All Listings";
$btn_link[0] = "disabled";

//***********************************************
// Listings
//***********************************************
    //All sub listing
    //$r_list =mysql_query("SELECT DISTINCT l.* FROM $pds_list l WHERE state='apr' and level='2' ORDER BY RAND() LIMIT 0,10;");
    $r_list =mysql_query("SELECT DISTINCT l.* FROM $pds_list l WHERE state='apr' ORDER BY firm LIMIT 0,10;");
    //include "sublist_promotion.php";
    $list=getMeListFromRecords($r_list);
    $tpl->assign('feature_list',$list);
    unset($list);

    //Recent listings
    $r_list = mysql_query("SELECT DISTINCT l.* FROM $pds_list l WHERE state='apr' ORDER BY d_submit DESC LIMIT 0,10;");
    //include "sublist_promotion.php" ;
    $list=getMeListFromRecords($r_list);
    $tpl-> assign('recent_list',$list);
    unset($list);
    
 	//popular listings
	//$r_list =mysql_query("SELECT l.* ,round((AVG(question1)+AVG(question2)+AVG(question3)+AVG(question4)+AVG(question5)+AVG(question6)+AVG(question7))/7) as vote_avg FROM $pds_list l LEFT OUTER JOIN pds_votes v ON l.id = v.list_id GROUP BY list_id having state='apr' ORDER BY vote_avg DESC LIMIT 0,10;");
		//popular Promotions
	$r_list =mysql_query("SELECT l.*,count(f.id)
FROM pds_list l
INNER JOIN `pds_list_favorites` f ON f.list_id = l.id
WHERE l.state='apr' AND f.ispromotion =0 GROUP BY f.id LIMIT 0,10
");
    //include "sublist_promotion.php";
    $list=getMeListFromRecords($r_list);
	$tpl-> assign('popular_list',$list);

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
$tpl-> display("$config[deftpl]/listing.tpl");

?>
