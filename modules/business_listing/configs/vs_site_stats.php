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
// Variable Set - Site Statistics
//***********************************************

$vs_stat_user = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM $pds_user"));
$vs_stat_list_sub = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM $pds_list WHERE state='sub';"));
$vs_stat_list_act = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM $pds_list WHERE state='apr';"));
$vs_stat_list_del = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM $pds_list WHERE state='del';"));
$vs_stat_cat_tot = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM $pds_category;"));
$vs_stat_cat_on = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM $pds_category WHERE f_mt != '';"));
$vs_stat_cat_off = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM $pds_category WHERE f_mt = '' OR f_mt IS NULL;"));

$r_mod = mysql_query("SELECT * FROM $pds_mods ORDER BY d_added");
for($x=0;$x<mysql_num_rows($r_mod);$x++){
	$f_mod = mysql_fetch_assoc($r_mod);
	foreach($f_mod as $key => $value){
		$vs_mods[$x][$key] = $value;
	}
}

$tpl-> assign('vs_mods',$vs_mods);
$tpl-> assign('vs_stat_user',$vs_stat_user[0]);
$tpl-> assign('vs_stat_list_sub',$vs_stat_list_sub[0]);
$tpl-> assign('vs_stat_list_act',$vs_stat_list_act[0]);
$tpl-> assign('vs_stat_list_del',$vs_stat_list_del[0]);
$tpl-> assign('vs_stat_cat_tot',$vs_stat_cat_tot[0]);
$tpl-> assign('vs_stat_cat_on',$vs_stat_cat_on[0]);
$tpl-> assign('vs_stat_cat_off',$vs_stat_cat_off[0]);

?>