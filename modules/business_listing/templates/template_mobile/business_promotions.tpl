{*****************************************
        Search Results Template
          phpDirectorySource
******************************************}
{*****************************************
   Get Template Config Variables
******************************************}
{config_load file="$deftpl/system.conf" section='search'}
{*****************************************
   Display Header
******************************************}
{if $list_view eq 1}
    {include file="$deftpl/sitehead.tpl"}
{else}
   {include file="$deftpl/header.tpl"}
{/if}
{*****************************************
   Page Display
******************************************} 
 
 <div data-role="page">
 <div data-role="header">
  <a href="{$elgg_site_url}promotionslisting.php?show_type=PR" data-role="button" data-icon="home" data-iconpos="notext"></a>     <h4>Business promotions</h4>
  <a href="#" onclick="self.close();" data-role="button" data-icon="delete" data-iconpos="notext"></a>
 </div>
  <div data-role="content">
  
        {if $list} 
			{include file="$deftpl/post-loops.tpl"}
        {else}
            <div class="fail">
                There are no promotions posted by business.
            </div>
        {/if} 
    </div>
	{include file="$deftpl/common_footer.tpl"}
</div> 
{*****************************************

   Display Footer

******************************************}
{include file="$deftpl/sitefoot.tpl"}
