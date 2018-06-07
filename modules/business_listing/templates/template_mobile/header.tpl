<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.2//EN" "http://www.openmobilealliance.org/tech/DTD/xhtml-mobile12.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
<meta name="apple-mobile-web-app-capable" content="yes" />
<!-- <META name="author" content="{#meta_author#}">
  <META name="copyright" content="{#meta_copyright#}"> -->
  <META name="robots" content="index, follow">
  <META name="revisit-after" content="7 days">
 <!-- <META name="keywords" content="{#meta_keywords#}"> -->
  
   <title>THE RESTAURANT</title>
   <meta property="og:title" content="THE RESTAURANT" />
   <meta property="og:description" content="A platform for restaurants to showcase and connect with their customers in an unique fashion." />
    
	<META NAME="Description" CONTENT="A platform for restaurants to showcase and connect with their customers in an unique fashion">
	<META NAME="Keywords" CONTENT="Restaurant">

  <!-- for Mobile Start -->
   	
  <link rel="stylesheet" href="{$elgg_main_url}user/templates/css/style.css" type="text/css" media="screen" />
       <link rel="stylesheet" href="{$elgg_site_url}templates/template_mobile/css/screen.css" type="text/css" media="screen" />

	<link rel="stylesheet" href="{$elgg_main_url}css/themes/inspired/structure.css?version=2" type="text/css" media="screen" />
	<link rel="stylesheet" href="{$elgg_main_url}css/themes/inspired/style.css?version=2" type="text/css" media="screen" />

	<link rel="stylesheet" href="{$elgg_main_url}css/biz_message.css" type="text/css" media="screen" />  
	<link rel="stylesheet" href="{$elgg_main_url}css/biz_data_grid.css" type="text/css" media="screen" /> 
    <link href="{$elgg_main_url}css/jqm-extra-icon.css" rel="stylesheet" type="text/css" />

<script src="{$elgg_main_url}user/templates/js/jquery.js"></script>
<script type="text/javascript">
$(document).bind("mobileinit", function () {
    $.mobile.ajaxEnabled = false;
});
</script> 
<script src="{$elgg_main_url}user/templates/js/jquery.mobile-1.3.0.js"></script>

 
<!--
<script src="templates/{$deftpl}/js/jquery-1.6.4.min.js"></script>
<script src="templates/{$deftpl}/js/jquery.mobile.min.js"></script>
-->

	<!-- for Mobile End -->

  {*** include file="$deftpl/mobile_datepicker_control/script.tpl" ***}

    <script language="javascript" type="text/javascript" src="templates/{$deftpl}/js/simple_validator.js"></script>
    <script type="text/javascript" src="templates/{$deftpl}/js/overlib.js"></script>
	<script src="templates/{$deftpl}/js/mobiscroll.min.js"></script>
	<link href="templates/{$deftpl}/css/mobiscroll.min.css" rel="stylesheet" type="text/css" /> 
	
	{literal}
    <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4e1e6d554ea00436"></script>
	  
   <script type="text/javascript" language="javascript">
    function clear_top_StMetro(cmbState_id,cmbMetroArea_id){
        if(cmbState_id.length > 0){
          $("#"+cmbState_id).html("<option value=''>Select State</option>");
          $('#'+cmbState_id).selectmenu('refresh', true);
        }
        
        if(cmbMetroArea_id.length > 0){
            $("#"+cmbMetroArea_id).html('<select name="metro_area" id="metro_area" ><option value="">Select Metro Area</option></select>');
            $('#'+cmbMetroArea_id).selectmenu('refresh', true);
        } 
    }
	
	function change_states_by_country(cmbcountry_id,cmbstate_id,cmbMetroArea_id){
        $('#'+cmbstate_id).empty();
        $('<option value="">Select State</option>').appendTo($('#'+cmbstate_id));
        $('#'+cmbstate_id).selectmenu('refresh', true);
        if (document.getElementById(cmbcountry_id).value != ""){
       		$('#'+cmbstate_id).attr("disabled", true);

            $.post("{/literal}{$website}{literal}/ajax/getJPContries.php",
            {
			    country_code: document.getElementById(cmbcountry_id).value},

                function(response){

                  $('#'+cmbstate_id).empty();
                 	$('#'+cmbstate_id).attr("disabled", false);
                 	$(response).appendTo($('#'+cmbstate_id));
            	 	$('#'+cmbstate_id).selectmenu('refresh', true);
                    change_metro_area_by_state(cmbstate_id,cmbMetroArea_id);
                }
            );
            return false;
        }else{
            alert ("Please Select Country");
            clear_top_StMetro(cmbstate_id,cmbMetroArea_id);
        }
	}

    function change_metro_area_by_state(cmbState_id,cmbMetroArea_id)
	{
        if (document.getElementById(cmbState_id).value > 0){
       		$('#'+cmbMetroArea_id).empty();
       		$('#'+cmbMetroArea_id).attr("disabled", true);
            $.post("{/literal}{$website}{literal}/ajax/get_chid_categories.php",
            {
			    parent_id: document.getElementById(cmbState_id).value},

                function(response){
                 	$('#'+cmbMetroArea_id).empty();
                 	$('#'+cmbMetroArea_id).attr("disabled", false);
                 	$(response).appendTo($('#'+cmbMetroArea_id));
            	 	$('#'+cmbMetroArea_id).selectmenu('refresh', true);
                }
            );
            return false;
        }else{
            alert ("Please Select State");
            clear_top_StMetro('',cmbMetroArea_id);
        }
	}
	
    function bodyOnload(){
       var str = $('div.ui-input-search').html();
         $('div.ui-input-search').append('<a data-theme="a" href="promotionslisting.php?listing_type=quick_search" title="All Promotion" data-role="button" rel="external" data-icon="search" style="float:right;margin-right:-30px;"><small>Adv. Search</small></a>');
        $('div.ui-input-search').trigger('create');
    } 
</script>

  {/literal} 
 <!-- <title>{$title_tag}</title> -->
 </head>
<body>
	<div id="overDiv" style="position:absolute;visibility:hide;z-index:1000;"></div>
