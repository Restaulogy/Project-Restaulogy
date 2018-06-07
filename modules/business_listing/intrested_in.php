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
include ("classes/inputfilter.php");
$filter = new inputFilter($allow_tags,$allow_attr);
include_once ("classes/email_message.php");
$mail = new email_message_class;
$html_mail = new Smarty;

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
if (isset($_GET['show_type'])){
  $show_type=$_GET['show_type'];
}else{
  $show_type="BL";
}
if($show_type=="PR"){
  	$isPromotions=1;
 	$title_tag = "Promotions I&rsquo;m interested in";
    $bread_crumb[0] = "Promotions I&rsquo;m interested in";
}else{
  	$isPromotions=0;
    $title_tag = "Businesses I&rsquo;m interested in";
    $bread_crumb[0] = "Businesses I&rsquo;m interested in";
}
//echo "show_type=$show_type";

$tpl-> assign('show_type' , $show_type);
$tpl-> assign('operation' , '');

//echo "curruserss=".$vs_current_user[id] ;

if ( $vs_current_user[id] != "" ){
$country = '';
$states = 0;
$categories = '';
$metro_area = 0;
$keywords = '';
$business_title ='';
if (isset($_POST['country']))
{
  if(is_array($_POST['country'])){
        $country = implode(',', $_POST['country']);
  }else{
        $country = $_POST['country'];
  }
}

if( (isset($_POST['states'])) && ((strlen(trim($_POST['states'])))!=0))
{
   $states = $_POST['states'];
}

if( (isset($_POST['metro_area'])) && ((strlen(trim($_POST['metro_area'])))!=0)){
   $metro_area = $_POST['metro_area'];
}
if( (isset($_POST['categories'])) && ((strlen(trim($_POST['categories'])))!=0)){
    $categories = $_POST['categories'];
}

if( (isset($_POST['keywords'])) && ((strlen(trim($_POST['keywords'])))!=0)){
    $keywords = $_POST['keywords'];
}
if( (isset($_POST['business_title'])) && ((strlen(trim($_POST['business_title'])))!=0)){
    $business_title = $_POST['business_title'];
}

if( (isset($_POST['title'])) && ((strlen(trim($_POST['title'])))!=0)){
    $business_title = $_POST['title'];
}
 

 //print_r($_POST);


if (isset($_POST['save']))
  {
        $result = mysql_query("Select id from pds_intrested_in where userid=".$vs_current_user[id]." AND isPromotions=$isPromotions");
  		if ($result)
  		{
	  		$count = mysql_num_rows($result);
  		}

         if ($count == 0)
         {
            $sql = "insert into pds_intrested_in (userid,title,keywords,business_title,categories,countries,states,metro_area,isPromotions) values (".mysql_real_escape_string($vs_current_user[id]).",'". mysql_real_escape_string($title)."','". mysql_real_escape_string($keywords)."','". mysql_real_escape_string($business_title)."','". mysql_real_escape_string($categories)."','".mysql_real_escape_string($country)."', ".mysql_real_escape_string($states)." , ".mysql_real_escape_string($metro_area)." ,$isPromotions)" ;

            if ($isPromotions == 1)
		     {
 			$tpl-> assign ('operation' , 'Your Promotion choice inserted successfully');
	         }
			else
			{
                 $tpl-> assign ('operation' , 'Your Listing choice inserted successfully');
   			}
            
        }
        else
        {
             $sql = "update pds_intrested_in set title = '". mysql_real_escape_string($title)."', keywords = '". mysql_real_escape_string($keywords)."', business_title = '". mysql_real_escape_string($business_title)."',  categories = '". mysql_real_escape_string($categories)."', countries = '".mysql_real_escape_string($country)."' ,  states = ".mysql_real_escape_string($states).",  metro_area = ".mysql_real_escape_string($metro_area)." where userid=".mysql_real_escape_string($vs_current_user[id])." AND isPromotions=$isPromotions";

		  if ($isPromotions == 1)
		     {
 			$tpl-> assign ('operation' , 'Your Promotion choice updated successfully');
	         }
			else
			{
                 $tpl-> assign ('operation' , 'Your Listing choice updated successfully');
   			}
			
        }
		//echo $sql;
        $res = mysql_query($sql);

        $sel_user = get_user($_SESSION['guid']);
       	$listing_link = $CONFIG->wwwroot."pg/business_listing/main/promotion_intrested/".$_SESSION['guid'];

         if ($isPromotions == 1){
             	$listing_link = $CONFIG->wwwroot."pg/business_listing/main/promotion_intrested/".$_SESSION['guid'];
             	$listing_or_promo = "Promotions";
		}else{
            $listing_link = $CONFIG->wwwroot."pg/business_listing/main/listing_intrested/".$_SESSION['guid'];
             $listing_or_promo = "Business Listing";
  		}
  		
        $html_mail-> assign("bizname",$sel_user->name);
		$html_mail-> assign("category_list", get_category_listing_values($categories,","));
		$html_mail-> assign("country_list", get_country_list_values($country,","));
		$html_mail-> assign("keywords", $keywords);
        $html_mail-> assign("business_title", $business_title);
		$html_mail-> assign("state_name", getState_name($states));
		$html_mail-> assign("metro_area_name", getMetroArea_name($metro_area));
		$html_mail-> assign("listing_or_promo", $listing_or_promo);
		$html_mail-> assign("listing_link", $listing_link);
		$html_mail-> assign("BIZNETWORKING_SITE_NAME", $BIZNETWORKING_SITE_NAME);
		


        if($res){
			//Send Notification Message
			$mail-> ResetMessage();
			unset($alternative_parts);
			$subject = "Filter Criteria For $listing_or_promo";

			$mail-> SetEncodedEmailHeader("From",$config['admin_email'],$config['admin_name']);
			$mail-> SetEncodedEmailHeader("Reply-To",$config['admin_email'],$config['admin_name']);
			$mail-> SetEncodedEmailHeader("To",$vs_current_user['usermail'],$vs_current_user['usermail']);
			$mail-> SetEncodedHeader("Subject",$subject);
			$mail-> cache_body = false;


			if( $html_mail-> template_exists($template="mail/intrested_in_html.tpl") )                       {
				//Set up HTML Message to notify admin of new listing
				$html_message=$html_mail-> fetch("mail/intrested_in_html.tpl");
				$mail-> CreateQuotedPrintableHTMLPart($html_message,"",$html_part);
				$count_parts = count($alternative_parts);
				$alternative_parts[$count_parts] = $html_part;
			}

			$mail-> AddAlternativeMultipart($alternative_parts);
			$mail-> Send();
		}
          mysql_free_result($res);
         
  }
/*
elseif (isset($_POST['search']))
    {
     $contrysql = "";
      $statesql = "";
      $categorysql = "";

        if ($country != "")
            {
              $contrysql = " And find_in_set(l.country, '$country') ";
            }

        if ($states != "")
            {
              $statesql = " And find_in_set(l.states_id, '$states')";
            }
         if ($categories != "")
            {
              $categorysql = " And find_in_set(lc.cat_id, '$categories') ";
            }

        $sql = "SELECT SQL_CALC_FOUND_ROWS l. * FROM  pds_listcat  lc left outer join pds_list l on lc.list_id = l.id LEFT OUTER JOIN pds_votes v ON l.id = v.list_id  where state='apr' $contrysql $statesql $categorysql" ;


    //  $searchpage = str_replace("intrested_in.php", "searchPa.php?query=$sql", $_SERVER['PHP_SELF']);
    $searchpage = "searchPa.php?imfrmin=true&contrysql=$contrysql&statesql=$statesql&categorysql=$categorysql";
 //$searchpage = "http://inforeshatech.globat.com/dev/elgg/mod/business_listing/business_listing/searchPa.php?query=$sql";
         header('Location:'.$searchpage);
         exit;

    }
*/
    $result = mysql_query("select * from pds_intrested_in where userid=".$vs_current_user[id]." AND isPromotions=$isPromotions");
   // echo "select * from pds_intrested_in where userid=".$vs_current_user[id]." AND isPromotions=$isPromotions<br>";
    if ($result){
	  	$count = mysql_num_rows($result);
  	}

	 if ($count > 0)
	  {
         $sql ="select * from pds_intrested_in where userid=".$vs_current_user[id]." AND isPromotions=$isPromotions";
         //echo $sql;
    	 $row = mysql_fetch_array(mysql_query($sql));


    	 $prev_id = $row['id'];
    	 $prev_country = explode(",",$row['countries']);
    	 $prev_categories = explode(",",$row['categories']);
    	 $prev_states =  $row['states'];
    	 $prev_metro_area = $row['metro_area'];
    	 $prev_keywords = $row['keywords'];
    	 $prev_business_title = $row['business_title'];
         $prev_metro_area_list = GetMetroAreaByState($row['states']);
         $tpl-> assign('prev_id' , $prev_id);
 		 $tpl-> assign('prev_country',$prev_country);
		 $tpl-> assign('prev_categories',$prev_categories);
		 $tpl-> assign('categories_str',$row['categories']);
		 $tpl-> assign('prev_states',$prev_states);
		 $tpl-> assign('prev_metro_area',$prev_metro_area);
		 $tpl-> assign('prev_keywords',$prev_keywords);
		 $tpl-> assign('prev_business_title',$prev_business_title);
		 $tpl-> assign('prev_metro_area_list',$prev_metro_area_list);
     }
}
$tpl-> assign('title_tag', $title_tag);
$tpl-> assign('bread_crumb', $bread_crumb);
$tpl-> assign('btn_link',$btn_link);
$tpl-> assign('isPromotions',$isPromotions);
$tpl-> assign('show_page','user');

//***********************************************
// Display Template
//***********************************************
$tpl-> display("$config[deftpl]/interested_in.tpl");
?>
