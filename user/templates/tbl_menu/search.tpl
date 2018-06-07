<form style="display: none;" id="filter_menu_for_cust" method="POST" action="{$website}/user/tbl_menu.php?mode=VIEW&menu_id={$smarty.session[$smarty.const.SES_MENU]}&is_preview=1" onsubmit="">
	<table style="width: 100%;"  class="biz_box white_border">
        <tr>
		<td style="padding: 5px;text-align:center;" colspan="3">
			<label><b class="panel_bg">SEARCH<b></label> <hr>
		</tr>
		
        <tr>
		<td style="padding: 5px;" colspan="3">
			<label>Keyword</label>
			<input type="text" name="search_keyword" id="search_keyword" placeholder="Keyword" value="{$smarty.session.menu_filt.search_keyword}"/></td>
		</tr>
		
		<tr>
		<td style="display:none" colspan="3">
			<label>Sub menu</label>
            <select id="search_submenu" name="search_submenu" >
              <option value="" data-placeholder="true">Select Submenu</option>
    		 {foreach $lst_sub_menu as $_sub_menu}
    		 	<option value="{$_sub_menu@key}" {if $smarty.session.menu_filt.search_submenu && ($_sub_menu@key eq $smarty.session.menu_filt.search_submenu)  }selected="selected"{/if}>{$_sub_menu}</option>
    		 {/foreach}
    		 </select>
        </td>
		</tr>
		
		<tr> 
		<td style="padding: 5px;" colspan="3">
			<label>Items that are</label>
            <select id="search_attrib" name="search_attrib[]" multiple="multiple" data-native-menu="false">
             <option value="" data-placeholder="true">Select From List</option>
    		 {foreach $lst_dish_attribs as $attrib}
    		 	<option value="{$attrib@key}" {if  $smarty.session.menu_filt.search_attrib && in_array($attrib@key,$smarty.session.menu_filt.search_attrib)  }selected="selected"{/if}>{$attrib}</option>
    		 {/foreach}
    		 </select>
        </td>
		</tr>

		<tr>
			<td style="padding: 5px;" colspan="3">
			<label>Price</label>
			 <select name="search_price" id="search_price">
                    <option value="0">Select One</option>
			 		<option value="1" {if 1 eq $smarty.session.menu_filt.search_price}selected="selected"{/if}>$0-$5</option>
			 		<option value="2" {if 2 eq $smarty.session.menu_filt.search_price}selected="selected"{/if}>$5-$20</option>
			 		<option value="3" {if 3 eq $smarty.session.menu_filt.search_price}selected="selected"{/if}>$20-$50</option>
			 		<option value="4" {if 3 eq $smarty.session.menu_filt.search_price}selected="selected"{/if}> >=$50 </option>
			 </select>
			</td>
		</tr>
		
		<tr>
		<td {if $smarty.session.rest_menu_opt_det.rst_mnu_allergy eq 0}style="display:none"{/if} colspan="3">
			<label>Allergy</label>
            <select id="search_allergy" name="search_allergy[]" multiple="multiple" data-native-menu="false" >
             <option value="" data-placeholder="true">Select From List</option>
    		 {foreach $lst_allergies as $alergy}
    		 	<option value="{$alergy@key}" {if $smarty.session.menu_filt.search_allergy &&  in_array($alergy@key,$smarty.session.menu_filt.search_allergy) }selected="selected"{/if}>{$alergy}</option>
    		 {/foreach}
		    </select>
        </td>
		</tr>

		<tr>
			<td class="biz_center line_break" colspan="3">
                <input type='hidden' id='web_redt' name='web_redt' value="{$web_redt}" />
                <input data-inline="true" data-icon="search" type="hidden" name="add_filter" value="1" />
				<input data-inline="true" data-icon="search" type="submit" name="fts_search" value="{$_lang.search_lbl}"/>
				<input data-inline="true" data-icon="delete" type="button" onclick="window.location.href='{$website}/user/tbl_menu.php?web_redt={$web_redt}&search_attrib=&search_keyword=&search_price=0&cancel_filter=1&mode=VIEW&menu_id={$smarty.session[$smarty.const.SES_MENU]}&is_preview=1';" value="{$_lang.cancel_lbl}"/>
			</td>
		</tr>
	</table> 
	<br><br>
</form>
