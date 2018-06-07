{include file="header.tpl"}

<div class="wrapper">
<!--<h1>{$_lang.tbl_prom_cond_details.edit_title}</h1>-->

{if $error_msg}
	<div class="biz_center">{$error_msg}</div><!--/center-->
{/if} 

{**include file="tbl_prom_conditions/tabs.tpl"**}

{include file="tbl_prom_cond_details/main_promions_tab.tpl"}

{include file="tbl_prom_cond_details/prom_cond_disc_tab.tpl"}
<br/>
{include file="tbl_prom_cond_details/bogo_item.tpl"}
<br/>
<form name="frmcreatetbl_prom_cond_details" id="frmcreatetbl_prom_cond_details" onsubmit="return validatetbl_prom_cond_details();" method="POST" action="{$website}/user/tbl_prom_cond_details.php?prcndtl_condition={$tbl_prom_cond_detailsinfo.info.prmcon_id}&mode=UPDATE">
	<!-- <input type="hidden" name="prcndtl_id" id="prcndtl_id" value="0"/> 
	<div style="display:none;" class="error" id="prcndtl_id_err"></div>-->

	<div class="biz_hidden">
		<label for="prcndtl_condition">{$_lang.tbl_prom_cond_details.label.prcndtl_condition}</label>
		<input maxlength="11" id="prcndtl_condition" type="text" value="{$tbl_prom_cond_detailsinfo.info.prmcon_id}" name="prcndtl_condition"/> 
		<div class="error" id="prcndtl_condition_err"></div>
	</div>

	<div class="biz_hidden">
		<label for="prcndtl_cond_type">{$_lang.tbl_prom_cond_details.label.prcndtl_cond_type}</label>		 
		<input name="prcndtl_cond_type" id="prcndtl_cond_type"/>
		<div class="error" id="prcndtl_cond_type_err"></div>
	</div>	
	
 
<fieldset style="border: 1px solid #ccc;margin:5px;padding:5px;">

    <legend>
	    <label class='biz_hidden'>
	    	<input class='biz_hidden' type="checkbox" id='chk_cond_pogo' name="chk_cond_sel_opt[]" value="BOGO" {if $smarty.session[$smarty.const.SES_CONDITIONS].bogo}{/if} checked="checked" /> BOGO
	    </label>
    </legend>
		{assign var=bogo_count value=0} 
		{if $smarty.session[$smarty.const.SES_CONDITIONS].bogo} 	
 
<div id="item">
			<table class="biz_data_grid">
			<thead>
				<tr>
					<th style="width:5%;">#</th>
					<th style="width:10%;">{$_lang.tbl_prom_cond_details.label.prcndtl_bogo_qty}</th>
					<th style="width:35%;">{$_lang.tbl_prom_cond_details.label.prcndtl_bogo_sbmnu}</th>
					<th style="width:35%;">{$_lang.tbl_prom_cond_details.label.prcndtl_bogo_sbmnu_dish}</th>
					<th style="width:10%;" colspan="2"></th>
				</tr>
			</thead>
			
			 <tbody>
			
			{foreach name=bogo_cart item=cond from=$smarty.session[$smarty.const.SES_CONDITIONS].bogo}
				 <tr class="{cycle values="odd,even"}">
						<td>({$smarty.foreach.bogo_cart.iteration})</td>
						<td>{$cond.qty}<input name="prcndtl_bogo_qty[{$cond@key}]" id="prcndtl_bogo_qty_{$cond@key}" type="hidden" value="{$cond.qty}"/></td>
						<td>{$cond.submenu_title}
							<input type="hidden" value="{$cond.submenu}" name="prcndtl_bogo_sbmnu[{$cond@key}]" id="prcndtl_bogo_sbmnu_{$cond@key}"/> 
						</td>
						<td>
							{$cond.dish_title}
							<input type="hidden" value="{$cond.dish}"  name="prcndtl_bogo_sbmnu_dish[{$cond@key}]" id="prcndtl_bogo_sbmnu_dish_{$cond@key}"/>   
							<input type="hidden" value="{$cond.id}"  name="prcndtl_bogo_id[{$cond@key}]" id="prcndtl_bogo_id_{$cond@key}"/> 
						</td>
						<td>
							{jqmbutton mini="true" icon="edit" iconpos="notext" onclick="updateBogoDetail({$cond@key});"}
            </td>
            <td>
                {jqmbutton mini="true" icon="delete" iconpos="notext" onclick="deleteBogoDetail({$cond@key},1,{$cond.id},{$prom_condition});"}
						</td>
					</tr>
					{math assign=bogo_count  equation="x+1" x=$bogo_count}  
{/foreach} 
				</tbody> 
			</table>
		
</div>	

{/if} 
	<input type="hidden" id="bogo_count" name="bogo_count" value="{$bogo_count}"/>
 <div class="error" id="bogo_count_err"></div>
<div class="biz_center"> 
	<input data-inline="true" data-icon="add-item"  type="button"  onclick="createBogoDetail();" value="Add Purchase Item"/>
</div> 
</fieldset>		
	
 <fieldset  style="display:none;border: 1px solid #ccc;margin:5px;padding:5px;">
 
    <legend><label><input type="checkbox" id='chk_cond_wkdy' name="chk_cond_sel_opt[]" value="WKDAY"{if $tbl_prom_cond_detailsinfo.wkday} checked="checked"{/if}/> {$_lang.tbl_shift_weekdays.listing_title}</label></legend>	
		{html_input type="hidden" name="prcndtl_wkday_id" value=$tbl_prom_cond_detailsinfo.wkday.prcndtl_id}
		{assign var=wkday  value=$tbl_prom_cond_detailsinfo.wkday}
	<div class="field-row">		
        <fieldset data-role="controlgroup" data-type="horizontal" data-mini="true">
				
        <label><input type="checkbox" name="prcndtl_wkdy_avail[sun]" value="Y" {if $wkday.prcndtl_wkdy_sunday eq 'Y'} checked="checked"{/if}/> Sun</label>
        <label><input type="checkbox" name="prcndtl_wkdy_avail[mon]" value="Y" {if $wkday.prcndtl_wkdy_monday eq 'Y'} checked="checked"{/if}/> Mon</label>
        <label><input type="checkbox" name="prcndtl_wkdy_avail[tue]" value="Y" {if $wkday.prcndtl_wkdy_tuesday eq 'Y'} checked="checked"{/if}/> Tue</label>
        <label><input type="checkbox" name="prcndtl_wkdy_avail[wed]" value="Y" {if $wkday.prcndtl_wkdy_wednesday eq 'Y'} checked="checked"{/if}/> Wed</label>
        <label><input type="checkbox" name="prcndtl_wkdy_avail[thu]" value="Y" {if $wkday.prcndtl_wkdy_thursday eq 'Y'} checked="checked"{/if}/> Thu</label>
        <label><input type="checkbox" name="prcndtl_wkdy_avail[fri]" value="Y" {if $wkday.prcndtl_wkdy_friday eq 'Y'} checked="checked"{/if}/> Fri</label>
        <label><input type="checkbox" name="prcndtl_wkdy_avail[sat]" value="Y" {if $wkday.prcndtl_wkdy_saturday eq 'Y'} checked="checked"{/if}/> Sat</label>
		</fieldset>
		<input type="hidden" name="prcndtl_wkdy_id" value="{$wkday.prcndtl_id}"/>
		<div class="error" id="prcndtl_wkdy_avail_err"></div>
	</div>
</fieldset>		

  <fieldset  style="display:none;border: 1px solid #ccc;margin:5px;padding:5px;">
    <legend><label><input type="checkbox" id='chk_cond_daytime' name="chk_cond_sel_opt[]" value="DAYTIME"{if $tbl_prom_cond_detailsinfo.daytime} checked="checked"{/if}/> Day time range</label></legend>
			<input type="hidden" name="prcndtl_daytime_id" value="{$tbl_prom_cond_detailsinfo.daytime.prcndtl_id}"/>
	<table style="width:100%">
		<tr>
			<td style="width:49%;"><label for="prcndtl_daytime_from">{$_lang.tbl_prom_cond_details.label.prcndtl_daytime_from}</label></td>
			<td style="width:2%;">&nbsp;</td>
			<td style="width:49%;"><label for="prcndtl_daytime_to">{$_lang.tbl_prom_cond_details.label.prcndtl_daytime_to}</label></td>
		</tr>
		<tr>
			<td style="width:49%;"><input type="text" readonly="readonly" name="prcndtl_daytime_from" id="prcndtl_daytime_from" value="{$tbl_prom_cond_detailsinfo.daytime.prcndtl_daytime_from}"/></td>
			<td style="width:2%;">&nbsp;</td>
			<td style="width:49%;"><input type="text" readonly="readonly" name="prcndtl_daytime_to" id="prcndtl_daytime_to" value="{$tbl_prom_cond_detailsinfo.daytime.prcndtl_daytime_to}"/></td>
		</tr>
		<tr>
			<td style="width:49%;"><div class="error" id="prcndtl_daytime_from_err"></div></td>
			<td style="width:2%;">&nbsp;</td>
			<td style="width:49%;"><div class="error" id="prcndtl_daytime_to_err"></div></td>
		</tr>	
	</table>
	
</fieldset>	

<fieldset style="border: 1px solid #ccc;margin:5px;padding:5px;">
	<div class="field-row"> 
		<label for="prmcon_title">{$_lang.tbl_prom_conditions.label.prmcon_title}</label>
		<input name="prmcon_title"  id="prmcon_title" value="{$tbl_prom_cond_detailsinfo.info.prmcon_title}"/>
		<div class="error" id="prmcon_title_err"></div>
	</div>
	<div class="{if $prom_detail.disc_aply_type neq 'ITEM'}field-row{else}biz_hidden{/if}"> 
		<label for="purchase_discount">{if $prom_detail.disc_aply_type eq 'FIXED'}Fixed Price{else}Discount{/if}</label>
		 <table>
			<tr>
				<td class="biz_top_align bigListItem">
                <input name="disc_amt" id="disc_amt" value="{if $prom_detail.disc_amt neq ''}{$prom_detail.disc_amt}{else}0.00{/if}" ></input>
				</td>
				<td class="biz_top_align">&nbsp;&nbsp;in&nbsp;&nbsp;</td>
				<td class="biz_top_align" id="td_disc_amt_type" >
				<select name="disc_amt_type" id="disc_amt_type" >
				 <option value="VALUE" {if $prom_detail.disc_amt_type eq 'VALUE'}selected='selected'{/if}>Rs.</option>
				{if $prom_detail.disc_aply_type neq 'FIXED'}					
					<option value="PERCENT" {if $prom_detail.disc_amt_type eq 'PERCENT'}selected='selected'{/if}>%</option>
			    
				{/if}
				</select>
				
				</td>
			</tr>
		  </table>
		<div class="error" id="disc_amt_err"></div>
	</div>

<!--<div class="field-row">
		<label for="prcndtl_wkdy_sunday">{$_lang.tbl_prom_cond_details.label.prcndtl_wkdy_sunday}</label>
		<input maxlength="1" id="prcndtl_wkdy_sunday" type="text" value="{$smarty.post.prcndtl_wkdy_sunday}" name="prcndtl_wkdy_sunday"/> 
		<div class="error" id="prcndtl_wkdy_sunday_err"></div>
	</div>

	<div class="field-row">
		<label for="prcndtl_wkdy_monday">{$_lang.tbl_prom_cond_details.label.prcndtl_wkdy_monday}</label>
		<input maxlength="1" id="prcndtl_wkdy_monday" type="text" value="{$smarty.post.prcndtl_wkdy_monday}" name="prcndtl_wkdy_monday"/> 
		<div class="error" id="prcndtl_wkdy_monday_err"></div>
	</div>

	<div class="field-row">
		<label for="prcndtl_wkdy_tuesday">{$_lang.tbl_prom_cond_details.label.prcndtl_wkdy_tuesday}</label>
		<input maxlength="1" id="prcndtl_wkdy_tuesday" type="text" value="{$smarty.post.prcndtl_wkdy_tuesday}" name="prcndtl_wkdy_tuesday"/> 
		<div class="error" id="prcndtl_wkdy_tuesday_err"></div>
	</div>

	<div class="field-row">
		<label for="prcndtl_wkdy_wednesday">{$_lang.tbl_prom_cond_details.label.prcndtl_wkdy_wednesday}</label>
		<input maxlength="1" id="prcndtl_wkdy_wednesday" type="text" value="{$smarty.post.prcndtl_wkdy_wednesday}" name="prcndtl_wkdy_wednesday"/> 
		<div class="error" id="prcndtl_wkdy_wednesday_err"></div>
	</div>

	<div class="field-row">
		<label for="prcndtl_wkdy_thursday">{$_lang.tbl_prom_cond_details.label.prcndtl_wkdy_thursday}</label>
		<input maxlength="1" id="prcndtl_wkdy_thursday" type="text" value="{$smarty.post.prcndtl_wkdy_thursday}" name="prcndtl_wkdy_thursday"/> 
		<div class="error" id="prcndtl_wkdy_thursday_err"></div>
	</div>

	<div class="field-row">
		<label for="prcndtl_wkdy_friday">{$_lang.tbl_prom_cond_details.label.prcndtl_wkdy_friday}</label>
		<input maxlength="1" id="prcndtl_wkdy_friday" type="text" value="{$smarty.post.prcndtl_wkdy_friday}" name="prcndtl_wkdy_friday"/> 
		<div class="error" id="prcndtl_wkdy_friday_err"></div>
	</div>

	<div class="field-row">
		<label for="prcndtl_wkdy_saturday">{$_lang.tbl_prom_cond_details.label.prcndtl_wkdy_saturday}</label>
		<input maxlength="1" id="prcndtl_wkdy_saturday" type="text" value="{$smarty.post.prcndtl_wkdy_saturday}" name="prcndtl_wkdy_saturday"/> 
		<div class="error" id="prcndtl_wkdy_saturday_err"></div>
	</div>-->
	<!--
	<div class="field-row">
		<label for="prcndtl_start_date">{$_lang.tbl_prom_cond_details.label.prcndtl_start_date}</label>
		<input  id="prcndtl_start_date" type="text" value="{$smarty.post.prcndtl_start_date}" name="prcndtl_start_date"/> 
		<div class="error" id="prcndtl_start_date_err"></div>
	</div>
	-->

	<!--
	<div class="field-row">
		<label for="prcndtl_end_date">{$_lang.tbl_prom_cond_details.label.prcndtl_end_date}</label>
		<input  id="prcndtl_end_date" type="text" value="{$smarty.post.prcndtl_end_date}" name="prcndtl_end_date"/> 
		<div class="error" id="prcndtl_end_date_err"></div>
	</div>
	-->
 </fieldset>
	<div class="biz_center">
  <input type="hidden" id="action" name="action" value=""/><input data-inline="true" data-icon="save" type="button" onclick="$('#action').val('{$smarty.const.ACTION_UPDATE}');$('#frmcreatetbl_prom_cond_details').submit();" value="Save Purchase Items To Promotion"/>
  <!--
  <input type="button" value="{$_lang.cancel_lbl}" data-inline="true" data-icon="delete" onclick="window.location.href='{$website}/user/tbl_prom_conditions.php?prmcon_promotion={$promotion}'"/>
  -->
  </div><!--/center-->
 
  
</form>

</div>

{include file="footercontent.tpl"}
{include file="tbl_prom_cond_details/js.tpl"}
{literal}
    <script>
        $(function(){
        	$("#prcndtl_daytime_from").scroller({ preset: 'time', timeFormat: 'HH:ii:ss', timeWheels: 'HHii', animate: 'pop'});
        	$("#prcndtl_daytime_to").scroller({ preset: 'time', timeFormat: 'HH:ii:ss', timeWheels: 'HHii', animate: 'pop'});
        })
    </script>
{/literal}
</body></html>
