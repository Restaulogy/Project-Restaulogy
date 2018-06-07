<div id="div_remind_me" style="display:none;position:fixed;width:300px;z-index:100;top: 50%;left: 10%;margin-left:-30px;margin-top:-150px;border:1px solid #FF9600;" class='ui-body-a'>    <div data-role="header" data-theme="a" class="ui-corner-top">		<h1>{$_lang.tbl_prom_reminder.title}</h1>	</div><form name="frmupdatetbl_prom_reminder" id="frmupdatetbl_prom_reminder" onsubmit="return validatetbl_prom_reminder();" method="POST" action="{$elgg_main_url}modules/business_listing/show.php?show_type=PR&lid={$showing_promotion.list_id}&promoid={$promoid}" ><div data-role="content" style="padding:5px;">	<input type="hidden" name="prem_id" id="prem_id" value="{$tbl_prom_reminderinfo.prem_id}"/>		<div style="display:none;" class="error" id="prem_id_err"></div>	<div class="biz_hidden">		<label for="prem_promotion">{$_lang.tbl_prom_reminder.label.prem_promotion}</label>		<input type="text" name="prem_promotion" id="prem_promotion" value="{$promoid}"/>		<div class="error" id="prem_promotion_err"></div>	</div>	<div >		<label for="prem_user">{$_lang.tbl_prom_reminder.label.prem_user}</label>		<input type="text" name="prem_user" id="prem_user" value="{$prem_user}"/>		<div class="error" id="prem_user_err"></div>	</div>		<div class="biz_hidden">		<label for="prem_phone">{$_lang.tbl_prom_reminder.label.prem_phone}</label>		<input type="text" name="prem_phone" id="prem_phone" value="{$prem_phone}"/>		<div class="error" id="prem_phone_err"></div>	</div>    Remind Me	<div >        <!-- <label for="prem_before">{$_lang.tbl_prom_reminder.label.prem_before}</label> -->        <div style="float: left;">            <label><input data-mini="true" data-inline="true" type="radio" id='chk_prem_before' name="chk_remind[]" value="BEFORE" {if $tbl_prom_reminderinfo.prem_before gt 0} checked="checked"{/if}  /> &nbsp;{*$_lang.tbl_prom_reminder.label.prem_before*}</label>        </div>        <div style="float: left;">    		<select name="prem_before" id="prem_before" data-mini="true" data-inline="true">    		      {for $foo=0 to 20}    	                <option value="{$foo}" {if $tbl_prom_reminderinfo.prem_before eq $foo} selected="selected" {/if}> {$foo} </option>    	           {/for}            </select>        </div>        <div style="float: left;">Days before the promotion <br>expires</div>        		<div class="error" id="prem_before_err"></div>		<br><br>	</div>	<div class="field-row"><!--<label for="prem_after">{$_lang.tbl_prom_reminder.label.prem_after}</label>-->        <div style="float: left;"><label><input type="radio" data-mini="true" data-inline="true" id='chk_prem_after' name="chk_remind[]" value="AFTER" {if $tbl_prom_reminderinfo.prem_after gt 0} checked="checked"{/if} />&nbsp;{* $_lang.tbl_prom_reminder.label.prem_after *}</label></div>        <div style="float: left;">&nbsp;&nbsp;In </div>        <div style="float: left;">		<select name="prem_after" id="prem_after" data-mini="true" data-inline="true">		      {for $foo=0 to 20}	                <option value="{$foo}" {if $tbl_prom_reminderinfo.prem_after eq $foo} selected="selected" {/if}> {$foo} </option>	          {/for}        </select>        </div> <div style="float: left;">Days</div>		<div class="error" id="prem_after_err"></div>		<br><br>	</div>	<div class="field-row"><!-- <label for="prem_spc_date">{$_lang.tbl_prom_reminder.label.prem_spc_date}</label>-->    <div style="float: left;"><label><input type="radio" data-mini="true" data-inline="true" id='chk_prem_spc_date' name="chk_remind[]" value="ON_DATE" {if $tbl_prom_reminderinfo.prem_spc_date neq '' && $tbl_prom_reminderinfo.prem_spc_date neq $smarty.const.EMPTY_DATE_FORMAT} checked="checked"{/if}  />&nbsp;{*$_lang.tbl_prom_reminder.label.prem_spc_date*}</label> </div>            <div style="float: left;">&nbsp;&nbsp;On &nbsp;&nbsp; </div>        <div style="float: left;">&nbsp;		<input type="text" name="prem_spc_date" id="prem_spc_date" value="{if $tbl_prom_reminderinfo.prem_spc_date neq '' && $tbl_prom_reminderinfo.prem_spc_date neq $smarty.const.EMPTY_DATE_FORMAT} {$tbl_prom_reminderinfo.prem_spc_date} {/if}" data-inline="true" style="margin-top:-16px;"/>		</div>		<div class="error" id="prem_spc_date_err"></div>		<br><br>	</div><div class="error" id="choose_opt_err"></div>	<div class="biz_hidden">		<label for="prem_act_send_dt">{$_lang.tbl_prom_reminder.label.prem_act_send_dt}</label>		<input type="text" name="prem_act_send_dt" id="prem_act_send_dt" value="{$tbl_prom_reminderinfo.prem_act_send_dt}"/>		<div class="error" id="prem_act_send_dt_err"></div>	</div>	<div class="biz_hidden">		<label for="prem_is_send">{$_lang.tbl_prom_reminder.label.prem_is_send}</label>		<input type="text" name="prem_is_send" id="prem_is_send" value="{$tbl_prom_reminderinfo.prem_is_send}"/>		<div class="error" id="prem_is_send_err"></div>	</div>	<!--	<div class="biz_hidden">		<label for="prem_start_date">{$_lang.tbl_prom_reminder.label.prem_start_date}</label>		<input type="text" name="prem_start_date" id="prem_start_date" value="{$tbl_prom_reminderinfo.prem_start_date}"/>		<div class="error" id="prem_start_date_err"></div>	</div>	-->	<!--	<div class="biz_hidden">		<label for="prem_end_date">{$_lang.tbl_prom_reminder.label.prem_end_date}</label>		<input type="text" name="prem_end_date" id="prem_end_date" value="{$tbl_prom_reminderinfo.prem_end_date}"/>		<div class="error" id="prem_end_date_err"></div>	</div>	-->    <br>	<div class="biz_center">    <input type="hidden" id="save_remind" name="save_remind" value="1"/>    <input  data-inline="true" data-icon="save"  type="submit" value="{$_lang.save_lbl}"/>    <input type="button" data-icon="delete" data-inline="true" onclick="$('#div_remind_me').hide();" value="{$_lang.cancel_lbl}"/>    </div>        </div></form>{include file="$deftpl/tbl_prom_reminder/js.tpl"}{literal}    <script>        $(function(){        	$("#prem_spc_date").scroller({ preset: 'date'});{/literal}    {if $smarty.request.auto_load_remind eq 1}{literal}            $('#div_remind_me').show();{/literal}    {/if}{literal}        })    </script>{/literal}</div>