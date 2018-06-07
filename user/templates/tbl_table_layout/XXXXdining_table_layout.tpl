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
		background-position: left;
		background-repeat: no-repeat;
		background-size: 100% 100%; 
   }
	 table#div2 td a{ width:100%;height:100%;display:block;}
   
		 
	  
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
  	
 <table id="div2" >
  {for $i=0;$i<5;$i++}
 	<tr>

		 {for $j=0;$j<5;$j++}
		 <td id="cell_{$gridtable["{$i}_{$j}"].table_id}" posX="{$i}" posY="{$j}" {if $gridtable["{$i}_{$j}"]} style="background-image: url('{$website}/images/tables/{$gridtable["{$i}_{$j}"].table_id}.png');" {/if}>
             {if $gridtable["{$i}_{$j}"]}
                <a href="#" onclick="getTblStatus({$gridtable["{$i}_{$j}"].table_id},{$gridtable["{$i}_{$j}"].customer_session});" data-rel="popup"></a>
             {/if}

         </td>
		 {/for}		 
	</tr> 
	{/for}	
	</table>

{*<a href="#popupDetail" onclick="getdetails({$gridtable["{$i}_{$j}"].table_id},{$gridtable["{$i}_{$j}"].customer_session});" data-rel="popup"></a>*}
</div> <!--/#wrapper-->
<div id="js_hidden">
	{foreach $tbl_layouts as $tbl_layout}
		 {$tbl_layout}
	{/foreach}
</div>
<div data-role="popup" id="popupDetail" style="width: 270px;" data-overlay-theme="g">
	 <div data-role="header"><h1>Detail</h1></div>
	 <div data-role="content">
	 	<div class="navTable_border">
			<table class="navTable" style="width:250px;"><tr><th><a class="biz_hidden" id="tab_link_detail" href="#"  onclick="chageTab('detail');">Detail</a><b  id="tab_header_detail">Detail</b></th><th><a href="#" id="tab_link_notification" onclick="chageTab('notification');">Notification</a><b id="tab_header_notification" class="biz_hidden">Notification</b></th></tr></table> 
		</div>
		<div id="content_detail"> 
			<table class="listTable white_border"> 
					<tr><td class="fieldItem">Customer</td><td class="valueItem" id="customer_td"></td></tr>
				 	<tr><td class="fieldItem">Server</td><td class="valueItem" id="server_td"></td></tr>
				 	<tr><td class="fieldItem">Party Size</td><td class="valueItem" id="party_size_td"></td></tr>
					<tr><td class="fieldItem">Customer Arrival</td><td class="valueItem" id="cust_arival_td"></td></tr>
			</table> 
		</div>
		<div id="content_notification" class="biz_hidden"></div>    
	 </div>
</div>

<input type="hidden" id="table_id" value="0" />
{include file='footercontent.tpl'}
<script type="text/javascript" src="{$website}/js/html2canvas.min.js"></script> 
 
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
		window.open("{/literal}{$website}{literal}/user/tbl_alerts.php?table_id=" + table_id);
}
	
	function chkTableStatus(table_id,customer_session){
        window.open("{/literal}{$website}{literal}/user/tbl_table_status_link.php?latestOnly=1&customer_session_id="+ customer_session +"&pst_table_id=" + table_id);
	}
	function chkOrders(table_id,customer_session){
		window.open("{/literal}{$website}{literal}/user/tbl_table_status_link.php?latestOnly=1&pst_table_id=" + table_id);
	}

	function chkServiceRequests(table_id,customer_session){
		window.open("{/literal}{$website}{literal}/user/tbl_alerts.php?pst_table_id=" + table_id);
	}
	function chkPromotions(table_id,customer_session){
		window.open("{/literal}{$website}{literal}/user/tbl_alerts.php?pst_table_id=" + table_id);
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
                               $('#cell_' + i).css('background-image', 'url(' + data[i] + ')').trigger('refresh');

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
</script>
{/literal} 
</body></html>
