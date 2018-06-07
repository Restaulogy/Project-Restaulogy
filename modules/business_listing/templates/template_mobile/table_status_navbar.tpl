<!--
<div class="navTable_border">
<table class="navTable" style="width:350px;">
	<tr>
        <th><a href="{$website}/user/tbl_table_status_link.php?latestOnly=1">{$_lang.tbl_table_status_link.listing_title}</a></th>
        <th><a href="{$website}/user/dining_table_layout.php">{$_lang.tbl_dining_table.layout}</a></th>
        <th><b>{$_lang._details}</b></th>
	</tr>
</table>
</div>
 -->
<div class="navTable navTable_border">
	<table class="navTable" style="width:250px;">
		<tr>
				<th>{if $tb_sts_lnk_tab eq "detail"}<b>Detail</b>{else}<a href="{$website}/user/tbl_table_status_link.php?table_status=1&customer_session_id={$tmp_sess_id}&pst_table_id={$table_id}&{$smarty.const.MODE_TITLE}={$smarty.const.MODE_VIEW}">Detail</a>{/if}</th>
				<th>{if $tb_sts_lnk_tab eq "request"}<b>Requests</b>{else}<a href="{$website}/user/employee_requests.php?table_id={$table_id}&sess_id={$tmp_sess_id}&table_status=1" >Requests</a>{/if}</th>
				<th>{if $tb_sts_lnk_tab eq "order"}<b>{$_lang.tbl_orders.listing_title}</b>{else}<a href="{$website}/user/tbl_orders.php?order_session_id={$tmp_sess_id}&table_status=1&table_id={$table_id}" >{$_lang.tbl_orders.listing_title}</a>{/if}</th>
				<th><b>{$_lang.lbl_coupons}</b></th>
		</tr>		
	</table> 
</div>
