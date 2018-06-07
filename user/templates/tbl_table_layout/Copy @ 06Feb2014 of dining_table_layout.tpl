{include file='header.tpl'}
{literal}
<style type="text/css"> 
  
	 table#div2{  
	  position:relative;
	  width:100%;  
	  border:1px solid #fff;background: #efefef;
	 	border-spacing: 10px;
         border-collapse: separate;
	 }
	 table#div2 td{
	  position:relative !important;
	 	 border:1px solid #000;
		 width:19%; 
		 height:120px;
		/* padding:1%;*/
		/*background-position: left;
		background-repeat: no-repeat;
		background-size: 82% 100%;*/
		 
   }
	 table#div2 td span{display:inline-block;width:80%;height:80%;background-position: left;
		background-repeat: no-repeat;
		background-size: 100% 100%; cursor:pointer}
   table#div2 td ul {
      float:right;
      margin:0px;
      padding:0px;
   }
   table#div2 td ul li {
   }
   table#div2 td ul li img {
      width:27px;height:27px;
      cursor:pointer;
        filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0\'/></filter></svg>#grayscale"); /* Firefox 10+, Firefox on Android */
        filter: gray; /* IE6-9 */
        -webkit-filter: grayscale(100%);
   }
   
    table#div2 td ul li img:hover , table#div2 td ul li img.active {
        filter: none;
        -webkit-filter: grayscale(0);
    }

	 table#div2 td img{
	 	width :120px;
		height:120px;
		margin:5px 15px;
		display:inline-block; 
	 }
	  table#div2 td img{
			margin:0px;
		}  
		
		table.biz_status_picker{
	display: inline-block !important;
	height:25px;
	margin:2px 20%; 
	
	vertical-align:top !important;
}

table.biz_status_picker td{
 border-collapse: collapse !important;
 padding:0px !important;
 border:none !important;
 border-spacing: none;
 width:auto !important; 
 font-size:12px; 
 height:25px;
 vertical-align:top !important;
}
table.biz_status_picker td .biz_icon_text{
 height: 14px !important;
 overflow-y:hidden;
} 

</style>
{/literal}

<div class="wrapper" > 
<h1>{$_lang.tbl_table_type.layout}</h1>

{if $error_msg}
	<center>{$error_msg}</center>
{/if}
{include file="tbl_table_layout/curr_tables_tabs.tpl"}

  {**<div id="div1" ondrop="drop(event)" ondragover="allowDrop(event)">**}
	 {**foreach $divtables as $table}
			<img src="{$website}/images/tables/{$table@key}.png" class="flip-horizontal" draggable="true" alt="{$table@key}" ondragstart="drag(event)" id="drag{$table@key}" />
		{/foreach**} 
	{**</div>**}
  	
 <table id="div2">
  {for $i=0;$i<5;$i++}
 	<tr>
		 {for $j=0;$j<5;$j++}
		 <td id="cell_{$gridtable["{$i}_{$j}"].table_id}" posX="{$i}" posY="{$j}"  onclick="$('#popupDetail').popup('open');">
		 
		 {if $gridtable["{$i}_{$j}"]}
		 		{if $gridtable["{$i}_{$j}"].tbl_status_lnk}
            <span id="img_{$gridtable["{$i}_{$j}"].table_id}" onclick="getTblStatus({$gridtable["{$i}_{$j}"].table_id},{$gridtable["{$i}_{$j}"].customer_session});" style="background-image: url('{$website}/images/tables/{$gridtable["{$i}_{$j}"].table_id}.png');"></span>
            
          <ul style="float:right;">
            <li><img src="{$website}/css/jqm_extra_icon/green/search.png" onclick="chkTableStatus({$gridtable["{$i}_{$j}"].table_id},{$gridtable["{$i}_{$j}"].customer_session});" {if $gridtable["{$i}_{$j}"].customer_session gt 0}class="active"{/if} title="View"/></li>
            <li><img src="{$website}/css/jqm_extra_icon/green/edit.png" onclick="chkOrders({$gridtable["{$i}_{$j}"].table_id},{$gridtable["{$i}_{$j}"].customer_session});" {if $gridtable["{$i}_{$j}"].order gt 0}class="active"{/if} title="{$_lang.tbl_alerts.filter.order}"/></li>
            <li><img src="{$website}/css/jqm_extra_icon/green/processing.png" onclick="chkServiceRequests({$gridtable["{$i}_{$j}"].table_id},{$gridtable["{$i}_{$j}"].customer_session});" {if $gridtable["{$i}_{$j}"].request gt 0}class="active"{/if} title="{$_lang.tbl_alerts.filter.request}"/></li>
            <li><img src="{$website}/css/jqm_extra_icon/green/tag.png" {if $gridtable["{$i}_{$j}"].promotion gt 0}class="active"{/if} onclick="chkPromotions({$gridtable["{$i}_{$j}"].table_id},{$gridtable["{$i}_{$j}"].customer_session});" title="{$_lang.tbl_alerts.filter.promotion}"/></li>
            <li><img src="{$website}/css/jqm_extra_icon/green/chat.png" onclick="chkNotification({$gridtable["{$i}_{$j}"].table_id},{$gridtable["{$i}_{$j}"].customer_session});" {if $gridtable["{$i}_{$j}"].general gt 0}class="active"{/if} title="{$_lang.tbl_alerts.filter.general}"/></li>
          </ul>
         {assign var='tbl_table_status_linkitem' value=$gridtable["{$i}_{$j}"].tbl_status_lnk}
         {if $tbl_table_status_linkitem}{include file="tbl_table_status_link/new_statuspicker.tpl"}{/if}
         {/if} 
		{/if}
		 </td>
		 {/for}		 
	</tr> 
	{/for}	
	</table>
</div> <!--/#wrapper-->
<div id="js_hidden">
	{foreach $tbl_layouts as $tbl_layout}
		 {$tbl_layout}
	{/foreach}
</div>
{include file='footercontent.tpl'}
{include file="tbl_table_status_link/js.tpl"}
<script type="text/javascript" src="{$website}/js/html2canvas.min.js"></script> 
{**<a href="#popupMenu" data-rel="popup" onclick="$('#table_id').val('{$gridtable["{$i}_{$j}"].table_id}');"><img src="{$website}/images/tables/{$gridtable["{$i}_{$j}"].table_id}.png"  alt="{$gridtable["{$i}_{$j}"].table_id}" id="drag{$gridtable["{$i}_{$j}"].table_id}"/></a><img src="{$website}/css/jqm_extra_icon/green/chat.png" style="position: absolute;z-index:50;width:40px;height:40px;top:30px;right:30px;"/>{/if}**}
  
<!--
<div data-role="popup" id="popupDetail"  data-theme="d" >
	 <ul data-role="listview" data-inset="true" style="min-width:210px;"> 			<li data-role="divider" data-theme="a">Choose</li>  
		<li><a href="#" onclick="checkTableStatus();">Table Status</a></li>
		<li><a href="#" onclick="checkNotification();">Table Notification</a></li>  
  </ul>
</div>
<div data-role="popup" id="popupMenu"  data-theme="d" >
	<ul data-role="listview" data-inset="true" style="min-width:210px;"> 			<li data-role="divider" data-theme="a">Choose</li>  
		<li><a href="#" onclick="checkTableStatus();">Table Status</a></li>
		<li><a href="#" onclick="checkNotification();">Table Notification</a></li>  
  </ul>
</div>
-->
<input type="hidden" id="table_id" value="0" />

<form id='frmChangeRequestStage' name='frmChangeRequestStage' method="post" action='{$website}/user/tbl_table_status_link.php'>
    <input type='hidden' name='pst_table_id' id='pst_table_id' value='0'/>
	<input type='hidden' name='pst_cust_id' id='pst_cust_id' value='0'/>
	<input type='hidden' name='pst_status_id' id='pst_status_id' value='0'/>
	<input type='hidden' name='pst_emp_id' id='pst_emp_id' value='{if $smarty.session.guid gt 0}{$smarty.session.guid}{else}0{/if}'/>
	<input type='hidden' name='pst_last_status_id' id='pst_last_status_id' value='0'/>
	<input type='hidden' name='change_stage' value='change_stage'/>
	<input type='hidden' name='from_layout' value='1'/>
</form>

{literal}
<script type="text/javascript"> 
    function getTblStatus(table_id,customer_session){
    	window.open("{/literal}{$website}{literal}/user/tbl_table_status_link.php?latestOnly=1&with_notification=1&customer_session_id="+ customer_session +"&pst_table_id=" + table_id);
    }
    
    function chageTab(tab){
  		$('#content_detail,#content_notification,#tab_link_detail,#tab_link_notification,#tab_header_detail, #tab_header_notification ').addClass('biz_hidden').trigger('refresh');
    	 reverse_tab = (tab == 'detail') ? 'notification' : 'detail' ;
    	 $('#content_'+ tab +' , #tab_link_'+ reverse_tab +', #tab_header_'+ tab +'').removeClass('biz_hidden');
    }

    function getdetails(table_id,customer_session){
      $('#customer_td,#server_td,#party_size_td,#cust_arival_td').html('');
    	ajaxian({action:'getTableDetail',var1:table_id,var2:customer_session},function(res){
    		if(res){
    			 $('#customer_td').html(res.tbl_cust_sess_customer);
    			 $('#server_td').html(res.employee_name);
    			 $('#party_size_td').html(res.tbl_cust_sess_party_size);
    			 $('#cust_arival_td').html(res.cust_arrive);
    		}
    	});
    }


    function chkNotification(table_id,customer_session){
		window.open("{/literal}{$website}{literal}/user/tbl_alerts.php?alert_post_type={/literal}{$smarty.const.ALERT_FILTER_GENERAL}{literal}&search_isLiveOnly=1&with_notification=1&customer_session_id="+ customer_session +"&search_table=" + table_id);
	}
	function chkTableStatus(table_id,customer_session){
        window.open("{/literal}{$website}{literal}/user/tbl_table_status_link.php?latestOnly=1&customer_session_id="+ customer_session +"&pst_table_id=" + table_id);
	}
	function chkOrders(table_id,customer_session){
		window.open("{/literal}{$website}{literal}/user/tbl_alerts.php?alert_post_type={/literal}{$smarty.const.ALERT_FILTER_ORDER}{literal}&search_isLiveOnly=1&with_notification=1&customer_session_id="+ customer_session +"&search_table=" + table_id);
	}

	function chkServiceRequests(table_id,customer_session){
		window.open("{/literal}{$website}{literal}/user/tbl_alerts.php?alert_post_type={/literal}{$smarty.const.ALERT_FILTER_REQUEST}{literal}&search_isLiveOnly=1&with_notification=1&customer_session_id="+ customer_session +"&search_table=" + table_id);
		 
	}
	function chkPromotions(table_id,customer_session){
		window.open("{/literal}{$website}{literal}/user/tbl_alerts.php?alert_post_type={/literal}{$smarty.const.ALERT_FILTER_PROMOTION}{literal}&search_isLiveOnly=1&with_notification=1&customer_session_id="+ customer_session +"&search_table=" + table_id);
		  
	}
	

  $(function(){ 
	 var params = {};
	 
	  {/literal}
		{assign var="cnt" value=0}
		{foreach $tbl_layouts as $tbl_layout}
		{literal}
		html2canvas([elemById("{/literal}tbl_layout_{$tbl_layout@key}{literal}")], {
        proxy: "https://html2canvas.appspot.com/query",
        onrendered: function(canvas) {
            var img = canvas.toDataURL("image/png");
            var output = img.replace(/^data:image\/(png|jpg);base64,/, "");
            var output = encodeURIComponent(img);
            //var Parameters = "name[0]" + "=<?=$table?>" + "&image[0]=" + output +  "&name[1]" + "=2&image[1]=" + output +  "&filedir=" + "<?=$CONFIG->path?>/images/tables/occupied";
			var Parameters = "&name[{/literal}{$cnt}{literal}]={/literal}{$tbl_layout@key}{literal}&image[{/literal}{$cnt}{literal}]=" + output;
			params["{/literal}{$tbl_layout@key}{literal}"] = Parameters;
		 }
		}); 
		{/literal}
		{math assign="cnt" equation="x+1" x=$cnt}
		{/foreach}
		{literal}
		 
		setTimeout(function(){ 
		   var str = "filedir=images/tables/occupied";
		   for(i in params){
			 	str = str + params[i];
		 }
	       $.ajax({
              type: "POST",
              url: "{/literal}{$website}{literal}/ajax/getimgsrc.php",
              data: str,
    		  dataType : 'json',
              success : function(data){
                //alert(data);
        			if(data){
        				for ( i in data){
                               $('#img_' + i).css('background-image', 'url(' + data[i] + ')').trigger('refresh');

        				       //document.getElementById("cell_" + i).style. = data[i];
        				   //$('#drag' + i).attr('src',data[i]).trigger('create');
        				}
        			}
                //console.log("screenshot done");
				//alert('done');
              },
              error : function (objrespone){
                  alert(objrespone.responseText);
              }
          });
        $('#js_hidden').hide(); 
        
		},200);
	});
	
	
	function changeRequestStage(pst_table_id,pst_cust_id,pst_status_id,pst_emp_id,pst_last_status_link_id,curr_status_id){

	if((pst_table_id>0) && (pst_status_id>0)){

	if((curr_status_id == {/literal}{$smarty.const.TBL_STATUS_AVAILABLE}{literal}) && (pst_status_id == {/literal}{$smarty.const.TBL_STATUS_OCCUPIED}{literal})){
		  window.location.href = '{/literal}{$website}{literal}/user/tbl_table_status_link.php?latestOnly={/literal}{$latestOnly}{literal}&mode=NEW&tbl_sts_lnk_table_id=' + pst_table_id ;
	}else{
    	$("#pst_table_id").val(pst_table_id);
        $("#pst_cust_id").val(pst_cust_id);
        $("#pst_status_id").val(pst_status_id);
    	if(pst_emp_id > 0){
    		$("#pst_emp_id").val(pst_emp_id);
    	}
        $("#pst_last_status_id").val(pst_last_status_link_id);
		if(pst_status_id == "{/literal}{$smarty.const.TBL_STATUS_AVAILABLE}{literal}"){
			tablesPendingReqst("frmChangeRequestStage",pst_table_id);
		}else if(pst_status_id == "{/literal}{$smarty.const.TBL_STATUS_ORDER_CONFIRM}{literal}"){
			checkforconfirmOrder(pst_table_id);
		}else if(pst_status_id == "{/literal}{$smarty.const.TBL_STATUS_CHECK}{literal}"){
			checkforUnPaidOrders (pst_table_id);
		}else{
			//$("#frmChangeRequestStage").submit();
			document.getElementById("frmChangeRequestStage").submit();
		}
	}
	}else{
		alert({/literal}"{$_lang.tbl_table_status_link.non_empty_msg.tbl_sts_lnk_status_id}"{literal})
	}
 }
</script>
{/literal} 
</body></html>
