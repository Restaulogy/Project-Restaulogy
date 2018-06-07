
{* if $smarty.session[$smarty.const.SES_TABLE] && $smarty.session[$smarty.const.SES_TABLE] neq "" && $smarty.session.rest_menu_opt_det.rst_mnu_loyalty_rewards eq 1}
<ul data-role="listview">
   <li class="biz_pointer">
    <table style="width:100%;height:100%;font-size:12px;">
		<tr>
			<td rowspan="2" onclick="window.location.href='{$elgg_main_url}user/cust_login.php';" style="width:110px;">
            <img src="{$elgg_main_url}images/reward.png" style='width:100px;height:100px;'/>
            </td>
			<td style="vertical-align:top !important;">
			    <b style='color: Green !important;'>Sign up for the Reward program</b> <br> <br>
                Join {$webtitle} and start earning rewards. <br> <br>
                <input type="button" data-mini="true" data-icon="star" data-inline="true" name="reward_signup" onclick="window.location.href='{$elgg_main_url}user/cust_login.php';" value="Sign Up" />
			</td>
		</tr>
	</table>
    </li>
</ul>
<br>
{/if *}

{include file="{$deftpl}/cust_login_tiny.tpl"}


{if $list}
<ul data-role="listview">
	{section name=itm loop=$list}
	{if $ispromotion eq 1}
	{assign var=user_promotion value=$list[itm].user_promotion}
	 
	{section name=pitm  loop=$user_promotion} 
	{assign var="promo_img_src" value=""}
	
		 {if !($user_promotion[pitm].img_ext)||($user_promotion[pitm].img_ext eq '0')}
		  {if $list[itm].restaurant_logo !=""}
				 {assign var="promo_img_src" value=$list[itm].restaurant_logo}
			{else}
		    {if $list[itm].logo !=""}
		         {assign var="promo_img_src" value=$promo_img_src|cat:"modules/business_listing/logo/"|cat:$list[itm].logo}
			{else}
		         {assign var="promo_img_src" value=$promo_img_src|cat:"templates/"|cat:$deftpl|cat:"/images/nologo.jpg"}
		    {/if}
			{/if}
		{else}
		    {assign var="promo_img_src" value=$promo_img_src|cat:"promotion_images/"|cat:$user_promotion[pitm].id|cat:"."|cat:$user_promotion[pitm].img_ext}
		{/if}
			<li class="biz_pointer">  
			<table style="width:100%;height:100%;font-size:12px;">
				<tr>
					<td  rowspan="2" onclick='window.location.href="show.php?show_type=PR&amp;lid={$list[itm].id}&amp;promoid={$user_promotion[pitm].id}"' style="width:110px;"><img src="{$promo_img_src}" style='width:100px;height:100px;'/></td>
					 <td style="vertical-align:top !important;">
					 <table style="width: 100%;height:100%;">
					 	<tr onclick='window.location.href="show.php?show_type=PR&amp;lid={$list[itm].id}&amp;promoid={$user_promotion[pitm].id}"'>
							<td><b style='color: Green !important;'>{$user_promotion[pitm].title|truncate:40}</b></td>
						</tr>
						{if $listing_type neq 'is_event'}
    						<tr onclick='window.location.href="show.php?show_type=PR&amp;lid={$list[itm].id}&amp;promoid={$user_promotion[pitm].id}"'>
    							<td>Valid till {$user_promotion[pitm].end_date|date_format:$smarty.const.HTML5_DAY_FORMAT}</td>
    						</tr>
						{/if}
						<tr >
							<td>
{if $elgg_user_acct_type eq "business"}
        {if $user_promotion[pitm].isExpired eq 1}
			<!-- <a href="promotion.php?renew=1&id={$user_promotion[pitm].id}" class="renewIcon"></a> -->
			 {*jqmbutton mini="true" icon="reload" value="Renew" onclick="window.location.href='promotion.php?renew=1&id={$user_promotion[pitm].id}'"*}
		{else}
            <!--<a href="promotion.php?edit=1&id={$user_promotion[pitm].id}" class="editIcon"></a> -->
			{jqmbutton mini="true" icon="edit" value="Edit" onclick="window.location.href='promotion.php?edit=1&id={$user_promotion[pitm].id}'"}
		{/if}    
		{if $user_promotion[pitm].redimed_cupons gt 0}
			<!--<a href="coupon_statistics.php?promotion_id={$user_promotion[pitm].id}" class="statsIcon"></a>-->
			{jqmbutton mini="true" icon="bar-chart" value="Statistics" onclick="window.location.href='coupon_statistics.php?promotion_id={$user_promotion[pitm].id}'"}
		{else} 
			{jqmbutton mini="true" icon="bar-chart" value=" Statistics" onclick="#" disabled="disabled"}
		{/if}
{else}
{*
	{if $elgg_current_user gt 0}
       {if $user_promotion[pitm].is_promo_fav eq 0}
			<!--<a href="favorite.php?new=1&show_type=PR&lid={$user_promotion[pitm].id}&uid={$elgg_current_user}" class="saveIcon"></a>-->
			{assign var='link1' value="window.location.href='favorite.php?new=1&show_type=PR&lid={$user_promotion[pitm].id}&uid={$elgg_current_user}'"}
			{jqmbutton onclick="{$link1}" value="save" icon="save" mini="true"}
	   {else}
			{if $listing_type eq "favorite"}
				<!--	<a href="favorite.php?new=-1&show_type=PR&lid={$user_promotion[pitm].id}&uid={$elgg_current_user}&customer_name={$smarty.session[$smarty.const.SES_CUST_NM]}" class="remove_saveIcon"></a>-->
				 {assign var='link2' value="window.location.href='favorite.php?new=-1&show_type=PR&lid={$user_promotion[pitm].id}&uid={$elgg_current_user}'"}
					{jqmbutton onclick="{$link2}" value="Remove" icon="remove_save" mini="true"}
			{else}
					<!--<b class="grayScale saveIcon"></b>-->
			{/if}
	   {/if}
	{else}
		<!--
        <a href="{$elgg_main_url}user/login.php?prev_page=PROMOTION&action=save_coupon&{$smarty.const.SES_PROMOTION}={$user_promotion[pitm].id}" class="saveIcon"></a>
        -->
		{assign var="link3" value="window.location.href='{$elgg_main_url}user/login.php?prev_page=PROMOTION&action=save_coupon&{$smarty.const.SES_PROMOTION}={$user_promotion[pitm].id}'"} 
		{if $smarty.session[$smarty.const.SES_TABLE] && $smarty.session[$smarty.const.SES_TABLE] neq ""}
		      {jqmbutton onclick="{$link3}" value="save" icon="save" mini="true"}
		{/if}
	{/if}
*}
	
   {if $smarty.session[$smarty.const.SES_TABLE] && $smarty.session[$smarty.const.SES_TABLE] neq ""}
   {include file="$deftpl/share_code.tpl"}

        {* jqmbutton onclick="window.location.href='{$elgg_main_url}user/cust_login_tiny.php?prom_id={$user_promotion[pitm].id}&is_email_friend=1';" value="Email a Friend" icon="save" mini="true" *}
        
        {jqmbutton onclick="set_email_friend({$user_promotion[pitm].id});" value="Email a Friend" icon="save" mini="true"}

     	<a data-role="button" href="#" onclick="$('#div_add_this_{$user_promotion[pitm].id}').show();" data-inline="true" data-icon="star" data-position-to="window" data-mini="true">Share</a>
     	
     	<a data-role="button" href="{$elgg_main_url}modules/business_listing/show.php?show_type=PR&lid={$list[itm].id}&promoid={$user_promotion[pitm].id}&auto_load_remind=1" data-inline="true" data-mini="true" data-icon="addressbook" >Remind Me</a>
     	{if $user_promotion[pitm].cupon_type eq 'refer_friend'}
     	<a data-role="button" href="{$elgg_main_url}user/usr_refer_friend.php?promoid={$user_promotion[pitm].id}" data-inline="true" data-mini="true" data-icon="addressbook" target="_blank" >Refer a friend</a>
     	{/if}
    <!-- || $user_promotion[pitm].cupon_type eq 'survey' || ($smarty.now|date_format:"%Y%m%d" <= $user_promotion[pitm].start_date|date_format:"%Y%m%d")  ($user_promotion[pitm].prm_allow_multi_redeem eq 0) -->
	{if $elgg_current_user gt 0 }
			{if $user_promotion[pitm].allowed_cupons eq 0  || $user_promotion[pitm].allowed_cupons eq $user_promotion[pitm].redimed_cupons }
	         <!-- <b class="grayScale cartIcon" alt="&nbsp;"></b> -->
				   {* jqmbutton onclick='window.location.href="#"' value="claim" disable="disable" icon="cart" mini="true" *}
			 <!--	   <a data-role="button"  href="#" data-inline="true" data-icon="cart" data-position-to="window" data-mini="true" disable="disable" >Claim</a> -->
			{else} 
   	             <!-- <a data-role="button"  href="coupon.php?save=1&promotion_id={$user_promotion[pitm].id}&user_id={$elgg_current_user}&customer_name={$smarty.session[$smarty.const.SES_CUST_NM]}" data-inline="true" data-icon="cart" data-position-to="window" data-mini="true" >Claim</a> -->
   	       
				   {* assign var='link4' value="window.location.href='coupon.php?save=1&promotion_id={$user_promotion[pitm].id}&user_id={$elgg_current_user}&customer_name={$smarty.session[$smarty.const.SES_CUST_NM]}'" }
				   { jqmbutton onclick="{$link4}" value="claim" icon="cart" mini="true" *}
				    <!--	  <a href="show.php?show_type=PR&amp;lid={$list[itm].id}&amp;promoid={$user_promotion[pitm].id}&show_pr_code=1" data-role='button' data-icon='cart' data-mini='true' data-inline='true' > Claim</a> -->
			{/if}
		 
   {else}
		 <!--
         <a href="#" onclick="askCustName()" class="cartIcon"></a> 
		 {jqmbutton onclick='askCustName()' value="claim" icon="cart" mini="true"}
		 -->
		{* if ($smarty.now|date_format:"%Y%m%d" <= $user_promotion[pitm].start_date|date_format:"%Y%m%d")}
				&nbsp;
		{else} 
				<a href="show.php?show_type=PR&amp;lid={$list[itm].id}&amp;promoid={$user_promotion[pitm].id}&show_pr_code=1" data-role='button' data-icon='cart' data-mini='true' data-inline='true'>Claim</a>
		{/if *}
		 
        <!-- <a data-role="button"  href="{$elgg_main_url}user/login.php?prev_page=PROMOTION&action=claim_coupon&{$smarty.const.SES_PROMOTION}={$user_promotion[pitm].id}" data-inline="true" data-icon="cart" data-position-to="window" data-mini="true" >Claim</a>
        -->
         
    {/if}
   {/if}
  {/if}
							</td>
						</tr>
      {if $sesslife && $Global_member.member_role_id neq $smarty.const.ROLE_CUSTOMER}
						<tr onclick='window.location.href="show.php?show_type=PR&amp;lid={$list[itm].id}&amp;promoid={$user_promotion[pitm].id}"'>
							<td >
                                #claims :{$user_promotion[pitm].redimed_cupons}
                            </td>
						</tr>
      {/if}
                       {if $user_promotion[pitm].cupon_type eq 'survey'}
                            <tr onclick='window.location.href="show.php?show_type=PR&amp;lid={$list[itm].id}&amp;promoid={$user_promotion[pitm].id}"'>
    							<td ><b style='font-style:Italic;color: Green !important;'>Feedback Promotion</b></td>
    						</tr>
    				   {elseif $user_promotion[pitm].cupon_type eq 'invitation'}
                            <tr onclick='window.location.href="show.php?show_type=PR&amp;lid={$list[itm].id}&amp;promoid={$user_promotion[pitm].id}"'>
    							<td ><b style='font-style:Italic;color: Green !important;'>Invite only Promotion</b></td>
    						</tr>
    					{elseif $user_promotion[pitm].cupon_type eq 'exclusive'}
                            <tr onclick='window.location.href="show.php?show_type=PR&amp;lid={$list[itm].id}&amp;promoid={$user_promotion[pitm].id}"'>
    							<td ><b style='font-style:Italic;color: Green !important;'>Exclusive Promotion</b></td>
    						</tr>
                       {/if}
					 </table> 
					</td>
				</tr> 
			</table>  
			 </li>
	{/section}
	{/if}
	{/section}
	</ul> 
<div class="clearfix line_break"></div>
<br /> 
  <div align="center" class="pagination">{if $paginate.total gt $vs_config.search_page}{paginate_prev}&nbsp;{paginate_middle format='page' prefix='[' suffix=']' page_limit='10'}&nbsp;{paginate_next}{/if}</div>
{else}
    {if $byconnections}
        <div class="error">
            There are no promotions posted by Connections.
        </div>
    {elseif $bygroupmem}
        <div class="error">
            There are no promotions posted by Group Members.
        </div>
    {else}
        <div class="error">
		    {lang->desc p1='search' p2=$lang_set p3='not_found'}
        </div>
    {/if}
{/if}<!--$List-->

{literal}
<script type="text/javascript">
$(function(){
 $('.ui-listview li').mouseover(function() {  
    $(this).addClass("ui-btn-hover-c").removeClass( "ui-btn-up-c" ).trigger('create');
	 
  }).mouseout(function(){
    $(this).addClass("ui-btn-up-c").removeClass( "ui-btn-hover-c" ).trigger('create');
  }) ;
});

function set_email_friend(prom_id){
    $('#prom_id').val(prom_id);
    $('#pop_email_friend').popup('open');
}

</script>
{/literal}
