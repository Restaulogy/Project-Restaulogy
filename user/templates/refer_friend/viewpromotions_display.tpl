{if $vPromotion.id}

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
		        {assign var="promo_img_src" value="{$website}"}
				 {if ($vPromotion.img_ext eq '')||($vPromotion.img_ext eq '0')}
				    {if $vPromotion.restaurent_img !=""}
						 {assign var="promo_img_src" value=$promo_img_src|cat:"/images/restaurant/"|cat:$vPromotion.prm_restaurent|cat:"."|cat:$vPromotion.restaurent_img}
					{else}
		    		     {assign var="promo_img_src" value=$promo_img_src|cat:"/modules/business_listing/templates/template_mobile/images/nologo.jpg"}
					{/if}
				{else}
				    {assign var="promo_img_src" value=$promo_img_src|cat:"/modules/business_listing/promotion_images/"|cat:$vPromotion.id|cat:"."|cat:$vPromotion.img_ext}
				{/if}
	            <div calss="biz_center" style="clear:both !important;">
	                 <img src="{$promo_img_src}" width="300" height="200" />
	            </div>
            </td>
        </tr>
		<tr>
		    <td colspan="2" style="text-align:justify;">{$vPromotion.comments|nl2br}<br/></td>
		</tr>
	</table>

{else}
    <div class='error'>
        This promotion is Deleted.
    </div>
{/if}