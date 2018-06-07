{include file="header.tpl"}
<div class="wrapper description">
{if $request}
<h1>{$request.service.name}</h1>
{if $error_msg}
	{$error_msg}
{/if} 
		<p><b>{$request.table.number}</b>&nbsp;:&nbsp;{$request.service.name}<small>{$request.service.description}<br>By <b>{$request.created_by}</b> Posted <b>{$request.friendly_created_on}</b></small></p>
		 {if $request.completed_at}
		 	<p>Completed On <b>{$request.friendly_completed_at}</b>  </p>
			<p>
				 <small>Waiter : <b>{if $request.emp_id gt 0}{$request.employee.full_name}{else}--{/if}</b></small>
				{/if} 
			</p> 
		{if $request.sub_service}
			<h6>Services Items</h6>
			{foreach from=$request.sub_service item=sub_service name=srvc}
			{if $sub_service.typeId}
				{if $sub_service.value eq 1}
					<p>{$smarty.foreach.srvc.iteration})&nbsp;<b>{$sub_service.name}</b><span class='checkIcon'></span></p>
				{/if} 
			{else}
				<p>{$smarty.foreach.srvc.iteration})&nbsp;<b>{$sub_service.name}</b> : {$sub_service.value}</p> 
			{/if}
			{/foreach} 
		{/if}	
{else}
	<div class='errorbox'>{$_lang['services_requests']['view_request']['no_record_msg']}</div>	
{/if}
</div>
{include file="footer.tpl"}