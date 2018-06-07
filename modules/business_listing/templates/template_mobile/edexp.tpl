{*****************************************

    Edit Expiration Periods Template
          phpDirectorySource

******************************************}
{*****************************************

   Get Template Config Variables

******************************************}
{config_load file="$deftpl/system.conf" section='edexp'}
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

        <form action=edexp.php method=post class="job_detail_view">
{if $notice != ""}
         <div class="fail">
				 {$notice}
		 </div>
{/if}

		 <table width=100%>
          <tr>
           <td align=center>
            {lang->select p1='exp_pd' p2=$lang_set p3=$sel_prop}
			</tr>
          <tr>
           <td align=center>
            <input type=submit name=change value="{lang->desc p1='edexp' p2=$lang_set p3='btn_change'}" class="blackbutton" style="width:70px;">
            <input type=submit name=delete value="{lang->desc p1='edexp' p2=$lang_set p3='btn_delete'}" class="blackbutton" style="width:70px;">
           </td>
          </tr>
          <tr>
           <td align=center>
            <input type=submit name=new value="{lang->desc p1='edexp' p2=$lang_set p3='btn_new'}" class="blackbutton" style="width:70px;">
           </td>
          </tr>
  
         </table>
        </form>
        
        
        
  {if $page == 'add' or $page == 'change'}
        <form class="job_detail_view" action=edexp.php method=post>
         <table width=100%>
          <tr>
           <th colspan=2 >

    {if $page == 'add'}
             {lang->desc p1='edexp' p2=$lang_set p3='add_title'}
    {else}
             {lang->desc p1='edexp' p2=$lang_set p3='change_title'}
    {/if}

           </th>
          </tr>
          <tr>
           <td class="right_td">
			{lang->desc p1='pds_exp' p2=$lang_set p3='title'}
           </td>
           <td class="left_td">
            <input type=text name=title value="{$vs_expire[$exp_pd].title}">
           </td>
          </tr>
          <tr>
           <td class="right_td">
             {lang->desc p1='pds_exp' p2=$lang_set p3='days'}
            </td>
           <td class="left_td">
            <input type=text name=days value="{$vs_expire[$exp_pd].days}">
           </td>
          </tr>
          <tr>
           <td colspan=2 align=center bgcolor="{#form_btn_bgcolor#}">

    {if $page == 'change'}
              <input type=hidden name=chg_exp value={$exp_pd}>
              <input type=submit name=change_exp value="{lang->desc p1='edexp' p2=$lang_set p3='btn_change'}" style="font-size:{#submit_btn_font_size#}; background-color:{#submit_btn_bgcolor#};" class="blackbutton" style="width:70px;">
    {/if}
    {if $page == 'add'}
              <input type=submit name=add_exp value="{lang->desc p1='edexp' p2=$lang_set p3='btn_add'}" class="blackbutton" style="width:70px;">
    {/if}
            </font>
           </td>
          </tr>
         </table>
        </form>
  {/if}
  {if $page == 'confirm'}
        <form class="job_detail_view" action=edexp.php method=post>
         <table width=100%>
          <tr>
           <td colspan="2" class="fail">
             {lang->desc p1='edexp' p2=$lang_set p3='delete_confirm'}: {$vs_expire[$exp_pd].title}

	 		</td>
          </tr>
          <tr>
           <td colspan=2 align=center  >

             <input type=hidden name=del_exp value={$exp_pd}>
             <input type=submit name=delete_confirm value="{lang->desc p1='edexp' p2=$lang_set p3='btn_confirm'}" class="blackbutton" style="width:100px;">
             <input type=submit name=no_confirm value="{lang->desc p1='edexp' p2=$lang_set p3='btn_cancel'}" class="blackbutton" style="width:100px;">

           </td>
          </tr>
		 </table>
		</form>
  {/if}
{/if}
        <table class="myTABLE" width="100%" align="center" >
         <tr class="odd">
          <td class="column1" style="color:#17a;" width="15%">
           {lang->desc p1='pds_exp' p2=$lang_set p3='id'}
          </td>
          <td class="column1" style="color:#17a;" width="65%">
           {lang->desc p1='pds_exp' p2=$lang_set p3='title'}
          </td>
          <td class="column1" style="color:#17a;" width="20%">
           {lang->desc p1='pds_exp' p2=$lang_set p3='days'}
          </td>
         </tr>
{section name=itm loop=$vs_expire_ct}
        {assign var=lvl value=$vs_expire_ct[itm]}
         <tr>
          <td class="column1" width="15%">
           {$vs_expire[$lvl].id}
          </td>
          <td class="column1" width="65%">
           {$vs_expire[$lvl].title}
          </td>
          <td class="column1" width="20%">
           {$vs_expire[$lvl].days}
          </td>
         </tr>
{/section}
        </table>
{*****************************************

   Display Footer

******************************************}
{include file="$deftpl/sitefoot.tpl"}
