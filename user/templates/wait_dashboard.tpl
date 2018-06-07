{include file='header.tpl'}


<div class="clearfix" id="dashboard" align="center"> 
<table>
    <tr>
         <td style="width:48%;"> 
		  {if $smarty.session[$smarty.const.SES_QUEUE] gt 0}
		  	<a href="{$website}/user/tbl_wait_queue.php">
				<img src="{$website}/images/status.png" alt="{$_lang.main.customer_dashboard_menu.status}" height="136" width="136"/>
				<span>{$_lang.main.customer_dashboard_menu.status}</span>
			</a>
		  {else}
		  	<a href="{$website}/user/tbl_wait_queue.php?{$smarty.const.MODE_TITLE}={$smarty.const.MODE_CREATE}">
				<img src="{$website}/images/profile.png" alt="{$_lang.main.customer_dashboard_menu.new_que}" height="136" width="136"/>
				<span>{$_lang.main.customer_dashboard_menu.new_que}</span>
			</a> 
		  {/if}
			
		 </td>
         <td style="width:4%;">&nbsp;</td>
         <td style="width:48%;">
              <a href="{$website}/user/tbl_alerts.php">
				<img src="{$website}/images/feedback.png" alt="{$_lang.main.pref_mng_cntrols.alerts}" height="136" width="136"/>
				<span>{$_lang.main.pref_mng_cntrols.alerts}</span>
			</a>
         </td>
	</tr>
</table> 

<div data-role="popup" id="popupPhoneNumber" data-overlay-theme="a" data-theme="c" data-dismissible="false" style="width:200px;" class="ui-corner-all">
	 <div data-role="header" data-theme="a" class="ui-corner-top">
        <h6>Phone Number</h6>
		 
    </div>
    <div data-role="content" class="ui-corner-bottom ui-content" style="padding:5px;">
	<form action="{$page_url}" method="POST" onsubmit="return validatePhoneNumber();"> 
		<label>Phone Number</label>
		<input type='text' name='phone_number' id='phone_number' value=''/>
		<div class="clearfix error" id='phone_err'></div>  			
		<div class="clearfix"></div>
		<center>
			<input type="submit" value="{$_lang.save_lbl}"/>
		</center>
	  </form>
	</div>
</div>
</div> <!--/#wrapper-->
{include file='footercontent.tpl'} 

{literal}
<script type="text/javascript"> 
function validatePhoneNumber(){
	var ph = $('#phone_number').val();
	var ph_err = $('#phone_err');
	ph_err.html("");
	var err = false;
	if(IsNonEmpty(ph)==false){
		err = true;
		ph_err.html("Please Enter Phone Number");
	}else{
		if(isPhoneNumber(ph)==false){
			err = true;
			ph_err.html("Please Enter Proper Phone Number");
		}
	}
	ph_err.trigger('refresh');
	
	if(err){
		return false;	
	}else{
		return true;
	}
	
}
{/literal}
{if $is_name_req eq 1}
{literal}
   $(function(){
   	$('#popupPhoneNumber').popup("open");
   });
{/literal}
{/if}
{literal}
</script> 
{/literal}
</body></html>
