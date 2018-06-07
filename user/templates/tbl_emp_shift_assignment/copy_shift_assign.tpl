{include file='header.tpl'} 
<div class="wrapper">
<h1>Add New Schedule</h1>

{include file="tbl_emp_shift_assignment/copy_tabs.tpl"} 
 <form action="{$website}/user/copy_emp_shift_assignment.php" method="post" onsubmit="return validateCopySchedule();">
 <fieldset data-mini="true" data-role="controlgroup" data-type="horizontal">
				
				 	<input type="radio" name="datefilter_type" id="datefilter_type1" value="1" checked="checked"/>
         	<label for="datefilter_type1">Single</label>
					<input type="radio" name="datefilter_type" id="datefilter_type2" value="2"/>
         	<label for="datefilter_type2">Date Range</label> 
						<input type="radio" name="datefilter_type" id="datefilter_type3" value="3"/>
         	<label for="datefilter_type3">Week</label>
					<input type="radio" name="datefilter_type" id="datefilter_type4" value="4"/>
					<label for="datefilter_type4">Month</label>  
	</fieldset>

	
	<div id="box_date_type1" style="width: 100%;"> 
  <label>Source Date </label>
	<input type="text" readonly="readonly" name="single_date" id="single_date" value=""/>
	<div id="single_date_err" class="error"></div> 
	</div>
	<div id="box_date_type2" class="biz_hidden" style="width: 100%;">   
	<label>Source Date Range</label>
		<table style="width: 100%;">
			<tr>
				<td>
						<input type='text' id='date_from' name='date_from' readonly="readonly"   value=''/>
				</td>
				<td>&nbsp;</td>
				<td>
						<input type='text' id='date_to' name='date_to' readonly="readonly"   value=''/> 
				</td>
			</tr> 
			<tr>
				<td id="date_from_err" class="error"></td>
				<td>&nbsp;</td>
				<td id="date_to_err" class="error"></td>
			</tr> 
	</table> 
	</div> 
	<div id="box_date_type3" class="biz_hidden" style="width: 100%;"> 
			<label>Select Week</label>
		 <select id='week' name='week' data-native-menu="true"> 
			{foreach $weeklist as $week}
			<option value="{$week@key}" {if $week@key eq $current_week}selected="selected"{/if}>{$week.start} To {$week.end}</option>
			{/foreach} 
		 </select> 
	</div>
	<div id="box_date_type4" class="biz_hidden" style="width: 100%;"> 
		<label>Select Month</label>
	  <select name="month" id="month" data-native-menu="true">
				{for $month_number=1 to 12}
				<option value="{$month_number}">{"01-`$month_number`-2013"|date_format:"%B"}</option>
				{/for} 
		</select>  
	</div>
	<label>Server</label>
	<select name="employee" id="employee">
		<option>Select Server</option>
	 {foreach $employeelist as $emp} 
		<option value="{$emp@key}" {if $smarty.request.employee eq $emp@key}selected="selected"{/if}>{$emp}</option>
	 {/foreach}
	</select>
	<label>Shift</label>
	<select name="shift" id="shift">
		<option>Select shift</option>
	 {foreach $shiftlist as $sft} 
		<option value="{$sft@key}" {if $smarty.request.shift eq $sft@key}selected="selected"{/if}>{$sft}</option>
	 {/foreach}
	</select>   
	<label>Desire Date Range</label>
	<table style="width: 100%;">
			<tr>
				<td>
						<input type="text" readonly="readonly" name="dsr_from" id="dsr_from" value=""/>   
				</td>
				<td>&nbsp;</td>
				<td>
						<input type="text" readonly="readonly" name="dsr_to" id="dsr_to" value=""/>
				</td>
			</tr>
			<tr>
				<td id="dsr_from_err" class="error"></td>
				<td>&nbsp;</td>
				<td id="dsr_to_err" class="error"></td>
			</tr>  
	</table> 
		<div class="biz_center clearfix">
		
		<input type="hidden" name="{$smarty.const.ACTION_TITLE}" value="COPY_EMP_SFT_BY_DT"/>  
			{jqmbutton value="View Source Schedule" onclick="getSourceSchedule();"}
			{jqmbutton value="View Desire Schedule" onclick="getDesireSchedule();"}  
			{jqmbutton type="form_save"} 
		</div> 
 </form>
</div>
{include file="footercontent.tpl"}
{include file="tbl_emp_shift_assignment/js.tpl"}
</body></html>