<form style="display: none;" id="filter_for_dishes" method="POST" action="{$website}/user/tbl_dishes.php" onsubmit="return valid_search();">
	<table style="width: 100%;"  class="biz_box white_border">
        <tr>
		<td style="padding: 5px;text-align:center;" >
			<label><b class="panel_bg">SEARCH<b></label> <hr>
		</tr>
		
		<tr>
		<td style="padding: 5px;" >
			<label>Dish Name</label>
            <input id="search_dish" name="search_dish" value="{$search_restaurant}" />
            <div id="search_dish_err" class="error"></div>
        </td>
		</tr>

		<tr>
			<td class="biz_center line_break" >
				<input data-inline="true" data-icon="search" type="submit" name="fts_search" value="{$_lang.search_lbl}"/>
				<input data-inline="true" data-icon="delete" type="button" onclick="window.location.href='{$website}/user/tbl_dishes.php';" value="{$_lang.cancel_lbl}"/>
			</td>
		</tr>
	</table> 
	<br><br>
</form>
