{include file='header.tpl'}<div class="wrapper"><h1>{$service_info.name}-{$_lang.tbl_service_stage.listing_title}</h1>{if $error_msg}	<center>{$error_msg}</center>{/if}<form name="frm_tbl_service_stagelist" id="frm_tbl_service_stagelist"  method="POST" action="{$page_url}" >{if $result_found gt 0 && $tbl_service_stagelist}	<table class="listTable">		<tr><th class="bigListItem" colspan='2'>{$_lang.tbl_service_stage.title}</th>		</tr>		{foreach from=$tbl_service_stagelist item=tbl_service_stageitem}			<tr>				<td style="width:2%;">				<label for="sel_tbl_service_stage[{$tbl_service_stageitem.srvc_stg_id}]" data-mini="true" style="width:23px;"><input type="checkbox" data-inline='true' data-mini='true' id="sel_tbl_service_stage[{$tbl_service_stageitem.srvc_stg_id}]" name="sel_tbl_service_stage[{$tbl_service_stageitem.srvc_stg_id}]" />&nbsp;</label>                </td>				<td class="bigListItem"><a href="{$page_url}&mode={$smarty.const.MODE_VIEW}&srvc_stg_id={$tbl_service_stageitem.srvc_stg_id}">{$tbl_service_stageitem.srvc_stg_name} ( {$tbl_service_stageitem.srvc_stg_thresh_hold_time} Sec.)</a></td>				<td class="actionListItem"><a href="{$page_url}&mode={$smarty.const.MODE_VIEW}&srvc_stg_id={$tbl_service_stageitem.srvc_stg_id}" class="detailIcon"></a><a href="{$page_url}&mode={$smarty.const.MODE_UPDATE}&srvc_stg_id={$tbl_service_stageitem.srvc_stg_id}" class="editIcon"></a><a class="deleteIcon" href="#" onclick="deletetbl_service_stage({$tbl_service_stageitem.srvc_stg_id});"></a>{if $tbl_service_stageitem.isActive eq 1}<a href="{$page_url}&action={$smarty.const.ACTION_DEACTIVATE}&srvc_stg_id={$tbl_service_stageitem.srvc_stg_id}" class="deactiveIcon" title="{$_lang.tbl_service_stage.DEACTIVATE.BTN_LBL}"></a>{else}<a href="{$page_url}&action={$smarty.const.ACTION_ACTIVATE}&srvc_stg_id={$tbl_service_stageitem.srvc_stg_id}" class="activeIcon" title="{$_lang.tbl_service_stage.ACTIVATE.BTN_LBL}"></a>{/if}</td>			</tr>	{/foreach}	</table>{else}	<div class="error">{$_lang.tbl_service_stage.no_record_found}</div>{/if}{if $pagination}	<div class="biz_center">{$pagination}</div>{/if} <div class="biz_center biz_hidden"><input type='hidden' name='action' id='action' value='' /> <input data-inline="true" data-icon="briefcase" type="button" id="sel_all_tbl_service_stage" name="sel_all_tbl_service_stage" value="{$_lang.main.toggle}" onclick="javascript:$('input[type=checkbox]').click();" /><input data-inline="true" data-icon="delete" type="button" id="del_sel_all_tbl_service_stage" name="del_sel_all_tbl_service_stage" value="{$_lang.tbl_service_stage.DELETE.BTN_LBL}" onclick="deletetbl_service_stage({$tbl_service_stageitem.srvc_stg_id});" /><input  data-inline="true" data-icon="add-item"  onclick="window.location.href='{$page_url}&mode={$smarty.const.MODE_CREATE}'" type="button" value="{$_lang.tbl_service_stage.CREATE.BTN_LBL}"/><input  data-inline="true" data-icon="back"  onclick="window.location.href='{$website}/user/tbl_services_code.php?srvc_id={$service_info.srvc_id}&mode={$smarty.const.MODE_VIEW}'" type="button" value="{$service_info.name}"/></div></div>{include file="tbl_service_stage/js.tpl"}{include file="footer.tpl"}