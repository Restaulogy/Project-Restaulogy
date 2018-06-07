<table style="width:780px;border:none;">
	<tr>
		<td style="width:70px;border-bottom:none;">
	 		<b style="font-size:12px;">&nbsp;Category</b>
		</td>

		<td style="width:710px;border-bottom:none;" VALIGN="MIDDLE">
		<input type="text" name="categories" id="categories" value="{$smarty.post.categories|escape}"/>{$tree_cate}
     <input type="text" style='display:none;' name="categories" id="searchform_categories" value="{$smarty.post.categories|escape}"/>

	</td>
	</tr>
</table>
