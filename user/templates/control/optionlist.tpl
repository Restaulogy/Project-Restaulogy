 
<option value="">{$option_caption}</option>
{foreach $options as $value}
	<option value="{$value@key}" {if $option_selected eq $value@key}selected="selected"{/if}>{$value}</option>
{/foreach} 