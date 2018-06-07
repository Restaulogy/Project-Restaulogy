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
{include file="$deftpl/header.tpl"}
{*****************************************

   Page Display

******************************************}
<div data-role="page">
 {include file="$deftpl/common_header.tpl"} 
 <div data-role="content">
 {include file="$deftpl/breadcrumb.tpl"}

        {if !$result_found gt 0}
            {assign var="result_found" value="0"}
        {/if}
        {if !$promotion_result_count}
            {assign var="promotion_result_count" value="0"}
        {/if}
	<h1>Search Results<a href="#" onclick="$('#popupsearch').popup('open');" style="float:right;" data-iconpos="notext" data-role="button" data-icon="search">search</a></h1>
	 
    {if $show_filter}
    <div class="info"><b>Search Criteria :</b>  {$show_filter}</div> 
	{/if}
	<br/>	
	{include file="$deftpl/post-loops.tpl"} 
 </div><!--Content-->
 {include file="$deftpl/inlineSearch.tpl"}
{include file="$deftpl/common_footer.tpl"}
</div><!--Page-->


{*****************************************

   Display Footer

******************************************}
{include file="$deftpl/sitefoot.tpl"}
