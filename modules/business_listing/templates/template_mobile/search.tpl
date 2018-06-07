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
{include file="$deftpl/sitehead.tpl"}
{*****************************************

   Page Display

******************************************}
<center>
<table style="text-align:left;">
<tr>
    <td>
     <a style='font-size:11px;text-decoration:none;' href="{$vs_config.mainurl}/promotionslisting.php?listing_type=all&show_type=PR">&laquo;Home</a><br/>
        {if !$search_alpha}
			<div class="attention" >
                    {lang->desc p1='search' p2=$lang_set p3='search'} {lang->desc p1='search' p2=$lang_set p3='result'}: {if $ispromotion eq 1}{$promotion_result_count}{else}{$result_found}{/if}
        	</div>
          {else}
         	<div class="attention">
                    {lang->desc p1='search' p2=$lang_set p3='search'} {lang->desc p1='search' p2=$lang_set p3=$search_type}: {lang->desc p1='search' p2=$lang_set p3='keyword'}&raquo;({$search_char}) , {lang->desc p1='search' p2=$lang_set p3='result'}: {$result_found}
        	</div>
          {/if}

        {if $list != ""}
		<br /><br />
	        <!--<ul data-role="listview"  data-filter="true" data-inset="true">
			    {section name=itm loop=$list}
				    {assign var="subfile" value=$list[itm].subfile}
			        {include file="$deftpl/sublist/$subfile"}
			    {/section}
			</ul>-->
				{include file="$deftpl/post-loops.tpl"}

        		{if $paginate.total > $vs_config.search_page}
        		         <div align=center style="font-size: 10pt; font-weight: normal; color: black;">
        		           {paginate_prev}{paginate_middle format='page' prefix='[' suffix=']' page_limit='10'}{paginate_next}
        		          </div>

        		{/if}

        {else}
            {if $byconnections}
                <div class="fail">
                    There are no promotions posted by Connections.
                </div>
            {elseif $bygroupmem}
                <div class="fail">
                    There are no promotions posted by Group Members.
                </div>
            {else}
                <div class="fail">
        		    {lang->desc p1='search' p2=$lang_set p3='not_found'}
                </div>
            {/if}

        {/if}
    </td>
</tr>
<tr>
<td>
	{if $clist != ""}
		<center>{lang->desc p1='search' p2=$lang_set p3='rec_cat_list'}</center>
          {html_table_adv loop=$clist cols=2 inner=cols table_attr='width=100% border=0 cellpadding=4 cellspacing=4 style="font-size: 14px; font-weight: bold; color: #999999;"'}
                 [[href]]
          {/html_table_adv}
        {/if}
</td>
</tr>
</table>
</center>



{*****************************************

   Display Footer

******************************************}
{include file="$deftpl/sitefoot.tpl"}
