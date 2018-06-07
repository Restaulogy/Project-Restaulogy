<table style="width:780px;border:none;">
	<tr>
		<td style="width:70px;border-bottom:none;" VALIGN="TOP">
	 		<b style="font-size:12px;">&nbsp;Category</b>
		</td>

		<td style="width:710px;border-bottom:none;position:relative;" VALIGN="MIDDLE">
            <table style="border:none;width:500px;position:absolute;top:0px;left:0px;">
        	   <tr>
        		  <td style="border:none;width:480px;">
                    <input type='text' value="" id="category_listing_text" style='width:480px;font-size:11px;' READONLY/>
                  </td>
        		  <td style="border:none;">
                    <input style="width:30px;" type="button" class="blackbutton" value="..." onClick='show_category_dialog("searchform_categories","searchform_cat_list");'/>
                  </td>
        	   </tr>
            </table>
            <br/>
            <span id="searchform_cat_list" style='font-size:10px;'></span>
            <input type="text" style='display:none;' name="categories" id="searchform_categories" value="{$smarty.post.categories|escape}"/>
	   </td>
	</tr>
</table>
