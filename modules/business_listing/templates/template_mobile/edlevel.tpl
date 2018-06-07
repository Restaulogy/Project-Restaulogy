{*****************************************

     Edit Membership Level Template 
          phpDirectorySource

******************************************}

{*****************************************

   Get Template Config Variables

******************************************}
{config_load file="$deftpl/system.conf" section='edlevel'}
{*****************************************

   Display Header

******************************************}
{include file="$deftpl/sitehead.tpl"}
{*****************************************

   Page Display

******************************************}
{if $vs_current_admin.f_full or $vs_current_admin.f_level}

 {**********************************************
  Admin priveledges exist for editing level
 ***********************************************}


<form action=edlevel.php method=post class="job_detail_view">
    {if $notice != ""}
	    	<div class="fail">
            {$notice}
            </div>
	{/if}

         <table width=100%>
          <tr>
           <td align=center>
            {lang->select p1='mem_level' p2=$lang_set p3=$sel_prop}
           </td>
          </tr>
          <tr>
           <td align=center>
            <input type=submit name=change value="{lang->desc p1='edlevel' p2=$lang_set p3='btn_change'}"  class="blackbutton" style="width:100px;" />
            <input type=submit name=delete value="{lang->desc p1='edlevel' p2=$lang_set p3='btn_delete'}"  class="blackbutton" style="width:100px;">
           </td>
          </tr>
          <tr>
           <td align=center>
            <input type=submit name=new value="{lang->desc p1='edlevel' p2=$lang_set p3='btn_new'}"  class="blackbutton" style="width:100px;">
           </td>
          </tr>
         </table>


        </form>
  {if $page == 'add' or $page == 'change'}
        <form action=edlevel.php method=post class="job_detail_view">
         <table width=100%>
          <tr>
           <th colspan="2">

    {if $page == 'add'}
             {lang->desc p1='edlevel' p2=$lang_set p3='add_title'}
    {else}
             {lang->desc p1='edlevel' p2=$lang_set p3='change_title'}
    {/if}

           </th>
          </tr>
          <tr>
           <td  class="right_td">

             {lang->desc p1='pds_level' p2=$lang_set p3='title'}

           </td>
           <td class="left_td">

             <input type=text name=title value="{$vs_level[$level_id].title}">

           </td>
          </tr>
          <tr>
           <td class="right_td">

             {lang->desc p1='pds_level' p2=$lang_set p3='cost'}

           </td>
           <td class="left_td">

             <input type=text name="cost" value="{$vs_level[$level_id].cost}">

           </td>
          </tr>
          <tr>
           <td class="right_td">
             {lang->desc p1='pds_level' p2=$lang_set p3='expire'}
           </td>
           <td class="left_td">

             <input type=text name=expire size=4 value="{$vs_level[$level_id].expire}">


           </td>
          </tr>
          <tr>
           <td class="right_td">

             {lang->desc p1='pds_level' p2=$lang_set p3='premium'}
           </td>
           <td class="left_td">

             <input type=text name="premium" value="{$vs_level[$level_id].premium}">

           </td>
          </tr>
    {if $enabled.description}
          <tr>
           <td class="right_td">
             {lang->desc p1='pds_level' p2=$lang_set p3='description'}

           </td>
           <td class="left_td">

      {if  $vs_level[$level_id].description}
             <input style="width:25px;" type=checkbox name=description value=1 checked>
      {else}
             <input style="width:25px;"  type=checkbox name=description value=1>
      {/if}

           </td>
          </tr>
    {/if}
    {if $enabled.address}
          <tr>
           <td class="right_td">
             {lang->desc p1='pds_level' p2=$lang_set p3='address'}

           </td>
           <td class="left_td">

      {if  $vs_level[$level_id].addr1}
             <input style="width:25px;" type=checkbox name=address value=1 checked>
      {else}
             <input style="width:25px;" type=checkbox name=address value=1>
      {/if}

           </td>
          </tr>
    {/if}
    {if $enabled.zip}
          <tr>
           <td class="right_td">
             {lang->desc p1='pds_level' p2=$lang_set p3='zip'}

           </td>
           <td class="left_td">

      {if  $vs_level[$level_id].zip}
             <input style="width:25px;" type=checkbox name=zip value=1 checked>
      {else}
             <input style="width:25px;" type=checkbox name=zip value=1>
      {/if}

           </td>
          </tr>
    {/if}
    {if $enabled.contact}
          <tr>
          <td class="right_td">
             {lang->desc p1='pds_level' p2=$lang_set p3='contact'}

           </td>
           <td class="left_td">

      {if  $vs_level[$level_id].contact}
             <input  style="width:25px;" type=checkbox name=contact value=1 checked>
      {else}
             <input  style="width:25px;" type=checkbox name=contact value=1>
      {/if}

           </td>
          </tr>
    {/if}
    {if $enabled.phone}
          <tr>
          <td class="right_td">
             {lang->desc p1='pds_level' p2=$lang_set p3='phone'}

           </td>
           <td class="left_td">

      {if  $vs_level[$level_id].phone}
             <input  style="width:25px;" type=checkbox name=phone value=1 checked>
      {else}
             <input  style="width:25px;" type=checkbox name=phone value=1>
      {/if}

           </td>
          </tr>
    {/if}
    {if $enabled.fax}
          <tr>
           <td class="right_td">

             {lang->desc p1='pds_level' p2=$lang_set p3='fax'}

           </td>
           <td class="left_td">

      {if  $vs_level[$level_id].fax}
             <input  style="width:25px;" type=checkbox name=fax value=1 checked>
      {else}
             <input  style="width:25px;" type=checkbox name=fax value=1>
      {/if}

           </td>
          </tr>
    {/if}
    {if $enabled.mobile}
          <tr>
           <td class="right_td">
             {lang->desc p1='pds_level' p2=$lang_set p3='mobile'}

           </td>
           <td class="left_td">

      {if  $vs_level[$level_id].mobile}
             <input  style="width:25px;" type=checkbox name=mobile value=1 checked>
      {else}
             <input  style="width:25px;" type=checkbox name=mobile value=1>
      {/if}

           </td>
          </tr>
    {/if}
    {if $enabled.loc1}
          <tr>
          <td class="right_td">
             {lang->desc p1='pds_level' p2=$lang_set p3='loc1'}

           </td>
           <td class="left_td">

      {if  $vs_level[$level_id].loc1}
             <input  style="width:25px;" type=checkbox name=loc1 value=1 checked>
      {else}
             <input  style="width:25px;" type=checkbox name=loc1 value=1>
      {/if}

           </td>
          </tr>
    {/if}
    {if $enabled.website}
          <tr>
           <td class="right_td">
             {lang->desc p1='pds_level' p2=$lang_set p3='website'}

           </td>
           <td class="left_td">

      {if  $vs_level[$level_id].website}
             <input  style="width:25px;" type=checkbox name=website value=1 checked>
      {else}
             <input  style="width:25px;" type=checkbox name=website value=1>
      {/if}

           </td>
          </tr>
    {/if}
    {if $enabled.listmail}
          <tr>
           <td class="right_td">
             {lang->desc p1='pds_level' p2=$lang_set p3='listmail'}

           </td>
           <td class="left_td">

      {if  $vs_level[$level_id].listmail}
             <input  style="width:25px;" type=checkbox name=listmail value=1 checked>
      {else}
             <input  style="width:25px;" type=checkbox name=listmail value=1>
      {/if}

           </td>
          </tr>
    {/if}
          <tr>
           <td class="right_td">
             {lang->desc p1='pds_level' p2=$lang_set p3='logo'}

           </td>
           <td class="left_td">

      {if  $vs_level[$level_id].logo}
             <input  style="width:25px;" type=checkbox name=logo value=1 checked>
      {else}
             <input  style="width:25px;" type=checkbox name=logo value=1>
      {/if}

           </td>
          </tr>
          <tr>
           <td class="right_td">
             {lang->desc p1='pds_level' p2=$lang_set p3='cats'}

           </td>
           <td class="left_td">

             <input type=text name=cats size=4 value="{$vs_level[$level_id].cats}">

           </td>
          </tr>
    {if $enabled.xtra_1}
          <tr>
           <td class="right_td">
             {lang->desc p1='pds_level' p2=$lang_set p3='xtra_1'}

           </td>
           <td class="left_td">

      {if  $vs_level[$level_id].xtra_1}
             <input  style="width:25px;" type=checkbox name=xtra_1 value=1 checked>
      {else}
             <input  style="width:25px;" type=checkbox name=xtra_1 value=1>
      {/if}

           </td>
          </tr>
    {/if}
    {if $enabled.xtra_2}
          <tr>
           <td class="right_td">
             {lang->desc p1='pds_level' p2=$lang_set p3='xtra_2'}

           </td>
           <td class="left_td">

      {if  $vs_level[$level_id].xtra_2}
             <input  style="width:25px;" type=checkbox name=xtra_2 value=1 checked>
      {else}
             <input  style="width:25px;" type=checkbox name=xtra_2 value=1>
      {/if}

           </td>
          </tr>
    {/if}
    {if $enabled.xtra_3}
          <td class="right_td">
             {lang->desc p1='pds_level' p2=$lang_set p3='xtra_3'}

           </td>
           <td class="left_td">

      {if  $vs_level[$level_id].xtra_3}
             <input  style="width:25px;" type=checkbox name=xtra_3 value=1 checked>
      {else}
             <input  style="width:25px;" type=checkbox name=xtra_3 value=1>
      {/if}

           </td>
          </tr>
    {/if}
    {if $enabled.xtra_4}
          <tr>
           <td class="right_td">
             {lang->desc p1='pds_level' p2=$lang_set p3='xtra_4'}

           </td>
           <td class="left_td">

      {if  $vs_level[$level_id].xtra_4}
             <input  style="width:25px;" type=checkbox name=xtra_4 value=1 checked>
      {else}
             <input  style="width:25px;" type=checkbox name=xtra_4 value=1>
      {/if}

           </td>
          </tr>
    {/if}
    {if $enabled.xtra_5}
          <tr>
           <td class="right_td">
             {lang->desc p1='pds_level' p2=$lang_set p3='xtra_5'}

           </td>
           <td class="left_td">

      {if  $vs_level[$level_id].xtra_5}
             <input  style="width:25px;" type=checkbox name=xtra_1 value=1 checked>
      {else}
             <input  style="width:25px;" type=checkbox name=xtra_5 value=1>
      {/if}

           </td>
          </tr>
    {/if}
    {if $enabled.xtra_6}
          <tr>
           <td class="right_td">
             {lang->desc p1='pds_level' p2=$lang_set p3='xtra_6'}

           </td>
           <td class="left_td">

      {if  $vs_level[$level_id].xtra_6}
             <input  style="width:25px;" type=checkbox name=xtra_6 value=1 checked>
      {else}
             <input  style="width:25px;" type=checkbox name=xtra_6 value=1>
      {/if}

           </td>
          </tr>
    {/if}
    {if $enabled.custom_1}
          <tr>
           <td class="right_td">
             {lang->desc p1='pds_level' p2=$lang_set p3='custom_1'}

           </td>
           <td class="left_td">

      {if  $vs_level[$level_id].custom_1}
             <input  style="width:25px;" type=checkbox name=custom_1 value=1 checked>
      {else}
             <input  style="width:25px;" type=checkbox name=custom_1 value=1>
      {/if}

           </td>
          </tr>
    {/if}
    {if $enabled.custom_2}
          <tr>
          <td class="right_td">
             {lang->desc p1='pds_level' p2=$lang_set p3='custom_2'}

           </td>
           <td class="left_td">

      {if  $vs_level[$level_id].custom_2}
             <input  style="width:25px;" type=checkbox name=custom_2 value=1 checked>
      {else}
             <input  style="width:25px;" type=checkbox name=custom_2 value=1>
      {/if}

           </td>
          </tr>
    {/if}
    {if $enabled.custom_3}
          <tr>
          <td class="right_td">
             {lang->desc p1='pds_level' p2=$lang_set p3='custom_3'}

           </td>
           <td class="left_td">

      {if  $vs_level[$level_id].custom_3}
             <input  style="width:25px;" type=checkbox name=custom_3 value=1 checked>
      {else}
             <input  style="width:25px;" type=checkbox name=custom_3 value=1>
      {/if}

           </td>
          </tr>
    {/if}
    {if $enabled.custom_4}
          <tr>
          <td class="right_td">
             {lang->desc p1='pds_level' p2=$lang_set p3='custom_4'}

           </td>
           <td class="left_td">

      {if  $vs_level[$level_id].custom_4}
             <input  style="width:25px;" type=checkbox name=custom_4 value=1 checked>
      {else}
             <input  style="width:25px;" type=checkbox name=custom_4 value=1>
      {/if}

           </td>
          </tr>
    {/if}
    {if $enabled.custom_5}
          <tr>
           <td class="right_td">
             {lang->desc p1='pds_level' p2=$lang_set p3='custom_5'}

           </td>
           <td class="left_td">

      {if  $vs_level[$level_id].custom_5}
             <input  style="width:25px;" type=checkbox name=custom_5 value=1 checked>
      {else}
             <input  style="width:25px;" type=checkbox name=custom_5 value=1>
      {/if}

           </td>
          </tr>
    {/if}
    {if $enabled.custom_6}
          <tr>
           <td class="right_td">
             {lang->desc p1='pds_level' p2=$lang_set p3='custom_6'}

           </td>
           <td class="left_td">

      {if  $vs_level[$level_id].custom_6}
             <input  style="width:25px;" type=checkbox name=custom_6 value=1 checked>
      {else}
             <input  style="width:25px;" type=checkbox name=custom_6 value=1>
      {/if}

           </td>
          </tr>
    {/if}
          <tr>
           <td colspan="2" align="center">
    {if $page == 'change'}
             <input type=hidden name=chg_level value={$level_id}>
             <input type=submit name=change_level value="{lang->desc p1='edlevel' p2=$lang_set p3='btn_change'}"  class="blackbutton" style="width:100px;">
    {/if}
    {if $page == 'add'}
             <input type=submit name=add_level value="{lang->desc p1='edlevel' p2=$lang_set p3='btn_add'}"  class="blackbutton" style="width:100px;">
    {/if}

           </td>
          </tr>
         </table>
        </form>
  {/if}
  {if $page == 'confirm'}
        <form action=edlevel.php method=post>
         <table width=100%>
          <tr>
           <td colspan=2 >

             {lang->desc p1='edlevel' p2=$lang_set p3='delete_confirm'}: {$vs_expire[$exp_pd].title}

           </td>
          </tr>
          <tr>
           <td colspan=2 >
             <input type=hidden name=del_level value={$level_id}>
             <input type=submit name=delete_confirm value="{lang->desc p1='edlevel' p2=$lang_set p3='btn_confirm'}"  class="blackbutton" style="width:100px;">
             <input type=submit name=no_confirm value="{lang->desc p1='edlevel' p2=$lang_set p3='btn_cancel'}"  class="blackbutton" style="width:100px;">

           </td>
          </tr>
		 </table>
		</form>
  {/if}
{/if}

        {include file="$deftpl/compare.tpl"}
{*****************************************

   Display Footer

******************************************}
{include file="$deftpl/sitefoot.tpl"}
