 <div data-role="page" id="list">

    {include file="$deftpl/list/header.tpl"}


		<div data-role="content">

        <table style="font-size:10px !important;">
          <tr>
            <td colspan="2">
             {if $vs_current_listing.logo != "" }
             <IMG BORDER="0" ALIGN="Left" src="{$vs_current_listing.logo}" />
            {else}
            <IMG BORDER="0" ALIGN="Left" src="templates/{$deftpl}/images/nologo.jpg" />
            {/if}
            <!--
            <a target="_blank" href="{$vs_current_listing.buss_prof_link}?view=mobile" style="font-size: 10px;" data-role="button" data-icon="profile" data-inline="true" data-iconpos="left"  data-theme="a" >Profile</a>
            -->
            {if $vs_current_user.id}
           <a target="_blank" href="{$elgg_main_url}modules/business_listing/edlist.php?lid={$vs_current_listing.id}"  style="font-size: 10px;" data-role="button" data-icon="profile" data-inline="true" data-iconpos="left" data-theme="a">Edit</a>
           {/if}

            </td>
         </tr>
         <tr>
             <td colspan="2">
                <table style='font-family:Arial;font-size:11px;'>
                 <tr>
                    <td style='width:50%;vertical-align:top;'>
                        <div style='border-bottom:1.5px dotted gray;padding-bottom:5px;'>                          <b style="font-size: 14px;font-weight: bolder;color:#28166F;">{$vs_current_listing.firm}</b><br>
                            <span>{if $vs_current_listing.show_field_on_form.fld_mail_add}{$vs_current_listing.address} {/if} ,
                            {$vs_current_listing.loc1},{$vs_current_listing.xtra_4_name}{if $vs_current_listing.zip}-{/if}{$vs_current_listing.zip} <br>
                            <a style="text-decoration:none;" href="{$vs_current_listing.map_link}" target="_blank"><img width="16px" height="16px" border="0" src="{$elgg_main_url}images/graphics/icons/map_icon.png" alt="Driving directions/map"/> Driving directions/map</a> <br>{if $vs_current_listing.dist neq 0} Distance : {$vs_current_listing.dist} miles{/if}
                            
                             {$vs_current_listing.recommendation_display}
                        </div>
                        <div>
                        <b>Contact :</b><br>
                	 	  {if $vs_current_listing.show_field_on_form.fld_phone && $vs_current_listing.phone neq ""}
                		 	 <span><img src="{$elgg_graphics_small_icon_url}contact.png" width="11" height="11">&nbsp;{$vs_current_listing.phone}</span> &nbsp;
                		  {/if}
                		  {if $vs_current_listing.show_field_on_form.fld_mobile && $vs_current_listing.mobile neq ""}
                		 	<span><img src="{$elgg_graphics_small_icon_url}phone.png" width="11" height="11">&nbsp;{$vs_current_listing.mobile}</span>&nbsp;
                		  {/if}
                		  {if $vs_current_listing.show_field_on_form.fld_fax && $vs_current_listing.fax neq ""}
                		 	<span><img src="{$elgg_graphics_small_icon_url}print.png" width="11" height="11">&nbsp;{$vs_current_listing.fax}</span> &nbsp;
                		  {/if}
                		  <br>
                		  {if $vs_current_listing.website neq ""}
                			<a href="{$vs_current_listing.website}" target="_blank"><img src="{$elgg_graphics_small_icon_url}world.png" width="11" height="11">&nbsp;{$vs_current_listing.website}</a>
                          {/if}
                    </div>
                    </td>
                    </tr>
                    <tr>
                    <td style='width:10%px;padding-left:10px;vertical-align:top;'> <b>Hrs:</b></td>            </tr>
                    <tr>
                     
                    <td style='width:40%;vertical-align:top;'>{$vs_current_listing.biz_wrk_hrs}
                    </td>
                </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <span style="text-align:justify;"><b>&nbsp;&nbsp;&nbsp;&nbsp;{$vs_current_listing.description}</b></span>
            </td>
         </tr>
        </table>

<b>{lang->desc p1='show' p2=$lang_set p3='cat_path'}</b><br>

{section name=itm loop=$vs_catpath}
  {if $vs_config.rewrite}
            <img src=templates/{$deftpl}/images/arrow.gif> <a href="{$vs_catpath[itm].mod_title}-{$vs_catpath[itm].id}-0.html">{$vs_catpath[itm].path}</a><br>
  {else}
            <img src=templates/{$deftpl}/images/arrow.gif> <a href=index.php?cat={$vs_catpath[itm].id}>{$vs_catpath[itm].path}</a><br>
  {/if}
{/section}
 <br>

<br>


{assign var="varBussPath" value=$elgg_main_url|cat:"pg/business_listing/main/show_business/"|cat:$vs_current_listing.id}


        </div><!--content-->
    {include file="$deftpl/list/footer.tpl"}

 </div><!--Page-->
