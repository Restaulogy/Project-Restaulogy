 {*****************************************

        Search Results Template
          phpDirectorySource

******************************************}
{*****************************************

   Get Template Config Variables

******************************************}
{config_load file="$deftpl/system.conf" section='searchPa'}
{*****************************************

   Display Header

******************************************}
{include file="$deftpl/sitehead.tpl"}
{*****************************************

   Page Display

******************************************}

{if $list != ""}
{if $search_keywords}
	<div class="attention">
        {$search_keywords}  &nbsp;Result found ={$result_found}
	</div>
{/if}

 {section name=itm loop=$list}
    {assign var="subfile" value=$list[itm].subfile}
    {include file="$deftpl/sublist/$subfile"}
  {/section}

{if $paginate.total > $vs_config.search_page}
         <div align=center style="font-size: 10pt; font-weight: normal; color: black;">
           {paginate_prev}{paginate_middle format='page' prefix='[' suffix=']' page_limit='10'}{paginate_next}
          </div>

{/if}

{else}
        <div class="fail">
		    {lang->desc p1='search' p2=$lang_set p3='not_found'}
        </div>

{/if}

     {if $clist != ""}
            <table width = 100%>
             <tr>
              <td align=center bgcolor="{#table_std_bgcolor#}">
               <font style="color:{#table_std_font_color#}; font-size:{#table_std_font_size#}; font-weight:bold; background-color:{#table_std_font_bgcolor#};">
                {lang->desc p1='search' p2=$lang_set p3='rec_cat_list'}
               </font>
              </td>
             </tr>
            </table>
      {html_table_adv loop=$clist cols=2 inner=cols table_attr='width=100% border=0 cellpadding=4 cellspacing=4 style="font-size: 14px; font-weight: bold; color: #999999;"'}
             [[href]]
      {/html_table_adv}
    {/if}
{*****************************************

   Display Footer

******************************************}
{include file="$deftpl/sitefoot.tpl"}
