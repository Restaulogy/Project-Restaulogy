<div class="navTable navTable_border">
	<table class="navTable" style="width:250px;">
		<tr> 
				<th>{if $tb_sts_lnk_tab eq "order"}<b>{$_lang.tbl_orders.listing_title}</b>{else}<a href="{$website}/user/tbl_orders.php?{$smarty.const.FILTER_BY_CUST}={$flt_cust}&{$smarty.const.ORDER_CUSTOMER_TYPE}={$flt_cust_type}&{$smarty.const.ORDER_CUSTOMER_ID}={$flt_cust_id}" >{$_lang.tbl_orders.listing_title}</a>{/if}</th>
				<th>{if $tb_sts_lnk_tab eq "promotion"}<b>{$_lang.lbl_coupons}</b>{else}<a href="{$website}/modules/business_listing/coupon_statistics.php?{$smarty.const.FILTER_BY_CUST}={$flt_cust}&{$smarty.const.SES_CUST_TYPE}={$flt_cust_type}&userid={$flt_cust_id}">{$_lang.lbl_coupons}</a>{/if}</th>
				<th>{if $tb_sts_lnk_tab eq "favorite"}<b>{$_lang.tbl_cust_favorites.title}</b>{else}<a href="{$website}/user/tbl_cust_favorites.php?{$smarty.const.FILTER_BY_CUST}={$flt_cust}">{$_lang.tbl_cust_favorites.title}</a>{/if}</th>
				<th>{if $tb_sts_lnk_tab eq "preferences"}<b>{$_lang.main.order.preferences}</b>{else}<a href="{$website}/user/tbl_orders.php?{$smarty.const.FILTER_BY_CUST}={$flt_cust}&{$smarty.const.ORDER_CUSTOMER_TYPE}={$flt_cust_type}&{$smarty.const.ORDER_CUSTOMER_ID}={$flt_cust_id}&flt_cust_prefs=1">{$_lang.main.order.preferences}</a>{/if}</th>
		</tr>	
	</table>
</div>
