{*****************************************

     Membership Comparison Template
          phpDirectorySource

******************************************}
{*****************************************

   Get Template Config Variables

******************************************}
{config_load file="$deftpl/system.conf" section='compare'}
{*****************************************

   Comparison Chart

******************************************}

         

<center>
<span style="font-size:16px; font-weight:bolder; line-height:40px; color:{#chart_title_font_color#}; ">{lang->desc p1='compare' p2=$lang_set p3='title'}</span>
{section name=tbl loop=$vs_level_ct step=#member_cols#}
  <table class="myTABLE" >
  <thead>
         <tr class="odd">
          <td class="column1">
           
          </td>
  {section name=itm loop=$vs_level_ct start=$smarty.section.tbl.index max=#member_cols#}
          <td    bgcolor={#chart_title_bgcolor#}>
           <font style="color:{#chart_title_font_color#}; font-size:{#chart_title_font_size#}; font-weight:{#chart_title_font_weight#}; background-color:{#chart_title_font_bgcolor#};">
		    {assign var=lvl value=$vs_level_ct[itm]}
            {$vs_level[$lvl].title}
           </font>
          </td>
  {/section}
         </tr>
  </thead>
  <tfoot>
         <tr>
           <td  class="column1">{lang->desc p1='pds_level' p2=$lang_set p3='cost'}
          </td>
  {section name=itm loop=$vs_level_ct start=$smarty.section.tbl.index max=#member_cols#}
          <td  >
           <font style="color:{#chart_field_font_color#}; font-size:{#chart_field_font_size#}; font-weight:{#chart_field_font_weight#}; background-color:{#chart_field_font_bgcolor#};">
            {assign var=lvl value=$vs_level_ct[itm]}{$vs_level[$lvl].cost}
           </font>
          </td>
  {/section}
         </tr>
         <tr>
         <td  class="column1">{lang->desc p1='compare' p2=$lang_set p3='expire'}</td>
  {section name=itm loop=$vs_level_ct start=$smarty.section.tbl.index max=#member_cols#}
          <td >
           <font style="color:{#chart_field_font_color#}; font-size:{#chart_field_font_size#}; font-weight:{#chart_field_font_weight#}; background-color:{#chart_field_font_bgcolor#};">
          {assign var=lvl value=$vs_level_ct[itm]}&nbsp;{$vs_level[$lvl].expire}&nbsp;{$vs_level[$lvl].exp_title}
		  </font></td>
  {/section}
         </tr>
         <tr>
          <td  class="column1">{lang->desc p1='pds_level' p2=$lang_set p3='premium'}
           </td>
    {section name=itm loop=$vs_level_ct start=$smarty.section.tbl.index max=#member_cols#}
		   {assign var=lvl value=$vs_level_ct[itm]}
          <td  >
      {if $vs_level[$lvl].premium}
           <img src="templates/{$deftpl}/images/icon-check.gif"/>
      {else}
            
      {/if}
          </td>
    {/section}
         </tr>
  {if $enabled.description}
         <tr>
         <td  class="column1">{lang->desc p1='pds_level' p2=$lang_set p3='description'}
           </font>
          </td>
    {section name=itm loop=$vs_level_ct start=$smarty.section.tbl.index max=#member_cols#}
		   {assign var=lvl value=$vs_level_ct[itm]}
          <td  >
      {if $vs_level[$lvl].description}
          <img src="templates/{$deftpl}/images/icon-check.gif"/>
      {else}
            
      {/if}
          </td>
    {/section}
         </tr>
  {/if}
  {if $enabled.address}
         <tr>
         <td  class="column1">{lang->desc p1='pds_level' p2=$lang_set p3='address'}

          </td>
    {section name=itm loop=$vs_level_ct start=$smarty.section.tbl.index max=#member_cols#}
		   {assign var=lvl value=$vs_level_ct[itm]}
          <td  >
      {if $vs_level[$lvl].addr1}
           <img src="templates/{$deftpl}/images/icon-check.gif"/>
      {else}
            
      {/if}
          </td>
    {/section}
         </tr>
  {/if}
  {if $enabled.contact}
         <tr>
        <td  class="column1">    {lang->desc p1='pds_level' p2=$lang_set p3='contact'}

          </td>
    {section name=itm loop=$vs_level_ct start=$smarty.section.tbl.index max=#member_cols#}
		   {assign var=lvl value=$vs_level_ct[itm]}
          <td  >
      {if $vs_level[$lvl].contact}
           <img src="templates/{$deftpl}/images/icon-check.gif"/>
      {else}
            
      {/if}
          </td>
    {/section}
         </tr>
  {/if}
  {if $enabled.phone}
         <tr>
         <td  class="column1">   {lang->desc p1='pds_level' p2=$lang_set p3='phone'}
           </font>
          </td>
    {section name=itm loop=$vs_level_ct start=$smarty.section.tbl.index max=#member_cols#}
		   {assign var=lvl value=$vs_level_ct[itm]}
          <td  >
      {if $vs_level[$lvl].phone}
           <img src="templates/{$deftpl}/images/icon-check.gif"/>
      {else}
            
      {/if}
          </td>
    {/section}
         </tr>
  {/if}
  {if $enabled.fax}
         <tr>
         <td  class="column1">   {lang->desc p1='pds_level' p2=$lang_set p3='fax'}
           </font>
          </td>
    {section name=itm loop=$vs_level_ct start=$smarty.section.tbl.index max=#member_cols#}
		   {assign var=lvl value=$vs_level_ct[itm]}
          <td  >
      {if $vs_level[$lvl].fax}
           <img src="templates/{$deftpl}/images/icon-check.gif"/>
      {else}
            
      {/if}
          </td>
    {/section}
         </tr>
  {/if}
  {if $enabled.mobile}
         <tr>
         <td  class="column1">  {lang->desc p1='pds_level' p2=$lang_set p3='mobile'}
           </font>
          </td>
    {section name=itm loop=$vs_level_ct start=$smarty.section.tbl.index max=#member_cols#}
		   {assign var=lvl value=$vs_level_ct[itm]}
          <td  >
      {if $vs_level[$lvl].mobile}
           <img src="templates/{$deftpl}/images/icon-check.gif"/>
      {else}
            
      {/if}
          </td>
    {/section}
         </tr>
  {/if}
  {if $enabled.loc1}
         <tr>
          	<td  class="column1">  {lang->desc p1='pds_level' p2=$lang_set p3='loc1'}
           </td>
    {section name=itm loop=$vs_level_ct start=$smarty.section.tbl.index max=#member_cols#}
		   {assign var=lvl value=$vs_level_ct[itm]}
          <td  >
      {if $vs_level[$lvl].loc1}
           <img src="templates/{$deftpl}/images/icon-check.gif"/>
      {else}
            
      {/if}
          </td>
    {/section}
         </tr>
  {/if}
  {if $enabled.website}
         <tr>
          	<td  class="column1">  {lang->desc p1='pds_level' p2=$lang_set p3='website'}
           </td>
    {section name=itm loop=$vs_level_ct start=$smarty.section.tbl.index max=#member_cols#}
		   {assign var=lvl value=$vs_level_ct[itm]}
          <td  >
      {if $vs_level[$lvl].website}
           <img src="templates/{$deftpl}/images/icon-check.gif"/>
      {else}
            
      {/if}
          </td>
    {/section}
         </tr>
  {/if}
  {if $enabled.listmail}
         <tr>
          	<td  class="column1">  {lang->desc p1='pds_level' p2=$lang_set p3='listmail'}
            </td>
    {section name=itm loop=$vs_level_ct start=$smarty.section.tbl.index max=#member_cols#}
		   {assign var=lvl value=$vs_level_ct[itm]}
          <td  >
      {if $vs_level[$lvl].listmail}
           <img src="templates/{$deftpl}/images/icon-check.gif"/>
      {else}
            
      {/if}
          </td>
    {/section}
         </tr>
  {/if}
         <tr>
         	<td  class="column1">  {lang->desc p1='pds_level' p2=$lang_set p3='logo'}
          </td>
    {section name=itm loop=$vs_level_ct start=$smarty.section.tbl.index max=#member_cols#}
		   {assign var=lvl value=$vs_level_ct[itm]}
          <td  >
      {if $vs_level[$lvl].logo}
           <img src="templates/{$deftpl}/images/icon-check.gif"/>
      {else}
            
      {/if}
          </td>
    {/section}
         </tr>
         <tr>
         	<td  class="column1">  {lang->desc p1='pds_level' p2=$lang_set p3='cats'}
            </td>
  {section name=itm loop=$vs_level_ct start=$smarty.section.tbl.index max=#member_cols#}
          <td  >
           <font style="color:{#chart_field_font_color#}; font-size:{#chart_field_font_size#}; font-weight:{#chart_field_font_weight#}; background-color:{#chart_field_font_bgcolor#};">
            {assign var=lvl value=$vs_level_ct[itm]}
            {$vs_level[$lvl].cats}
           </font>
          </td>
  {/section}
         </tr>
  {if $enabled.xtra_1}
         <tr>
          	<td  class="column1"> {lang->desc p1='pds_level' p2=$lang_set p3='xtra_1'}
           </td>
    {section name=itm loop=$vs_level_ct start=$smarty.section.tbl.index max=#member_cols#}
		   {assign var=lvl value=$vs_level_ct[itm]}
          <td  >
      {if $vs_level[$lvl].xtra_1}
           <img src="templates/{$deftpl}/images/icon-check.gif"/>
      {else}
            
      {/if}
          </td>
    {/section}
         </tr>
  {/if}
  {if $enabled.xtra_2}
         <tr>
          	<td  class="column1"> {lang->desc p1='pds_level' p2=$lang_set p3='xtra_2'}
           </td>
    {section name=itm loop=$vs_level_ct start=$smarty.section.tbl.index max=#member_cols#}
		   {assign var=lvl value=$vs_level_ct[itm]}
           <td  >
     {if $vs_level[$lvl].xtra_2}
           <img src="templates/{$deftpl}/images/icon-check.gif"/>
      {else}
            
      {/if}
          </td>
    {/section}
         </tr>
  {/if}
  {if $enabled.xtra_3}
         <tr>
          	<td  class="column1"> {lang->desc p1='pds_level' p2=$lang_set p3='xtra_3'}
          </td>
    {section name=itm loop=$vs_level_ct start=$smarty.section.tbl.index max=#member_cols#}
		   {assign var=lvl value=$vs_level_ct[itm]}
          <td  >
      {if $vs_level[$lvl].xtra_3}
           <img src="templates/{$deftpl}/images/icon-check.gif"/>
      {else}
            
      {/if}
          </td>
    {/section}
         </tr>
  {/if}
  {if $enabled.xtra_4}
         <tr>
          	<td  class="column1">{lang->desc p1='pds_level' p2=$lang_set p3='xtra_4'}
           </td>
    {section name=itm loop=$vs_level_ct start=$smarty.section.tbl.index max=#member_cols#}
		   {assign var=lvl value=$vs_level_ct[itm]}
          <td  >
      {if $vs_level[$lvl].xtra_4}
           <img src="templates/{$deftpl}/images/icon-check.gif"/>
      {else}
            
      {/if}
          </td>
    {/section}
         </tr>
  {/if}
  {if $enabled.xtra_5}
         <tr>
          	<td  class="column1">{lang->desc p1='pds_level' p2=$lang_set p3='xtra_5'}
          </td>
    {section name=itm loop=$vs_level_ct start=$smarty.section.tbl.index max=#member_cols#}
		   {assign var=lvl value=$vs_level_ct[itm]}
           <td  >
      {if $vs_level[$lvl].xtra_5}
           <img src="templates/{$deftpl}/images/icon-check.gif"/>
      {else}
            
      {/if}
          </td>
    {/section}
         </tr>
  {/if}
  {if $enabled.xtra_6}
         <tr>
         	<td  class="column1">{lang->desc p1='pds_level' p2=$lang_set p3='xtra_6'}</td>
    {section name=itm loop=$vs_level_ct start=$smarty.section.tbl.index max=#member_cols#}
		   {assign var=lvl value=$vs_level_ct[itm]}
          <td  >
      {if $vs_level[$lvl].xtra_6}
           <img src="templates/{$deftpl}/images/icon-check.gif"/>
      {else}
            
      {/if}
          </td>
    {/section}
         </tr>
  {/if}
  {if $enabled.custom_1}
         <tr>
          	<td  class="column1">{lang->desc p1='pds_level' p2=$lang_set p3='custom_1'}</td>
    {section name=itm loop=$vs_level_ct start=$smarty.section.tbl.index max=#member_cols#}
		   {assign var=lvl value=$vs_level_ct[itm]}
          <td  >
      {if $vs_level[$lvl].custom_1}
           <img src="templates/{$deftpl}/images/icon-check.gif"/>
      {else}
            
      {/if}
          </td>
    {/section}
         </tr>
  {/if}
  {if $enabled.custom_2}
         <tr>
          	<td  class="column1">{lang->desc p1='pds_level' p2=$lang_set p3='custom_2'}</td>
    {section name=itm loop=$vs_level_ct start=$smarty.section.tbl.index max=#member_cols#}
		   {assign var=lvl value=$vs_level_ct[itm]}
          <td  >
      {if $vs_level[$lvl].custom_2}
           <img src="templates/{$deftpl}/images/icon-check.gif"/>
      {else}
            
      {/if}
          </td>
    {/section}
         </tr>
  {/if}
  {if $enabled.custom_3}
         <tr>
 			<td  class="column1">{lang->desc p1='pds_level' p2=$lang_set p3='custom_3'}</td>
    {section name=itm loop=$vs_level_ct start=$smarty.section.tbl.index max=#member_cols#}
		   {assign var=lvl value=$vs_level_ct[itm]}
          <td  >
      {if $vs_level[$lvl].custom_3}
           <img src="templates/{$deftpl}/images/icon-check.gif"/>
      {else}
            
      {/if}
          </td>
    {/section}
         </tr>
  {/if}
  {if $enabled.custom_4}
         <tr>
          <td  class="column1">{lang->desc p1='pds_level' p2=$lang_set p3='custom_4'}</td>
    {section name=itm loop=$vs_level_ct start=$smarty.section.tbl.index max=#member_cols#}
		   {assign var=lvl value=$vs_level_ct[itm]}
          <td  >
      {if $vs_level[$lvl].custom_4}
           <img src="templates/{$deftpl}/images/icon-check.gif"/>
      {else}
            
      {/if}
          </td>
    {/section}
         </tr>
  {/if}
  {if $enabled.custom_5}
         <tr>
 			<td  class="column1">

            {lang->desc p1='pds_level' p2=$lang_set p3='custom_5'}

          </td>
    {section name=itm loop=$vs_level_ct start=$smarty.section.tbl.index max=#member_cols#}
		   {assign var=lvl value=$vs_level_ct[itm]}
          <td  >
      {if $vs_level[$lvl].custom_5}
           <img src="templates/{$deftpl}/images/icon-check.gif"/>
      {else}
            
      {/if}
          </td>
    {/section}
         </tr>
  {/if}
  {if $enabled.custom_6}
         <tr>
         	<td  class="column1">{lang->desc p1='pds_level' p2=$lang_set p3='custom_6'}</td>
    {section name=itm loop=$vs_level_ct start=$smarty.section.tbl.index max=#member_cols#}
		   {assign var=lvl value=$vs_level_ct[itm]}
          <td>
      {if $vs_level[$lvl].custom_6}
           <img src="templates/{$deftpl}/images/icon-check.gif"/>
      {else}
            
      {/if}
          </td>
    {/section}
         </tr>
  {/if}
  </tfoot>
        </table>

{/section}
</center>
