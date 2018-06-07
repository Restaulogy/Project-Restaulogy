<div class="navTable navTable_border">
	<table class="navTable" style="width:250px;">
		<tr>
				<th>{if $tb_sts_lnk_tab eq "detail"}<b>Detail</b>{else}<a href="{$website}/user/tbl_table_status_link.php?table_status=1&customer_session_id={$tmp_sess_id}&pst_table_id={$tmp_tbl_id}&{$smarty.const.MODE_TITLE}={$smarty.const.MODE_VIEW}">Detail</a>{/if}</th>
				<th>{if $tb_sts_lnk_tab eq "request"}<b>Requests</b>{else}<a href="{$website}/user/employee_requests.php?table_id={$tmp_tbl_id}&sess_id={$tmp_sess_id}&table_status=1" >Requests</a>{/if}</th>
				<th>{if $tb_sts_lnk_tab eq "order"}<b>{$_lang.tbl_orders.listing_title}</b>{else}<a href="{$website}/user/tbl_orders.php?order_session_id={$tmp_sess_id}&table_status=1&table_id={$tmp_tbl_id}" >{$_lang.tbl_orders.listing_title}</a>{/if}</th>
				<th>{if $tb_sts_lnk_tab eq "promotion"}<b>{$_lang.lbl_coupons}</b>{else}<a href="{$website}/modules/business_listing/coupon_statistics.php?table_id={$tmp_tbl_id}&cust_sess_id={$tmp_sess_id}&table_status=1">{$_lang.lbl_coupons}</a>{/if}</th>
		</tr>		
	</table> 
</div>