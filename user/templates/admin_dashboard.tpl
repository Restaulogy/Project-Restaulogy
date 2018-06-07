<div class="wrapper">
 <h1>Menu</h1>
{if $smarty.session.tbl_admin_dashboard_list}
	{if $smarty.session.rest_menu_opt_det.rst_mnu_orders eq 1}
		<p><label for="lbl_alerts"> Notifications:&nbsp;&nbsp;<a href="#" onclick="hide_show_alert('lst_grid_alert');"><img id="img_lst_grid_alert" src="{$website}/images/_graphics/show.gif"></a></label></p>	
		<div id='lst_grid_alert' class="biz_grid" style="display: none;">		
			{include file='alert_grid.tpl'}
		</div>
		<br>
	{/if}
	
	{foreach from=$smarty.session.tbl_admin_dashboard_list item=tbl_admin_dashboarditem}
		<div class="admin_dshmnu">
			{if $tbl_admin_dashboarditem.admdash_lnk eq '#'}
				<a href="{$tbl_admin_dashboarditem.admdash_lnk}" onclick="$('#quick_filter_for_rwards_lst').popup('open');">
			{else}
				<a href="{$website}/{$tbl_admin_dashboarditem.admdash_lnk}">
			{/if}			
				<img src="{$website}/{$tbl_admin_dashboarditem.admdash_img}" alt="{$tbl_admin_dashboarditem.admdash_name}" />
				<span>{$tbl_admin_dashboarditem.admdash_name}</span>
			</a>
		</div>
	{/foreach}
{/if}

</div> <!--/#wrapper-->

<div data-role="popup" id="popupAlertMsg" data-theme="a" data-overlay-theme="g" data-dismissible="false" style="width:270px;">	
 <div data-role="header">
 	<h1>Message</h1> 
</div>	
<div data-role="content" style="padding:5px;">
	<div id="alrtmsg" style="width:260px;text-align: justify;"></div>
	<div class="clearfix line_break"></div>
	<div class="biz_center">
		<input type="button" onclick="$('#popupAlertMsg').popup('close');" data-icon="delete" data-inline="true" value="{$_lang.close_lbl}"/>
	</div>
</div>
</div> 


{include file='quick_add_points.tpl'}

{include file="footercontent.tpl"}
{include file="alert_js.tpl"}

{literal} 
<script type="text/javascript">
	function hide_show_alert(txt_id){
		if(txt_id){}else{txt_id = "lst_grid_alert"};
	    var state = document.getElementById(txt_id).style.display;
	    
	    if (state == 'none') {	        
	        document.getElementById(txt_id).style.display = 'block';
	        document.getElementById("img_" + txt_id).src="{/literal}{$website}{literal}/images/_graphics/hide.gif";
	    }else{
	        document.getElementById(txt_id).style.display = 'none';
	        document.getElementById("img_" + txt_id).src="{/literal}{$website}{literal}/images/_graphics/show.gif";
	    }
	}
</script>
{/literal}

</body></html>