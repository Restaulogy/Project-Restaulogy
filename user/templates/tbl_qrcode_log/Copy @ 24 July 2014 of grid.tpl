{include file='header.tpl'}<div class="wrapper"><h1>{$_lang.main.prom_stats.prom_stats_title}</h1><!--<a href="#" style="float:right;" data-role="button" data-icon="search" data-iconpos="notext" onclick="$('#filter_for_qrcodescan').toggle();"></a>-->{if $filt_text neq ''}	<div style="width:99%;padding:5px;border-bottom:1px dotted #ccc;font-style: italic;"><span class="info">Search results &laquo; </span><span class="notice">{$filt_text}</span><span class="info">&raquo;</span></div><br>{/if}{if $error_msg}	<center>{$error_msg}</center>{/if}{include file="tbl_qrcode_log/tabs.tpl"}{if $rpt_to_show=='qr_code_log'}    {include file="tbl_qrcode_log/{$deviceType}/qrcodescan.tpl"}{elseif $rpt_to_show=='loyalty_reward'}    {include file="tbl_qrcode_log/{$deviceType}/loyalty_reward.tpl"}{elseif $rpt_to_show=='promotions'}    {include file="tbl_qrcode_log/{$deviceType}/promotions.tpl"}{/if}</div>{include file="tbl_qrcode_log/js.tpl"}{include file="footercontent.tpl"}{literal}<script type="text/javascript">      $(function(){  $("#search_from_dt, #search_to_dt").scroller({ display:'bubble', preset: 'date', dateFormat: 'mm/dd/yyyy', timeWheels: 'yyyymmdd', animate: 'slidevertical'});});</script>{/literal}</body></html>