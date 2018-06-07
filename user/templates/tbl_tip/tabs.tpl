<div class="navTable_border">
<table class="navTable" style="width:300px;">
	<tr> 
		<th {if $active_page eq 'tbl_tip'}class="active"{else}class="link" onclick="window.location.href='{$website}/user/tbl_tip.php'"{/if}>{$_lang.tbl_tip.listing_title}</th> 
		<th {if $active_page eq 'tbl_tip_distribution'}class="active"{else}class="link" onclick="window.location.href='{$website}/user/tbl_tip_distribution.php'"{/if}>{$_lang.tbl_tip_distribution.listing_title}</th>	 
		<th {if $active_page eq 'tbl_tip_list'}class="active"{else}class="link" onclick="window.location.href='{$website}/user/tbl_tip_list.php'"{/if}>{$_lang.tbl_tip.tip_list}</th> 
	</tr>
</table> 
</div>