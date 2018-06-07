<table style="width:750px;border:none;">
	<tr>
		<td style="width:80px;border-bottom:none;">
			<input type="hidden" name="sa" value="site">
			<b style="font-size:12px;">&nbsp;Keywords</b>
		</td>

		<td style="width:510px;border-bottom:none;">
			<input class="searchfield"  type="text" style="width:500px;" id="search_keywords" name="sk" value="{$search_key}" >
		</td>
		<td style="width:80px;veritcal-align:middle;border-bottom:none;">
			<input type="radio" style='width:20px;' name="st" value="all" {if $search_type == "any"}checked{else}{/if}><b style='font-size:11px;'>All</b>
		</td>
		<td style="width:80px;veritcal-align:middle;border-bottom:none;">
			<input type="radio" style='width:20px;' name="st" value="any" {if $search_type == "any"}{else}checked{/if}><b style='font-size:11px;'>Any</b>
		 </td>
	</tr>
</table>
