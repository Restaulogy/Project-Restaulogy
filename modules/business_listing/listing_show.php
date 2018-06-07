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

    $list = get_listing_info($_GET['id']);
    $list['user_promotion'] = get_current_promotions($_GET['id']);
    //..Insert into hits table view count..
    IncreaseViewCount(0,$_GET['id']);
    
    $tpl-> assign('list',$list);
	//print_r($list);
}

$tpl-> display("$config[deftpl]/dialog_list.tpl");

?>
