<table style="width:780px;border:none;">
	<tr>
		<td style="width:70px;border-bottom:none;" VALIGN="TOP">
	 		<b style="font-size:12px;">&nbsp;Category</b>
		</td>

		<td style="width:710px;border-bottom:none;" VALIGN="TOP">
            <table style="border:none;width:500px;">
        	   <tr>
        		  <td style="border:none;width:680px;">
                    <input type='text' value="" id="category_listing_text" style='width:480px;font-size:11px;' READONLY/>
                  </td>
        		  <td style="border:none;">
                    <input style="width:30px;" type="button" class="blackbutton" value="..." onClick='show_category_dialog("searchform_categories","searchform_cat_list");'/>
                  </td>
        	   </tr>
        	   <tr>
                <td colspan="2">
                 {if $smarty.post.searchform_cat_list|strlen eq 0}
                        {assign var="search_form_display" value="none"}
                 {else}
                        {assign var="search_form_display" value="block"}
                 {/if}
                    <textarea name="searchform_cat_list" id="searchform_cat_list" style='display:{$search_form_display};max-height:20px;width:650px;background:transparent !important;border:none !important;font-size:10px;line-height:12px !important;height:28px !important;' READONLY>{if $smarty.post.searchform_cat_list}{$smarty.post.searchform_cat_list}{/if}</textarea>
            <input type="text" style='display:none;' name="categories" id="searchform_categories" value="{$smarty.post.categories|escape}"/>
                </td>
               </tr>
            </table>
	   </td>
	</tr>
</table>
