{*****************************************

            Admin Template 
          phpDirectorySource

******************************************}
{*****************************************

   Get Template Config Variables

******************************************}
{config_load file="$deftpl/system.conf" section='admin'}
{*****************************************

   Display Header

******************************************}
{include file="$deftpl/sitehead.tpl"}
{*****************************************

   Page Display

******************************************}

{if $vs_current_admin.login == ""}
 {if $notice != ""}
          <div class="fail">
             {$notice}
           </div>
   {/if}
        <form name="form1" method="post" action="admin.php" class="job_detail_view">
         <table width=100% border=0 cellspacing=0 cellpadding=0>
          <tr >
           <th colspan="2">
             {lang->desc p1='admin' p2=$lang_set p3='title'}
            </th>
          </tr>

          <tr>
           <td class="right_td">
             {lang->desc p1='pds_admin' p2=$lang_set p3='login'}
           </td>
           <td class="left_td">
             <input  type=text name=login />
           </td>
          </tr>
          <tr>
           <td class="right_td">
             {lang->desc p1='pds_admin' p2=$lang_set p3='pass'}
           </td>
           <td class="left_td">
             <input type="password" name="pass" />
           </td>
          </tr>
          <tr>
           <td colspan="2" align="center">
             <input class="blackbutton" type="submit" name="login_btn" id="login_btn" value={lang->desc p1='admin' p2=$lang_set p3='btn_login'} />
          </td>
          </tr>
         </table>
        </form>
{elseif $change_pass}
    {if $notice != ""}
          <div class="fail">
             {$notice}
           </div>
   {/if}
        <form class="job_detail_view" action=admin.php method=post>
        <table width=100% border=0 cellspacing=0 cellpadding=0>
         <tr >
           <th colspan="2">
             {lang->desc p1='admin' p2=$lang_set p3='pw_title'}
           </th>
          </tr>
          <tr>
           <td class="right_td">
             {lang->desc p1='admin' p2=$lang_set p3='c_pass'}:
            </td>
           <td class="left_td">
             <input name=new_pass type=password id=new_pass />
            </tr>
          <tr>
           <td class="right_td">
             {lang->desc p1='admin' p2=$lang_set p3='v_pass'}:
            </td>
           <td class="left_td">
             <input name="v_pass" type="password" id="v_pass" />
           </td>
          </tr>
          <tr>
           <td colspan="2" align="center" >

             <input class="blackbutton" name="btn_change_pw" type="submit" id="btn_change_pw" value="{lang->desc p1='admin' p2=$lang_set p3='btn_change_pw'}" />

           </td>
          </tr>
          <tr>
           <td colspan=2 align=center bgcolor="{#form_btn_bgcolor#}">
            <font style="color:{#form_btn_font_color#}; font-size:{#form_btn_font_size#}; font-weight:{#form_btn_font_weight#}; background-color:{#form_btn_font_bgcolor#};">

            </font>
           </td>
          </tr>
         </table>
        </form><br>
{else}
   {if $notice != ""}
          <div class="fail">
             {$notice}
           </div>
   {/if}
         <table class="job_detail_view" width=100% border=0 cellspacing=0 cellpadding=0>

          <tr>
           <th colspan="2">
             {lang->desc p1='admin' p2=$lang_set p3='stats'}
           </th>
          </tr>
          <tr>
           <td class="right_td">
             {lang->desc p1='admin' p2=$lang_set p3='stat_user'}
           </td>
           <td class="left_td">
             {$vs_stat_user}
            </td>
          </tr>
          <tr>
           <td class="right_td">
             {lang->desc p1='admin' p2=$lang_set p3='stat_list_sub'}:
           </td>
           <td class="left_td">
             {$vs_stat_list_sub}
            </td>
          </tr>
          <tr>
           <td class="right_td">
             {lang->desc p1='admin' p2=$lang_set p3='stat_list_act'}:
           </td>
           <td class="left_td">
             {$vs_stat_list_act}
             </td>
          </tr>
          <tr>
           <td class="right_td">
             {lang->desc p1='admin' p2=$lang_set p3='stat_list_del'}:
            </td>
           <td class="left_td">
             {$vs_stat_list_del}
             </td>
          </tr>
          <tr>
           <td class="right_td">
             {lang->desc p1='admin' p2=$lang_set p3='stat_cat_tot'}:
            </td>
           <td class="left_td">
             {$vs_stat_cat_tot}
             </td>
          </tr>
          <tr>
           <td class="right_td">
             {lang->desc p1='admin' p2=$lang_set p3='stat_cat_on'}:
             </td>
           <td class="left_td">
             {$vs_stat_cat_on}
             </td>
          </tr>
          <tr>
           <td class="right_td">
             {lang->desc p1='admin' p2=$lang_set p3='stat_cat_off'}:
              </td>
           <td class="left_td">
             {$vs_stat_cat_off}
           </td>
          </tr>
      <!--    <tr>
           <th colspan=2>
             {lang->desc p1='admin' p2=$lang_set p3='mods'}
           </th>
          </tr>
 {section name=itm loop=$vs_mods}
          <tr>
           <td colspan=2 style="border:none;height:20px; vertical-align:middle;">
            <font style="color:{#table_std_font_color#}; font-size:8pt; font-weight:{#table_std_font_weight#}; background-color:{#table_std_font_bgcolor#};">
            <img src="templates/{$deftpl}/images/icon-check.gif" width="11px" height="11px"/> {$vs_mods[itm].title} {lang->desc p1='admin' p2=$lang_set p3='version'}  {$vs_mods[itm].ver}  {lang->desc p1='admin' p2=$lang_set p3='installed'}{$vs_mods[itm].d_added} {lang->desc p1='admin' p2=$lang_set p3='installed_by'}  {$vs_mods[itm].added_by}
            </font>
           </td>
          </tr>
  {/section} -->
          <tr>
           <td colspan="2" align="center" >

             <button type="button" class="blackbutton" onClick="document.location.href='./admin.php?act=cpw'">{lang->desc p1='admin' p2=$lang_set p3='change_pass'}</button>

           </td>
          </tr>
         </table>
{/if}

{*****************************************

   Display Footer

******************************************}
{include file="$deftpl/sitefoot.tpl"}
