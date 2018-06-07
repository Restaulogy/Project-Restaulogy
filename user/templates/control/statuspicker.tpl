<table class="biz_status_picker">
	<tr>
		<td><a class="biz_icon ui-icon ui-icon-arrow-l" href="#popupReverseMenu{if $sts_picker_stage_id neq ""}{$sts_picker_stage_id}{/if}" {if $sts_picker_l_extra}{$sts_picker_l_extra}{/if} data-rel="popup"></a></td>
		<td><b class="biz_icon_text" title="{$sts_picker_stage}" {if $sts_picker_text_extra}{$sts_picker_text_extra}{/if}>{$sts_picker_stage|truncate:10}</b></td>
		<td><a class="biz_icon ui-icon ui-icon-arrow-r" href="#popupMenu{if $sts_picker_stage_id neq ""}{$sts_picker_stage_id}{/if}" {if $sts_picker_r_extra}{$sts_picker_r_extra}{/if} data-rel="popup"></a></td>
	</tr>
</table>