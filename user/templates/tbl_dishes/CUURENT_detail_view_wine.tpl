<div class="listTable biz_no_border" style="background:transparent !important;" >
    <table>
        <tr>
             <td width="60%">
                 <img src="{$website}/uploads/dish/{$tbl_dishesinfo.dish_img}" style="width:200px;margin:3px;height:200px;"/>
             </td>
             <td width="40%">
                  <b>{$_lang.tbl_dishes.label.dish_vintage}</b> - {$tbl_dishesinfo.dish_vintage} <br>
                  <b>{$_lang.tbl_dishes.label.dish_varietal}</b> - {$tbl_dishesinfo.dish_varietal}
             </td>
        </tr>
        <tr>
            <td colspan='2'>
                {$tbl_dishesinfo.dish_winery} - {$tbl_dishesinfo.dish_region}- {$tbl_dishesinfo.dish_country}
            </td>
        </tr>
        <tr>
            <td colspan='2'>
                <b>{$_lang.tbl_dishes.label.dish_alcohol_percent}</b> -{$tbl_dishesinfo.dish_alcohol_percent}
            </td>
        </tr>
        <tr>
            <td colspan='2'>
                <b>{$_lang.tbl_dishes.label.dish_notes}</b> :<br> <div class="clearfix line_break"></div><div id="less_des" style="text-align:justify;font-size:12px;">{$tbl_dishesinfo.dish_notes|truncate:180:'...<a href="#" onclick=\'$("#popupDesc").popup("open");$("#more_des").toggle();\'>more</a>'}
            </td>
        </tr>
        <tr>
            <td colspan='2'>
                <b>{$_lang.tbl_dishes.label.dish_food_wine_pair}</b> :<br>{$tbl_dishesinfo.dish_food_wine_pair}
            </td>
        </tr>
        <tr>
            <td colspan='2'>
                <b>{$_lang.tbl_dishes.label.dish_bottle_price}</b> :${$tbl_dishesinfo.dish_bottle_price}
            </td>
        </tr>
    </table>
</div>

	<div data-role="popup" id="popupDesc" data-dismissible="false" data-theme="a1" data-overlay-theme="g" style="width:270px;">
		<div data-role="header"><h3>Description</h3></div>
		<div data-role="content">
		<div class="description" style="height:150px;overflow-y: auto;padding:5px 7px;"><p>{$tbl_dishesinfo.dish_notes}</p>
		</div>
		<div class="biz_center"><input data-inline="true" data-mini="true" data-icon="delete" type="button" onclick="$('#popupDesc').popup('close');" value="{$_lang.close_lbl}"></div>
		</div>
	</div>
	
	<div class="clearfix"></div>
