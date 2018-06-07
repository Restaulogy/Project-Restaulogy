<table style="width:750px;border:none;">
	<tr>
		<td style="width:70px;">
			<input type="hidden" name="sa" value="site">
			<b style="font-size:12px;">&nbsp;Keywords</b>
		</td>
		<td style="width:250px;">
		    <small style="font-size:9px;">
					<!--[<b>Must be seprated By either space or (,).</b>]-->
			</small>
		</td>
		<td style="width:280px;">
			<input class="searchfield"  type="text" style="width:280px;" id="search_keywords" name="sk" value="{$search_key}" >
		</td>
		<td style="width:70px;veritcal-align:middle;">
			<input type="radio" style='width:20px;' name="st" value="all" {if $search_type == "any"}checked{else}{/if}><b style='font-size:11px;'>All</b>
		</td>
		<td style="width:70px;veritcal-align:middle;">
			<input type="radio" style='width:20px;' name="st" value="any" {if $search_type == "any"}{else}checked{/if}><b style='font-size:11px;'>Any</b>
		 </td>
	</tr>
</table>
