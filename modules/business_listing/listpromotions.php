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


//***********************************************
// Result set paging
//***********************************************

//***********************************************
// Verify User
//***********************************************

//***********************************************
// Button Press Logic
//***********************************************

//***********************************************
// Code
//***********************************************

//$r_promotions = mysql_query("SELECT * FROM pds_list_promotions WHERE list_id='$vs_current_listing[id]'") or die(mysql_error());
//$result = mysql_query("SELECT * FROM pds_list_promotions") or die(mysql_error());
$result =  mysql_query("SELECT * FROM pds_list_promotions WHERE list_id='$vs_current_listing[id]'") or die(mysql_error());
/** previous code for list of the promotions
    while ($row = mysql_fetch_assoc($result))
    {
        $list_promotions[] = array('id' => $row['id'], 'title' => $row['title'], 'pdf_1' => $row['pdf_1'], 'pdf_2' => $row['pdf_2'],'comment' => $row['comment']  );
    }
****/


$row = mysql_fetch_array($result);


	 	$tpl-> assign('id' , $row['id']);
 		$tpl-> assign('list_id',$row['list_id']);
		$tpl-> assign('title',string_replace_for_sql($row['title']));
		$tpl-> assign('pdf_1',$row['pdf_1']);
		$tpl-> assign('pdf_2',$row['pdf_2']);
        $tpl-> assign('comment',$row['comment']);


$tpl-> display("$config[deftpl]/listpromotions.tpl");

?>
