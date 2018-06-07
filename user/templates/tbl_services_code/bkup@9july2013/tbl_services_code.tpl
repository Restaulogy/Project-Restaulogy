{include file='header.tpl'}

<div class="wrapper">
<h1>{$_lang.tbl_services_code.listing_title}</h1>

{if $error_msg}
	<center>{$error_msg}</center>
{/if}

{if $result_found gt 0 && $tbl_services_codelist}
	<table class="listTable">		
		<tr><th class="bigListItem" colspan="2">{$_lang.tbl_services_code.title}</th>
		<th class="actionListItem"></th></tr>
		{foreach from=$tbl_services_codelist item=tbl_services_codeitem}
			<tr>				
				<td width="30">
                 <img width="30" height="30" src="{$website}/uploads/services/{$tbl_services_codeitem.srvc_img}" alt="{$tbl_services_codeitem.srvc_name}" />
                 </td>
                <td class="bigListItem"><a href="{$page_url}?mode=view&srvc_id={$tbl_services_codeitem.srvc_id}">{$tbl_services_codeitem.srvc_name}</a><br>
                <small>{$tbl_services_codeitem.srvc_description}</small>
                </td>				
				
				<td class="actionListItem"><a href="{$page_url}?mode=view&srvc_id={$tbl_services_codeitem.srvc_id}" class="detailIcon"></a><a href="{$page_url}?mode=update&srvc_id={$tbl_services_codeitem.srvc_id}" class="editIcon"></a><a class="deleteIcon" href="#" onclick="deletetbl_services_code({$tbl_services_codeitem.srvc_id});"></a>{if $tbl_services_codeitem.isActive eq 1}<a href="{$page_url}?action=deactivate&srvc_id={$tbl_services_codeitem.srvc_id}" class="deactiveIcon" title="{$_lang.tbl_services_code.DEACTIVATE.BTN_LBL}"></a>{else}<a href="{$page_url}?action=activate&srvc_id={$tbl_services_codeitem.srvc_id}" class="activeIcon" title="{$_lang.tbl_services_code.ACTIVATE.BTN_LBL}"></a>{/if}</td>
			</tr>
	{/foreach}
	</table>
{/if}
{if $pagination}
	<center>{$pagination}</center>
{/if}
<center>
<input onclick="window.location.href='{$page_url}?mode={$smarty.const.MODE_CREATE}'" data-inline="true" data-icon="add-item" type="button" value="{$_lang.tbl_services_code.CREATE.BTN_LBL}"/>
 
<input type="button" value="{$_lang.lbl_manage}&nbsp;{$_lang.tbl_service_category.title}" data-inline="true" data-icon="configuration"  onclick="window.location.href='{$website}/user/tbl_service_category.php'"/>
</center>
</div>

{include file="tbl_services_code/js.tpl"}
{include file="footer.tpl"}
