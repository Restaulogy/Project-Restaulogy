{if $Global_member.member_role_id eq $smarty.const.ROLE_MANAGER || $Global_member.member_role_id eq $smarty.const.ROLE_EXPEDITOR || $Global_member.member_role_id eq $smarty.const.ROLE_WAITER}{else}{assign var=isMenuActive value=0}{/if}
{if $isMenuActive gt 0}

{if $active_page eq 'tbl_table_status_link' OR $active_page eq 'table_layout' }
       {assign var="list_view_lnk" value= "{$website}/user/tbl_table_status_link.php?latestOnly=1"}
{elseif $active_page eq 'tbl_orders'}
       {assign var="list_view_lnk" value= "{$website}/user/tbl_orders.php?ord_live_only=1"}
{elseif $active_page eq 'employee_requests'}
       {assign var="list_view_lnk" value= "{$website}/user/employee_requests.php"}
{elseif $smarty.request.curr_view_enty eq 'coupon_statistics'}
       {assign var="list_view_lnk" value= "{$website}/modules/business_listing/coupon_statistics.php"}
{elseif $active_page eq 'tbl_alerts'}
       {assign var="list_view_lnk" value= "{$website}/user/tbl_alerts.php"}
{/if}

<div class="navTable_border">
<table class="navTable" style="width:350px;">
	<tr>
        {if $active_page eq 'table_layout'}
            <th><a href="{$list_view_lnk}">{$_lang.tbl_table_status_link.listing_title}</a></th>
            <th><b>{$_lang.tbl_dining_table.layout}</b></th>
        {else}
            <th><b>{$_lang.tbl_table_status_link.listing_title}</b></th>
            <th><a href="{$website}/user/dining_table_layout.php?from_entity">{$_lang.tbl_dining_table.layout}</a></th>
        {/if}
	</tr>
</table> 
</div>

{/if}
