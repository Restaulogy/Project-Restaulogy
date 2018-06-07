<div class="navTable navTable_border">
<table class="navTable" style="width:320px;">
	<tr>
	   <th>
		{if $active_page eq "services_request"}
			 <b>{$_lang.main.customer_nav_menu.send_requests}</b>	
		{else}
			 <a href="{$website}/user/services_request.php?table_id={$table_id}">{$_lang.main.customer_nav_menu.send_requests}</a>	
		{/if} 		
		</th>
	   <th>
	   	{if $active_page eq "customer_request"}
			 <b>{$_lang.main.customer_nav_menu.requests}</b>	
		{else}
			 <a href="{$website}/user/customer_requests.php?table_id={$table_id}">{$_lang.main.customer_nav_menu.requests}</a>	
		{/if} 	
		</th>

	   	{if $active_page eq "tbl_services_requests"}
    	   	<th>
    			 <b>{$_lang._details}</b>
    		</th>
		{/if}
		
	</tr>
</table>
</div>
<br />
