{include file='header.tpl'}<div class="wrapper"><h1>{$_lang.tbl_food_pairing.listing_title} for {$food_pair_main_dish_detail.dish_name}</h1>{if $error_msg}	<center>{$error_msg}</center>{/if}<form name="frm_tbl_food_pairing" id="frm_tbl_food_pairing"  method="POST" action="{$page_url}" >{if $result_found gt 0 && $tbl_food_pairinglist}	<table class="listTable">		<tr>        <th class="bigListItem">{$_lang.tbl_food_pairing.title}</th>		<th class="actionListItem"></th>        </tr>		{foreach from=$tbl_food_pairinglist item=tbl_food_pairingitem}			<tr>				<td class="bigListItem">				                 <table >                   <tr>				 	 <td style="width:2%;">						<label for="sel_tbl_food_pairing[{$tbl_food_pairingitem.food_pair_id}]" data-mini="true" style="width:23px;"><input type="checkbox" data-inline='true' data-mini='true' id="sel_tbl_food_pairing[{$tbl_food_pairingitem.food_pair_id}]" name="sel_tbl_food_pairing[{$tbl_food_pairingitem.food_pair_id}]" />&nbsp;</label>		     	    </td>                     <td width="40" height="40" style="border-bottom:none !important;">                         {if $tbl_food_pairingitem.food_pair_paired_dish_details.attrib_details}                            {foreach $tbl_food_pairingitem.food_pair_paired_dish_details.attrib_details as $attribs}                                {if $attribs.dish_attrib_img neq ''}                                    <img style="width:20px;height:20px;" src="{$website}{$smarty.const.DISH_ATTRIB_IMG_UPLOAD_PATH}{$attribs.dish_attrib_img}" />                                {/if}                            {/foreach}                            {/if}                         {if $tbl_food_pairingitem.food_pair_paired_dish_details.dish_img neq ""}                        <a target="_blank" href="{$website}/uploads/dish/{$tbl_food_pairingitem.food_pair_paired_dish_details.dish_img}"><img width="40" height="40" src="{$website}/uploads/dish/{$tbl_food_pairingitem.food_pair_paired_dish_details.dish_img}" /></a>                         {/if}                     </td>                     <td style="border-bottom:none !important;">                        <table >                            <tr>                                <td style="border-bottom:none !important;">                                    <a target="_blank" href="{$website}/user/tbl_dishes.php?mode={$smarty.const.MODE_VIEW}&dish_id={$tbl_food_pairingitem.food_pair_paired_dish}">{$tbl_food_pairingitem.food_pair_paired_dish_details.dish_name}</a>                                </td>                            </tr>                            <tr>                                <td style="border-bottom:none !important;">              <small>							{if $tbl_food_pairingitem.food_pair_paired_dish_details.submenu}								{foreach $tbl_food_pairingitem.food_pair_paired_dish_details.submenu as $sbmnu}									{$sbmnu.menu_name} &raquo; {$sbmnu.submnu_name}								{/foreach}							{/if}							<!--{$tbl_food_pairingitem.food_pair_paired_dish_details.dish_notes|truncate :50}-->                            </small>                                </td>                            </tr>                        </table>                     </td>                   </tr>                </table>                </td>				<td class="actionListItem">				<!--                <a href="{$page_url}?mode={$smarty.const.MODE_UPDATE}&food_pair_id={$tbl_food_pairingitem.food_pair_id}" class="editIcon"></a><a class="deleteIcon" href="#" onclick="deletetbl_food_pairing({$tbl_food_pairingitem.food_pair_id});"></a>{if $tbl_food_pairingitem.isActive eq 1}<a href="{$page_url}?action={$smarty.const.ACTION_DEACTIVATE}&food_pair_id={$tbl_food_pairingitem.food_pair_id}" class="deactiveIcon" title="{$_lang.tbl_food_pairing.DEACTIVATE.BTN_LBL}"></a>{else}<a href="{$page_url}?action={$smarty.const.ACTION_ACTIVATE}&food_pair_id={$tbl_food_pairingitem.food_pair_id}" class="activeIcon" title="{$_lang.tbl_food_pairing.ACTIVATE.BTN_LBL}"></a>{/if}        -->                </td>			</tr>	{/foreach}	</table>{else}	<div class="error">{$_lang.tbl_food_pairing.no_record_found}</div>{/if}{if $pagination}	<center>{$pagination}</center>{/if}<input type="hidden" id="action" name="action" value=""/></form><div class="biz_center">{if $result_found gt 0 && tbl_food_pairing}    <input data-inline="true" data-icon="briefcase" type="button" value="{$_lang.main.toggle}" onclick="javascript:$('input[type=checkbox]').click();" />    <input data-inline="true" data-icon="recycle-full" type="button"  value="{$_lang.tbl_dishes.DELETE.BTN_LBL}" onclick="actiontbl_food_pairing('{$smarty.const.ACTION_DELETE}');" />{/if}<input data-icon="add-item" data-inline="true" onclick="window.location.href='{$page_url}&mode={$smarty.const.MODE_CREATE}'" type="button" value="{$_lang.tbl_food_pairing.CREATE.BTN_LBL}"/></div></div>{include file="tbl_food_pairing/js.tpl"}{include file="footer.tpl"}