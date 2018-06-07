<table style="width:780px;border:none;">
	<tr>
		<td style="width:70px;border-bottom:none;">
	 		<b style="font-size:12px;">&nbsp;Category</b>
		</td>

		<td style="width:710px;border-bottom:none;" VALIGN="MIDDLE">
        <div id="dialog_category_form">
     <input type="text" name="categories" id="categories" value="{$smarty.post.categories|escape}"/>{$tree_cate}
           </div>
           <table style="border:none;">
			<tr>
				<td>
					<span style='padding:2px; font-size:12px; height:21px;border:1px solid #7F9DB9; width:600px; display:inline-block !important; background:#fff;' id="category_span"></span>
				</td>
				<td>
				    &nbsp;<input type="button" onclick="$('#dialog_category_form').dialog('open');" style='height:21px;font-size:12px;font-weight:bold;width:21px;' class="blackbutton" value="..."/>
				</td>
			</tr>
		   </table>
     <input type="text" style='display:none;' name="categories" id="searchform_categories" value="{$smarty.post.categories|escape}"/>
    
	</td>
	</tr>
</table>
