 {if $promotion.id|trim|strlen eq 0}
    {assign var="ALLOW_TO_POST" value=0}
    {if $elgg_user_allow_to_post eq 1}
        {if $elgg_user_subscription_id && $elgg_remaining_itm_to_post }
            {assign var="ALLOW_TO_POST" value=1}
        {else}
            {if $elgg_user_allow_to_free_post eq 1}
                {assign var="ALLOW_TO_POST" value=1}
            {/if}
        {/if}
    {/if}
 {else}
     {assign var="ALLOW_TO_POST" value="1"}
 {/if}
 {if $ALLOW_TO_POST eq 0}
    <div class="fail">Not Allowed To Post Promotion.</div>
 {else}
{include file="$deftpl/promotion/notify_msg.tpl"}
<form id="promotion_form" name="promotion_form" action="{$elgg_main_url}modules/business_listing/promotion.php" method="post"  enctype="multipart/form-data" data-ajax="false" onsubmit="return validate_promotion_form();">
<input type="hidden" name="list_id" value="{$vs_user_profile_list_id}"/>
{if $promotion.id}
    <input type="hidden" id="id" style="width:50px;" name=" id" value="{$promotion.id}"/>
{/if}
{if $is_renew_promotion}
     <input type="hidden" id="is_renew_promotion"  name="is_renew_promotion" value="1"/>
    {/if}
		<div class="biz_box" style="padding:5px;padding-bottom:5px;">
<fieldset style="border: 1px solid #ccc;margin:5px;padding:5px;">
    <legend><label> Basic Details</label></legend>
        <table class="job_detail_panal_table" >
        
        <tr >
            <td class="detail_right_td">{$_lang.lbl_coupons} Type</td>
			<td class="detail_left_td">

                {if ($promotion.id && $is_renew_promotion neq 1) OR ($smarty.request.is_exclusive eq 1)}
                    {if $promotion.cupon_type eq 'all_site'}
                        Listed
                    {elseif $promotion.cupon_type eq 'survey'}
                        Survey
                    {elseif $promotion.cupon_type eq 'reward'}
                        Rewards
                    {elseif $promotion.cupon_type eq 'invitation'}
                        Invite only
                    {elseif $promotion.cupon_type eq 'exclusive' OR $smarty.request.is_exclusive eq 1}
                        Exclusive
                    {/if}
                    <input type='hidden' name="cupon_type" id="cupon_type" value="{if $smarty.request.is_exclusive eq 1}exclusive{else}{$promotion.cupon_type}{/if}">
                {else}
                    <select name="cupon_type" id="cupon_type" onchange="toggle_allow_multi_redeem(this.value);">
                        <!--<option value="none" {if $coupon_type eq 'none'}selected{/if}>Regular promotions</option>-->
                        <option value="all_site" {if $promotion.cupon_type eq 'all_site'}selected{else}{if $coupon_type eq "all_site"}selected{else}{/if}{/if}>Listed</option>
                       <!--
                       <option value="recommendation" {if $promotion.cupon_type eq 'recommendation'}selected{else}{if $coupon_type eq "recommendation"}selected{else}{/if}{/if}>{$_lang.lbl_coupon} on recommendation</option>
                       <option value="survey" {if $promotion.cupon_type eq 'survey'}selected{else} {if $coupon_type eq "survey"}selected{else}{/if}{/if}>Survey</option>
                       -->
                       <option value="reward" {if $promotion.cupon_type eq 'reward'}selected{else} {if $coupon_type eq "reward"}selected{else}{/if}{/if}>Rewards</option>
                       <option value="invitation" {if $promotion.cupon_type eq 'invitation'}selected{else} {if $coupon_type eq "Invitation"}selected{else}{/if}{/if}>Invite only</option>
                    </select>
                {/if}
                <!--
                &nbsp;<a href="#" title="what is this?" style="background:url('{$elgg_main_url}images/_graphics/icon_bookmarkthis.gif') 0px 0px no-repeat;  padding-left:20px;font-size:12px !important;font-weight:bold;color:#6a18b6;font-family:  Verdana, Arial, Helvetica, sans-serif; height:55px !important;" onclick="return overlib('<table  class=\'inside_popup\' style=\'font-family:  Verdana, Arial, Helvetica, sans-serif;width:290px;font-size:10px !important;\'><tr><td colspan=\'2\' class=\'top_line\'><span style=\'width:290px;text-align:left;padding-left:15px;line-height:20px;font-size:12px;font-weight:bold;color:Gray;\'>Coupons</span><br><b>1. Regular promotions </b>- These could be your regular lunch specials or dinner special or happy hours or inventory clearance deals or occasional specials.<br><b>2. One time redeem coupon -</b> This is a onetime redeem only coupon. The customer can redeem this coupon only one time and this can be used for marketing or advertising a new business or menu.<br><b>3 - Rewards program -</b> This is a program for your regular customers. You can customize your own rewards program. Also you can take help of our team to create a effective rewards program.<br><b>4. This coupon is a Thank you coupon </b>given to a customer who has recommended your business. This would appreciate and encourage customers promote your business<br>o	Regular promotion<br>o	One time redeem coupon<br>o	Rewards program<br>o	Coupon on Recommendation<a href=\'#\' style=\'float:right;\' onclick=\'return cClick();\'>close</a></td></tr><tr><td colspan=\'2\' style=\'text-transform: lowercase !important;\'>{$varPromPath}</td></tr><tr><td colspan=\'2\' class=\'bottom_line\'></td></tr></table>',STICKY);" >what is this?</a>
                -->
            </td>
        </tr>
        
        <tr id="row_prm_allow_multi_redeem">
            <td class="detail_right_td"></td>
			<td class="detail_left_td">
                   <label for="prm_allow_multi_redeem"><input type="checkbox" value="1" id="prm_allow_multi_redeem" name="prm_allow_multi_redeem" {if $promotion.prm_allow_multi_redeem eq 1}checked='checked'{/if} />Use one time only?</label>
			</td>
        </tr>

        <tr>
            <td class="detail_right_td">Title <font color="red">*</font></td>
			<td class="detail_left_td">
			     <input type="text" name="title" id="title" {$req_cls}  value="{$promotion.title}">
            </td>
         </tr>
         <tr><td colspan="2"><span class="error" id="title_error"></span></td></tr>

         <tr>
            <td class="detail_right_td">Start Date <font color="red">*</font></td>
			<td class="detail_left_td">
            {* if $promotion.id && $is_renew_promotion neq 1 }
                   {if $promotion.start_date}{$promotion.start_date|date_format:'%m/%d/%Y %I:%M %p'}{/if}
			{else}
                <input class="startdate" type="text" name="start_date" id="start_date" size="10" value="{if $promotion.start_date}{$promotion.start_date|date_format:'%m/%d/%Y'}{else}{$smarty.post.start_date|date_format:'%m/%d/%Y'}{/if}" />
            {/if *}

            <input class="startdate" type="text" name="start_date" id="start_date" size="10" value="{if $promotion.start_date}{$promotion.start_date|date_format:'%m/%d/%Y'}{else}{$smarty.post.start_date|date_format:'%m/%d/%Y'}{/if}"  {if $promotion.id && $promotion._prom_type neq 'forthcoming'} readOnly="readOnly" {/if} />
            
			</td>
         </tr>
         <tr><td colspan="2"><span class="error"  id="start_date_error"></span></td></tr>
         <tr>
             <td class="detail_right_td">Expires On <font color="red">*</font></td>
			<td class="detail_left_td">
            {*if $promotion.id && $is_renew_promotion neq 1}
            	{if $promotion.end_date}{$promotion.end_date|date_format:'%m/%d/%Y %I:%M %p'}{/if}
            {else}
			   <input class="enddate" type="text" id="end_date" name="end_date" size="10" value="{if $promotion.end_date}{$promotion.end_date|date_format:'%m/%d/%Y'}{else}{$smarty.post.end_date|date_format:'%m/%d/%Y'}{/if}" />
            {/if *}
                <input class="enddate" type="text" id="end_date" name="end_date" size="10" value="{if $promotion.end_date}{$promotion.end_date|date_format:'%m/%d/%Y'}{else}{$smarty.post.end_date|date_format:'%m/%d/%Y'}{/if}" />
			</td>
         </tr>
         <tr><td colspan="2"><span class="error"  id="end_date_error"></span></td>
         </tr>
         
        <tr>
			<td class="detail_right_td">Details <font color="red">*</font></td>
			<td class="detail_left_td">
                <textarea id="comments" name="comments" rows="5" {$req_cls}>{$promotion.comments}</textarea>
			</td>
         </tr>
		 <tr>
            <td colspan="2"><span class="error" id="comments_error"></span></td>
        </tr>

        <tr>
            <td class="detail_right_td">Image</td>
			<td class="detail_left_td">
                  <input style="display: none;" type="checkbox" name="use_list_img" value="1" id="use_list_img" onclick="change_image_file();" onchange="change_image_file();"/>
                  <label style="display: none;" for="use_list_img">Use Listing logo</label>
            {if  $promotion.img_ext  || $promotion.img_ext neq '0'}
                    <a target="_blank" href="promotion_images/{$promotion.id}.{$promotion.img_ext}">{$promotion.title}</a><br>
            {/if}
				<input type="file" size="15" name="promo_img" ACCEPT="text/html, image/jpeg" id="promo_img">&nbsp;&nbsp;
			</td>
         </tr>
         <tr><td colspan="2"><span class="error"  id="promo_img_error"></span></td>
         </tr>
         
         <tr class="biz_hidden">
            <td class="detail_right_td">Select Template</td>
            <td class="detail_left_td">
                <select name="template_id" id="template_id">
                 {if $templates_info}
             		{section name=itm loop=$templates_info}
                            <option value="{$templates_info[itm].id}"  {if $templates_info[itm].id == $promotion.prom_template_id || $templates_info[itm].id == $smarty.post.template_id }selected="selected"{/if}>{$templates_info[itm].title}</option>
                    {/section}
                {/if}
                </select>
                <a href="#" data-role="button" onclick="call_preview({if $promotion.id && $is_renew_promotion neq 1}{$promotion.id}{else}0{/if}, $('#template_id').val());" name="preview">Preview</a>
                <br>
		   </td>
        </tr>

         <tr>
            <td class="detail_right_td">
				Promotion&nbsp;<small>(pdf)</small>
			</td>
			<td class="detail_left_td">
            	{if $promotion.id && $is_renew_promotion neq 1}
    		 	    <a href="pdf/{$promotion.pdf}" target="_blank">{$promotion.title}</a><br>
                {/if}
                <input type="checkbox" value="1" id="new_pdf" name="new_pdf" onchange="change_for_new_pdf();" onclick="change_for_new_pdf();"/>
                <label for="new_pdf">Add New pdf</label>
				 
             <input type="file" size="15" id="pdf" name="pdf" {if $promotion.id}{else}disabled="disabled"{/if}/> &nbsp;&nbsp;
			</td>
         </tr>
          <tr><td colspan="2"><span class="error"  id="pdf_error"></span></td></tr>

         <tr id="prom_code_row">
             <td class="detail_right_td">Code</td>
			<td class="detail_left_td">
                   <input type="text" name="prom_code" id="prom_code" {if $promotion.prom_code neq ''} value="{$promotion.prom_code}"{else} value='' {/if}/>
			</td>
         </tr>
       <tr><td colspan="2"><span class="error"  id="prom_code_error"></span></td></tr>
        <tr id="row_is_event">
             <td class="detail_right_td"></td>
			<td class="detail_left_td">
                   <label for="is_event"><input type="checkbox" value="1" id="is_event" name="is_event" {if $promotion.is_event eq 1}checked='checked'{/if} />Is this an Event?</label>
			</td>
        </tr>
        
        <tr><td colspan="2"><span class="error" id="is_event_error"></span></td>
		</tr>
        
        {*if $is_edit_promotion eq false*}
        {if 0}
            <tr>
                <td  colspan="2" class="detail_right_td">Email Content</td>
    		</tr>
            <tr>
    			<td class="detail_left_td" colspan="2">
                    <textarea id="email_content" name="email_content" rows="5"></textarea>
    			</td>
            </tr>
        {/if}
        <tr>
            <td colspan="2">
                  <a href="#" id="lnk_terms" onclick="$('#terms_section').show();$('#lnk_terms').hide();">Terms and conditions</a>
            </td>
		 </tr>
          
       </table>
 </fieldset>
 
 <fieldset style="border: 1px solid #ccc;margin:5px;padding:5px;">
    <legend><label> Discount Details</label></legend>
       <table class="job_detail_panal_table">
         
        <tr style="display:none;">
            <td class="detail_right_td">
                State <font color="red">*</font>
   			</td>
			<td class="detail_left_td">
				<input type="hidden" name="states" id="states" value="3"/>
            </td>
         </tr>
         <tr style="display:none;"><td colspan="2"><span class="error"  id="states_error"></span></td></tr>
         <tr id="show_sub_categories" style="display:none;">
         	<td class="detail_right_td">
                Metro Area <font color="red">*</font>
         </td>
         <td class="detail_left_td" id="metro_area_box">
			 	<input type="hidden" name="metro_area" id="metro_area" value="259"/>
	             </td>
         </tr>
         <tr style="display:none;"><td colspan="2"><span class="error"  id="metro_area_error"></span></td>
         </tr>

         


       
		<!-- <tr id="allowed_cupons_row" {if $promotion.cupon_type eq 'none' || $coupon_type eq 'none'}style="display:none"{/if}>-->
		 <tr id="allowed_cupons_row">
             <td class="detail_right_td">Allowed {$_lang.lbl_coupons}</td>
			<td class="detail_left_td">
                   <input type="text" name="allowed_cupons" id="allowed_cupons" {if $promotion.cupon_type neq "" && $promotion.cupon_type neq "none" && $promotion.allowed_cupons gt 0} value="{$promotion.allowed_cupons}"{else} value="1000" {/if}/>
			</td>
         </tr>		 
         <tr><td colspan="2"><span class="error"  id="promo_allowed_cupons_error"></span></td></tr>

		 
		<tr id="is_exclusive_row">
             <td class="detail_right_td">Exclusive<font color="red">*</font></td>
			<td class="detail_left_td">
                   <input type="checkbox" value="1" id="is_exclusive" name="is_exclusive" {if $promotion.is_exclusive eq 1}checked='checked'{/if} />
                   <label for="is_exclusive">Is Exclusive</label> 
			</td>
        </tr>
        <tr><td colspan="2"><span class="error" id="is_exclusive_error"></span></td>		 	
		</tr>	
		
		<tr id="priority_row">
            <td class="detail_right_td">Priority<font color="red">*</font></td>
			<td class="detail_left_td">
				<select name="priority" id="priority">
					{for $foo=1 to 10}
					    <option value="{$foo}" {if $promotion.priority eq $foo}selected='selected'{/if}>{$foo}</option>
					{/for}
				</select>                  
			</td>
        </tr>
        <tr><td colspan="2"><span class="error" id="priority_error"></span></td>		 	
		</tr>		 
		 
		<tr id="disc_aply_type_row">
            <td class="detail_right_td">Apply Type<font color="red">*</font></td>
			<td class="detail_left_td">
				<select name="disc_aply_type" id="disc_aply_type" onchange="toggle_btn_discount(this.value,{if $promotion.id}{$promotion.id}{else}0{/if});">
					<option value="ORDER" {if $promotion.disc_aply_type eq 'ORDER'}selected='selected'{/if}>Complete Bill</option>
					<option value="ITEM" {if $promotion.disc_aply_type eq 'ITEM'}selected='selected'{/if}>Individual Item</option>
					<option value="FIXED" {if $promotion.disc_aply_type eq 'FIXED'}selected='selected'{/if}>Fixed Price</option>
					<option value="COND_DISC" {if $promotion.disc_aply_type eq 'COND_DISC'}selected='selected'{/if}>Condition Discount</option>
				</select>
               <!-- &nbsp;<a href="#" title="what is this?" style="background:url('{$elgg_main_url}images/_graphics/icon_bookmarkthis.gif') 0px 0px no-repeat;  padding-left:20px;font-size:12px !important;font-weight:bold;color:#6a18b6;font-family:  Verdana, Arial, Helvetica, sans-serif; height:55px !important;" onclick="return overlib('<table  class=\'inside_popup\' style=\'font-family:  Verdana, Arial, Helvetica, sans-serif;width:290px;font-size:10px !important;\'><tr><td colspan=\'2\' class=\'top_line\'><span style=\'width:290px;text-align:left;padding-left:15px;line-height:20px;font-size:12px;font-weight:bold;color:Gray;\'>Apply Type</span><br><b>1. Complete bill </b> - Using this you can add discount on the total Bill (by providing only Discounted Amount)...<br><b>2. Individual Item </b> - Using this you add Buy one get one free/50% both the items from the same sub menu and from different sub menus (by providing only Purchase Required).Also you can able to add particular item disocunt (by providing only Discounted items)..<br><b>3. Fixed Price -</b> Using this you can buy 3 of the same sub menu for Rsx or you can buy 2-3 different sub menu items for Rsx amount - like a combo deal (by providing prurchse required and disocunt amount amount).<br><b>4 - Condition Discount -</b> Using this you can add discount like When you buy 2 you get off on the 2 items u buy and with sub menu and dish combinations (by providing prurchase required and discount amount)..<br><br><a href=\'#\' style=\'float:right;\' onclick=\'return cClick();\'>close</a></td></tr><tr><td colspan=\'2\' style=\'text-transform: lowercase !important;\'>{$varPromPath}</td></tr><tr><td colspan=\'2\' class=\'bottom_line\'></td></tr></table>',STICKY);" >what is this?</a>-->
				<a href="#" onclick="$('#popupBasic').popup('open');">what is this?</a>
				<div id="btn_discount" style="display: none;">
					<input data-role="button" data-icon="star" name="btn_discount" type="button" value="Discount" onclick="window.open('{$elgg_main_url}user/tbl_prom_discounts.php?prmdisc_promotion={$promotion.id}');"/>
				</div> 
				<div id="btn_conditions" style="display: none;">
                <input data-role="button" data-icon="addressbook" name="btn_conditions" type="button" value="Conditions" onclick="window.open('{$website}/user/tbl_prom_conditions.php?prmcon_promotion={$promotion.id}');"/>
				</div>             
			</td>
         </tr>		  
         <tr><td colspan="2"><span class="error" id="disc_aply_type_error"></span></td></tr>

		 <tr id="disc_amt_row" {if $promotion.disc_aply_type neq 'ITEM'}{else}style='display:none;'{/if}>
            <td class="detail_right_td">Discount Amount (Rs)<font color="red">*</font></td>
			<td class="detail_left_td">
			
   <table>
			<tr>
					<td class="biz_top_align bigListItem">
                    <input name="disc_amt" id="disc_amt" value="{if $promotion.disc_amt neq ''}{$promotion.disc_amt}{else}0.00{/if}" ></input>
					</td>
					<td class="biz_top_align">&nbsp;&nbsp;in&nbsp;&nbsp;</td>
					<td class="biz_top_align" id="td_disc_amt_type" >
    					<select name="disc_amt_type" id="disc_amt_type" >
                            <option value="VALUE" {if $promotion.disc_amt_type eq 'VALUE'}selected='selected'{/if}>Rs.</option>
        					<option value="PERCENT" {if $promotion.disc_amt_type eq 'PERCENT'}selected='selected'{/if}>%</option>
    				    </select>
					</td>
			</tr>
		    </table>
								
			</td>
         </tr>
         <tr><td colspan="2"><span class="error" id="disc_amt_error"></span> &nbsp;<span class="error"  id="disc_amt_type_error"></span></td>		 	
		 </tr>
		 
       <tr>
       <td colspan="2">
<fieldset  style="border: 1px solid #ccc;margin:5px;padding:5px;">

    <legend><label><input type="checkbox" id='chk_cond_wkdy' name="chk_cond_sel_opt[]" value="WKDAY"{if $pds_list_prom_condinfo.wkday} checked="checked"{/if}/> {$_lang.tbl_shift_weekdays.listing_title}</label></legend>
		{html_input type="hidden" name="prom_cnd_wkday_id" value=$pds_list_prom_condinfo.wkday.prom_cnd_id}
		{assign var=wkday  value=$pds_list_prom_condinfo.wkday}
	<div class="field-row">
        <fieldset data-role="controlgroup" data-type="horizontal" data-mini="true">

        <label><input type="checkbox" name="prom_cnd_wkdy_avail[sun]" value="Y" {if $wkday.prom_cnd_wkdy_sunday eq 'Y'} checked="checked"{/if}/> Sun</label>
        <label><input type="checkbox" name="prom_cnd_wkdy_avail[mon]" value="Y" {if $wkday.prom_cnd_wkdy_monday eq 'Y'} checked="checked"{/if}/> Mon</label>
        <label><input type="checkbox" name="prom_cnd_wkdy_avail[tue]" value="Y" {if $wkday.prom_cnd_wkdy_tuesday eq 'Y'} checked="checked"{/if}/> Tue</label>
        <label><input type="checkbox" name="prom_cnd_wkdy_avail[wed]" value="Y" {if $wkday.prom_cnd_wkdy_wednesday eq 'Y'} checked="checked"{/if}/> Wed</label>
        <label><input type="checkbox" name="prom_cnd_wkdy_avail[thu]" value="Y" {if $wkday.prom_cnd_wkdy_thursday eq 'Y'} checked="checked"{/if}/> Thu</label>
        <label><input type="checkbox" name="prom_cnd_wkdy_avail[fri]" value="Y" {if $wkday.prom_cnd_wkdy_friday eq 'Y'} checked="checked"{/if}/> Fri</label>
        <label><input type="checkbox" name="prom_cnd_wkdy_avail[sat]" value="Y" {if $wkday.prom_cnd_wkdy_saturday eq 'Y'} checked="checked"{/if}/> Sat</label>
		</fieldset>
		<input type="hidden" name="prom_cnd_wkdy_id" value="{$wkday.prom_cnd_id}"/>
		<div class="error" id="prom_cnd_wkdy_avail_err"></div>
	</div>
</fieldset>

  <fieldset style="border: 1px solid #ccc;margin:5px;padding:5px;">
    <legend><label><input type="checkbox" id='chk_cond_daytime' name="chk_cond_sel_opt[]" value="DAYTIME"{if $pds_list_prom_condinfo.daytime} checked="checked"{/if}/> Day time range</label></legend>
			<input type="hidden" name="prom_cnd_daytime_id" value="{$pds_list_prom_condinfo.daytime.prom_cnd_id}"/>
	<table style="width:100%">
		<tr>
			<td style="width:49%;"><label for="prom_cnd_daytime_from">{$_lang.tbl_prom_cond_details.label.prcndtl_daytime_from}</label></td>
			<td style="width:2%;">&nbsp;</td>
			<td style="width:49%;"><label for="prom_cnd_daytime_to">{$_lang.tbl_prom_cond_details.label.prcndtl_daytime_to}</label></td>
		</tr>
		<tr>
			<td style="width:49%;"><input type="text" readonly="readonly" name="prom_cnd_daytime_from" id="prom_cnd_daytime_from" value="{$pds_list_prom_condinfo.daytime.prom_cnd_daytime_from}"/></td>
			<td style="width:2%;">&nbsp;</td>
			<td style="width:49%;"><input type="text" readonly="readonly" name="prom_cnd_daytime_to" id="prom_cnd_daytime_to" value="{$pds_list_prom_condinfo.daytime.prom_cnd_daytime_to}"/></td>
		</tr>
		<tr>
			<td style="width:49%;"><div class="error" id="prom_cnd_daytime_from_err"></div></td>
			<td style="width:2%;">&nbsp;</td>
			<td style="width:49%;"><div class="error" id="prom_cnd_daytime_to_err"></div></td>
		</tr>
	</table>
</fieldset>

      </td>
	</tr>

    <tr>
            <td colspan="2">
                  <a href="#" id="lnk_terms" onclick="$('#terms_section').show();$('#lnk_terms').hide();">Terms and conditions</a>
            </td>
		 </tr>
		 


</table>
		</div>
		<br/>
		<div class="biz_box white_border" style="padding:5px;margin:1%;display: none;" id="terms_section">
		<table class="job_detail_panal_table">
				<tr>
				 		<td colspan="2" class="detail_right_td">{$_lang.lbl_prom_terms}</td>
				</tr>
				<tr>
						<td colspan="2" class="detail_left_td">
							 <textarea id="terms_desc" name="terms_desc" rows="5" >{$promotion.terms_desc}</textarea>
								<a href="#" onclick="$('#lnk_terms').show();$('#terms_section').hide();">Hide terms and conditions</a>
						</td>
				 </tr>
   </table>
</fieldset>
		</div> 
<div data-role="popup" id="popupBasic" style="width:270px;" data-theme="a" data-overlay-theme="g" data-dismissible="false">
 <div data-role="header">
  <h1>Apply Type </h1> 
 </div>
 <div data-role="content" style="padding:5px;font-family:Arial !important;font-size:12px !important;"><b>1. Complete bill </b> - Using this you can add discount on the total Bill (by providing only Discounted Amount)...<br><b>2. Individual Item </b> - Using this you add Buy one get one free/50% both the items from the same sub menu and from different sub menus (by providing only Purchase Required).Also you can able to add particular item disocunt (by providing only Discounted items)..<br><b>3. Fixed Price -</b> Using this you can buy 3 of the same sub menu for Rsx or you can buy 2-3 different sub menu items for Rsx amount - like a combo deal (by providing prurchse required and disocunt amount amount).<br><b>4 - Condition Discount -</b> Using this you can add discount like When you buy 2 you get off on the 2 items u buy and with sub menu and dish combinations (by providing prurchase required and discount amount)..</div> 
 <div class="biz_center">{jqmbutton value="{$_lang.close_lbl}" onclick="$('#popupBasic').popup('close');" icon="delete" style="float:right"}</div> 
</div>		
		
		  {literal}
        <script type="text/javascript">
	
    function validate_promotion_form(){

      validform = true;

//..For firm
 	 //var var_title  = document.forms.promotion_form.title.value;
 	 
      var var_title  = $("#promotion_form #title").val();
 	 
     $("#title_error").html('');

     
	 if (!IsNonEmpty(var_title)){
            $("#title_error").html('Please Enter Title.');
            validform = false;
	 }
	 
	//var var_pdf = document.forms.promotion_form.pdf.value;
	
	var var_pdf  = $("#promotion_form #pdf").val();
	
	$("#pdf_error").html('');
 
    var chk = $("#new_pdf:checked").length;

	if(IsNonEmpty(var_pdf)){


        if(!IsFileType(var_pdf, 'pdf')){
            $("#pdf_error").html('Please Select pdf Document.');
            validform = false;
 		}
 	}else {
         if(chk){
            $("#pdf_error").html('Please Add pdf Document.');
            validform = false;
           }else{

          }
    }

   //.. for   description
   // var var_comments  = document.forms.promotion_form.comments.value;
    var var_comments  = $("#promotion_form #comments").val();

     $("#comments_error").html('');
	 if (!IsNonEmpty(var_comments)){
            $("#comments_error").html('Please Enter Details.');
            validform = false;
	 }
    {/literal}
    

    {literal}
      //.. for   startdate
    // var var_start_date  = document.forms.promotion_form.start_date.value;
     var var_start_date  = $("#promotion_form #start_date").val();
     var var_end_date = $("#promotion_form #end_date").val();
     
     $("#start_date_error").html('');
     $("#end_date_error").html('');
     var d= new Date();
 	 var todayvalue = new Date(d.getFullYear(), d.getMonth(), d.getDate());
     
	 if (!IsNonEmpty(var_start_date)){
            $("#start_date_error").html('Please Enter Start Date.');
            validform = false;
	 }else  {
      if(!checkdate(var_start_date)){
             $("#start_date_error").html('Please Enter Proper Date.Format Must Be like mm/dd/yyyy.');
            validform = false;
  		}else{
            {/literal}

            {* if $promotion.id && $is_renew_promotion neq 1 *}
            {if $promotion.id && $promotion._prom_type neq 'forthcoming'}
                   {** DO NOTHING **}
            {else}
            {literal}
            if(((Date.parse(todayvalue) == Date.parse(var_start_date)) || ( Date.parse(todayvalue) < Date.parse(var_start_date)))==false){
               $("#start_date_error").html('Start Date Should be greater than todays date');
			   validform = false;
			}
			 {/literal}
			{/if}
			{literal}
		}
     }
     //var var_end_date = 	document.forms.promotion_form.end_date.value;
     //var var_end_date = $("#promotion_form #end_date").val();

	 if (!IsNonEmpty(var_end_date)){
            $("#end_date_error").html('Please Enter End Date.');
            validform = false;
	 }else{
		if(!checkdate(var_end_date)){
             $("#end_date_error").html('Please Enter Proper Date.Format Must Be like mm/dd/yyyy.');
            validform = false;
  		}else{
        /*
        var nextmontvalue = new Date(var_start_date);
		  nextmontvalue.setDate(nextmontvalue.getDate()+ 30);
		  if(( Date.parse(var_end_date)  < Date.parse(nextmontvalue))==false){
             $("#end_date_error").html("End date should be within 30 days from Start  date.");
             validform = false;
		  }
        */
		  if(( Date.parse(var_end_date)  > Date.parse(var_start_date))==false){
            $("#end_date_error").html("End date should be greater than Start date.");
             validform = false;
		  }
		  if(((Date.parse(todayvalue) == Date.parse(var_end_date)) || ( Date.parse(todayvalue) < Date.parse(var_end_date)))==false){
               $("#end_date_error").html('End Date Should be greater than todays date');
			   validform = false;
		  }
		  
		}
  	}
  
	// var var_states  = document.forms.promotion_form.states.value;
	  var var_states = $("#promotion_form #states").val();

     $("#states_error{/literal}{literal}").html('');
	 if (!IsNonEmpty(var_states)){
            $("#states_error").html('Please Select State.');
            validform = false;
	 }

	// var var_metro_area  = document.forms.promotion_form.metro_area.value;
	 var var_metro_area = $("#promotion_form #metro_area").val();
	 
     $("#metro_area_error").html('');
	 if (!IsNonEmpty(var_metro_area)){
            $("#metro_area_error").html('Please Select Metro Area.');
            validform = false;
	 }

	//var var_promo_img = document.forms.promotion_form.promo_img.value;
	
	var var_promo_img = $("#promotion_form #promo_img").val();
	
	$("#promo_img_error").html('');

	if(IsNonEmpty(var_promo_img)){
        if(((IsFileType(var_promo_img, 'jpg')) || (IsFileType(var_promo_img, 'png')))==false){
            $("#promo_img_error").html('Please Select JPG, PNG,  Document.');
            validform = false;
 		}
 	}
 	
 	var var_promo_allowed_cupons = $("#promotion_form #allowed_cupons").val();

	$("#promo_allowed_cupons_error").html('');
 	
    if(cupons_quanity_value() == 1){
      if(IsNonEmpty(var_promo_allowed_cupons)==false){
             $("#promo_allowed_cupons_error").html('Please Enter Quantity');
             validform = false;
      }else{
         if(isInt(var_promo_allowed_cupons)==false){
              $("#promo_allowed_cupons_error").html('Please Enter integer value.');
                validform = false;
         }else{
            if(is_gt_zero_num(var_promo_allowed_cupons)==false){
                $("#promo_allowed_cupons_error").html('Please Enter value greater than zero');
                validform = false;
            }
         }
      }
    }
 	
	//.. for prom_code
    var var_prom_code  = $("#promotion_form #prom_code").val();
    $("#prom_code_error").html('');
    /*
    if (!IsNonEmpty(var_prom_code)){
       $("#prom_code_error").html('Please Enter Promotion Code.');
       validform = false;
	}
	*/
	//.. for prom_code
	var var_disc_amt = $("#promotion_form #disc_amt").val();
	var var_disc_amt_type = $("#promotion_form #disc_amt_type").val();
	var var_disc_aply_type =$('#promotion_form #disc_aply_type').val();
	

	$("#disc_amt_error").html('');
    /*
	if(var_disc_aply_type!='ITEM'){
        if(IsNonEmpty(var_disc_amt)==false){
          $("#disc_amt_error").html('Please Enter Discount Amount');
              validform = false;
         }else{
    		 if(isFloat(var_disc_amt) ==false) {
                  $("#disc_amt_error").html('Please Enter valid Amount.');
                  validform = false;
             }else{
                if(var_disc_amt_type =='PERCENT'){
    				if(var_disc_amt>100){
    					$("#disc_amt_error").html('Discount must not exceed 100.00%');
                    	validform = false;
    				}
                }
             }
         }
    }
    */
    
	$("#prom_cnd_cond_type_err").html("");
	/*$("#prom_cnd_bogo_sbmnu_err").html("");
	$("#prom_cnd_bogo_sbmnu_dish_err").html("");*/
	$("#prom_cnd_wkdy_sunday_err").html("");
	$("#prom_cnd_wkdy_monday_err").html("");
	$("#prom_cnd_wkdy_tuesday_err").html("");
	$("#prom_cnd_wkdy_wednesday_err").html("");
	$("#prom_cnd_wkdy_thursday_err").html("");
	$("#prom_cnd_wkdy_friday_err").html("");
	$("#prom_cnd_wkdy_saturday_err").html("");
	$("#prom_cnd_daytime_from_err").html("");
	$("#prom_cnd_daytime_to_err").html("");
	$("#prom_cnd_start_date_err").html("");
	
	

if ($('#chk_cond_daytime').is(':checked')) {
		var compare_date = 0;
		if(IsNonEmpty(elemById("prom_cnd_daytime_from").value)==false){
			$("#prom_cnd_daytime_from_err").html("{/literal}{$_lang.tbl_prom_cond_details.not_empty_msg.prom_cnd_daytime_from}{literal}");
			validform = false;
			compare_date = 0;
		}

		if(IsNonEmpty(elemById("prom_cnd_daytime_to").value)==false){
			$("#prom_cnd_daytime_to_err").html("{/literal}{$_lang.tbl_prom_cond_details.not_empty_msg.prom_cnd_daytime_to}{literal}");
			validform = false;
			compare_date = 0;
		}else{
			if(elemById("prom_cnd_daytime_to").value  < elemById("prom_cnd_daytime_from").value){
				$("#prom_cnd_daytime_to_err").html("{/literal}{$_lang.messages.validation.gt_others_time|sprintf:$_lang.tbl_prom_cond_details.label.prom_cnd_daytime_from}{literal}");
				validform = false;
			}
		}
	}
	
	if(validform == false){
         alert('Please Revise the form');
  	}
	return validform;
 }    
	
    $(function(){
{/literal}
     {if (!$promotion.id) || ($promotion.id && $promotion._prom_type eq 'forthcoming')}
{literal}
        $("#start_date").scroller({ preset: 'date' ,endYear: ((new Date).getFullYear() + 40)});
{/literal}
     {/if}
{literal}
    		
	$("#end_date").scroller({ preset: 'date',endYear: ((new Date).getFullYear() + 40) });
	$("#prom_cnd_daytime_from").scroller({ preset: 'time', timeFormat: 'HH:ii:ss', timeWheels: 'HHii', animate: 'pop'});
	$("#prom_cnd_daytime_to").scroller({ preset: 'time', timeFormat: 'HH:ii:ss', timeWheels: 'HHii', animate: 'pop'});
	
	toggle_allow_multi_redeem("{/literal}{if $promotion.cupon_type}{$promotion.cupon_type}{else}all_site{/if}{literal}");
	
{/literal}
     {if $promotion.id >0 }
{literal}
        toggle_btn_discount("{/literal}{$promotion.disc_aply_type}{literal}",1); 
{/literal}
     {else}     	
{literal} 
		$('#tab_prchase_req').hide();
		$('#tab_discounted_itm').hide();
		toggle_btn_discount('ORDER',0);    
{/literal}
     {/if}
{literal}
	
    });
	
	function toggle_btn_discount(sel_val,prom_id){
	//alert('i am in now-'+sel_val+ ' SELECTED PROM '+ prom_id);
		
       $("#disc_amt_row").show();
        if(sel_val=='ORDER'){
           $("#btn_discount").hide();
           $("#btn_conditions").hide();
        }else if(sel_val=='ITEM'){ 
		   $("#disc_amt").val(0);
		   $("#disc_amt_row").hide();	   	   
        }else if(sel_val=='FIXED'){
           $("#btn_discount").hide();
           $("#disc_amt_row").hide();
        }else if(sel_val=='COND_DISC'){
           $("#btn_discount").hide();
           $("#disc_amt_row").hide();
        }
       
       //if(prom_id>0){
       	   $('#tab_basic_prom').show();
		   $('#tab_prchase_req').hide();
		   $('#tab_discounted_itm').hide();
		   //	alert('i am in now-'+sel_val);
	       if(sel_val=='ORDER'){
	           $('#tab_prchase_req').hide();
		   	   $('#tab_discounted_itm').hide();
	        }else if(sel_val=='ITEM'){ 
			   $('#tab_prchase_req').show();
		   	   $('#tab_discounted_itm').show();
	        }else if(sel_val=='FIXED'){
	           $('#tab_prchase_req').show();
	        }else if(sel_val=='COND_DISC'){
	           $('#tab_prchase_req').show();
	        }
      // }      
        
	 }
	 //.change_cupons
	 function toggle_allow_multi_redeem(sel_val){
        $("#row_prm_allow_multi_redeem").hide();
        //if((sel_val=='invitation') || (sel_val=='all_site')){
        if((sel_val=='invitation')){
           $("#row_prm_allow_multi_redeem").show();
        }
	 }
		 
    </script>
{/literal}
         
   <center>
    {if $promotion.id}
        <input type="hidden" id="listid" name="listid" value="{$promotion.list_id}"/>
    {else}
        <input type="hidden" id="listid" name="listid" value="{$listid}"/>
    {/if}
     <input type="hidden" id="promotion_id" name="promotion_id" value=""/>
     <input type="hidden" id="prm_restaurent" name="prm_restaurent" value="{$smarty.session[$smarty.const.SES_RESTAURANT]}"/>
     <!--<input type="submit" name="preview" value="Preview"/>-->
     <input name="save" type="hidden" value="1"/>
	 <input type="submit" data-icon="save" data-role="button" data-inline="true" value="{if $promotion.id && $is_renew_promotion neq 1}Update{else}Create{/if}"/>
     {if $promotion.id && $is_renew_promotion neq 1}
         <a href="#promotion_view" data-icon="delete" data-role="button" data-inline="true"  data-theme="a" > Cancel</a>
	 {else}
    <!--<input data-role="button" data-inline="true" type="button"  name="cancel_insert" onclick="document.location.href='edlist.php?lid={$listid}'"  data-theme="a" value="Profile"/>-->
   {/if}
   </center>
  </form>
  
 {/if}
