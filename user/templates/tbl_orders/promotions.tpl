<div id="popupPromotions"  style="display:none;position:fixed;width:270px;z-index:100;top: 50%;left: 50%;margin-left:-120px;margin-top:-150px;border:1px solid #FF9600;" class='ui-body-a'>
    <div data-role="header" data-theme="a" class="ui-corner-top">
        <h6>Claim Promotion</h6>
 	<a href="#" onclick="$('#popupPromotions').hide();" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
    </div>
    <div data-role="content" data-theme="a" class="ui-corner-bottom ui-content" style="padding:5px;">
		 <form method="POST" action="{$website}/user/tbl_orders.php?{$smarty.const.MODE_TITLE}={$smarty.const.MODE_VIEW}&order_id={$tbl_ordersinfo.order_id}" onsubmit="return validateClaimProm()">
		 	<label for='claim_promotions'>Select Promotions</label>
				<select id='claim_promotions' name="claim_promotions[]" data-native-menu="false" multiple="multiple"></select>
				<div id="claim_promotions_err" class="error"></div>
				<div class="biz_center">
					{jqmbutton icon="star" type="submit" value="Claim Promotion" name="prom_claim"}
				</div> 
		</form>
		</div>
</div>
