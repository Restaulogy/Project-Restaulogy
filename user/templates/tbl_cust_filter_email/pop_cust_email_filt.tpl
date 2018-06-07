<div data-role="popup" id="popupPromFiltVal" data-dismissible="false" style="width:270px;border:5px solid #333;" data-overlay-theme="a">
	<div data-role="header">
		<h1>Redeem Promotion</h1>
	</div>

	<form name='frm_prom_filt_detail' id="frm_prom_filt_detail" method="POST" action="{$elgg_main_url}modules/business_listing/show.php?show_type=PR&lid={$showing_promotion.list_id}&promoid={$promoid}" autocomplete="off">
	<div data-role="content" style="padding:5px;">

        <div class="biz_hidden">
			<label>Email</label>
            <input type='text' name='email_val' id='email_val' value="" />
            <div id="email_val_err" class="error"></div>
            <input type='text' name='confirm_email_val' id='confirm_email_val' value="{$prom_filt_email}" />
		</div>
		

		<input type='hidden' name='action' id='action' value="{$smarty.const.ACTION_CREATE}" />

		<input type='hidden' name='cust_id' id='cust_id' value="0" />

		<div class='biz_center'>
            <input type="submit" data-icon="save" data-inline="true" value="{$_lang.save_lbl}"/>
    		<input type="button" data-icon="delete" data-inline="true" onclick="$('#popupPromFiltVal').popup('close');" value="{$_lang.cancel_lbl}"/>
        </div>
	</div>
	</form>
	
</div>
