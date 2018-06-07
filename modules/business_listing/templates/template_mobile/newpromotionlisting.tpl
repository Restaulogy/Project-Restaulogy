{if $listing_type eq quick_search}{include file="$deftpl/quick_search.tpl"}{elseif $listing_type eq filter}{include file="$deftpl/filter.tpl"}{else}{include file="$deftpl/sitehead.tpl"}
{********* Page Display ***********************}

    {literal}
    <style>
    #select-choice-1-button {float: left;}
    .ui-btn-text{ text-align:center !important;}
    </style>
    
    <script type="text/javascript">
     $.each($('#home').find('select'), function () {
        var currentID = this.id;
        $.each($(this).find('option'), function (index, element) {
            if ($(element).attr('data-icon') != undefined) {
              //alert(currentID);
                $('#' + currentID + '-menu').children().eq(index).find('.ui-btn-inner').append('<span class="ui-icon ui-icon-' + $(element).attr('data-icon') + ' ui-icon-shadow" />');
            }
        });
    });
    </script>

    {/literal}
    {assign var="tpl_file" value=""}
  	{assign var="heading" value=""}
  <br/>
  
  <div data-role="page" style="background:#000;">
  
    {include file="$deftpl/common_header.tpl"}
    
	<div data-role="content" id="container" class="page-home">
    {include file="$deftpl/breadcrumb.tpl"}
    {include file="$deftpl/menubar.tpl"}
    {if $Global_member.member_role_id eq $smarty.const.ROLE_ADMIN OR $Global_member.member_role_id eq $smarty.const.ROLE_MANAGER OR $Global_member.member_role_id eq $smarty.const.ROLE_DEV}
        {include file="$deftpl/promotion/prom_cond_disc_tab.tpl"}
    {/if}
		{section name=menu_no loop=$menu_list}
		    {if $menu_list[menu_no].link eq $listing_type}
		        {assign var="tpl_file" value=$menu_list[menu_no].tpl_file}
		        {assign var="heading" value=$menu_list[menu_no].heading}
		    {/if}
	    {/section} 
		
		<div class="clearfix line_break"></div>
        <!--
        <input type="button" data-mini="true" data-icon="grid" data-inline="true" name="prom_subscribe" onclick="window.location.href='{$elgg_main_url}user/cust_login_tiny.php?prom_id=0';" value="Subscribe" />
        -->
        {if $smarty.session.rest_menu_opt_det.rst_mnu_loyalty_rewards eq 1 && $smarty.session[$smarty.const.SES_TABLE] gt 0}
            <input type="button" data-mini="true" data-icon="star" data-inline="true" name="custome_reward" onclick="window.location.href='{$elgg_main_url}user/customer_rewards.php';" value="Rewards" />
        {/if}
		
		<h1>{if $heading neq ''}{$heading}{else}{$_lang.lbl_coupons}{/if}<a  href="#" onclick="$('#popupsearch').popup('open');" style="float:right;" data-iconpos="notext" data-role="button" data-icon="search">search</a></h1>
		<div class="clearfix line_break"></div>
	 {if $totalmenu_visible gt 1}
		<div data-role="navbar" >
		<ul>
			{section name=menu_no loop=$menu_list} 
			{if $menu_list[menu_no].visible eq 1}
 			{if $menu_list[menu_no].isbusiness eq 1}
	    		{if $elgg_user_acct_type eq "business" || $elgg_user_acct_type eq "social/business organization"}
	    		 <li>
                    <a href="promotionslisting.php?show_type={$show_type}&amp;listing_type={$menu_list[menu_no].link}" title="{$menu_list[menu_no].display}" data-mini="true" data-role="button" rel="external" data-icon="{$menu_list[menu_no].icon}" data-iconpos="top" style="font-size:10px;font-family:Arial;text-align:center !important;" {if $listing_type eq $menu_list[menu_no].link}class="ui-btn-active ui-state-persist"{else}class="link"{/if}>{$menu_list[menu_no].display}</a>
                 </li>
	            {/if}
            {else}
                <li>
                    <a href="promotionslisting.php?show_type={$show_type}&amp;listing_type={$menu_list[menu_no].link}" title="{$menu_list[menu_no].display}" data-role="button" data-mini="true" rel="external" data-icon="{$menu_list[menu_no].icon}" data-iconpos="top" style="font-size:10px;font-family:Arial;;text-align:center !important;" {if $listing_type eq $menu_list[menu_no].link}class="ui-btn-active ui-state-persist"{else}class="link"{/if}  >{$menu_list[menu_no].display}</a>
                </li>
	        {/if}
			
			{/if} 
	    	{/section} 
	</ul>	
		</div> 
	{/if}
     

	
	{if $listing_type eq "expired"}
	 <!--<a href="coupon_statistics.php" data-role="button">Promotion Claimed Details</a>-->
	{/if}
	
	{*** Date Control Start
		{assign var="field_contain_id" value="date_contatin"}
		{assign var="field_id" value="date"}
		{assign var="field_name" value="date"}
		{include file="$deftpl/mobile_datepicker_control/control.tpl"}
		 <input type="time" id="exampleC" value="04:00 PM" data-interval="15" data-native-menu="false" data-inline="true"/>
	  Date Control End    ***}

	{if $listing_type != 'post'}<br><br>{/if}
 			 
     {if $tpl_file|strlen > 0}
	    {include file="$deftpl/$tpl_file"}
     {/if}
	 
	 {* if $elgg_user_acct_type eq "business" || $elgg_user_acct_type eq "social/business organization" *}
	 {* if $Global_member.member_role_id eq $smarty.const.ROLE_MANAGER  || $Global_member.member_role_id eq $smarty.const.ROLE_EXPEDITOR }
	        <a href="promotion.php?list_id={$vs_user_profile_list_id}&new=1" title="Post Promotion" target="_blank" data-role="button" rel="external"  data-icon="add-item">Create Promotion</a> 
	  {/if *}
 </div>
 	{include file="$deftpl/inlineSearch.tpl"}
	{include file="$deftpl/common_footer.tpl"}
</div>

{/if}  
{*****************************************

   Display Footer

******************************************}
{include file="$deftpl/sitefoot.tpl"}
