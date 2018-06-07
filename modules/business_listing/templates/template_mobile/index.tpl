{*****************************************

            Index Template
          phpDirectorySource

******************************************}
{*****************************************

   Get Template Config Variables

******************************************}
{config_load file="$deftpl/system.conf" section='index'}
{*****************************************

   Display Header

******************************************}
{include file="$deftpl/header.tpl"}
{*****************************************

   Page Display

******************************************}
<div data-role="page">
	<div data-role="header">
	    <a href="{$vs_config.mainurl}/promotionslisting.php?listing_type=all&show_type=BL" data-icon="home" data-iconpos="notext" rel="external"></a>
		<h4>{if $ispromotion}Promotions{else}Business Listing{/if}</h4>
	</div>
	
	<div data-role="content">
    <div style="display:inline;vertical-align:top !important;">
         <a style="cursor: pointer;text-decoration:none;" href="index.php?sp={$ispromotion}" data-inline="true" rel="external">Home</a>
         {section name=itm loop=$bread_crumb}
    		<b style="font-size:15px;">&raquo;</b>
            <a style="cursor: pointer;text-decoration:none;" rel="external" data-inline="true" {$btn_link[itm]}>{$bread_crumb[itm]}</a>
        {/section}
    </div>
	<br/><br/>
	
{if $cat_head_file != ""}
    {include file=$cat_head_file}<br>
    {elseif !$cat_id}
        <!--
        <table  width=100% border=0 cellspacing=1 cellpadding=0>
         <tr>
          <td class="page_heading">
           {lang->desc p1='site_text' p2=$lang_set p3='main_content_head'}
          </td>
         </tr>
        </table>
        -->
    {/if}

{*************************
for the showing categories
**************************}
 {if count($categories) > 0 }
    	{if $main_cat == 1}
              <div data-role="collapsible-set" data-theme="a" data-content-theme="c">
                  <div data-role="collapsible">
                  <h3>&nbsp;<a href="#" onclick="location.href='{$vs_config.mainurl}/promotionslisting.php?show_type=PR&listing_type=all'">All</a></h3>
                  <p>All categories</p>
                  </div>
              {section name=itm loop=$categories}
                   <div data-role="collapsible">
                    <h3>&nbsp;{$categories[itm].href}</h3>
                    <p>
                        <div style='font-size:12px;font-family:arial;'>
                        {$categories[itm].sub|replace:'|':'<br>'}
                        </div>
                    </p>
                    </div>
              {/section}
			</div>
	{elseif $main_cat ==0}

    {/if}
{/if}
        
{if $list != ""}
	<ul data-role="listview" data-filter="true" data-inset="true">
		{section name=itm loop=$list}
			{assign var="subfile" value=$list[itm].subfile}
			{include file="$deftpl/sublist/$subfile"}
		{/section}
	</ul>

  {if $paginate_list.total > $vs_config.lists_page}
        
		 <div align=center style="font-size: 10pt; font-weight: normal; color: black;">
		  		{paginate_prev id="list"}{paginate_middle id="list" format='page' prefix='[' suffix=']' page_limit='10'}{paginate_next id="list"}
          </div>

  {/if}

{else}
    {if $main_cat == 0}
    	  <div class="fail">
                {lang->desc p1='site_text' p2=$lang_set p3='no_list_found'}
          </div>
    {/if}
{/if}


{if $cat_foot_file != ""}
   {include file=$cat_foot_file}<br>
{elseif !$cat_id}
  <div align=center style="font-size: 18px; font-weight: bold; color: #CC6600;">
   {lang->desc p1='site_text' p2=$lang_set p3='main_content_foot'}
  </div>
{/if}

<!--
{if $paginate_cat.total > $vs_config.cats_page}
<div align=center style="font-size: 10pt; font-weight: normal; color: black;">
    {if $vs_config.rewrite}
        {paginate_prev rewrite=$mod_title cat=$cat_id id="cat"}{paginate_middle rewrite=$mod_title cat=$cat_id id="cat" format='page' prefix='[' suffix=']' page_limit='10'}{paginate_next rewrite=$mod_title cat=$cat_id id="cat"}
    {else}
        {paginate_prev id="cat"}{paginate_middle id="cat" format='page' prefix='[' suffix=']' page_limit='10'}{paginate_next id="cat"}
    {/if}
</div>
{/if}
-->

</div>
    {include file="$deftpl/common_footer.tpl"}
</div>

{*****************************************

   Display Footer

******************************************}
  {include file="$deftpl/sitefoot.tpl"}
