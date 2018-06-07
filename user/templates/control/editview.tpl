<div id="{$editview_id}_view" style="font-size:12px;display:none;">
 {$editview_value}<input type="button" value="Edit" onclick="$('#{$editview_id}_edit').show();$('#{$editview_id}_view').hide();" data-icon="edit" data-inline="true" data-mini="true"/> 
</div> 

<div id="{$editview_id}_edit" > 
	{if $editInline}
		<input  id="{$editview_id}" name="{$editview_name}" value="{$editview_value}" onchange="$('#{$editview_id}_btns').show();" />
	{else}
		<textarea id="{$editview_id}" name="{$editview_name}" onchange="$('#{$editview_id}_btns').show();">{$editview_value}</textarea>
	{/if}
	<div id="{$editview_id}_err" class="error"></div>
	<div id="{$editview_id}_btns" class='biz_center' style="display:none;">
			<input type="submit" value="save" data-icon="save" data-inline="true" data-mini="true" data-theme="a"/>
			<input type="button" value="cancel" onclick="$('#{$editview_id}_btns').hide();" data-icon="delete" data-inline="true" data-mini="true" data-theme="a"/>
	</div>
</div>