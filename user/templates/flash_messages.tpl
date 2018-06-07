 
{if $disp_msg} 
	{assign var=flash_msg value=$disp_msg|replace:"'":'"'} 
	{literal}
		<script type="text/javascript" src="{/literal}{$website}{literal}/js/flashMessage.js"></script>
		<script type="text/javascript"> 
			$(function(){ 
				  flashMessage('{/literal}{$flash_msg}{literal}');
			}); 
		</script>	     
	{/literal}
{/if} 