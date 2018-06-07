
{if $Global_member.member_role_id eq $smarty.const.ROLE_MANAGER || $Global_member.member_role_id eq $smarty.const.ROLE_EXPEDITOR || $Global_member.member_role_id eq $smarty.const.ROLE_WAITER}
{assign var="list_view_lnk" value= ""}
{if $active_page eq 'tbl_table_status_link' OR $active_page eq 'table_layout' }
       {assign var="list_view_lnk" value= "{$website}/user/tbl_table_status_link.php?latestOnly=1"}
{elseif $active_page eq 'tbl_orders'}
       {assign var="list_view_lnk" value= "{$website}/user/tbl_orders.php?ord_live_only=1"}
{elseif $active_page eq 'employee_requests'}
       {assign var="list_view_lnk" value= "{$website}/user/employee_requests.php"}
{elseif $active_page eq 'coupon_statistics'}
       {assign var="list_view_lnk" value= "{$website}/modules/business_listing/promotionslisting.php?show_type=PR&listing_type=all"}
{elseif $active_page eq 'tbl_alerts'}
       {assign var="list_view_lnk" value= "{$website}/user/tbl_alerts.php"}
{/if}
<!--
<div class="navTable">
	<table class="navTable" style="width:100%">
		<tr> 
				<th {if $active_page eq "tbl_alerts"}class="active"{else}class="link" onclick='window.location.href="{$website}/user/tbl_alerts.php";'{/if}>{$_lang.tbl_alerts.listing_title}</th>
				<th {if $active_page eq "tbl_orders"}class="active"{else}class="link" onclick='window.location.href="{$website}/user/tbl_orders.php";'{/if}>{$_lang.tbl_orders.listing_title}</th>
				<th {if $active_page eq "employee_requests"}class="active"{else}class="link" onclick='window.location.href="{$website}/user/employee_requests.php";'{/if}>Requests</th>
				<th {if $active_page eq "tbl_table_status_link"}class="active"{else}class="link" onclick='window.location.href="{$website}/user/tbl_table_status_link.php"'{/if}>{$_lang.tbl_table_status_link.title}</th>
				<th {if $active_page eq "coupon_statistics"}class="active"{else}class="link" onclick='window.location.href="{$website}/modules/business_listing/coupon_statistics.php"'{/if}>{$_lang.lbl_coupons}</th>

		</tr>	
	</table>
</div>
-->
<div class="line_break"></div>
<div class="line_break"></div>
<div class="line_break"></div>

{*if $list_view_lnk neq ''*}
{if 0}
<div class="navTable_border" >
<table class="navTable" style="width:350px;">
	<tr>
        {if ($smarty.request.table_status>0) && ($smarty.request.pst_table_id > 0 || $smarty.request.table_id > 0)}
            <th><a href="{$website}/user/tbl_table_status_link.php?latestOnly=1">{$_lang.tbl_table_status_link.listing_title}</a></th>
            <th><a href="{$website}/user/dining_table_layout.php?active_page=tbl_table_status_link">{$_lang.tbl_dining_table.layout}</a></th>
            <th><b>{$_lang._details}</b></th>
        {else}
           {if $curr_pg_nm eq 'table_layout'}
                <th><a href="{$list_view_lnk}">{$_lang.tbl_table_status_link.listing_title}</a></th>
                <th><b>{$_lang.tbl_dining_table.layout}</b></th>
            {else}
                <th><b>{$_lang.tbl_table_status_link.listing_title}</b></th>
                <th><a href="{$website}/user/dining_table_layout.php?active_page={$active_page}">{$_lang.tbl_dining_table.layout}</a></th>
            {/if}
        {/if}
        
	</tr>
</table>
</div>
{/if}

{/if}
 
