{if $Global_member.member_role_id eq $smarty.const.ROLE_MANAGER || $Global_member.member_role_id eq $smarty.const.ROLE_WAITER|| $Global_member.member_role_id eq $smarty.const.ROLE_ADMIN|| $Global_member.member_role_id eq $smarty.const.ROLE_OWNER}
<div class="navTable_border">
    <a href="#" onclick="$('#popupSearch').toggle();" data-role="button" data-inline="true" data-transition="pop" data-icon="search" data-iconpos="notext"  data-theme="b" style="float:right;">Search</a>
	<table class="navTable" style="width:100%">
		<tr> 
		<th {if $rpt_to_show eq "qr_code_log"}class="active"{else}class="link" onclick='window.location.href="{$website}/user/tbl_qrcode_log.php?rpt_to_show=qr_code_log"'{/if}>{$_lang.tbl_qrcode_log.title}</th>
        <th {if $rpt_to_show eq "loyalty_reward"}class="active"{else}class="link" onclick='window.location.href="{$website}/user/tbl_qrcode_log.php?rpt_to_show=loyalty_reward"'{/if}>{$_lang.biz_rewards.title}</th>
        
        <th {if $rpt_to_show eq "rewrad_point_list"}class="active"{else}class="link" onclick='window.location.href="{$website}/user/rewrad_point_list.php?rpt_to_show=rewrad_point_list";'{/if}>{$_lang.biz_rewards.rwd_points_lst}</th>
        
        <th {if $rpt_to_show eq "promotions"}class="active"{else}class="link" onclick='window.location.href="{$website}/user/tbl_qrcode_log.php?rpt_to_show=promotions"'{/if}>{$_lang.main.mnu_claims}</th>
        
        <th {if $smarty.request.tab_sel eq "restaurent"}class="active"{else}class="link" onclick='window.location.href="{$website}/user/prom_stats.php?tab_sel=restaurent";'{/if}>{$_lang.tbl_restaurent.title}</th> 
				
		<th {if $smarty.request.tab_sel eq "promotion"}class="active"{else}class="link" onclick='window.location.href="{$website}/user/prom_stats.php?tab_sel=promotion"'{/if}>{$_lang.lbl_coupons}</th>		
		</tr>	
	</table>

</div>

<div class="line_break"></div>
<div class="line_break"></div>
<div class="line_break"></div>
{/if}
