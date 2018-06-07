<?PHP


//***********************************************
// Include Modules
//***********************************************
include ("modules/modules.php");

//***********************************************
// Include Variable Sets
//***********************************************
include ("configs/common_vs.php");

if((isset($_GET['id']))&&($_GET['id']>0)){
        $promotion = get_promotion_info($_GET['id']);
        $promotion['listing'] = get_listing_info($promotion['list_id']);
        //..Insert into hits table view count..
        IncreaseViewCount($_GET['id'],0);
        //print_r($promotion['listing']);
/*
	$result =  mysql_query("SELECT * FROM pds_list_promotions WHERE id={$_GET['id']}") or die(mysql_error());
    $row = mysql_fetch_assoc($result);
    $row['state_name'] = getState_name($row['states']);
    $row['metro_area_name'] = getMetroArea_name($row['metro_area']);
*/
//	print_r($promotion);
	$promo_img_src = '';
 if (!(isset($promotion['img_ext'])) OR ($promotion['img_ext'] == '0'))
	{
	    if ($promotion['listing']['logo'] != "")
			$promo_img_src .= "logo/{$promotion['listing']['logo']}" ;
		else
	        $promo_img_src .= "templates/default/images/nologo.jpg" ;
	}
else
         $promo_img_src .= "promotion_images/{$promotion['id']}.{$promotion['img_ext']}";
	
	$promotion['img_src'] = $promo_img_src;
    $tpl-> assign('promotion',$promotion);
}

$tpl-> display("$config[deftpl]/dialog_promo.tpl");

?>
