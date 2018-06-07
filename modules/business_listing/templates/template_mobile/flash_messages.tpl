{if $smarty.session.disp_msg neq "" } 
	{assign var=flash_msg value=$smarty.session.disp_msg|replace:"'":'"'} 
	{literal}
		<script type="text/javascript" src="{/literal}{$elgg_main_url}{literal}js/flashMessage.js"></script>
		<script type="text/javascript"> 
			$(function(){ 
				  flashMessage('{/literal}{$flash_msg}{literal}');
			}); 
		</script>	     
	{/literal}
{/if} 