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

if ( !$vs_current_admin[login] ){
	//no admin logged in
	header("Location: $config[mainurl]/admin.php");
	exit;
}

//***********************************************
// Assign Local Variables
//***********************************************
$title_tag = $language->desc('site_text',$lang_set,'main_title')." | ".$language->desc('edloc',$lang_set,'title_tag');
$bread_crumb[0] = $language->desc('edloc',$lang_set,'breadcrumb');
$btn_link[0] = "disabled";
if ($_POST['level_str'] != ""){
	//Track location levels
	$level_str = $_POST['level_str'];
	$level_path = explode(":",$_POST['level_str']);
	$parent = end($level_path);
}
$loc_level = $_POST['loc_level'];

$locid=$_POST['loc'];

//***********************************************
// Result set paging
//***********************************************

//***********************************************
// Button Press Logic
//***********************************************

if ( isset($_POST['add_loc']) ){
	//Add location
	if ($_POST['loc_text'] != ""){
		//Text field is not empty
		if (!$parent){
			//Add as main location
			mysql_query ("INSERT INTO $pds_locsel (title, level) VALUES ('$_POST[loc_text]', '$loc_level');");
		}else{
			//Add as child location
			mysql_query ("INSERT INTO $pds_locsel (title, p, level) VALUES ('$_POST[loc_text]', '$parent', '$loc_level');");
		}
		$insert_id = mysql_insert_id();
		$language->slave('location', $insert_id, $_POST['loc_text']);
		$notice .= "Location Added";
	}else{
		$notice .= "Entry field is empty - Nothing to add";
	}

}elseif ( isset($_POST['update_loc']) ){
	// Update Selected Location
	if ($_POST['loc_text'] != ""){
		//Text field is not empty
		mysql_query ("UPDATE $pds_locsel SET title='$_POST[loc_text]', level='$loc_level' WHERE id='$_POST[loc]';") or die(mysql_error());
		$language->slave('location', $_POST[loc], $_POST['loc_text']);
	}else{
		mysql_query ("UPDATE $pds_locsel SET level='$loc_level' WHERE id='$_POST[loc]';") or die(mysql_error());
	}
	$notice .= "Location Updated";

}elseif ( isset($_POST['delete_loc']) ){
	// Delete Selected Locations
	$r_title = mysql_query ("SELECT title FROM $pds_locsel WHERE id='$locid';");
	$f_title = mysql_fetch_array($r_title);
	$loc_count = mysql_fetch_array( mysql_query ("SELECT COUNT(*) FROM $pds_locsel WHERE p='$locid';") );
	if ($loc_count[0] == 0){
		mysql_query ("DELETE FROM $pds_locsel WHERE id='$locid';");

		//Deprecated in language table
		$language->put("location", $language->native, $locid, $f_title['title'], $locid, "d");

		$notice .= "Location Deleted";
	}else{
		$notice .= "Delete not allowed on locations with children<br>";
	}

}elseif ( isset($_POST['parent_btn']) ){
	//down one level
	$new_sel = end($level_path);
	array_pop($level_path);
	$level_str = implode(":",$level_path);
	$parent = end($level_path);
//	$loc_level -= 1;
	

}elseif ( isset($_POST['child_btn']) ){
	//up one level
	if (!count($level_path)){
		$level_path[0] = $_POST['loc'];
	}else{
		array_push($level_path, $_POST['loc']);
	}
	$level_str = implode(":",$level_path);
	$parent = end($level_path);
//	$loc_level += 1;

}

//***********************************************
// Edit Locations
//***********************************************
if (!$level_path[0]){
	//get main locations
	$r = mysql_query ("SELECT * FROM $pds_locsel WHERE p IS NULL ORDER BY title;");
}else{
	//get child Locations
	$r = mysql_query ("SELECT * FROM $pds_locsel WHERE p=$parent;");
	$r_loc = mysql_query ("SELECT * FROM $pds_locsel WHERE id=$parent ORDER BY title;");
	$f_loc = mysql_fetch_assoc($r_loc);
}
$r_rows = mysql_num_rows($r);

$html = "<form method=post action=edloc.php>
          <table width=100% border=0 cellspacing=0 cellpadding=5 align=left>
            <tr>
              <td height=50>".$language->desc("location", $lang_set, $f_loc['id'])."<input type=hidden name=level_str value=$level_str></td>
              </tr>
			<tr>
			 <td align=center>
			  $notice
			 </td>
			</tr>
            <tr>
              <td align=center>";
if ($parent){
	//Child Location so show Parent Button
	$html .= "			   <input name=parent_btn type=submit id=parent_btn value=".$language->desc("site_text", $lang_set, "parent").">&nbsp;";
}
if ($r_rows > 0){
	//There are locations to show so show them
	$html .= "			   <select name=loc size=1 onChange=submit()>";
	for ($x=0;$x<$r_rows;$x++){
		$f = mysql_fetch_assoc($r);
		if ($x==0){$loc_level = $f[level];}
		if ( ($f['id'] == $_POST['loc'] and !$insert_id) or ($f['id'] == $insert_id) or ($f['id'] == $new_sel and $new_sel) ){
			$html .= "<option value=$f[id] selected>".$language->desc("location", $lang_set, $f['id'])."</option>";
			$loc_level = $f[level];
		}else{
			$html .= "<option value=$f[id]>".$language->desc("location", $lang_set, $f['id'])."</option>";
		}
	}
	$html .= "              </select>&nbsp;";
	if ($loc_level){
		//Children Specified so allow
		$html .= "				<input name=child_btn type=submit id=child_btn value=".$language->desc("site_text", $lang_set, "children").">";
	}
}

$html .= "			 </td>
            </tr>
            <tr align=center>
              <td><input name=loc_text type=text size=50 maxlength=100></td>
              </tr>
			<tr>
			 <td align=center>
			  ".$language->desc("site_text", $lang_set, "loc_level")."&nbsp;&nbsp;";

$html .= $language->select('loc_level', $lang_set, array(
				   'var_name'		=> 'loc_level',
				   'value'		=> $loc_level
				   ));

$html .= "
			 </td>
			</tr>
			
            <tr>
              <td align=center><input name=add_loc type=submit id=add_loc value=".$language->desc("site_text", $lang_set, "add").">";
if ($r_rows > 0){
	//There are locations in the list so allow rename and delete
	$html .= "			   &nbsp;<input name=update_loc type=submit id=update_loc value=".$language->desc("site_text", $lang_set, "update").">&nbsp;
                <input name=delete_loc type=submit id=delete_loc value=".$language->desc("site_text", $lang_set, "delete").">
				";
}
$html .= "			   </td>
              </tr>
          </table>
        </form>";

//***********************************************
// Assign local variables to template
//***********************************************
$tpl-> assign('title_tag', $title_tag);
$tpl-> assign('bread_crumb', $bread_crumb);
$tpl-> assign('btn_link',$btn_link);
$tpl-> assign('edloc',$html);
$tpl-> assign('show_page','edloc');

//***********************************************
// Display Template
//***********************************************
$tpl-> display("$config[deftpl]/edloc.tpl");

?>