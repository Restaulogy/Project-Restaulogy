{if $info}  
	{foreach from=$info name=latestTableStatus item=tbl_table_status_linkitem}
	{if $smarty.foreach.latestTableStatus.last}
		{assign var=lastTableStatus value=$tbl_table_status_linkitem}
	{/if}
	{/foreach}   
{/if}	

{assign var='tb_sts_lnk_tab' value='detail'}
{assign var=tmp_tbl_id value=$tbl_details.table_id}
{assign var=tmp_table_number value=$tbl_details.table_number}
{assign var=tmp_sess_id value=$lastTableStatus.tbl_sts_lnk_session_id}

{if $smarty.request.with_notification eq 1} 
	{include file="tbl_table_status_link/tbl_status_tab.tpl"}
{else}
	{include file="tbl_table_status_link/navbar.tpl"}
{/if}
 
		{if $tbl_details} 
		<table class="listTable white_border">
			<tr>
				<th class="fieldItem" colspan="2">{$tbl_details.table_number}</th>
			</tr>
			 
			<tr>
				<td class="fieldItem">Customer</td>
				<td class="valueItem">{if $lastTableStatus.customer_session.tbl_cust_sess_customer}{$lastTableStatus.customer_session.tbl_cust_sess_customer}{else}Guest{/if}
				 
				</td>
			</tr>
			<tr>
				<td class="fieldItem">Server</td>
				<td class="valueItem">{if $lastTableStatus.employee.full_name}{$lastTableStatus.employee.full_name}{else}--{/if}</td>
			</tr>
			<tr>
				<td class="fieldItem">Party Size</td>
				<td class="valueItem">{if $lastTableStatus.customer_session.tbl_cust_sess_party_size}{$lastTableStatus.customer_session.tbl_cust_sess_party_size}{else}0{/if}</td>
			</tr>
			<tr>
				<td class="fieldItem">Customer Arrival </td>
				<td class="valueItem">{if $lastTableStatus.customer_session.tbl_cust_sess_start_date}{$lastTableStatus.customer_session.tbl_cust_sess_start_date|date_format:'%A, %B %e, %Y  @%H:%M'}{else}0{/if}</td>
			</tr>
		</table>
		{/if}
  
	{if $info}  
	<table class="biz_data_grid">
	<tr> 
		<th class="fieldItme">Status</th> 
		<th class="valueItem">Time</th>
	</tr>
	{foreach from=$info|@array_reverse name=latestTableStatus item=tbl_table_status_linkitem}
		{**Do not show the available status**}
		{if $tbl_table_status_linkitem.tbl_sts_lnk_status_id neq $smarty.const.TBL_STATUS_AVAILABLE}
		 <tr class="{cycle values="odd,even"}">
			 
			<td class="fieldItem no_hover">{$tbl_table_status_linkitem.status.tbl_sts_name} </td>
		 
			<td class="valueItem no_hover">{$tbl_table_status_linkitem.elapsed_time|date_format:$smarty.const.HTML5_TIME_FORMAT}</td>
		 </tr> 
	 {/if}
	{/foreach}
	
		</table>
	{else}
		<div class="error">No latest record found.</div>
	{/if}
 
  <div class='field-row clearfix' id='newtblSrv'>
 	<center>
	<!--
		 <input data-role="button" data-inline="true" data-icon="gear" class="fright" type="button" value="{$_lang.services_requests.listing_title}" onclick="getSessSrvcReqst({$lastTableStatus.tbl_sts_lnk_session_id});"/>
		  <input data-role="button" data-inline="true" data-icon="cart" class="fright" type="button" value="{$_lang.tbl_orders.listing_title}" onclick="getSessOrders({$lastTableStatus.tbl_sts_lnk_session_id});"/>
       <br/>
	    <input data-role="button" data-inline="true" data-icon="gear" class="fright" type="button" value="{$_lang.services_requests.listing_title}" onclick="window.location.href='{$website}/user/employee_requests.php?table_id={$tbl_details.table_id}&sess_id={$lastTableStatus.tbl_sts_lnk_session_id}&table_status=1'"/>
	   
        <input data-role="button" data-inline="true" data-icon="cart" class="fright" type="button" value="{$_lang.tbl_orders.listing_title}" onclick="window.open('{$website}/user/tbl_orders.php?order_session_id={$lastTableStatus.tbl_sts_lnk_session_id}&table_status=1&table_id={$tbl_details.table_id}');" {if $tbl_details.lastOrderId gt 0}{else}disabled="disabled"{/if}/> 
		<input data-role="button" data-inline="true" data-icon="star" class="fright" type="button" value="{$_lang.main.navbar.claimed_promotion}" onclick="window.open('{$website}/modules/business_listing/coupon_statistics.php?table_id={$tbl_details.table_id}&table_number={$tbl_details.table_number}&cust_sess_id={$lastTableStatus.tbl_sts_lnk_session_id}&latestOnly={$latestOnly}');"/> -->
		 <input data-role="button" data-inline="true" data-icon="add-item" class="fright" type="button" value="{$_lang.main.set_up_menu.add_order}" onclick="location.href='{$website}/user/tbl_menu.php?is_preview=1'"/>       
		</center>
      
 </div>
 
 <div data-role="popup" data-dismissible="false" data-theme="a1" data-overlay-theme="g" id="popupBlock" style="width:270px;">
 	<div data-role="header">
	 	<h3 id="blockHeader"></h3> 
	</div>
	
	<div data-role="content">
		<div id="blockContent">
			
		</div>
		<center>
		<a href="#" data-inline="true" data-role="button" data-icon="delete" onclick="$('#popupBlock').popup('close');">{$_lang.close_lbl}</a></center>
	</div>
 </div>
 
 {literal}
 <script type="text/javascript">
 	function getSessSrvcReqst(cust_sess_id){
			var info = {};
			  info['action'] = 'getSessSrvcReqst';
			  info['var1'] = cust_sess_id;
			var blockContent = $('#blockContent');
			$('#blockHeader').html('Service Request').trigger('create');
			var strOp = '';
			$.ajax({
	        type     : "POST",
	        url      : website + "/ajax/custom_functions.php" , 
					data	 : info,
	        dataType : "json",
					async	 : false,
	    	success  : function(results){ 
                  if(results){
                  	strOp  = strOp + '<table class="biz_data_grid"><tr><th>Customer</th><th>Service</th><th>Status</th></tr>';  
										var cnt = 0;
										var strClass = "";
										for(i in results){ 
											strOp  = strOp + '<tr class="'+ ((cnt%2==0)? "even" :"odd")  +'" onclick="window.open(\'{/literal}{$website}{literal}/user/tbl_services_requests.php?mode=view&srvc_reqst_id='+ results[i].srvc_reqst_id  +'\');">';
											strOp  = strOp + '<td>'+ (IsNonEmpty(results[i].created_by)?results[i].created_by:'Guest') + '</td>';
											strOp  = strOp + '<td>'+ results[i].service_name + '</td>';
											
											
											
											if(results[i].last_stage && results[i].last_stage.srvc_stg_name){
												strOp  = strOp + '<td>'+ results[i].last_stage.srvc_stg_name  + '</td>';
												
											}else{
												strOp  = strOp + '<td>Completed</td>';
												
											}
											
											strOp  = strOp + '</tr>';
											cnt ++;
											
										}
										strOp  = strOp + '</table><br/>';
										
										if(cnt == 0){
											strOp = '<div class="error">No service request found</div>';
										}
										
                  }else{
										strOp = '<div class="error">No service request found</div>';
									}
                },
			error: function(objResponse){
				strOp = '<div class="error">No service request found</div>';
				//alert(objResponse.responseText);
			}
		});
		
		blockContent.html(strOp).trigger('create'); 
		$('#popupBlock').popup('open');
	}
	
	function getSessOrders(cust_sess_id){
			var info = {};
			 info['action'] = 'getSessOrders';
			  info['var1'] = cust_sess_id;
				var strOp  = '';
			var blockContent = $('#blockContent');
			$('#blockHeader').html('Orders').trigger('create');
			$.ajax({
	        type     : "POST",
	        url      : website + "/ajax/custom_functions.php" , 
					data	 : info,
	        dataType : "json",
					async	 : false,
	    	success  : function(results){ 
                  if(results){
										strOp  = strOp + '<table class="biz_data_grid"><tr><th>Customer</th><th>Amount</th></tr>';
										
										var cnt =0; 
										for(i in results){
											strOp  = strOp + '<tr class="'+ ((cnt%2==0)? "even" :"odd")  +'" onclick="window.open(\'{/literal}{$website}{literal}/user/tbl_orders.php?mode=view&order_id='+ results[i].order_id  +'\');">';
											strOp  = strOp + '<td>'+results[i].order_customer_name +'</td>';
											if(results[i].gr_amt){
												strOp  = strOp + '<td>'+ results[i].gr_amt +'</td>';
											}else{
												strOp  = strOp + '<td>0.00</td>';
											}
											
											strOp  = strOp + '</tr>';
											cnt++;
										}
										strOp  = strOp + '</table>';
										
										if(cnt == 0){
											strOp = '<div class="error">No order found</div>';
										}
                  
                  }else{
										strOp = '<div class="error">No order found</div>';
									}
                },
			error: function(objResponse){
				strOp = '<div class="error">No order found</div>';
				//alert(objResponse.responseText);
			}
		}); 
		
		blockContent.html(strOp).trigger('create');
		$('#popupBlock').popup('open');
	}
 </script>
 {/literal}
