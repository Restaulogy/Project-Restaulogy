 <div class="navTable navTable_border">
 		<table class="navTable" style="width:320px;display:inline;">
		<tr>
			<th>
			 {if $ord_online eq 1}
			    {if $flt_cust neq ''}
					<a href="{$website}/user/tbl_orders.php?{$smarty.const.FILTER_BY_CUST}={$flt_cust}&{$smarty.const.ORDER_CUSTOMER_TYPE}={$flt_cust_type}&{$smarty.const.ORDER_CUSTOMER_ID}={$flt_cust_id}&ord_live_only={$ord_live_only}&ord_online=0&flt_cust_prefs={$flt_cust_prefs}{$url_tbl_param}">{$_lang.main.navbar.online_order}</a>
				{else}
 			        <a href="{$website}/user/tbl_orders.php?ord_live_only={$ord_live_only}&ord_online=0{$url_tbl_param}">Dine-In Orders</a>
				{/if}
			 {else}
                    {if $tbl_ordersinfo}
                       <a href="{$website}/user/tbl_orders.php?ord_live_only={$ord_live_only}&ord_online=0{$url_tbl_param}">Dine-In Orders</a>
                    {else}
 			            <b>Dine-In Orders</b>
 			        {/if}
			 {/if}
			 </th>
			{if ($isCustomer && $smarty.session[$smarty.const.SES_TABLE] gt 0)}
			{else}
			<th>
			  {if $ord_online eq 0}
				 {if $flt_cust neq ''}
				    <a href="{$website}/user/tbl_orders.php?{$smarty.const.FILTER_BY_CUST}={$flt_cust}&{$smarty.const.ORDER_CUSTOMER_TYPE}={$flt_cust_type}&{$smarty.const.ORDER_CUSTOMER_ID}={$flt_cust_id}&ord_live_only={$ord_live_only}&ord_online=1&flt_cust_prefs={$flt_cust_prefs}{$url_tbl_param}">{$_lang.main.navbar.online_order}</a>
				 {else}
				    <a href="{$website}/user/tbl_orders.php?ord_live_only={$ord_live_only}&ord_online=1{$url_tbl_param}">{$_lang.main.navbar.online_order}</a>
				 {/if}
			 {else}
                    {if $tbl_ordersinfo}
                       <a href="{$website}/user/tbl_orders.php?ord_live_only={$ord_live_only}&ord_online=1{$url_tbl_param}">{$_lang.main.navbar.online_order}</a>
                    {else}
                        <b>{$_lang.main.navbar.online_order}</b>
 			        {/if}
			 {/if}
			</th>
			{/if}
			
  	        {if $tbl_ordersinfo}
            	<th>
                    <b>{$_lang._details} </b>
                </th>
    		{/if}
		</tr>
		</table>
 </div>

