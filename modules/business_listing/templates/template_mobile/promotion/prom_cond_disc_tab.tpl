<div class="navTable_border"><table class="navTable" style="width:250px;">	<tr>        <th {if $active_page eq "prom_listing"}class="active"{else}class="link" onclick='window.location.href="{$website}/modules/business_listing/promotionslisting.php?show_type=PR"'{/if}>{$_lang.main.navbar.promotions}</th>                <th {if $active_page eq "promotion"}class="active"{else}class="link" onclick='window.location.href="{$website}/modules/business_listing/promotion.php?list_id={$smarty.session[$smarty.const.SES_RESTAURANT]}&new=1";'{/if}>{$_lang.main.promotion.basic_new}</th>                <th {if $active_page eq "tbl_crm_list"}class="active"{else}class="link" onclick='window.location.href="{$website}/user/tbl_crm_list.php"'{/if}>{$_lang.tbl_crm.email_prom_tab}</th>	</tr></table> </div> 