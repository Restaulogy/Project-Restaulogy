{include file='header.tpl'}

<div class="wrapper">
<h1>{$_lang.tbl_services_requests.listing_title}</h1>

{if $error_msg}
	<center>{$error_msg}</center>
{/if}

{if $result_found gt 0 && $tbl_services_requestslist}
	<table class="listTable">
		<tr><th class="bigListItem">{$_lang.tbl_services_requests.title}</th>
		<th class="actionListItem"></th></tr>
		{foreach from=$tbl_services_requestslist item=tbl_services_requestsitem}
			<tr >
				<td class="bigListItem"><a target="_blank" href="{$page_url}?mode=view&srvc_reqst_id={$tbl_services_requestsitem.srvc_reqst_id}">{$tbl_services_requestsitem.srvc_reqst_created_by}</a></td>
				<td class="actionListItem"><a href="{$page_url}?mode=update&srvc_reqst_id={$tbl_services_requestsitem.srvc_reqst_id}" class="editIcon"></a><a class="deleteIcon" href="#" onclick="deletetbl_services_requests({$tbl_services_requestsitem.srvc_reqst_id});"></a>{if $tbl_services_requestsitem.isActive eq 1}<a href="{$page_url}?action=deactivate&srvc_reqst_id={$tbl_services_requestsitem.srvc_reqst_id}" class="deactiveIcon" title="{$_lang.tbl_services_requests.DEACTIVATE.BTN_LBL}"></a>{else}<a href="{$page_url}?action=activate&srvc_reqst_id={$tbl_services_requestsitem.srvc_reqst_id}" class="activeIcon" title="{$_lang.tbl_services_requests.ACTIVATE.BTN_LBL}"></a>{/if}</td>
			</tr>
	{/foreach}
	</table>
{/if}
{if $pagination}
	<center>{$pagination}</center>
{/if}

<input type="button" value="{$_lang.tbl_services_requests.CREATE.BTN_LBL}"/>
</div>

{include file="tbl_services_requests/js.tpl"}
{include file="footer.tpl"}
