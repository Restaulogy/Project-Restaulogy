{include file='header.tpl'}
{literal}
<style type="text/css">
	    .viewport {
            /*border: 3px solid #eee; */
            overflow: hidden;
            position: relative !important;
        }
	    .dash_lbl {
            margin-top:-12px !important;
            color:#{/literal}{if $tbl_landing_pageinfo.lnd_pg_lbl_font_color}{$tbl_landing_pageinfo.lnd_pg_lbl_font_color}{else}000{/if}{literal} !important;/* #84A63F */
            font-size: 1.1em !important;
            font-weight: bold !important;
            font-family: Arial !important;
	    }
		.dark {  
			color:#fff;
			vertical-align: middle !important;
            font-size: 1.0em;
            font-weight: bold;
            height: 100% !important; 
            position	: absolute; 
						text-align: center;
            text-decoration: none;
            width:50%;
            z-index: -100;
			display: block; /*
			border:3px solid #ccc;*/
        }
        
        img:hover
        {
        opacity:0.4!important;
        filter:alpha(opacity=40)!important;  /* For IE8 and earlier */
        }
        img
        {
        opacity:1.0!important;
        filter:alpha(opacity=100)!important;  /* For IE8 and earlier */
        }
			 
</style> 
{/literal}

<div class="wrapper"
style="background-size: cover;
 {if $tbl_landing_pageinfo.lnd_pg_background_color neq ''}background-color:#{$tbl_landing_pageinfo.lnd_pg_background_color};{/if}
 {if $tbl_landing_pageinfo.lnd_pg_background neq ''}background-image: url('{$website}{$smarty.const.LAND_PG_UPLOAD_PATH}{$tbl_landing_pageinfo.lnd_pg_background}');{/if}
" >
<div class="clearfix" id="dashboard"><center>
<table style="width:100%;">
    <tr>

         <td style="width:50%;position:relative;" class="viewport">
		 		<div class="dark">{$_lang.main.customer_dashboard_menu.menu}</div>
				<a href="{$website}/user/tbl_menu.php" style="width:100%;text-align:center !important;">
    				
    				<img src="{if $tbl_landing_pageinfo.lnd_pg_menu neq ''}{$website}{$smarty.const.LAND_PG_UPLOAD_PATH}{$tbl_landing_pageinfo.lnd_pg_menu}{else}{$website}/images/dashboard/menu.png{/if}" alt="{$_lang.main.customer_dashboard_menu.menu}" style="width:50%"/>
					<span class='dash_lbl'>{if $tbl_landing_pageinfo.lnd_pg_lbl_menu}{$tbl_landing_pageinfo.lnd_pg_lbl_menu}{else}{$_lang.main.customer_dashboard_menu.menu}{/if}</span>
    			</a>  
         </td>
         
         <td style="width:50%;position: relative;margin-bottom:20px;" class="viewport">
		 		<div class="dark">{$_lang.main.customer_dashboard_menu.deals}</div>
		 	 	<a href="{$website}/modules/business_listing/promotionslisting.php?listing_type=all&show_type=PR" style="width:100%;text-align:center !important;">
    				
    				<img src="{if $tbl_landing_pageinfo.lnd_pg_promotion neq ''}{$website}{$smarty.const.LAND_PG_UPLOAD_PATH}{$tbl_landing_pageinfo.lnd_pg_promotion}{else}{$website}/images/dashboard/promotion.png{/if}" alt="{$_lang.main.customer_dashboard_menu.deals}" style="width:50%"/>
    				<span class='dash_lbl'>{if $tbl_landing_pageinfo.lnd_pg_lbl_promotion}{$tbl_landing_pageinfo.lnd_pg_lbl_promotion}{else}{$_lang.main.customer_dashboard_menu.deals}{/if}</span>
    			</a>
         </td>
    </tr> 

   <tr>
         <td style="height:40px !important;position:relative;" colspan="2" >&nbsp;</td>
    </tr>

    <tr>
         <td style="width:50%;position: relative;" class="viewport">
            <div class="dark">{$_lang.biz_rewards.title}</div>
                <a href="{$website}/user/customer_rewards.php" style="width:100%;text-align:center !important;">

    				<img src="{if $tbl_landing_pageinfo.lnd_pg_loyalty neq ''}{$website}{$smarty.const.LAND_PG_UPLOAD_PATH}{$tbl_landing_pageinfo.lnd_pg_loyalty}{else}{$website}/images/dashboard/loyalty.png{/if}" alt="{$_lang.biz_rewards.title}" style="width:50%"/>
    				<span class='dash_lbl'>{if $tbl_landing_pageinfo.lnd_pg_lbl_loyalty}{$tbl_landing_pageinfo.lnd_pg_lbl_loyalty}{else}{$_lang.biz_rewards.title}{/if}</span>
    			</a>
		 	 
         </td>
         <td style="width:50%;position: relative;" class="viewport">
		 	<div class="dark">{$_lang.main.customer_dashboard_menu.service_requests}</div>
    			<a href="#" onclick="$('#popupSocialMedia').popup('open');" style="width:100%;text-align:center !important;">

					
    				<img src="{if $tbl_landing_pageinfo.lnd_pg_connect neq ''}{$website}{$smarty.const.LAND_PG_UPLOAD_PATH}{$tbl_landing_pageinfo.lnd_pg_connect}{else}{$website}/images/dashboard/social_media.png{/if}" alt="{{$_lang.biz_rewards.title}}" alt="{$_lang.main.customer_dashboard_menu.service_requests}" style="width:50%"/>
    				<span class='dash_lbl'>{if $tbl_landing_pageinfo.lnd_pg_lbl_connect}{$tbl_landing_pageinfo.lnd_pg_lbl_connect}{else}{$_lang.main.customer_dashboard_menu.social_media}{/if}</span>
    			</a>
         </td>
    </tr>
    <tr>
         <td style="height:40px !important;position:relative;" colspan="2" >&nbsp;</td>
    </tr>
     <tr>

         <td style="width:50%;position: relative;" class="viewport">
                <div class="dark">{$_lang.main.customer_dashboard_menu.feedback}</div>
    			<a href="{$website}/user/tbl_complaints.php?mode=NEW" style="width:100%;text-align:center !important;">

    				<img src="{if $tbl_landing_pageinfo.lnd_pg_reviews neq ''}{$website}{$smarty.const.LAND_PG_UPLOAD_PATH}{$tbl_landing_pageinfo.lnd_pg_reviews}{else}{$website}/images/dashboard/feedback.png{/if}" alt="{$_lang.main.customer_dashboard_menu.feedback}" style="width:50%"/>
					<span class='dash_lbl'>{if $tbl_landing_pageinfo.lnd_pg_lbl_reviews}{$tbl_landing_pageinfo.lnd_pg_lbl_reviews}{else}{$_lang.main.customer_dashboard_menu.feedback}{/if} </span>
    			</a>
         </td>
         
         <td style="width:50%;position: relative;" class="viewport">
            {if $smarty.session.rest_menu_opt_det.rst_mnu_serv_req eq 1}
		 	    <div class="dark">{$_lang.main.customer_dashboard_menu.service_requests}</div>

                <a href="{$website}/user/services_request.php?table_id={$table_id}" style="width:100%;text-align:center !important;">

    				<img src="{if $tbl_landing_pageinfo.lnd_pg_service_req neq ''}{$website}{$smarty.const.LAND_PG_UPLOAD_PATH}{$tbl_landing_pageinfo.lnd_pg_service_req}{else}{$website}/images/dashboard/service_request.png{/if}" alt="{$_lang.main.customer_dashboard_menu.service_requests}" style="width:50%"/>
    				<span class='dash_lbl'>{if $tbl_landing_pageinfo.lnd_pg_lbl_service_req}{$tbl_landing_pageinfo.lnd_pg_lbl_service_req}{else}{$_lang.main.customer_dashboard_menu.service_requests}{/if}</span>
    			</a>
    		{/if}
         </td>
    </tr>
</table>  

<div data-role="popup" id="popupSocialMedia" data-dismissible="true" style="width:270px;border:5px solid #333;padding:5px;" data-overlay-theme="a">
       <a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
      <div data-role="header">
		<h1>{$_lang.main.customer_dashboard_menu.social_media}</h1>
	  </div>
	  
	  <div class="content-primary">
	   <ul data-role="listview" data-split-theme="d">
	   		{if ($smarty.session.curr_restant.lst_social_media.rstcnt_facebook) && ($smarty.session.curr_restant.lst_social_media.rstcnt_facebook neq '')}
           <li>           		
           			<a target="_balnk" href="{$smarty.session.curr_restant.lst_social_media.rstcnt_facebook}">
					<img src="{$website}/images/facebook.png" />
					<h3>Facebook</h3>
					<p> The Restaurant is on Facebook.</p>
					</a>
				           		
		     </li>
		     {/if}
		             	
		     
		     {if ($smarty.session.curr_restant.lst_social_media.rstcnt_twitter) && ($smarty.session.curr_restant.lst_social_media.rstcnt_twitter neq '')}
		     <li>		      
		      	<a target="_balnk" href="{$smarty.session.curr_restant.lst_social_media.rstcnt_twitter}">
					<img src="{$website}/images/twitter.png" />
					<h3>Twitter</h3>
					<p>The Restaurant is on Twitter.</p>
				</a>			   	
		     </li>
		     {/if}
		     
		     {if ($smarty.session.curr_restant.lst_social_media.rstcnt_linked_in) && ($smarty.session.curr_restant.lst_social_media.rstcnt_linked_in neq '')}
		      <li>	
		      		<a target="_balnk" href="{$smarty.session.curr_restant.lst_social_media.rstcnt_linked_in}">
					<img src="{$website}/images/linkedin.png" />					
					<h3>Linked In</h3>
					<p>The Restaurant is on Linked In.</p>
				</a>
			  </li>	
			  {/if}
		     
		     
     </ul>
    </div>
</div>

</center>
</div> 
<!--/#dashboard--> 

</div> <!--/#wrapper-->
{include file='footercontent.tpl'}
{literal} 
<script type="text/javascript" src="{/literal}{$website}{literal}/js/jquery.roundabout.js"></script>
<script type="text/javascript">
	$(function() { 
        $('.viewport').mouseenter(function(e) { 
			$(this).children('a').children('img').addClass("grayScale"); 
        }).mouseleave(function(e) { 
			$(this).children('a').children('img').removeClass("grayScale");
			 
        });  
    });  
</script>
{/literal} 
</body></html>
