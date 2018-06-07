<div id="popupemployeeshift" class="biz_hidden ui-body-a" style="width:250px;position:fixed;z-index:1000;">
  <div data-role="header" data-theme="h">
	<div class="biz_center" style="min-height: 30px;vertical-align: middle !important;font-weight: bold;" id="lbl_emp_shift"></div> 
	</div>
	<div data-role="content" data-theme="a" style="padding: 5px;"> 
	 
 <form id="frm_transfer" name="frm_transfer" action="{$website}/user/tbl_transfer.php" method="POST" onsubmit="return validatetbl_transfer();">	
	<div class="field-row">
		<label for="employee">Server</label>
		<select name="employee" id="employee" data-native-menu="false" data-mini="true">
				{foreach $employeelist as $emp}
					<option value="{$emp@key}">{$emp}</option>
				{/foreach}  
		</select>
	</div>
	
	<div class="field-row">
		<label for="shift_start_time">{$_lang.tbl_shift.label.shift_start_time}</label>
		<input type="text" readonly="readonly" name="trans_time_from" id="trans_time_from" value="{if $smarty.post.trans_time_from}{$smarty.post.trans_time_from}{else}{$smarty.now|date_format:'%T'}{/if}"/>
		<div class="error" id="trans_time_from_err"></div>
	</div>
	
	<div class="biz_hidden">
		<label for="shift_end_time">{$_lang.tbl_shift.label.shift_end_time}</label>
		<input type="text" readonly="readonly" name="trans_time_to" id="trans_time_to" value="{$smarty.post.trans_time_to}"/><div class="error" id="trans_time_to_err"></div>	</div>
	
	<div class="clearfix"></div>	
	<div class="biz_center"> 
		{html_input type="hidden" name="trans_type" value="{$trans_type}"}
		{html_input type="hidden" name="emp_shift" value="{$emp_shift}"}
		{html_input type="hidden" name="emp_shift_table" value="0"}
		{html_input type="hidden" name="transfer_now" value="1"} 
		{jqmbutton type="form_save" value="{$_lang.tbl_transfer.title}"}
		  
	  <input type="button" onclick="$('#popupemployeeshift').addClass('biz_hidden');" value="{$_lang.cancel_lbl}" data-icon="delete" data-inline='true'/>
	 </div>	
	</form>
	</div>
</div>
