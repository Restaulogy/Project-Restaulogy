{include file="header.tpl"}

<div class="wrapper">
<h1>{$_lang.biz_rewards.create_title}</h1>

{if $error_msg}
	<center>{$error_msg}</center>
{/if}

<form name="frmcreatebiz_rewards" id="frmcreatebiz_rewards" onsubmit="return validatebiz_rewards();" method="POST" action="{$page_url}">
	<input type="hidden" name="rwd_id" id="rwd_id" value="0"/>
	<div style="display:none;" class="error" id="rwd_id_err"></div>

	<div class="biz_hidden">
		<label for="rwd_buss_id">{$_lang.biz_rewards.label.rwd_buss_id}</label>
		<input id="rwd_buss_id" type="text" name="rwd_buss_id" value="{$smarty.session[$smarty.const.SES_RESTAURANT]}"/>
		<div class="error" id="rwd_buss_id_err"></div>
	</div>

	<div class="field-row">
		<label for="rwd_cup_id">{$_lang.biz_rewards.label.rwd_cup_id}</label>
		<input id="rwd_cup_id" type="text" value="{$smrty.post.rwd_cup_id}" name="rwd_cup_id"/>
		<div class="error" id="rwd_cup_id_err"></div>
	</div>
<!--
	<div class="field-row">
		<label for="rwd_type">{$_lang.biz_rewards.label.rwd_type}</label>
            <select name="rwd_type" id="rwd_type" onchange="toggleRewardType();" dir="ltl">
            	 <option value="visit_based" {if $smarty.post.rwd_type eq "visit_based"} selected='selected'{/if}>Visit Based</option> 
            	<option value="point_based" {if $smarty.post.rwd_type eq "point_based"} selected='selected'{/if}>Point Based</option>
            </select>
		<div class="error" id="rwd_type_err"></div>
	</div>
-->
    <div class="biz_hidden">
		<label for="rwd_type">{$_lang.biz_rewards.label.rwd_type}</label>
            <input name="rwd_type" id="rwd_type" value="point_based" />
		<div class="error" id="rwd_type_err"></div>
	</div>
	
	<div class="biz_hidden" id='row_rwd_one_point_val'>
		<label for="rwd_one_point_val">{$_lang.biz_rewards.label.rwd_one_point_val}</label>
		<input id="rwd_one_point_val" type="text" value="1" name="rwd_one_point_val"/>
		<div class="error" id="rwd_one_point_val_err"></div>
	</div>

	<div class="field-row" id='row_rwd_point_limit'>
		<label for="rwd_point_limit">{$_lang.biz_rewards.label.rwd_point_limit}</label>
		<input id="rwd_point_limit" type="text" value="{$smarty.post.rwd_point_limit}" name="rwd_point_limit"/>
		<div class="error" id="rwd_point_limit_err"></div>
	</div>
	
	<div class="field-row">
		<label for="rwd_basic">{$_lang.biz_rewards.label.rwd_basic}</label> <a href="#" onclick="$('#popup_rwd_basic').popup('open');">what is this?</a>
		<input  id="rwd_basic" type="text" value="{$smarty.post.rwd_basic}" name="rwd_basic"/>
		<div class="error" id="rwd_basic_err"></div>
	</div>

    <div class="field-row">
		<label for="rwd_total_balance">{$_lang.biz_rewards.label.rwd_total_balance}</label>
        <select name="rwd_total_balance" id="rwd_total_balance">
        <!-- <option value="" data-placeholder="true">Select Total/Balance </option> -->
    		 {foreach $lst_rwd_total_balance as $_rwd_total_balance}
    		 	<option value="{$_rwd_total_balance@key}" {if $smarty.post.rwd_total_balance && ($_rwd_total_balance@key eq $smarty.post.rwd_total_balance)} selected="selected" {/if}>{$_rwd_total_balance}</option>
    		 {/foreach}
        </select>
		<div class="error" id="rwd_total_balance_err"></div>
	</div>

    <div class="field-row">
		<label for="rwd_lr_type">{$_lang.biz_rewards.label.rwd_lr_type}</label>
        <select name="rwd_lr_type" id="rwd_lr_type" onchange="set_chk_bx(this.value);">
             <!--<option value="" data-placeholder="true">Select LR Type </option>-->
    		 {foreach $lst_rwd_lr_type as $_rwd_lr_type}
    		 	<option value="{$_rwd_lr_type@key}" {if $smarty.post.rwd_lr_type && ($_rwd_lr_type@key eq $smarty.post.rwd_lr_type)} selected="selected" {/if}>{$_rwd_lr_type}</option>
    		 {/foreach}
        </select>
		<div class="error" id="rwd_lr_type_err"></div>
	</div>

  <div id='div_rwd_is_reduction' class="field-row">
		<label for="rwd_is_reduction">{$_lang.biz_rewards.label.rwd_is_reduction}</label>
		<input id="rwd_is_reduction" type="checkbox" value="1" {if $smarty.post.rwd_is_reduction eq 1}checked="checked"{/if}  name="rwd_is_reduction"/>
		<div class="error" id="rwd_is_reduction_err"></div>
	</div>

	<div id='div_rwd_is_recurring' class="field-row">
		<label for="rwd_is_recurring">{$_lang.biz_rewards.label.rwd_is_recurring}</label>
		<input id="rwd_is_recurring" type="checkbox" value="1" {if $smarty.post.rwd_is_recurring eq 1}checked="checked"{/if} name="rwd_is_recurring"/>
		<div class="error" id="rwd_is_recurring_err"></div>
	</div>
	
	<div id='div_rwd_is_one_time' class="field-row">
		<label for="rwd_is_one_time">{$_lang.biz_rewards.label.rwd_is_one_time}</label>
		<input id="rwd_is_one_time" type="checkbox" value="1" {if $smarty.post.rwd_is_one_time eq 1}checked="checked"{/if}  name="rwd_is_one_time"/>
		<div class="error" id="rwd_is_one_time_err"></div>
	</div>

	<div class="field-row" id='row_rwd_check_in'>
		<label for="rwd_check_in">{$_lang.biz_rewards.label.rwd_check_in}</label>
		<input maxlength="4" id="rwd_check_in" type="text" value="0" name="rwd_check_in"/>
		<div class="error" id="rwd_check_in_err"></div>
	</div>

	<div class="biz_hidden">
		<label for="rwd_is_quest_asc">{$_lang.biz_rewards.label.rwd_is_quest_asc}</label>
		<input id="rwd_is_quest_asc" type="text" value="1" name="rwd_is_quest_asc"/>
		<div class="error" id="rwd_is_quest_asc_err"></div>
	</div>

	<div class="field-row">
		<label for="rwd_coupon_id">{$_lang.biz_rewards.label.rwd_coupon_id}</label>
		<select name="rwd_coupon_id" id="rwd_coupon_id" >
			{foreach $lst_rewards as $promotion}
				<option value="{$promotion@key}" {if $smarty.post.rwd_coupon_id eq $promotion@key} selected='selected'{/if}>{$promotion}</option>
			{/foreach}
		</select>
		
		<div class="error" id="rwd_coupon_id_err"></div>
	</div>

	<div class="field-row">
		<label for="rwd_start_dt">{$_lang.biz_rewards.label.rwd_start_dt}</label>
		<input type="text" id="rwd_start_dt" name="rwd_start_dt" value="{$smarty.post.rwd_start_dt|date_format:$smarty.const.HTML5_DAY_FORMAT}" placeholder="From" readonly="readonly">
		<div class="error" id="rwd_start_dt_err"></div>
	</div>

    <div class="field-row">
	       <label for="rwd_is_non_ending">
            <input type="checkbox" name="rwd_is_non_ending" id="rwd_is_non_ending" value="1" {if $biz_rewardsinfo.rwd_is_non_ending eq 1}checked="checked"{/if} onchange="toggle_isnonending();"/>
         	{$_lang.biz_rewards.label.rwd_is_non_ending}</label>
            <div class="error" id="rwd_is_non_ending_err"></div>
	</div>

	<div id='div_rwd_end_dt' class="field-row">
		<label for="rwd_end_dt">{$_lang.biz_rewards.label.rwd_end_dt}</label>
        <input type="text" id="rwd_end_dt" name="rwd_end_dt" value="{$smarty.post.rwd_end_dt|date_format:$smarty.const.HTML5_DAY_FORMAT}" placeholder="To" readonly="readonly">
		<div class="error" id="rwd_end_dt_err"></div>
	</div>
	
	<div class="field-row">
		<label for="rwd_loyalty_level">{$_lang.biz_rewards.label.rwd_loyalty_level}</label>
		<select id="rwd_loyalty_level" name="rwd_loyalty_level" >			
			{if $_lylty_levels_lst}
				<option value="0">Select Level</option>
				<option value="all"> All levels</option>
			{foreach $_lylty_levels_lst as $_level}
				<option value="{$_level@key}" >{$_level}</option>
			{/foreach}
			{/if}
		</select>
		<div class="error" id="rwd_loyalty_level_err"></div>
	</div>	

	<div class="biz_hidden">
		<label for="rwd_created_dt">{$_lang.biz_rewards.label.rwd_created_dt}</label>
		<input  id="rwd_created_dt" type="text" value="{$smarty.post.rwd_created_dt}" name="rwd_created_dt"/> 
		<div class="error" id="rwd_created_dt_err"></div>
	</div>

	<div class="biz_hidden">
		<label for="rwd_updated_dt">{$_lang.biz_rewards.label.rwd_updated_dt}</label>
		<input  id="rwd_updated_dt" type="text" value="{$smarty.post.rwd_updated_dt}" name="rwd_updated_dt"/> 
		<div class="error" id="rwd_updated_dt_err"></div>
	</div>

	<div class="biz_center">
    <input type="hidden" id="action" name="action" value="{$smarty.const.ACTION_CREATE}"/>
    <input data-inline="true" data-icon="save" type="submit" value="{$_lang.save_lbl}"/> <input data-inline="true" data-icon="delete" type="reset" value="{$_lang.cancel_lbl}" onclick="window.location.href='{$page_url}'"/>
    </div>
</form>
<div class="info">{$_lang.biz_rewards.info_msg.all_mandatory}</div>

{include file="biz_rewards/rwd_basic_popup.tpl"}
{include file="biz_rewards/js.tpl"}

</div>
{include file="footercontent.tpl"}
{literal}
    <script>
        $(function(){
            toggleRewardType();
        	$("#rwd_start_dt, #rwd_end_dt").scroller({ display:'bubble', preset: 'date', dateFormat: 'mm/dd/yyyy', timeWheels: 'yyyymmdd', animate: 'slidevertical',endYear: ((new Date).getFullYear() + 40) });
            set_chk_bx('b');
        });
    </script>
{/literal}
</body></html>


