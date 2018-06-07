{include file='header.tpl'}
<div class='wrapper'>
 <h1>All Services</h1>
  {if $error_msg}
  	  {$error_msg}
	  <br>
  {/if}
{if $info and $info.result_count gt 0}
	<table class='listTable'>
		<tr>
			<th class='bigListItem'>Services</th>
			<th class='actionListItem'></th>
		</tr>
	{foreach from=$info.services item=service}
	 	<tr>
			<td class='bigListItem'><a href='{$website}/user/service_code.php?srvc_id={$service.id}&mode=view' title="{$service.name}">{$service.name|truncate:32}</a></td>  
			<td class='actionListItem'><a href='{$website}/user/service_code.php?srvc_id={$service.id}&mode=update' title="Edit Service" class='editIcon'></a><a href='{$website}/user/service_code.php?srvc_id={$service.id}&action=delete' class='deleteIcon'  title="Delete Service" ></a></td>
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
	<input  class="fleft"  type="button" value="Add New Service"  onclick="window.location.href='{$website}/user/service_code.php?mode=new'"/>
</div>

</div>
{include file='footer.tpl'}
