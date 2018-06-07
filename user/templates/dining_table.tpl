{include file='header.tpl'}
<div class='wrapper'>
 <h1>All Tables</h1>
  {if $error_msg}
  	  {$error_msg}
	  <br>
  {/if}
{if $info and $info.result_count gt 0}

	<table class='listTable'>
		<tr>
			<th class='bigListItem'>Tables</th>
			<th class='actionListItem'></th>
		</tr>
	{foreach from=$info.tables item=table}
	 	<tr>
			<td class='bigListItem'><a href='{$website}/user/dining_table.php?table_id={$table.id}&mode=view' title="{$table.number}">{$table.number|truncate:32}</a></td>  
			<td class='actionListItem'><a href='{$website}/user/dining_table.php?table_id={$table.id}&mode=update' title="Edit Table" class='editIcon'></a><a href='{$website}/user/dining_table.php?table_id={$table.id}&action=delete' class='deleteIcon'  title="Delete Table" ></a></td>
		</tr>
	{/foreach}
	</table>
	{if $info.pagination}
	<center>
		{$info.pagination}
	</center>
	{/if}
	
{else}
	<div class="error">No record found.</div>
{/if}
<div class='field-row clearfix'>
	<input  class="fleft"  type="button" value="Add New Table"  onclick="window.location.href='{$website}/user/dining_table.php?mode=new'"/>
</div>

</div>
{include file='footer.tpl'}
