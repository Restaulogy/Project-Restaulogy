{include file='header.tpl'}

<div class="wrapper">
<h1>{$_lang.tbl_services_code.listing_title}</h1>

{if $error_msg}
	<center>{$error_msg}</center>
{/if}   

<form name="frm_tbl_services_codelist" id="frm_tbl_services_codelist"  method="POST" action="{$page_url}" >
{if $result_found gt 0 && $tbl_services_codelist}
	<table class="listTable">		
		<tr>
        <th class="bigListItem" colspan="2">{$_lang.tbl_services_code.title}</th>
        <th style="width:5%;">
            {$_lang.main.status}
    	</th>
        </tr>
		{foreach from=$tbl_services_codelist item=tbl_services_codeitem}
			<tr>				
				<td style="width:2%;">
				<label for="sel_services_code[{$tbl_services_codeitem.srvc_id}]" data-mini="true" style="width:23px;">
				{if $tbl_services_codeitem.srvc_id neq $smarty.const.SERVICE_PAY_BY_CASH}
                <input type="checkbox" data-inline='true' data-mini='true' id="sel_services_code[{$tbl_services_codeitem.srvc_id}]" name="sel_services_code[{$tbl_services_codeitem.srvc_id}]" />
                {/if}
                &nbsp;</label>
                </td>
				 
                <td class="bigListItem" style="width:98%">
                {if $tbl_services_codeitem.srvc_id eq $smarty.const.SERVICE_PAY_BY_CASH}
                    {$tbl_services_codeitem.srvc_name}
                {else}
                    <a href="{$page_url}?mode={$smarty.const.MODE_UPDATE}&srvc_id={$tbl_services_codeitem.srvc_id}">{$tbl_services_codeitem.srvc_name}</a>
                {/if}
                <br>
                <small>{$tbl_services_codeitem.srvc_description}</small>
                </td>

                <td style="width:5%;">
                    {if $tbl_services_codeitem.isActive eq 1}
                        <a href="#" class="activeIcon" title="{$_lang.tbl_dining_table.ACTIVATE.BTN_LBL}"></a>
                    {else}
                        <a href="#" class="deactiveIcon" title="{$_lang.tbl_dining_table.DEACTIVATE.BTN_LBL}"></a>
                    {/if}
				</td>
				
				<!--<td class="actionListItem"><a href="{$page_url}?mode=view&srvc_id={$tbl_services_codeitem.srvc_id}" class="detailIcon"></a><a href="{$page_url}?mode=update&srvc_id={$tbl_services_codeitem.srvc_id}" class="editIcon"></a><a class="deleteIcon" href="#" onclick="deletetbl_services_code({$tbl_services_codeitem.srvc_id});"></a>{if $tbl_services_codeitem.isActive eq 1}<a href="{$page_url}?action=deactivate&srvc_id={$tbl_services_codeitem.srvc_id}" class="deactiveIcon" title="{$_lang.tbl_services_code.DEACTIVATE.BTN_LBL}"></a>{else}<a href="{$page_url}?action=activate&srvc_id={$tbl_services_codeitem.srvc_id}" class="activeIcon" title="{$_lang.tbl_services_code.ACTIVATE.BTN_LBL}"></a>{/if}</td>-->
			</tr>
	{/foreach}
	</table>
{/if}
{if $pagination}
	<center>{$pagination}</center>
{/if}

<center>
<input type='hidden' name='action' id='action' value='' />

{if $result_found gt 0 && $tbl_services_codelist}
    <input data-inline="true" data-icon="briefcase" type="button" id="sel_all_services_code" name="sel_all_services_code" value="{$_lang.main.toggle}" onclick="javascript:$('input[type=checkbox]').click();" />
    <!--
    <input data-inline="true" data-icon="delete" type="button" id="del_sel_all_services_code" name="del_sel_all_services_code" value="{$_lang.tbl_services_code.DELETE.BTN_LBL}" onclick="deletetbl_services_code({$tbl_services_codeitem.srvc_id});" />
    -->
    <input data-inline="true" data-icon="active" type="button" value="{$_lang.tbl_dishes.ACTIVATE.BTN_LBL}" onclick="actiontbl_services_code('{$smarty.const.ACTION_ACTIVATE}');" />

    <input data-inline="true" data-icon="inactive" type="button" value="{$_lang.tbl_dishes.DEACTIVATE.BTN_LBL}" onclick="actiontbl_services_code('{$smarty.const.ACTION_DEACTIVATE}');" />

    <input data-inline="true" data-icon="recycle-full" type="button"  value="{$_lang.tbl_dishes.DELETE.BTN_LBL}" onclick="actiontbl_services_code('{$smarty.const.ACTION_DELETE}');" />
    
{/if}

<input onclick="window.location.href='{$page_url}?mode={$smarty.const.MODE_CREATE}'" data-inline="true" data-icon="add-item" type="button" value="{$_lang.tbl_services_code.CREATE.BTN_LBL}"/>
 
<!--
    <input type="button" value="{$_lang.lbl_manage}&nbsp;{$_lang.tbl_service_category.title}" data-inline="true" data-icon="configuration"  onclick="window.location.href='{$website}/user/tbl_service_category.php'"/>
-->

</center>
</form>

</div>

{include file="tbl_services_code/js.tpl"}
{include file="footer.tpl"}
