<link rel="stylesheet" href="{$website}/css/chosen/chosen.css" />
<div class="navTable_border">
<table class="navTable" style="width:250px;">
	<tr>
		<th>
		{if $trans_type eq 'server'}	
				<b>{$_lang.tbl_transfer.serverwise}</b>
		{else}
				<a href="{$website}/user/tbl_transfer.php?trans_type=server">{$_lang.tbl_transfer.serverwise}</a>	  
		{/if}
		</th>
		<th>
		{if $trans_type eq 'table'}	
			<b>{$_lang.tbl_transfer.tablewise}</b>
		{else}
				<a href="{$website}/user/tbl_transfer.php?trans_type=table">{$_lang.tbl_transfer.tablewise}</a>	  
		{/if}
		</th>
		<!--<th>
		{if $trans_type eq 'list'}	
			<b>{$_lang.tbl_transfer.list}</b>
		{else}
				<a href="{$website}/user/tbl_transfer.php?trans_type=list">{$_lang.tbl_transfer.list}</a>	  
		{/if}
		</th> -->
	</tr>
</table> 
</div>
