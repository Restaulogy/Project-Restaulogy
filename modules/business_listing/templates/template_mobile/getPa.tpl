{include file="$deftpl/breadcrumb_title.tpl"}



{config_load file="$deftpl/system.conf" section='index'}

{if $cat_head_file != ""}
  {include file=$cat_head_file}<br>
{elseif !$cat_id}
        <table  width=100% border=0 cellspacing=1 cellpadding=0>
         <tr>
          <td align=center style="line-height:30px; font-size:16px; font-weight:bolder; background:#17a; color: white;">
           {lang->desc p1='site_text' p2=$lang_set p3='main_content_head'}
          </td>
         </tr>
        </table>
{/if}

{*************************
for the showing categories
**************************}
 {if count($categories) > 0 }
    	{if $main_cat == 1}
			  {html_table_adv loop=$categories cols=1 inner=#cat_disp_order# table_attr='width=100% border=0 cellpadding=2 cellspacing=2 style="font-size: 14px; font-weight: bold; color: #999999; "'}

			        <table class="myTABLE"  style="MARGIN: 0px auto;  width:100%;" border="0" cellspacing="0" cellpadding="0">
			        <tr class="odd">
			               <th  align="left" style="BACKGROUND: #b1d8fe; font-size: 14px; font-weight: bold; color: #333333;"/><img src="templates/{$deftpl}/images/rightarrow.png" />&nbsp;[[href]] ([[listcount]])</th>
			          </tr>
			          <tr >
					   <td class="column1" style="background:white;" >[[sub]]</td>
			          </tr>
			         </table>
			  {/html_table_adv}
	{elseif $main_cat ==0}
            {html_table_adv loop=$categories  cols=1 inner=#cat_disp_order# table_attr='width=100% border=0 style="font-size: 14px; font-weight: bold; color: #999999;"'}
			        <!-- [[href]] -->
			       <table class="myTABLE"  style="MARGIN: 0px auto;  width:100%;" border="0" cellspacing="0" cellpadding="0">
			        <tr class="odd">
			               <th  align="left" style="BACKGROUND: #b1d8fe; font-size: 14px; font-weight: bold; color: #333333;"/><img src="templates/{$deftpl}/images/rightarrow.png" />&nbsp;[[href]] ([[listcount]])</th>
			          </tr>
			         </table>
			  {/html_table_adv}

    {/if}
{/if}
        
{if $list != ""}
<br>
  			{section name=itm loop=$list}
    			{assign var="subfile" value=$list[itm].subfile}
    			{include file="$deftpl/sublist/$subfile"}
  			{/section}

  {if $paginate_list.total > $vs_config.lists_page}
        
		 <div align=center style="font-size: 10pt; font-weight: normal; color: black;">
		  		{paginate_prev id="list"}{paginate_middle id="list" format='page' prefix='[' suffix=']' page_limit='10'}{paginate_next id="list"}
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
{if $paginate_cat.total > $vs_config.cats_page}
           <div align=center style="font-size: 10pt; font-weight: normal; color: black;">

  {if $vs_config.rewrite}
           {paginate_prev rewrite=$mod_title cat=$cat_id id="cat"}{paginate_middle rewrite=$mod_title cat=$cat_id id="cat" format='page' prefix='[' suffix=']' page_limit='10'}{paginate_next rewrite=$mod_title cat=$cat_id id="cat"}
  {else}
           {paginate_prev id="cat"}{paginate_middle id="cat" format='page' prefix='[' suffix=']' page_limit='10'}{paginate_next id="cat"}
  {/if}

          </div>

{/if}
{if !$categories AND !$list}
        <div class="fail">
            {lang->desc p1='site_text' p2=$lang_set p3='no_list_found'}
        </div>
{/if}


