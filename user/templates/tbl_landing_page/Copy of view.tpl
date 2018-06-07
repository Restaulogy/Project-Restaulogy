{include file="header.tpl"}<script type="text/javascript" src="{$website}/jscolor/jscolor.js"></script> <style>.ui-input-text.ui-focus,.ui-input-search.ui-focus {	-moz-box-shadow: 0px 0px 12px #000;	-webkit-box-shadow: 0px 0px 12px #000;	box-shadow: 0px 0px 12px #000;}</style><div class="wrapper"><h1>{$_lang.tbl_landing_page.title}</h1>{if $error_msg}	<center>{$error_msg}</center>{/if}<form name="frmupdatetbl_landing_page" id="frmupdatetbl_landing_page" enctype="multipart/form-data" onsubmit="return validatetbl_landing_page();" method="POST" action="{$page_url}" style="{if $isUpdate eq 1}{else}display:none;{/if}">	<input type="hidden" name="lnd_pg_id" id="lnd_pg_id" value="{$tbl_landing_pageinfo.lnd_pg_id}"/>	<div style="display:none;" class="error" id="lnd_pg_id_err"></div>	<div class="biz_hidden">		<label for="lnd_pg_restaurant" style='font-weight:bold;' >{$_lang.tbl_landing_page.label.lnd_pg_restaurant}</label>		<input type="text" name="lnd_pg_restaurant" id="lnd_pg_restaurant" value="{$tbl_landing_pageinfo.lnd_pg_restaurant}"/>		<div class="error" id="lnd_pg_restaurant_err"></div>	</div><table style='margin-left:auto;margin-right:auto;text-align:center;'>	<tr>        <td align="center">            <div class="field-row">        		<label for="lnd_pg_lbl_font_color" style='font-weight:bold;'>{$_lang.tbl_landing_page.label.lnd_pg_lbl_font_color}</label>        		<input type="text" class="color" name="lnd_pg_lbl_font_color" id="lnd_pg_lbl_font_color" value="{$tbl_landing_pageinfo.lnd_pg_lbl_font_color}" style='width:65%;' />        		<div class="error" id="lnd_pg_lbl_font_color_err"></div>        	</div>        </td>        <td style='width:5%;'>            &nbsp;        </td>        <td align="center">            <div class="field-row">        		<label for="lnd_pg_background" style='font-weight:bold;'>{$_lang.tbl_landing_page.label.lnd_pg_background}</label>        		{if $tbl_landing_pageinfo.lnd_pg_background neq ''}                    <a href="{$website}{$smarty.const.LAND_PG_UPLOAD_PATH}{$tbl_landing_pageinfo.lnd_pg_background}" target="_blank"><img style="width:50px;height:50px;" src="{$website}{$smarty.const.LAND_PG_UPLOAD_PATH}{$tbl_landing_pageinfo.lnd_pg_background}" /></a> &nbsp; <input data-inline="true" data-mini="true" data-icon="delete" type="button" onclick="window.location.href='{$page_url}?action=delt_img&lnd_pg_id={$tbl_landing_pageinfo.lnd_pg_id}&del_fld=lnd_pg_background';" value="{$_lang.tbl_landing_page.DELETE.BTN_LBL}"/>                {/if}        		<input type="file" name="lnd_pg_background" id="lnd_pg_background" value="{$tbl_landing_pageinfo.lnd_pg_background}" style='width:75%;'/>        		<div class="error" id="lnd_pg_background_err"></div>        	</div>        </td>	</tr>	    <tr>      <td align="center">    	<div class="field-row">    		<label for="lnd_pg_menu" style='font-weight:bold;'>{$_lang.tbl_landing_page.label.lnd_pg_menu}</label>    		{if $tbl_landing_pageinfo.lnd_pg_menu neq ''}    		  <a href="{$website}{$smarty.const.LAND_PG_UPLOAD_PATH}{$tbl_landing_pageinfo.lnd_pg_menu}" target="_blank"><img style="width:50px;height:50px;" src="{$website}{$smarty.const.LAND_PG_UPLOAD_PATH}{$tbl_landing_pageinfo.lnd_pg_menu}" /></a> &nbsp; <input data-inline="true" data-mini="true" data-icon="delete" type="button" onclick="window.location.href='{$page_url}?action=delt_img&lnd_pg_id={$tbl_landing_pageinfo.lnd_pg_id}&del_fld=lnd_pg_menu';" value="{$_lang.tbl_landing_page.DELETE.BTN_LBL}"/>    		{else}                <img src="{$website}/images/dashboard/menu.png" style="width:50px;height:50px;"/>    		{/if}    		<input type="file" name="lnd_pg_menu" id="lnd_pg_menu" value="{$tbl_landing_pageinfo.lnd_pg_menu}" style='width:75%;'/>    		<div class="error" id="lnd_pg_menu_err"></div>    	</div>    	<div class="field-row">    		<!-- <label for="lnd_pg_lbl_menu" style='font-weight:bold;'>{$_lang.tbl_landing_page.label.lnd_pg_lbl_menu}</label> -->    		<input type="text" name="lnd_pg_lbl_menu" id="lnd_pg_lbl_menu" value="{$tbl_landing_pageinfo.lnd_pg_lbl_menu}" style='width:55%;' />    		<div class="error" id="lnd_pg_lbl_menu_err"></div>        </div>              </td>      <td style='width:5%;'>            &nbsp;        </td>      <td align="center">    	<div class="field-row">    		<label for="lnd_pg_promotion" style='font-weight:bold;'>{$_lang.tbl_landing_page.label.lnd_pg_promotion}</label>    		{if $tbl_landing_pageinfo.lnd_pg_promotion neq ''}    		  <a href="{$website}{$smarty.const.LAND_PG_UPLOAD_PATH}{$tbl_landing_pageinfo.lnd_pg_promotion}" target="_blank"><img style="width:50px;height:50px;" src="{$website}{$smarty.const.LAND_PG_UPLOAD_PATH}{$tbl_landing_pageinfo.lnd_pg_promotion}" /></a>&nbsp; <input data-inline="true" data-mini="true" data-icon="delete" type="button" onclick="window.location.href='{$page_url}?action=delt_img&lnd_pg_id={$tbl_landing_pageinfo.lnd_pg_id}&del_fld=lnd_pg_promotion';" value="{$_lang.tbl_landing_page.DELETE.BTN_LBL}"/>    		{else}                <img src="{$website}/images/dashboard/promotion.png" style="width:50px;height:50px;" />    		{/if}    		<input type="file" name="lnd_pg_promotion" id="lnd_pg_promotion" value="{$tbl_landing_pageinfo.lnd_pg_promotion}" style='width:75%;'/>    		<div class="error" id="lnd_pg_promotion_err"></div>    	</div>    	<div class="field-row">    		<!-- <label for="lnd_pg_lbl_promotion" style='font-weight:bold;'>{$_lang.tbl_landing_page.label.lnd_pg_lbl_promotion}</label> -->    		<input type="text" name="lnd_pg_lbl_promotion" id="lnd_pg_lbl_promotion" value="{$tbl_landing_pageinfo.lnd_pg_lbl_promotion}" style='width:55%;'/>    		<div class="error" id="lnd_pg_lbl_promotion_err"></div>    	</div>      </td>    </tr>        <tr>      <td align="center">    <div class="field-row">		<label for="lnd_pg_loyalty" style='font-weight:bold;'>{$_lang.tbl_landing_page.label.lnd_pg_loyalty}</label>		{if $tbl_landing_pageinfo.lnd_pg_loyalty neq ''}		  <a href="{$website}{$smarty.const.LAND_PG_UPLOAD_PATH}{$tbl_landing_pageinfo.lnd_pg_loyalty}" target="_blank"><img style="width:50px;height:50px;" src="{$website}{$smarty.const.LAND_PG_UPLOAD_PATH}{$tbl_landing_pageinfo.lnd_pg_loyalty}" /></a>&nbsp; <input data-inline="true" data-mini="true" data-icon="delete" type="button" onclick="window.location.href='{$page_url}?action=delt_img&lnd_pg_id={$tbl_landing_pageinfo.lnd_pg_id}&del_fld=lnd_pg_loyalty';" value="{$_lang.tbl_landing_page.DELETE.BTN_LBL}"/>		{else}            <img src="{$website}/images/dashboard/loyalty.png" style="width:50px;height:50px;"/>		{/if}		<input type="file" name="lnd_pg_loyalty" id="lnd_pg_loyalty" value="{$tbl_landing_pageinfo.lnd_pg_loyalty}" style='width:75%;' />		<div class="error" id="lnd_pg_loyalty_err"></div>	</div>	<div class="field-row">		<!-- <label for="lnd_pg_lbl_loyalty" style='font-weight:bold;'>{$_lang.tbl_landing_page.label.lnd_pg_lbl_loyalty}</label> -->		<input type="text" name="lnd_pg_lbl_loyalty" id="lnd_pg_lbl_loyalty" value="{$tbl_landing_pageinfo.lnd_pg_lbl_loyalty}" style='width:55%;'/>		<div class="error" id="lnd_pg_lbl_loyalty_err"></div>	</div>      </td>      <td style='width:5%;'>            &nbsp;        </td>      <td align="center">    	<div class="field-row">    		<label for="lnd_pg_connect" style='font-weight:bold;'>{$_lang.tbl_landing_page.label.lnd_pg_connect}</label>    		{if $tbl_landing_pageinfo.lnd_pg_connect neq ''}    		  <a href="{$website}{$smarty.const.LAND_PG_UPLOAD_PATH}{$tbl_landing_pageinfo.lnd_pg_connect}" target="_blank"><img style="width:50px;height:50px;" src="{$website}{$smarty.const.LAND_PG_UPLOAD_PATH}{$tbl_landing_pageinfo.lnd_pg_connect}" /></a>&nbsp; <input data-inline="true" data-mini="true" data-icon="delete" type="button" onclick="window.location.href='{$page_url}?action=delt_img&lnd_pg_id={$tbl_landing_pageinfo.lnd_pg_id}&del_fld=lnd_pg_connect';" value="{$_lang.tbl_landing_page.DELETE.BTN_LBL}"/>            {else}                <img src="{$website}/images/dashboard/social_media.png" style="width:50px;height:50px;"/>            {/if}    		<input type="file" name="lnd_pg_connect" id="lnd_pg_connect" value="{$tbl_landing_pageinfo.lnd_pg_connect}" style='width:75%;' />    		<div class="error" id="lnd_pg_connect_err"></div>    	</div>    	<div class="field-row">    		<!-- <label for="lnd_pg_lbl_connect" style='font-weight:bold;'>{$_lang.tbl_landing_page.label.lnd_pg_lbl_connect}</label> -->    		<input type="text" name="lnd_pg_lbl_connect" id="lnd_pg_lbl_connect" value="{$tbl_landing_pageinfo.lnd_pg_lbl_connect}" style='width:55%;' />    		<div class="error" id="lnd_pg_lbl_connect_err"></div>    	</div>      </td>    </tr>        <tr>      <td align="center">        <div class="field-row">    		<label for="lnd_pg_reviews" style='font-weight:bold;'>{$_lang.tbl_landing_page.label.lnd_pg_reviews}</label>    		{if $tbl_landing_pageinfo.lnd_pg_reviews neq ''}    		  <a href="{$website}{$smarty.const.LAND_PG_UPLOAD_PATH}{$tbl_landing_pageinfo.lnd_pg_reviews}" target="_blank"><img style="width:50px;height:50px;" src="{$website}{$smarty.const.LAND_PG_UPLOAD_PATH}{$tbl_landing_pageinfo.lnd_pg_reviews}" /></a>&nbsp; <input data-inline="true" data-mini="true" data-icon="delete" type="button" onclick="window.location.href='{$page_url}?action=delt_img&lnd_pg_id={$tbl_landing_pageinfo.lnd_pg_id}&del_fld=lnd_pg_reviews';" value="{$_lang.tbl_landing_page.DELETE.BTN_LBL}"/>    		{else}                <img src="{$website}/images/dashboard/feedback.png" style="width:50px;height:50px;"/>    		{/if}    		<input type="file" name="lnd_pg_reviews" id="lnd_pg_reviews" value="{$tbl_landing_pageinfo.lnd_pg_reviews}" style='width:75%;' />    		<div class="error" id="lnd_pg_reviews_err"></div>    	</div>    	<div class="field-row">    		<!-- <label for="lnd_pg_lbl_reviews" style='font-weight:bold;'>{$_lang.tbl_landing_page.label.lnd_pg_lbl_reviews}</label> -->    		<input type="text" name="lnd_pg_lbl_reviews" id="lnd_pg_lbl_reviews" value="{$tbl_landing_pageinfo.lnd_pg_lbl_reviews}" style='width:55%;' />    		<div class="error" id="lnd_pg_lbl_reviews_err"></div>    	</div>      </td>      <td style='width:5%;'>            &nbsp;        </td>      <td align="center">        <div class="field-row">    		<label for="lnd_pg_service_req" style='font-weight:bold;'>{$_lang.tbl_landing_page.label.lnd_pg_service_req}</label>    		{if $tbl_landing_pageinfo.lnd_pg_service_req neq ''}                <a href="{$website}{$smarty.const.LAND_PG_UPLOAD_PATH}{$tbl_landing_pageinfo.lnd_pg_service_req}" target="_blank"><img style="width:50px;height:50px;" src="{$website}{$smarty.const.LAND_PG_UPLOAD_PATH}{$tbl_landing_pageinfo.lnd_pg_service_req}" /></a>&nbsp; <input data-inline="true" data-mini="true" data-icon="delete" type="button" onclick="window.location.href='{$page_url}?action=delt_img&lnd_pg_id={$tbl_landing_pageinfo.lnd_pg_id}&del_fld=lnd_pg_service_req';" value="{$_lang.tbl_landing_page.DELETE.BTN_LBL}"/>            {else}                <img src="{$website}/images/dashboard/service_request.png" style="width:50px;height:50px;"/>    		{/if}    		<input type="file" name="lnd_pg_service_req" id="lnd_pg_service_req" value="{$tbl_landing_pageinfo.lnd_pg_service_req}" style='width:75%;'/>    		<div class="error" id="lnd_pg_service_req_err"></div>    	</div>    	<div class="field-row">    		<!-- <label for="lnd_pg_lbl_service_req" style='font-weight:bold;'>{$_lang.tbl_landing_page.label.lnd_pg_lbl_service_req}</label> -->    		<input type="text" name="lnd_pg_lbl_service_req" id="lnd_pg_lbl_service_req" value="{$tbl_landing_pageinfo.lnd_pg_lbl_service_req}" style='width:55%;'/>    		<div class="error" id="lnd_pg_lbl_service_req_err"></div>    	</div>      </td>    </tr>        </table>    	<!--	<div class="field-row">		<label for="lnd_pg_start_date">{$_lang.tbl_landing_page.label.lnd_pg_start_date}</label>		<input type="text" name="lnd_pg_start_date" id="lnd_pg_start_date" value="{$tbl_landing_pageinfo.lnd_pg_start_date}"/>		<div class="error" id="lnd_pg_start_date_err"></div>	</div>	-->	<!--	<div class="field-row">		<label for="lnd_pg_end_date">{$_lang.tbl_landing_page.label.lnd_pg_end_date}</label>		<input type="text" name="lnd_pg_end_date" id="lnd_pg_end_date" value="{$tbl_landing_pageinfo.lnd_pg_end_date}"/>		<div class="error" id="lnd_pg_end_date_err"></div>	</div>	-->	<div class='biz_center'>    <input type="hidden" id="action" name="action" value="{$smarty.const.ACTION_UPDATE}"/>    <input  data-inline="true" data-icon="save"  type="submit" value="{$_lang.save_lbl}"/>    <input  data-inline="true" data-icon="search"  type="button" value="Preview" onclick="open_preview('{$page_url}?is_preview=1','MsgWindow',330,550);" />    <!-- <input data-inline="true" data-icon="delete" type="reset" onclick="$('#tbl_landing_page_view').show();$('#frmupdatetbl_landing_page').hide();" value="{$_lang.cancel_lbl}"/> -->    </div></form><div id="tbl_landing_page_view" class="description" style="{if $isUpdate eq 1}display:none;{/if}">	<table class="listTable">		<tr><th class="fieldItem">{$_lang.field_title}</th><th class="valueItem">{$_lang.value_title}</th></tr>		<tr><td class="fieldItem">{$_lang.tbl_landing_page.label.lnd_pg_id}<i>:</i></td><td class="valueItem">{$tbl_landing_pageinfo.lnd_pg_id}</td></tr>		<tr><td class="fieldItem">{$_lang.tbl_landing_page.label.lnd_pg_restaurant}<i>:</i></td><td class="valueItem">{$tbl_landing_pageinfo.lnd_pg_restaurant}</td></tr>		<tr><td class="fieldItem">{$_lang.tbl_landing_page.label.lnd_pg_background}<i>:</i></td><td class="valueItem">{$tbl_landing_pageinfo.lnd_pg_background}</td></tr>		<tr><td class="fieldItem">{$_lang.tbl_landing_page.label.lnd_pg_menu}<i>:</i></td><td class="valueItem">{$tbl_landing_pageinfo.lnd_pg_menu}</td></tr>		<tr><td class="fieldItem">{$_lang.tbl_landing_page.label.lnd_pg_promotion}<i>:</i></td><td class="valueItem">{$tbl_landing_pageinfo.lnd_pg_promotion}</td></tr>		<tr><td class="fieldItem">{$_lang.tbl_landing_page.label.lnd_pg_loyalty}<i>:</i></td><td class="valueItem">{$tbl_landing_pageinfo.lnd_pg_loyalty}</td></tr>		<tr><td class="fieldItem">{$_lang.tbl_landing_page.label.lnd_pg_connect}<i>:</i></td><td class="valueItem">{$tbl_landing_pageinfo.lnd_pg_connect}</td></tr>		<tr><td class="fieldItem">{$_lang.tbl_landing_page.label.lnd_pg_reviews}<i>:</i></td><td class="valueItem">{$tbl_landing_pageinfo.lnd_pg_reviews}</td></tr>		<tr><td class="fieldItem">{$_lang.tbl_landing_page.label.lnd_pg_service_req}<i>:</i></td><td class="valueItem">{$tbl_landing_pageinfo.lnd_pg_service_req}</td></tr>	<!--		<tr><td class="fieldItem">{$_lang.tbl_landing_page.label.lnd_pg_start_date}<i>:</i></td><td class="valueItem">{$tbl_landing_pageinfo.lnd_pg_start_date}</td></tr>	-->	<!--		<tr><td class="fieldItem">{$_lang.tbl_landing_page.label.lnd_pg_end_date}<i>:</i></td><td class="valueItem">{$tbl_landing_pageinfo.lnd_pg_end_date}</td></tr>	-->	<tr><td class="fieldItem">{$_lang.tbl_landing_page.label.isActive}<i>:</i></td><td class="valueItem">{if $tbl_landing_pageinfo.isActive eq 1}{$_lang.tbl_landing_page.label.isActive_yes}{else}{$_lang.tbl_landing_page.label.isActive_no}{/if}</td></tr>	</table>	<center><input data-inline="true" data-icon="edit" type="button" value="{$_lang.tbl_landing_page.UPDATE.BTN_LBL}" onclick="$('#tbl_landing_page_view').hide();$('#frmupdatetbl_landing_page').show();"/><input type="button" value="{$_lang.cancel_lbl}" data-inline="true" data-icon="delete" onclick="window.location.href='{$page_url}'"/></center></div>{include file="tbl_landing_page/js.tpl"}</div>{include file="footer.tpl"}