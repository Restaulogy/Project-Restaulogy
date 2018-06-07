<!--<div id='print_rcpt'>-->
<div data-role="popup" id="popupReceipt" data-dismissible="false" style="width:270px;" data-overlay-theme="g" data-theme="a">
    <div data-role="header" data-theme="a" class="ui-corner-top">
        <h1>Receipt</h1> 
    </div>
    <div data-role="content" data-theme="a" class="ui-corner-bottom ui-content" style="padding:5px;">
{if $all_ses_ord_dtl.order_details}
<table class="biz_data_grid" style="width:99%;">
	<tr class="odd">
		<td class="no_hover" style="text-align:left;">{$tbl_ordersinfo.dine_table}</td>
		<td class="no_hover" style="text-align:center;">{$tbl_ordersinfo.order_session_id}</td>
		<td class="no_hover" style="text-align:right;">#Gst {$all_ses_ord_dtl.customer_session.tbl_cust_sess_party_size}</td>
	</tr> 
	<tr class="odd">
		<td colspan="3" class="no_hover biz_center">{$tbl_ordersinfo.order_created_on|date_format:$smarty.const.HTML5_DATETIME_FORMAT}</td>
	</tr>
	<!--<tr>
		<th style="width:2%;text-align:center;">{$_lang.main.cart.qty}</th>
    <th style="width:40%;">{$_lang.main.cart.item}</th>  
		<th style="width:20%;text-align:right;">{$_lang.main.cart.total}</th>
	</tr>-->
	{assign var=grd_tot value=0}
	{assign var=tot value=0}
{foreach $all_ses_ord_dtl.order_details as $ord_dtl}
 
<tr>
		<th colspan="3" style="text-align: center !important;">{$all_ses_ord_dtl.amounts.customers[$ord_dtl@key]}</th>
</tr>
{assign var='sub_tot' value=0}
{foreach from=$ord_dtl key=kydish_cart item=dish_cart name=nmdish_cart}

		{math assign="tot" equation="x * y" x=$dish_cart.ord_dtl_price y=$dish_cart.ord_dtl_quantity}
	<tr class="sub_main"> 
		<td style="text-align:center;" class="no_hover">{$dish_cart.ord_dtl_quantity}</td>
		<td class="no_hover">{$dish_cart.title}</td>  
		<td class="no_hover" style="text-align:right;font-weight:bold;">{$tot|string_format:"%.2f"} 
			  {math assign="sub_tot" equation="x + y" x=$tot y=$sub_tot}
			
		</td>
	</tr>
	{if $dish_cart["opt_val_details"]}
    	{foreach from=$dish_cart["opt_val_details"] item=optItm name=nmoptItm}
        	{assign var="tot" value=0}
        	{math assign="tot" equation="x * y" x=$optItm.ord_det_opt_price y=$optItm.ord_det_opt_qty}
					
        	<tr class="{cycle values='odd,even'}">
						<td class="no_hover biz_center" >{$optItm.ord_det_opt_qty}</td>
        		<td class="no_hover">&nbsp;&nbsp;{$optItm.opt_value}</td> 
        		<td class="no_hover" style="text-align:right;font-weight:bold;">{$tot|string_format:"%.2f"} {math assign="sub_tot" equation="x + y" x=$tot y=$sub_tot}								
        		</td>
        	</tr>
    	{/foreach}
					
	{/if}

{/foreach}
    	<tr class="customers">
							<td class="no_hover" colspan="2" style="text-align:right;font-weight: bold;">SubTotal</td>
		<td class="no_hover" style="text-align:right;font-weight: bold;">{$sub_tot|string_format:"%.2f"} 
		{math assign="grd_tot" equation="x + y" x=$sub_tot y=$grd_tot}</td>
					</tr>
						
{/foreach}
	<tr class="customers">
 		<td class="no_hover" colspan="2" style="text-align:right;font-weight: bold;">{$_lang.tbl_orders.label.order_tax}</td>
		<td class="no_hover" style="text-align:right;font-weight: bold;"> {$all_ses_ord_dtl.amounts.tax_amt|string_format:"%.2f"} </td>
	</tr>
	<tr class="customers"> 
		<td colspan="2" class="no_hover" style="text-align:right;font-weight: bold;">{$_lang.tbl_orders.label.order_tip}</td>
		<td class="no_hover" style="text-align:right;font-weight: bold;"> {$all_ses_ord_dtl.amounts.tip_amt|string_format:"%.2f"} </td>
 </tr>
 <tfoot>
   {*math assign="grd_tot" equation="x + y + z" x=$grd_tot y=$all_ses_ord_dtl.amounts.tax_amt z=$all_ses_ord_dtl.amounts.tip_amt|string_format:"%.2f"*} 
	<tr>
		<th colspan="2" style="text-align:right;">{$_lang.main.cart.total}</th>
		<th style="text-align:right;font-weight: bold;">{*$grd_tot|string_format:"%.2f"*} {$all_ses_ord_dtl.amounts.gr_amt|string_format:"%.2f"}
		</th>
	</tr>
 </tfoot>
</table>
	<div class="error"> Reward Link: {$tbl_ordersinfo.ord_reward_pts_lnk} <br></div>
{/if}

	<div class="biz_center">
		{jqmbutton type="close" onclick="$('#popupReceipt').popup('close');"}
		{jqmbutton value="Print" icon="search" onclick="printContent('popupReceipt')"}
	</div>	
	</div>
</div>
{literal}

<script type="text/javascript">
<!--
function printContent(id){	
str=document.getElementById(id).innerHTML
newwin=window.open('','printwin','left=100,top=100,width=400,height=400')
newwin.document.write('<HTML>\n')
newwin.document.write('<TITLE>Print Page</TITLE>\n')
newwin.document.write('<link rel="stylesheet" href="{/literal}{$website}{literal}/css/themes/inspired/structure.css"/>\n<link rel="stylesheet" href="{/literal}{$website}{literal}/css/themes/inspired/style.css"/>\n<link rel="stylesheet" href="{/literal}{$website}{literal}/css/jqm-extra-icon.css"/>\n<link  rel="stylesheet" href="{/literal}{$website}{literal}/user/templates/css/style.css"/>\n<link rel="stylesheet" href="{/literal}{$website}{literal}/css/biz_data_grid.css"/>\n')
newwin.document.write('<script>\n')
newwin.document.write('function chkstate(){\n')
newwin.document.write('if(document.readyState=="complete"){\n')
newwin.document.write('window.close()\n')
newwin.document.write('}\n')
newwin.document.write('else{\n')
newwin.document.write('setTimeout("chkstate()",2000)\n')
newwin.document.write('}\n')
newwin.document.write('}\n')
newwin.document.write('function print_win(){\n')
newwin.document.write('window.print();\n')
newwin.document.write('chkstate();\n')
newwin.document.write('}\n')
newwin.document.write('<\/script>\n')
newwin.document.write('</HEAD>\n')
newwin.document.write('<BODY onload="print_win()">\n')
newwin.document.write(str)
newwin.document.write('</BODY>\n')
newwin.document.write('</HTML>\n')
newwin.document.close()
}
//-->
</script>
{/literal}	
