{include file='header.tpl'}<div class="wrapper"><h1>{$_lang.tbl_rest_menu_opt.listing_title}</h1>{if $error_msg}	<center>{$error_msg}</center>{/if}{if $result_found gt 0 && $tbl_rest_menu_optlist}	<table class="biz_data_grid">		<tr>			<th class="{if $smarty.get.sort_on eq 'rst_mnu_restaurant'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}?sort_on=rst_mnu_restaurant&sort_by={$new_sort}">{$_lang.tbl_rest_menu_opt.label.rst_mnu_restaurant}</a></th>						<th class="{if $smarty.get.sort_on eq 'rst_mnu_reward_conf'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}?sort_on=rst_mnu_reward_conf&sort_by={$new_sort}">{$_lang.tbl_rest_menu_opt.label.rst_mnu_reward_conf}</a></th>						<th class="{if $smarty.get.sort_on eq 'rst_mnu_add_order'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}?sort_on=rst_mnu_add_order&sort_by={$new_sort}">{$_lang.tbl_rest_menu_opt.label.rst_mnu_add_order}</a></th>			<th class="{if $smarty.get.sort_on eq 'rst_mnu_add_prom'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}?sort_on=rst_mnu_add_prom&sort_by={$new_sort}">{$_lang.tbl_rest_menu_opt.label.rst_mnu_add_prom}</a></th>			<th class="{if $smarty.get.sort_on eq 'rst_mnu_serv_req'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}?sort_on=rst_mnu_serv_req&sort_by={$new_sort}">{$_lang.tbl_rest_menu_opt.label.rst_mnu_serv_req}</a></th>			<th class="{if $smarty.get.sort_on eq 'rst_mnu_orders'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}?sort_on=rst_mnu_orders&sort_by={$new_sort}">{$_lang.tbl_rest_menu_opt.label.rst_mnu_orders}</a></th>			<th class="{if $smarty.get.sort_on eq 'rst_mnu_tbl_statuses'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}?sort_on=rst_mnu_tbl_statuses&sort_by={$new_sort}">{$_lang.tbl_rest_menu_opt.label.rst_mnu_tbl_statuses}</a></th>			<th class="{if $smarty.get.sort_on eq 'rst_mnu_prom_claimed'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}?sort_on=rst_mnu_prom_claimed&sort_by={$new_sort}">{$_lang.tbl_rest_menu_opt.label.rst_mnu_prom_claimed}</a></th>			<th class="{if $smarty.get.sort_on eq 'rst_mnu_complaints'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}?sort_on=rst_mnu_complaints&sort_by={$new_sort}">{$_lang.tbl_rest_menu_opt.label.rst_mnu_complaints}</a></th>			<th class="{if $smarty.get.sort_on eq 'rst_mnu_transfer_tbl'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}?sort_on=rst_mnu_transfer_tbl&sort_by={$new_sort}">{$_lang.tbl_rest_menu_opt.label.rst_mnu_transfer_tbl}</a></th>			<th class="{if $smarty.get.sort_on eq 'rst_mnu_online_users'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}?sort_on=rst_mnu_online_users&sort_by={$new_sort}">{$_lang.tbl_rest_menu_opt.label.rst_mnu_online_users}</a></th>			<th class="{if $smarty.get.sort_on eq 'rst_mnu_loyalty_rewards'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}?sort_on=rst_mnu_loyalty_rewards&sort_by={$new_sort}">{$_lang.tbl_rest_menu_opt.label.rst_mnu_loyalty_rewards}</a></th>			<th class="{if $smarty.get.sort_on eq 'rst_mnu_configuration'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}?sort_on=rst_mnu_configuration&sort_by={$new_sort}">{$_lang.tbl_rest_menu_opt.label.rst_mnu_configuration}</a></th>			<th class="{if $smarty.get.sort_on eq 'rst_mnu_allergy'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}?sort_on=rst_mnu_allergy&sort_by={$new_sort}">{$_lang.tbl_rest_menu_opt.label.rst_mnu_allergy}</a></th>			<!-- <th class="action_header">Action</th>  -->            		</tr>		{foreach from=$tbl_rest_menu_optlist item=tbl_rest_menu_optitem}		<tr class="{cycle values="odd,even"}">			<td><a href="{$page_url}?mode={$smarty.const.MODE_UPDATE}&rst_mnu_id={$tbl_rest_menu_optitem.rst_mnu_id}">{$tbl_rest_menu_optitem.rst_mnu_restaurant_nm}</a></td>            <td>{$tbl_rest_menu_optitem.rst_mnu_reward_conf}</td>            <td>{$tbl_rest_menu_optitem.rst_mnu_add_order}</td>			<td>{$tbl_rest_menu_optitem.rst_mnu_add_prom}</td>			<td>{$tbl_rest_menu_optitem.rst_mnu_serv_req}</td>			<td>{$tbl_rest_menu_optitem.rst_mnu_orders}</td>			<td>{$tbl_rest_menu_optitem.rst_mnu_tbl_statuses}</td>			<td>{$tbl_rest_menu_optitem.rst_mnu_prom_claimed}</td>			<td>{$tbl_rest_menu_optitem.rst_mnu_complaints}</td>			<td>{$tbl_rest_menu_optitem.rst_mnu_transfer_tbl}</td>			<td>{$tbl_rest_menu_optitem.rst_mnu_online_users}</td>			<td>{$tbl_rest_menu_optitem.rst_mnu_loyalty_rewards}</td>			<td>{$tbl_rest_menu_optitem.rst_mnu_configuration}</td>			<td>{$tbl_rest_menu_optitem.rst_mnu_allergy}</td>			<td>			<!--            <a href="{$page_url}?mode={$smarty.const.MODE_UPDATE}&rst_mnu_id={$tbl_rest_menu_optitem.rst_mnu_id}" class="editIcon"></a><a class="deleteIcon" href="#" onclick="deletetbl_rest_menu_opt({$tbl_rest_menu_optitem.rst_mnu_id});"></a>{if $tbl_rest_menu_optitem.isActive eq 1}<a href="{$page_url}?action={$smarty.const.ACTION_DEACTIVATE}&rst_mnu_id={$tbl_rest_menu_optitem.rst_mnu_id}" class="deactiveIcon" title="{$_lang.tbl_rest_menu_opt.DEACTIVATE.BTN_LBL}"></a>{else}<a href="{$page_url}?action={$smarty.const.ACTION_ACTIVATE}&rst_mnu_id={$tbl_rest_menu_optitem.rst_mnu_id}" class="activeIcon" title="{$_lang.tbl_rest_menu_opt.ACTIVATE.BTN_LBL}"></a>{/if}            -->            </td>   </tr>	{/foreach}		<tfoot>			<tr>				<td colspan="15">					# {$result_found}&nbsp;&nbsp;&nbsp;{if $pagination neq ""}{$pagination}{/if}					<select onchange="changePage('{$navigationURL}',this.value,{$smarty.request.limit});">					{if $allPageCount gt 1}						{for $foo=1 to $allPageCount}							<option value="{$foo}" {if $foo eq $currentPage}selected="selected"{/if}>{$foo}</option>						{/for}					{else}						<option value="1" disabled="disabled">1</option>					{/if}					</select>				</td>			</tr>		</tfoot>	</table>{else}	<div class="error">{$_lang.tbl_rest_menu_opt.no_record_found}</div>{/if}<center><input data-icon="add-item" data-inline="true" onclick="window.location.href='{$page_url}?mode={$smarty.const.MODE_CREATE}'" type="button" value="{$_lang.tbl_rest_menu_opt.CREATE.BTN_LBL}"/></center></div>{include file="tbl_rest_menu_opt/js.tpl"}{include file="footer.tpl"}