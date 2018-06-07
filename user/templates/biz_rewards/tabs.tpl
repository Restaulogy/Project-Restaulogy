<!-- tabs are only for the admin -->
{* if $isCustomer gt 0 or $smarty.session.curr_sess_p eq 'restaulogy' *}
{if $isCustomer gt 0}
{else}
<div class="navTable">
	<table class="navTable" style="width:100%">
	<tr>
        {if $sesslife && ($Global_member.member_role_id eq $smarty.const.ROLE_MANAGER || $Global_member.member_role_id eq $smarty.const.ROLE_WAITER || $Global_member.member_role_id eq $smarty.const.ROLE_ADMIN)}
                <th {if $active_page eq "rewrad_point_list"}class="active"{else}class="link" onclick='window.location.href="{$website}/user/rewrad_point_list.php";'{/if}>{$_lang.biz_rewards.rwd_points_lst}</th>
         {/if}
	
      <!--  <th {if $active_page eq "customer_requests"}class="active"{else}class="link" onclick='window.location.href="{$website}/user/customer_rewards.php?is_req=1"'{/if}>{$_lang.biz_rewards.rwd_requests}</th>-->

       {if $smarty.session[$smarty.const.SES_REWARD].id gt 0}
            {if $_is_from_approve eq 1}
                <th {if $active_page eq "customer_rewards"}class="active"{else}class="link" onclick='window.location.href="{$website}/user/customer_rewards.php?is_req=0&_is_from_approve={$_is_from_approve}"'{/if}>{$_lang.biz_rewards.redeem}</th>
            {/if}
        {/if}
        
        {if $sesslife && ($Global_member.member_role_id eq $smarty.const.ROLE_MANAGER || $Global_member.member_role_id eq $smarty.const.ROLE_WAITER || $Global_member.member_role_id eq $smarty.const.ROLE_ADMIN)}
                <th {if $active_page eq "biz_checkins"}class="active"{else}class="link" onclick='window.location.href="{$website}/user/biz_checkins.php?server_validated={$server_validated}";'{/if}>{$_lang.biz_checkins.listing_title}</th>
                
                <!-- <th {if $active_page eq "rewrad_point_list"}class="active"{else}class="link" onclick='window.location.href="{$website}/user/rewrad_point_list.php";'{/if}>{$_lang.biz_rewards.rwd_points_lst}</th>
                -->
         {/if}
	</tr>
	</table>
</div>
{/if}
<br>
