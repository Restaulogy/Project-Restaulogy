{include file="$deftpl/header.tpl"}
<div data-role="page">
    {include file="$deftpl/common_header.tpl"}
    <div data-role="content">
{include file="$deftpl/breadcrumb.tpl"}
{include file="$deftpl/menubar.tpl"}
	<h1>{if $table_status && $table_number neq ""}
        "{$table_number}" -
        {else if $flt_cust neq ""}"{$flt_cust}" - {/if}
        Promotion Claimed
        {if $islive neq 1}
        <!-- <a href="#search" style="float:right;" onclick="$('#search').toggle();" data-iconpos="notext" data-role="button" data-icon="search">search</a> -->
        <a href="#search" onclick="$('#search').toggle();" data-role="button" data-inline="true" data-transition="pop" data-icon="search" data-iconpos="notext"  data-theme="b" style="float:right;">Search</a>
        {/if}
    </h1>
  
	{if $smarty.request.isMenulist eq 1}
	<div data-role="navbar">
		<ul>
			{section name=menu_no loop=$menu_list} 
			{if $menu_list[menu_no].visible eq 1}
			
			{if $menu_list[menu_no].isbusiness eq 1}
	    		{if $elgg_user_acct_type eq "business" || $elgg_user_acct_type eq "social/business organization"}
	    		 <li><a href="promotionslisting.php?show_type={$show_type}&amp;listing_type={$menu_list[menu_no].link}" title="{$menu_list[menu_no].display}" data-mini="true" data-role="button" rel="external" data-icon="{$menu_list[menu_no].icon}" data-iconpos="top" style="font-size:10px;font-family:Arial;">{$menu_list[menu_no].display}</a></li>
	            {/if}
            {else}
                <li><a href="promotionslisting.php?show_type={$show_type}&amp;listing_type={$menu_list[menu_no].link}" title="{$menu_list[menu_no].display}" data-role="button" data-mini="true" rel="external" data-icon="{$menu_list[menu_no].icon}" data-iconpos="top" style="font-size:10px;font-family:Arial;">{$menu_list[menu_no].display}</a></li>
	        {/if}
			
			{/if} 
	    	{/section} 
	</ul>	
		</div> 
		<br/>
	{/if}
	 
	 {if $table_status}
		{include file="$deftpl/table_status_navbar.tpl"}
   {else if $flt_cust neq ""}
		{include file="$deftpl/filter_customer_navbar.tpl"}
	 {/if}
	 
	{include file="$deftpl/coupon_search.tpl"}
	 
	{if $Global_member.member_role_id gt 0}
{if  $Global_member.rl_fn_promotion_live eq 1 && $Global_member.rl_fn_promotion_expired eq 1} 
	<div class="navTable navTable_border">
	 
		<table class="navTable" style="width:250px;">
		 <tr>
					<th>{if $islive eq 1}<b>Live</b>{else}<a href="{$sorting_url}&islive=1">Live</a>{/if}</th>
					<th>{if $islive eq 0}<b>Expired</b>{else}<a href="{$sorting_url}&islive=0">Expired</a>{/if}</th>
			</tr>
		</table>	
	 </div>
	{/if}
{/if} 
 {if $info.search_text neq ''}
	<div style="width:99%;padding:5px;border-bottom:1px dotted #ccc;font-style: italic;"><span class="info">Search results &laquo; </span><span class="notice">{$info.search_text}</span><span class="info">&raquo;</span></div><br> 
{/if} 
 {if $info.coupons && $info.result_found gt 0}
	<table class="biz_data_grid">
		<tr>
            {if $smarty.request.table_id && $smarty.request.table_id gt 0}
            {else}
                 <th style="width:50px;" class="{if $smarty.get.sort_on eq 'tbl_cust_sess_table_id'}active_{if $smarty.get.sort_by eq 'ASC'}desc{else}asc{/if}{/if}"><a href="{$sorting_url}&sort_on=tbl_cust_sess_table_id&sort_by={$new_sort}">Table</a></th>
			     <th style="width:50px;" class="{if $smarty.get.sort_on eq 'tbl_server'}active_{if $smarty.get.sort_by eq 'ASC'}desc{else}asc{/if}{/if}"><a href="{$sorting_url}&sort_on=tbl_server&sort_by={$new_sort}">Server</a></th>
            {/if}

			<th style="width:50px;" class="{if $smarty.get.sort_on eq 'user_id'}active_{if $smarty.get.sort_by eq 'ASC'}desc{else}asc{/if}{/if}"><a href="{$sorting_url}&sort_on=user_id&sort_by={$new_sort}">Customer</a></th>
			<th style="width:155px;" class="{if $smarty.get.sort_on eq 'title'}active_{if $smarty.get.sort_by eq 'ASC'}desc{else}asc{/if}{/if}"><a href="{$sorting_url}&sort_on=title&sort_by={$new_sort}">Promotion</a></th>
		{if $islive eq 1}
			<th style="width:50px;" class="{if $smarty.get.sort_on eq 'tbl_status'}active_{if $smarty.get.sort_by eq 'ASC'}desc{else}asc{/if}{/if}"><a href="{$sorting_url}&sort_on=tbl_status&sort_by={$new_sort}">Status</a></th>
	 {/if}	
		<th style="width:40px;" class="{if $smarty.get.sort_on eq 'redimed_date'}active_{if $smarty.get.sort_by eq 'ASC'}desc{else}asc{/if}{/if}"><a href="{$sorting_url}&sort_on=redimed_date&sort_by={$new_sort}">Claimed On</a></th> 
		{if $islive eq 1}
			<th style="width:20px;" class="{if $smarty.get.sort_on eq 'biz_redimed'}active_{if $smarty.get.sort_by eq 'ASC'}desc{else}asc{/if}{/if}"><a href="{$sorting_url}&sort_on=redimed_date&sort_by={$new_sort}">Status</a></th>
	{/if}		 
			 
		<th style="width:25px;">Actual bill</th>
		</tr>
		{section name=itm loop=$info.coupons}
		<tr class="{cycle values='odd,even'}">	
            {if $smarty.request.table_id && $smarty.request.table_id gt 0}
            {else}
                 <td>{$info.coupons[itm].rdc_table_number}</td>
			     <td>{$info.coupons[itm].rdc_server_name}</td>
            {/if}
			<td>
			{if $info.coupons[itm].order_id gt 0}<a href="{$elgg_main_url}user/tbl_orders.php?order_id={$info.coupons[itm].order_id}&{$smarty.const.MODE_TITLE}={$smarty.const.MODE_VIEW}" target="_blank">{if $info.coupons[itm].order_info.order_customer_name neq ""}{$info.coupons[itm].order_info.order_customer_name}{else}{$info.coupons[itm].user_name}{/if}</a>{else}{if $info.coupons[itm].customer_name neq ""}{$info.coupons[itm].customer_name}{else}{$info.coupons[itm].user_name}{/if}{/if}
			</td>
			<td><a href="{$elgg_main_url}modules/business_listing/show.php?show_type=PR&amp;promoid={$info.coupons[itm].promotion_id}" target="_blank">{$info.coupons[itm].promotion.title|truncate:35}</a></td>
		  {if $islive eq 1}
				<td>{$info.coupons[itm].rdc_table_status_name}</td>
			{/if}
			<td>{$info.coupons[itm].redimed_date|date_format:$smarty.const.HTML5_DATETIME_FORMAT}</td>
			{if $islive eq 1}
			<td>			
    {if $info.coupons[itm].biz_redimed eq 1}
					 Applied
				{else}
					 Not Applied
				{/if}
			</td>
			{/if}
			
			
			<td style='text-align:right;'>{if $info.coupons[itm].order_info.gr_amt gt 0}{$info.coupons[itm].order_info.gr_amt|string_format:'%.2f'}{else}0{/if}</td>
		</tr>
		{/section}  
		<tfoot>
		<tr>
			<td colspan="{if $islive eq 1}8{else}6{/if}">#&nbsp;{$info.result_found}&nbsp;&nbsp;{$info.pagination}</td>
		</tr>
		</tfoot>
		
	</table> 
    {else}
          <div class="error">There are no {$_lang.lbl_coupons} claimed yet.</div>
    {/if}
  	  
  </div><!--content-->
    
  
	<div data-role="popup" style="width:200px;" data-theme="a" id="popupOrders">
		<div data-role="header">
			<h4>Select Order</h4>
		</div>
		<div data-role="content">
		<form>
		<input type="hidden" id="coupon_id" value=""/>
			{if $all_orders}
			{foreach $all_orders as $order}
			<label for="order_{$order}"><input type="radio" value="{$order}" id="order_{$order}" name="order_id">ID-{$order}</label>
			{/foreach}
		{else}
			 No order to Select

		{/if}
		</form>
		
		<center><input type="button" data-inline="true" value="Confirm" onclick="confirmCoupon();" data-icon="check" />
		<input type="button" data-inline="true" value="cancel" onclick="$('#popupOrders').popup('close');" data-icon="delete" /></center>
		</div>
	</div>

{include file="$deftpl/common_footer.tpl"}
</div>

{literal}
<script type="text/javascript">
 	$(function(){
		$("#start_date").scroller({ preset: 'date',dateFormat : '{/literal}{$smarty.const.MOBISCROL_FORMAT}{literal}', animate: 'pop'});
		$("#end_date").scroller({ preset: 'date',dateFormat : '{/literal}{$smarty.const.MOBISCROL_FORMAT}{literal}', animate: 'pop'});
	})
	
   function comparedate(){
		var isErr = true;
		$(".error").html("");
		var compare_date = 0;
		if(IsNonEmpty(elemById("start_date").value)==false){
			/*$("#start_date_err").html("{/literal}{$_lang.messages.validation.not_empty|sprintf:'Start Date'}{literal}");
			isErr = false;*/
			compare_date = 0;
		}

		if(IsNonEmpty(elemById("end_date").value)==false){
			/*$("#end_date_err").html("{/literal}{$_lang.messages.validation.not_empty|sprintf:'End Date'}{literal}");
			isErr = false;*/
			compare_date = 0;
		}else{
			if(new Date(elemById("end_date").value).getTime() < new Date(elemById("start_date").value).getTime()){
				$("#end_date_err").html("{/literal}{$_lang.messages.validation.gt_others_date|sprintf:'End Date':'Start Date'}{literal}");
				isErr = false;
			}
		}

		if(isErr == false){
			alert("{/literal}{$_lang.messages.revise_form}{literal}");
		}
		return isErr;

    }

 function popupConfirm(coupon_id){
 	$('#popupOrders').popup('open');
	$('#coupon_id').val(coupon_id);
 }
 function confirmCoupon(){
	var chkval = $('input[name=order_id]:checked').val();
 var coupon_id = $('#coupon_id').val();
	 if((chkval > 0) && ($('#coupon_id').val() > 0)){
	 	 window.location.href='{/literal}{$elgg_main_url}{literal}modules/business_listing/coupon.php?redim_id='+ coupon_id + '&biz_redimed=1&order_id='+chkval;
	 }else{
	 		alert('Please Select Order');
	 } 
 }
</script>
 
{/literal}
{include file="$deftpl/sitefoot.tpl"}
