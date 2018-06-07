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
$title_tag = $language->desc('site_text',$lang_set,'main_title')." | ".$language->desc('edcat',$lang_set,'title_tag');
$bread_crumb[0] = $language->desc('edcat',$lang_set,'breadcrumb');
$btn_link[0] = "disabled";
if ($_POST['level_str']){
	//Track category levels
	$level_str = $_POST['level_str']; 
	$level_path = explode(":",$_POST['level_str']);
	$parent = end($level_path);
}

$catid=$_POST['cat'];

//***********************************************
// Result set paging
//***********************************************

//***********************************************
// Button Press Logic
//***********************************************

if ( isset($_POST['add_cat']) ){
	//Add category
	if ($_POST['cat_text'] != ""){
		//Text field is not empty
		if (!$parent){
			//Add as main category
			mysql_query ("INSERT INTO $pds_category (title) VALUES ('$_POST[cat_text]');");
		}else{
			//Add as child category
			mysql_query ("INSERT INTO $pds_category (title, p) VALUES ('$_POST[cat_text]','$parent');");
		}
		$insert_id = mysql_insert_id();
		$language->slave('category', $insert_id, $_POST['cat_text']);
		$notice .= "Category Added";
	}else{
		$notice .= "Entry field is empty - Nothing to add";
	}
	if(count($level_path) > 0){
		$level_str = implode(":",$level_path);
		$parent = end($level_path);
	}

}elseif ( isset($_POST['rename_cat']) ){
	// Rename Selected Category
	if ($_POST['cat_text'] != ""){
		//Text field is not empty
		mysql_query ("UPDATE $pds_category SET title='$_POST[cat_text]' WHERE id='$_POST[cat]';");
		$language->slave('category', $_POST[cat], $_POST['cat_text']);
		$notice .= "Category Renamed";
	}else{
		$notice .= "Entry field is empty - Unable to rename";
	}

}elseif ( isset($_POST['delete_cat']) ){
	// Delete Selected Category
	$r_title = mysql_query ("SELECT title FROM $pds_category WHERE id='$catid';");
	$f_title = mysql_fetch_array($r_title);
	$cat_count = mysql_fetch_array( mysql_query ("SELECT COUNT(*) FROM $pds_category WHERE p='$catid';") );
	if ($cat_count[0] == 0){
		mysql_query ("DELETE FROM $pds_category WHERE id='$catid';");
		
		//Deprecated in language table
		$language->put("category", $language->native, $catid, $f_title['title'], $catid, "d");
		
		$notice .= "Category Deleted";
	}else{
		$notice .= "Delete not allowed on categories with children<br>";
	}

}elseif ( isset($_POST['parent_btn']) ){
	//down one level
	$new_sel = end($level_path);
	array_pop($level_path);
	$level_str = implode(":",$level_path);
	$parent = end($level_path);
	

}elseif ( isset($_POST['child_btn']) ){
	//up one level
	if (!count($level_path)){
		$level_path[0] = $_POST['cat'];
	}else{
		array_push($level_path, $_POST['cat']);
	}
	$level_str = implode(":",$level_path);
	$parent = end($level_path);

}

//***********************************************
// Edit Categories
//***********************************************
if (!$level_path[0]){
	//get main categories
	$r = mysql_query ("SELECT * FROM $pds_category WHERE p IS NULL ORDER BY title;");
}else{
	//get child categories
	$r = mysql_query ("SELECT * FROM $pds_category WHERE p=$parent ORDER BY title;");
	$r_cat = mysql_query ("SELECT * FROM $pds_category WHERE id=$parent");
	$f_cat = mysql_fetch_assoc($r_cat);
}
$r_rows = mysql_num_rows($r);

$html = "
	<form method=post class=\"job_detail_view\" action=edcat.php>
          <table width=100% border=0 cellspacing=0 cellpadding=5 align=left>
            <tr>
              <th height=50>".getCatPath($f_cat[id])."<input type=hidden name=level_str value=$level_str></th>
              </tr>
			<tr>
			 <td align=center>
			  $notice
			 </td>
			</tr>
            <tr>
              <td align=center>";
if ($parent){
	//Child Category so show Parent Button
	$html .= "			   <input name=parent_btn  style=\"width:100px\" class=\"blackbutton\" type=submit id=parent_btn value=Parent>&nbsp;";
}
if ($r_rows > 0){
	//There are categories to show so show them
	$html .= "			   <select name=cat size=1>";
	for ($x=0;$x<$r_rows;$x++){
		$f = mysql_fetch_assoc($r);
		if ( ($f['id'] == $_POST['cat'] and !$insert_id) or ($f['id'] == $insert_id) or ($f['id'] == $new_sel and $new_sel) ){
			$html .= "<option value=$f[id] selected>$f[title]</option>";
		}else{
			$html .= "<option value=$f[id]>$f[title]</option>";
		}
	}
	$html .= "              </select>&nbsp;<input  style=\"height:20px;width:100px;\" class=\"blackbutton\" name=child_btn type=submit id=child_btn value=Children>";
}

$html .= "			 </td>
            </tr>
            <tr align=center>
              <td><input name=cat_text type=text size=50 maxlength=100></td>
              </tr>
            <tr>
              <td align=center><input name=add_cat style=\"width:100px\" class=\"blackbutton\" type=submit id=add_cat value=Add Category>";
if ($r_rows > 0){
	//There are categories in the list so allow rename and delete
	$html .= "			   &nbsp;<input style=\"width:100px\" class=\"blackbutton\" name=rename_cat type=submit id=rename_cat value=Rename Category>&nbsp;
                <input style=\"width:100px\" class=\"blackbutton\" name=delete_cat type=submit id=delete_cat value=Delete Category>
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
$tpl-> assign('show_page','edcat');
$tpl-> assign('edcat',$html);

//***********************************************
// Display Template
//***********************************************
$tpl-> display("$config[deftpl]/edcat.tpl");

?>
