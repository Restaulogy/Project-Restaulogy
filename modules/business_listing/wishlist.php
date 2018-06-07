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
$bread_crumb[0] = "My Wish List";
//***********************************************
// Listings
//***********************************************
include ("categories.php");

function checkIfWishListItemALreadyAdded($user_id,$category_id) {
    $sql="Select id from pds_wish_list where userid=$user_id and category=$category_id";
    $result = mysql_query($sql);
	if (!$result) {  return 0; }
    $result = mysql_result($result, 0);
	return $result;
}
$tpl-> assign('operation' , '');
$tpl-> assign('notice' , '');
if ($vs_current_user[id] != "" ){

    //..get posted category
    if (isset($_POST['category']) && ($_POST['category']>0))
    {
       $category = (int)$_POST['category'];
    }
    if (isset($_POST['timeframe']) && ($_POST['timeframe']!=""))
    {
       $timeframe = $_POST['timeframe'];
    }
    if (isset($_POST['pricing']))
    {
       $pricing = $_POST['pricing'];
    }
    //..remove option from wish list
    if (isset($_GET['remove']) && isset($_GET['wishlistid']) && ($_GET['wishlistid']>0))
    {
        $sql = "delete from pds_wish_list where id=".$_GET['wishlistid'] ;
        $tpl-> assign ('operation' , 'Your wish list item removed successfully');
        mysql_query($sql);
    }
    //..insert new item to wishlist
    if (isset($_POST['Add']))
    {
        $result = mysql_query("Select id from pds_wish_list where userid=".$vs_current_user[id]);
  		if ($result)
  		{
	  		$count = mysql_num_rows($result);
  		}
        if (($count >= 0) || ($count <= 5))
        {
            if (checkIfWishListItemALreadyAdded($vs_current_user[id],$category)) {
                $tpl-> assign ('notice' , 'Sorry ! you already have this item in your list');
            } else {
                //$sql = "insert into pds_wish_list (userid,category) values (".mysql_real_escape_string($vs_current_user[id]).",". mysql_real_escape_string($category).")" ;
                $sql = "insert into pds_wish_list (userid,category,timeframe,pricing) values (".mysql_real_escape_string($vs_current_user[id]).",". mysql_real_escape_string($category).",'". mysql_real_escape_string($timeframe)."','". mysql_real_escape_string($pricing)."')" ;
                mysql_query($sql);
                $tpl-> assign ('operation' , 'Your wish list saved successfully');
            }
        }
        else
        {
            $tpl-> assign ('notice' , 'Sorry ! you can not add more than 5 items');
        }
    }
}

    //..Get all wish list items to show on page
    $count =0;
    $result = mysql_query("select w.*,c.title from pds_wish_list w inner join pds_category c on c.id=w.category where w.userid=".$vs_current_user[id]." limit 0,5");
    if ($result)
	{
  		$count = mysql_num_rows($result);
  		for($x=0;$x<mysql_num_rows($result);$x++){
           $user_wish_list[$x]=mysql_fetch_assoc($result);
        }
        $tpl-> assign('user_wish_list',$user_wish_list);
	}
	$tpl-> assign('items_in_wish_list',$count);

$tpl-> assign('title_tag', $title_tag);
$tpl-> assign('bread_crumb', $bread_crumb);
$tpl-> assign('btn_link',$btn_link);
$tpl-> assign('show_page','user');

//***********************************************
// Display Template
//***********************************************
$tpl-> display("$config[deftpl]/wishlist.tpl");
?>
