<!--
{if $smarty.session.member_role_id eq $smarty.const.ROLE_MANAGER }
 {if $is_preview neq 1}
 <div class="clearfix"></div>

 <table class="navTable">
	<tr>
		<th>
            {if $smarty.session.mnu_sel eq "menu"}
                <b>{$_lang.tbl_menu.title}</b>
            {else}
                <a href='{$website}/user/tbl_menu.php'>{$_lang.tbl_menu.title}</a>
            {/if}
        </th>

        <th>{if $smarty.session[$smarty.const.SES_MENU] gt 0}
                {assign var="vr_sub_mnu" value="<a href='{$website}/user/tbl_sub_menu.php?submnu_menu={$smarty.session[$smarty.const.SES_MENU]}'>{$_lang.tbl_sub_menu.title}</a>"}
                {if $smarty.session.mnu_sel eq "sub_menu"}
                    <b>{$_lang.tbl_sub_menu.title}</b>
                {else}
                     {$vr_sub_mnu}
                {/if}
            {else}
                <small style="font-size:12px;">{$_lang.tbl_sub_menu.title}</small>
            {/if}
       </th>
       
	   <th>
            {if $smarty.session[$smarty.const.SES_SUB_MENU] gt 0}
                {assign var="vr_dish_mnu" value="<a href='{$website}//user/tbl_submenu_dishes.php?sbmnu_dish_submenu={$smarty.session[$smarty.const.SES_SUB_MENU]}'>{$_lang.tbl_submenu_dishes.title}</a>"}
                {if $smarty.session.mnu_sel eq "dish"}
                    <b>{$_lang.tbl_submenu_dishes.title}</b>
                {else}
                     {$vr_dish_mnu}
                {/if}
            {else}
                <small style="font-size:12px;">{$_lang.tbl_submenu_dishes.title}</small>
            {/if}
       </th>
	</tr>
</table>
<br/>
  {/if}
{/if}
-->