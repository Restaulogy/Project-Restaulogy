{*****************************************

      Listing Statistics Template
          phpDirectorySource

******************************************}
{*****************************************

   Get Template Config Variables

******************************************}
{config_load file="$deftpl/system.conf" section='liststats'}
{*****************************************

   Display Header

******************************************}
{include file="$deftpl/sitehead.tpl"}
{*****************************************

   Page Display

******************************************}
<div class="job_detail_view">
         <table width=100% border=0 cellspacing=0 cellpadding=0>
          <tr align=center>
           <th colspan=2 >

             {lang->desc p1='liststats' p2=$lang_set p3='title'}

           </th>
          </tr>
          <tr>
           <td class="right_td">
             {lang->desc p1='liststats' p2=$lang_set p3='stat_subviews'}
           </td>
           <td class="left_td">
             {$list_stat.sub_views}
            </td>
          </tr>
          <tr>
           <td class="right_td">
             {lang->desc p1='liststats' p2=$lang_set p3='stat_pageviews'}
            </td>
           <td class="left_td">

             {$list_stat.page_views}

           </td>
          </tr>
          <tr>
            <td colspan="2" align="center">
               <button class="blackbutton" value="Back" onclick="document.location.href='javascript:history.go(-1)'">Back</button>
			</td>
          </tr>
         </table>
         </div>
{*****************************************

   Display Footer

******************************************}
{include file="$deftpl/sitefoot.tpl"}
