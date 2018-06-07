<div class="navTable">
	<table class="navTable" style="width:100%">

   <tr> 
		
        <th {if $rpt_to_show eq "loyalty_reward"}class="active"{else}class="link" onclick='window.location.href="{$website}/user/tbl_qrcode_log.php?rpt_to_show=loyalty_reward"'{/if}>{$_lang.biz_rewards.title}</th>
        
        <th {if $rpt_to_show eq "actvty_log"}class="active"{else}class="link" onclick='window.location.href="{$website}/user/biz_checkins.php?rpt_to_show=actvty_log"'{/if}>{$_lang.biz_rewards.activity_log}</th>
        
        <th {if $rpt_to_show eq "rewrad_point_list"}class="active"{else}class="link" onclick='window.location.href="{$website}/user/rewrad_point_list.php?rpt_to_show=rewrad_point_list";'{/if}>{$_lang.biz_rewards.rwd_points_lst}</th>
        
        <th {if $rpt_to_show eq "promotions"}class="active"{else}class="link" onclick='window.location.href="{$website}/user/tbl_qrcode_log.php?rpt_to_show=promotions"'{/if}>{$_lang.biz_rewards.label.rwd_coupon_id}</th>
        
        <!--<th {if $smarty.request.tab_sel eq "restaurent"}class="active"{else}class="link" onclick='window.location.href="{$website}/user/prom_stats.php?tab_sel=restaurent";'{/if}>{$_lang.tbl_restaurent.title}</th> 
				
		<th {if $smarty.request.tab_sel eq "promotion"}class="active"{else}class="link" onclick='window.location.href="{$website}/user/prom_stats.php?tab_sel=promotion"'{/if}>{$_lang.lbl_coupons}</th>	-->	
		</tr>
	</table>
</div>

