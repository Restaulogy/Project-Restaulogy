{if $vPromotion.id}

{if $prom_filt_rwd gt 0 && $prom_filt_usr gt 0  && $prom_filt_expired==1}
        <div class='fail'>
            This promotion is expired.
        </div>
{else}

{if $vPromotion.isExpired}
    <div class='fail'>
        This promotion is expired.
    </div>
{/if}
<h1>{if $vPromotion.pdf}<a  style="text-decoration:none;" href="pdf/{$vPromotion.pdf}" target="_blank">{$vPromotion.title}</a>{else}{$vPromotion.title}{/if}
 <br/><b style="font-size:11px;font-family:Arial">Expire On - {$vPromotion.end_date|date_format:$smarty.const.HTML5_DAY_FORMAT}</b>

 </h1>

    		    <table class="job_detail_panal_table" style="width:100% !important;">
				    {if $vPromotion.pdf}
                    <tr>
                        <td colspan="2" class="pdf" align="center">
						 	  <a href="pdf/{$vPromotion.pdf}" id="show_pdf_file" target="_blank"></a>
				  		</td>
					</tr>

					{/if}
                    <tr>
                        <td valign="top" colspan="2">
                        {assign var="promo_img_src" value=""}
                {if !($vPromotion.img_ext)||($vPromotion.img_ext eq '0')}
								{if $vPromotion.restaurant_logo != ""}
									{assign var="promo_img_src" value=$vPromotion.restaurant_logo}
								{else}
										{if $vs_current_listing.logo != "" }
                        {assign var="promo_img_src" value=$vs_current_listing.logo}
                		{else}
                         {assign var="promo_img_src" value=$promo_img_src|cat:"templates/"|cat:$deftpl|cat:"/images/nologo.jpg"}
                   {/if}
								{/if}
                {else}
                         {assign var="promo_img_src" value=$promo_img_src|cat:"promotion_images/"|cat:$vPromotion.id|cat:"."|cat:$vPromotion.img_ext}
                {/if}
                    <div calss="biz_center" style="clear:both !important;">
                         <img src="{$promo_img_src}" width="300" height="200" />
                    </div>


                        </td>
                    </tr>
					<tr>
					    <td colspan="2" style="text-align:justify;">{$vPromotion.comments|nl2br}<br/></td>

					</tr>

					<tr>
           <td colspan="2" style="font-size:11px;color:{$site_color.green};display:none;">
           {if $vPromotion.cupon_type neq 'none'}
						<b style="font-size:12px;color:{$site_color.green}">
                        {if $vPromotion.cupon_type eq 'all_site'}
                            All Site {$_lang.lbl_coupon}
                        {elseif $vPromotion.cupon_type  eq 'recommendation'}
                            Recommendations {$_lang.lbl_coupon}
                        {elseif $vPromotion.cupon_type  eq 'survey'}
                            Survey {$_lang.lbl_coupon}
                        {/if}
                        </b> <b>:</b>

                            {if $vPromotion.coupon && $vPromotion.coupon.id gt 0}

                                {if ($vPromotion.coupon.is_redimed) && ($vPromotion.coupon.is_redimed gt 1)}
                                       Already Redeemed
                                {else}
                                 <a href="coupon.php?redim_id={$vPromotion.cupon.id}&user_redimed=1"><img src='{$elgg_small_icon_url}bookmark_remove.png'/>Redeem {$_lang.lbl_coupon}</a>
                                {/if}
                    		{else}
							  {if $vPromotion.cupon_type eq 'survey' && $vPromotion.is_surveyed neq 1}
                    		<a href="{$elgg_main_url}pg/nabopoll/main/?id_txtserch={$vs_current_listing.userid}" target="_blank" title="Survey"><img src="{$elgg_small_icon_url}add.png" alt="Survey"/>To get {$_lang.lbl_coupon} please take survey by business.</a>
                	 		{elseif $vPromotion.cupon_type eq 'recommendation' && $vPromotion.is_recommended neq 1}
                     		<a href="#" onclick="PopupCenter('{$elgg_main_url}facebook/recommendation.php?isPopup=1&amp;type=1&amp;bizness_id={$vs_current_listing.id}&amp;is_in_cupobiz=1&amp;biz_text={$vs_current_listing.firm}','',425,350);" title="Recommend"><img src="{$elgg_small_icon_url}add.png" alt="Recommend"/>To get {$_lang.lbl_coupon} please recommend the business.</a>
                			{else}
                 			<a href="coupon.php?save=1&promotion_id={$vPromotion.id}&user_id={$elgg_current_user}"><img src='{$elgg_small_icon_url}bookmark_add.png'/>Save {$_lang.lbl_coupon}</a>
                				{/if}
                    		{/if}
                        {/if}
           </td>
        </tr>
				 <tr>
				<td colspan="2">

	<br/><br/>


{if $elgg_user_acct_type eq "business"}
	{if $vPromotion.coupon && $vPromotion.coupon.order_id gt 0}
		<a data-role="button" target="_blank" href="{$elgg_main_url}user/tbl_orders.php?order_id={$vPromotion.coupon.order_id}&{$smarty.const.MODE_TITLE}={$smarty.const.MODE_VIEW}" data-inline="true">Order</a>
	{/if}
{/if}

     {if $prom_crm_id}
          <!--
           <a data-role="button" href="show.php?show_type=PR&lid={$showing_promotion.list_id}&promoid={$showing_promotion.id}&use_this_prom={$prom_crm_id}" data-inline="true" data-icon="grid">Use this promotion</a>
           -->
     {/if}
     {if ($use_this_prom gt 0) || ($show_pr_code gt 0)}
          <h1 style='width:99%;background:orange;'>Promotion Code:<br>{$showing_promotion.prom_code}</h1>
     {/if}

 <a data-role="button" onclick="$('#div_add_this').show();" data-inline="true" data-icon="star">Share With</a>
  {if $smarty.session[$smarty.const.SES_TABLE]>0}
        
		{if $showing_promotion.google_cal neq ''}
		  <a href="#" onclick="$('#popupAddToCAL').show();" data-inline="true" data-role="button" data-icon="gear" >Add to Calendar</a>
 	    {/if}
		<a data-role="button" href="#" onclick="$('#div_remind_me').show();" data-inline="true" data-icon="addressbook" >Remind Me</a>
		<a data-role="button" href="#" onclick="set_email_friend({$showing_promotion.id});" data-inline="true" data-icon="save" >Email a Friend</a>
  {/if}

      <!--
      <a data-role="button" href="promotionslisting.php?show_type=PR" data-inline="true" data-icon="refresh">Back</a>
      -->
     <br/><br/>
	</td>
  </tr>
</table>
 {include file="$deftpl/share_add_this.tpl"}
 
{if $smarty.session[$smarty.const.SES_TABLE]>0}
    {if $showing_promotion.google_cal neq ''}
        {include file="$deftpl/add_to_cal.tpl"}
    {/if}
   
    {include file="{$deftpl}/cust_login_tiny.tpl"}
    {include file="$deftpl/tbl_prom_reminder/view.tpl"}
{/if}

{if $vPromotion.cupon_type eq 'invitation' AND $vPromotion.prm_allow_multi_redeem eq 0}
{else}
    {if $prom_filt_rwd gt 0 && $prom_filt_usr gt 0  && $vPromotion.isExpired==false }
        <a data-role="button" href="#" onclick="$('#popupPromFiltVal').popup('open');" data-inline="true" data-icon="refresh" >Claim</a>
        {include file="$deftpl/pop_cust_email_filt.tpl"}
    {/if}

    {if $prom_crm_id>0 && $vPromotion.isExpired==false}
        <a data-role="button" href="#" onclick="$('#popupPromEmailConfirm').popup('open');" data-inline="true" data-icon="refresh" >Claim</a>
        {include file="$deftpl/pop_prom_email_claim.tpl"}
    {/if}
{/if}


{/if}

{else}
    <div class='error'>
        This promotion is Deleted.
    </div>
{/if}

{literal}
<script type="text/javascript">

function set_email_friend(prom_id){
    $('#prom_id').val(prom_id);
    $('#pop_email_friend').popup('open');
}

</script>
{/literal}
