<table class="listTable">
	<tr><th colspan="2">Expected Time</th></tr>
	<tr> 
		<td><input id="sess_est_time" type="text" value="{$smarty.session[$smarty.const.SES_EST_TIME]}"/></td>
		<td>
			<input type="button" data-inline="true" data-mini="true" data-icon="check" onclick="set_sess_est_time();" value="Apply"/>
			<input type="button" data-inline="true" data-mini="true" data-icon="delete" onclick="set_sess_est_time(1);" value="Clear"/>
		</td>
		
	</tr>
</table>