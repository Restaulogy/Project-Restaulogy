<?php
$stroutput = "";
function build_child($oldID)	// Recursive function to get all of the children...unlimited depth
{
	global $exclude, $depth,$stroutput ;	// Refer to the global array defined at the top of this script
	$child_query = mysql_query("SELECT * FROM pds_category WHERE p=" . $oldID);
	$tempTree = "";

    $count = mysql_num_rows($child_query);
	if($count > 0)
	{
		$stroutput .= '<ul>';

	    while ( $child = mysql_fetch_array($child_query) )
		{
    		if ( $child['id'] != $child['p'])
    		{
    		     $stroutput .= '<li id="nav_id'.$child['id'].'" rel="'.$child['id'].'" title="'.$tempTree.$child['title'].'"> '.$tempTree.$child['title'].' ';
    			$tempTree.= build_child($child['id']);
                // Add to the temporary local tree
    		    $stroutput .= '</li>';
    			array_push($exclude, $child['id']);
                // Add the item to the exclusion list
    		}
		}
		$stroutput .= '</ul>';
	}
	return $tempTree;	// Return the entire child tree
}


//$link = mysql_connect('localhost','root','');
//$con=mysql_select_db('jobberbase');
/* Recursive function to generate a parent/child tree
   Without the need for a Root parent
   Orignally Written by: Brian Parnes 13 March 2006
*/
## Modified By Chintan Patel 16 Sep 2010
## http://scripts-code.blogspot.com
## Purpose to Modify: Showing it in to DropDown


// Define the exclusion array
$nav_query = mysql_query("SELECT * FROM pds_category ORDER BY id where id < 5");
$tree = "";	// Clear the directory tree

$top_level_on = 1;	// What top-level category are we on?
$exclude = array();
array_push($exclude, 0);	// Put a starting value in it
//onclick=\"document.getElementById('selected_category').innerHTML=get_category(document.getElementById('categories').value);\"

$stroutput .="<ul id=\"categorymenu\" class=\"mcdropdown_menu\">";
$stroutput .="<li rel=0  title=\"Select Category\">Select Category<input id=\"nav_id0\" type=hidden  value=\"0\"/></li>";

//$link = mysql_connect('localhost','root','');
//$con=mysql_select_db('jobberbase');
/* Recursive function to generate a parent/child tree
   Without the need for a Root parent
   Orignally Written by: Brian Parnes 13 March 2006
*/
## Modified By Chintan Patel 16 Sep 2010
## http://scripts-code.blogspot.com
## Purpose to Modify: Showing it in to DropDown


// Define the exclusion array
$nav_query = mysql_query("SELECT * FROM pds_category ORDER BY id");

$tree = "";	// Clear the directory tree

$top_level_on = 1;	// What top-level category are we on?
$exclude = array();
array_push($exclude, 0);	// Put a starting value in it

while ( $nav_row = mysql_fetch_array($nav_query) )
{
	$goOn = 1;	// Resets variable to allow us to continue building out the tree.
	// Check to see if the new item has been used
	for($x = 0; $x < count($exclude); $x++ )
	{
    	if ( $exclude[$x] == $nav_row['id'] )
    	{
        	$goOn = 0;
        	break;	// Stop looking b/c we already found that it's in the exclusion list and we can't continue to process this node
    	}
	}
	if ($goOn == 1)
	{
    	$tree .= $nav_row['title'] . "";	// Process the main tree node
    	$stroutput .= '<li rel="'.$nav_row['id'].'" title="'.$nav_row['title'].'">'.$nav_row['title'].'<input id="nav_id'.$nav_row['id'].'" type="hidden"  value="'.$nav_row['title'].'"/>';
    	array_push($exclude, $nav_row['id']);// Add to the exclusion list

    	$tree .= build_child($nav_row['id']);// Start the recursive function of building the child tree

        $stroutput .= '</li>';
	}
}
    $stroutput .= '</ul>';
    //echo $stroutput;

$tpl->assign('tree_cate', $stroutput);
?>
