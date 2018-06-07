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

        <form action=edexp.php method=post>
         <table width=100%>
          <tr>
           <td align=center>
            {lang->select p1='exp_pd' p2=$lang_set p3=$sel_prop} 
            <input type=submit name=change value="{lang->desc p1='edexp' p2=$lang_set p3='btn_change'}" style="font-size:{#submit_btn_font_size#}; background-color:{#submit_btn_bgcolor#};"> 
            <input type=submit name=delete value="{lang->desc p1='edexp' p2=$lang_set p3='btn_delete'}" style="font-size:{#submit_btn_font_size#}; background-color:{#delete_btn_bgcolor#};"> 
           </td>
          </tr>
          <tr>
           <td align=center>
            <input type=submit name=new value="{lang->desc p1='edexp' p2=$lang_set p3='btn_new'}" style="font-size:{#submit_btn_font_size#}; background-color:{#submit_btn_bgcolor#};"> 
           </td>
          </tr>
  {if $notice != ""}
          <tr>
           <td colspan=2 valign=top align=left bgcolor="{#notice_bgcolor#}">
            <font style="color:{#notice_font_color#}; font-size:{#notice_font_size#}; font-weight:{#notice_font_weight#}; background-color:{#notice_font_bgcolor#};">
			 {$notice}
			</font>
           </td>
          </tr>
  {/if}
         </table>
        </form>
  {if $page == 'add' or $page == 'change'}
        <form action=edexp.php method=post>
         <table width=100%>
          <tr>
           <td colspan=2 align=center bgcolor="{#form_title_bgcolor#}">
            <font style="color:{#form_title_font_color#}; font-size:{#form_title_font_size#}; font-weight:{#form_title_font_weight#}; background-color:{#form_title_font_bgcolor#};">
    {if $page == 'add'}
             {lang->desc p1='edexp' p2=$lang_set p3='add_title'}
    {else}
             {lang->desc p1='edexp' p2=$lang_set p3='change_title'}
    {/if}
            </font>
           </td>
          </tr>
          <tr>
           <td align=right bgcolor="{#form_label_bgcolor#}">
            <font style="color:{#form_label_font_color#}; font-size:{#form_label_font_size#}; font-weight:{#form_label_font_weight#}; background-color:{#form_label_font_bgcolor#};">
             {lang->desc p1='pds_exp' p2=$lang_set p3='title'}
            </font>
           </td>
           <td align=left bgcolor="{#form_field_bgcolor#}">
            <input type=text name=title value="{$vs_expire[$exp_pd].title}">
           </td>
          </tr>
          <tr>
           <td align=right bgcolor="{#form_label_bgcolor#}">
            <font style="color:{#form_label_font_color#}; font-size:{#form_label_font_size#}; font-weight:{#form_label_font_weight#}; background-color:{#form_label_font_bgcolor#};">
             {lang->desc p1='pds_exp' p2=$lang_set p3='days'}
            </font>
           </td>
           <td align=left bgcolor="{#form_field_bgcolor#}">
            <input type=text name=days value="{$vs_expire[$exp_pd].days}">
           </td>
          </tr>
          <tr>
           <td colspan=2 align=center bgcolor="{#form_btn_bgcolor#}">
            <font style="color:{#form_btn_font_color#}; font-size:{#form_btn_font_size#}; font-weight:{#form_btn_font_weight#}; background-color:{#form_btn_font_bgcolor#};">
    {if $page == 'change'}
              <input type=hidden name=chg_exp value={$exp_pd}>
              <input type=submit name=change_exp value="{lang->desc p1='edexp' p2=$lang_set p3='btn_change'}" style="font-size:{#submit_btn_font_size#}; background-color:{#submit_btn_bgcolor#};">
    {/if}
    {if $page == 'add'}
              <input type=submit name=add_exp value="{lang->desc p1='edexp' p2=$lang_set p3='btn_add'}" style="font-size:{#submit_btn_font_size#}; background-color:{#submit_btn_bgcolor#};">
    {/if}
            </font>
           </td>
          </tr>
         </table>
        </form>
  {/if}
  {if $page == 'confirm'}
        <form action=edexp.php method=post>
         <table width=100%>
          <tr>
           <td align=left bgcolor="{#notice_bgcolor#}">
            <font style="color:{#notice_font_color#}">
             {lang->desc p1='edexp' p2=$lang_set p3='delete_confirm'}: {$vs_expire[$exp_pd].title}
            </font>
           </td>
          </tr>
          <tr>
           <td colspan=2 align=center bgcolor="{#form_btn_bgcolor#}">
            <font style="color:{#form_btn_font_color#}; font-size:{#form_btn_font_size#}; font-weight:{#form_btn_font_weight#}; background-color:{#form_btn_font_bgcolor#};">
             <input type=hidden name=del_exp value={$exp_pd}>
             <input type=submit name=delete_confirm value="{lang->desc p1='edexp' p2=$lang_set p3='btn_confirm'}" style="font-size:{#submit_btn_font_size#}; background-color:{#delete_btn_bgcolor#};"> 
             <input type=submit name=no_confirm value="{lang->desc p1='edexp' p2=$lang_set p3='btn_cancel'}" style="font-size:{#submit_btn_font_size#}; background-color:{#submit_btn_bgcolor#};">
            </font>
           </td>
          </tr>
		 </table>
		</form>
  {/if}
{/if}
        <table width="100%" border="1">
         <tr>
          <td width="10%">
           {lang->desc p1='pds_exp' p2=$lang_set p3='id'}
          </td>
          <td width="80%">
           {lang->desc p1='pds_exp' p2=$lang_set p3='title'}
          </td>
          <td width="10%">
           {lang->desc p1='pds_exp' p2=$lang_set p3='days'}
          </td>
         </tr>
{section name=itm loop=$vs_expire_ct}
        {assign var=lvl value=$vs_expire_ct[itm]}
         <tr>
          <td width="10%">
           {$vs_expire[$lvl].id}
          </td>
          <td width="80%">
           {$vs_expire[$lvl].title}
          </td>
          <td width="10%">
           {$vs_expire[$lvl].days}
          </td>
         </tr>
{/section}
        </table>
{*****************************************

   Display Footer

******************************************}
{include file="$deftpl/sitefoot.tpl"}