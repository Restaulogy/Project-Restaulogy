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
// Variable Set - Membership Levels
//***********************************************

$r = mysql_query("SELECT * FROM $pds_level") or die( mysql_error() );
$rows = mysql_num_rows($r);
for ($x=0;$x<$rows;$x++){
	$f = mysql_fetch_assoc($r);
	$ra = mysql_query("SELECT * FROM $pds_exp WHERE id='$f[expire_period]';");
	$fa = mysql_fetch_assoc($ra);
	$id = $f[level];
	$vs_level_ct[$x] = $id;
	$vs_level[$id][exp_title] = $fa[title];
	$vs_level[$id][exp_days] = $fa[days];
	$vs_level[$id][cpd] = $f[cost]/($f[expire]*$fa[days]);
	foreach($f as $key => $value){
		$vs_level[$id][$key] = $value;
	}
	mysql_free_result($ra);
}
mysql_free_result($r);

$tpl-> assign('vs_level',$vs_level);
$tpl-> assign('vs_level_ct',$vs_level_ct);

?>