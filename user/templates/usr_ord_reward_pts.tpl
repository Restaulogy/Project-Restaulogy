{include file="header.tpl"}
<div class="wrapper" id='loginForm'>
		<h1>Reward Point Addition</h1>
		<form method="POST" action="{$website}/user/usr_ord_reward_pts.php" name="myForm" onsubmit="return validateLoginForm();">
		{if $tbl_ordersinfo && $tbl_ordersinfo.order_rewardpts_added eq 1} 
		 	<div class="field-row clearfix">
				<div class="error">Points are already added for this order</div>
			</div> 
		{else}	
			<div class="field-row">
				<p><label>Phone * :</label></p>
				<p><input type="text" id="phone" name="phone" value="{$smarty.request.phone}"/>
				<div id="phone_err" class="error"></div>
				</p>
			</div><!--/.field-row-->
						
			<div class="field-row clearfix">
				<p>
				<input type="hidden" name="reward_cd" value="{$reward_cd}" />
				<input type="hidden" name="act_to_do" value="ADD_POINTS" />
				<input data-inline="true" data-icon="save" name="login" tabindex="7" value="Add Reward Points" type="submit">	
                </p>
			</div><!--/.field-row-->			
			
		</form><!--/#reservation-form-->
		<!--<div class="info"> Note: &nbsp * marked fields are mandatory.</div>-->
		{/if}
		
		<h1>Order Details</h1>
		{include file="tbl_orders/itemcart_view.tpl"}
	
	</div><!--/.wrapper-->
{literal}
<script type="text/javascript">

	function validateLoginForm(){
	  var isErr = true;
	  $('#phone_err').html("");
		 
	  if(IsNonEmpty(elemById("phone").value) == false ){
		$('#phone_err').html("Phone should not be empty.");
		isErr = false;
	  }else{
	  	if(isPhoneNumber(elemById("phone").value) == false){
		  	$('#phone_err').html("Invalid Phone Number.Please Correct.");
			isErr = false;
	  	}
	  } 
	  
	  if(isErr == false){
	   		alert("Please Revise the form");
	  }  
	  
	  return isErr;
	}

</script>
{/literal}

{include file="footer.tpl"}