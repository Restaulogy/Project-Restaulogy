{if $_email_coupons}
	<div>
		<h1>Email Promotions</h1>
	<table class="listTable">
		
        {foreach from=$_email_coupons item=_email_couponsitem}
			<tr>
				<td class="bigListItem">
         {assign var="promo_img_src" value=""}
		 {if !($_email_couponsitem.img_ext)||($_email_couponsitem.img_ext eq '0')}
		    {if $_email_couponsitem.restaurent_img !=""}
				 {assign var="promo_img_src" value=$promo_img_src|cat:"images/restaurant/"|cat:$_email_couponsitem.rwd_buss_id|cat:"."|cat:$_email_couponsitem.restaurent_img}
			{else}
    		     {assign var="promo_img_src" value=$promo_img_src|cat:"modules/business_listing/templates/template_mobile/images/nologo.jpg"}
			{/if}
		{else}
		    {assign var="promo_img_src" value=$promo_img_src|cat:"modules/business_listing/promotion_images/"|cat:$_email_couponsitem.id|cat:"."|cat:$_email_couponsitem.img_ext}
		{/if}   
	        <table class="listTable">
				<tr>
					<td width="15%">
						<img src="{$website}/{$promo_img_src}" style='width:100px;height:60px;'/>
					</td>
					<td width="85%" >
						<a href="{$website}/modules/business_listing/show.php?show_type=PR&lid=1&promoid={$_email_couponsitem.id}&show_pr_code=1" target="_blank">
						{$_email_couponsitem.title}
						</a><br>
		               <small> {$_email_couponsitem.comments}</small>
					</td>
				</tr>
			</table>
        </td>
		<td class="actionListItem">
            {if $_email_couponsitem.cupon_type eq 'invitation' AND $_email_couponsitem.prm_allow_multi_redeem eq 0 }
            {else}
                {if $Global_member.member_role_id eq $smarty.const.ROLE_MANAGER OR $Global_member.member_role_id eq $smarty.const.ROLE_EXPEDITOR OR $Global_member.member_role_id eq $smarty.const.ROLE_OWNER OR $Global_member.member_role_id eq $smarty.const.ROLE_ADMIN OR $Global_member.member_role_id eq $smarty.const.ROLE_DEV}
                    {jqmbutton icon="star" value="Claim" onclick="location.href='{$website}/modules/business_listing/show.php?show_type=PR&lid={$_email_couponsitem.list_id}&promoid={$_email_couponsitem.id}&prom_crm_id={$_email_couponsitem.crm_pr_ml_id}&reward_code=1&use_this_prom={$_email_couponsitem.crm_pr_ml_id}'"}
                {else}
                    {jqmbutton icon="star" value="Claim" onclick="location.href='{$website}/modules/business_listing/show.php?show_type=PR&lid={$_email_couponsitem.list_id}&promoid={$_email_couponsitem.id}&prom_crm_id={$_email_couponsitem.crm_pr_ml_id}'"}
                {/if}
            {/if}
		</td>
		</tr>
    {/foreach}
	</table>
	</div>
{/if}
