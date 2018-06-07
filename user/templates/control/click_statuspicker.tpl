<table class="biz_status_picker">
	<tr>
		<td><a class="biz_icon ui-icon ui-icon-arrow-l" href="#" onclick="{$sts_picker_l_onclick}" {if $sts_picker_l_extra}{$sts_picker_l_extra}{/if}></a></td>
		<td><b class="biz_icon_text" title="{$sts_picker_stage}" {if $sts_picker_text_extra}{$sts_picker_text_extra}{/if}>{$sts_picker_stage|truncate:10}</b></td>
		<td><a class="biz_icon ui-icon ui-icon-arrow-r"  href="#" onclick="{$sts_picker_r_onclick}" {if $sts_picker_l_extra}{$sts_picker_r_extra}{/if}></a></td>
	</tr>
</table>