 
 <table class="navTable">
	<tr>
		<th>
            {if $active_page eq "tbl_dishes"}
				<b>{$_lang.tbl_dishes.title}</b> 
            {else}
                <a href='{$website}/user/tbl_dishes.php'>{$_lang.tbl_dishes.title}</a>
            {/if}
        </th>
		
		<th>
		   	{if $smarty.session[$smarty.const.SES_DISH]}
            	{if $active_page eq "tbl_dish_options"}
					<b>{$_lang.tbl_dish_options.title}</b> 
            	{else}
                	<a href='{$website}/user/tbl_dish_options.php'>{$_lang.tbl_dish_options.title}</a>
            	{/if}
			{else}
				<span>{$_lang.tbl_dish_options.title}</span> 
			{/if}
        </th>
		
		<th>
		    {if $smarty.session[$smarty.const.SES_DISH_OPTION]}
	            {if $active_page eq "tbl_dish_options_values"}
					<b>{$_lang.tbl_dish_options_values.title}</b> 
	            {else}
	                <a href='{$website}/user/tbl_dish_options_values.php'>{$_lang.tbl_dish_options_values.title}</a>
	            {/if}
			{else}
				<span>{$_lang.tbl_dish_options_values.title}</span> 
			{/if}
        </th> 
	</tr>
</table> 
<br/>