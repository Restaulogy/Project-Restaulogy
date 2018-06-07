{*****************************************

      User Control Panel Template
          phpDirectorySource

******************************************}
{*****************************************

   Get Template Config Variables

******************************************}
{config_load file="$deftpl/system.conf" section='user'}
{*****************************************

   Display Header

******************************************}
{include file="$deftpl/sitehead.tpl"}
{*****************************************

   Page Display

******************************************}
{if $show_login}
    {if $notice != ""}
            <div class="fail">
             {$notice}
            </div>
    {/if}
        <form action=user.php method=post>
         <table width=100% border=0 cellspacing=0 cellpadding=0>
          <tr align=center>
           <td colspan=2 bgcolor="{#form_title_bgcolor#}">
            <font style="color:{#form_title_font_color#}; font-size:{#form_title_font_size#}; font-weight:{#form_title_font_weight#}; background-color:{#form_title_font_bgcolor#};">
             {lang->desc p1='user' p2=$lang_set p3='title'}
            </font>
           </td>
          </tr>
          <tr>
           <td width=50% align=right bgcolor="{#form_label_bgcolor#}">
            <font style="color:{#form_label_font_color#}; font-size:{#form_label_font_size#}; font-weight:{#form_label_font_weight#}; background-color:{#form_label_font_bgcolor#};">
             {lang->desc p1='pds_user' p2=$lang_set p3='login'}: 
            </font>
           </td>
           <td width=50% bgcolor="{#form_field_bgcolor#}">
            <font style="color:{#form_field_font_color#}; font-size:{#form_field_font_size#}; font-weight:{#form_field_font_weight#}; background-color:{#form_field_font_bgcolor#};">
             <input name=login type=text id=login>
            </font>
           </td>
          </tr>
          <tr>
           <td width=50% align=right bgcolor="{#form_label_bgcolor#}">
            <font style="color:{#form_label_font_color#}; font-size:{#form_label_font_size#}; font-weight:{#form_label_font_weight#}; background-color:{#form_label_font_bgcolor#};">
             {lang->desc p1='pds_user' p2=$lang_set p3='pass'}: 
            </font>
           </td>
           <td width=50% bgcolor="{#form_field_bgcolor#}">
            <font style="color:{#form_field_font_color#}; font-size:{#form_field_font_size#}; font-weight:{#form_field_font_weight#}; background-color:{#form_field_font_bgcolor#};">
             <input name=pass type=password id=pass>
            </font>
           </td>
          </tr>
          <tr>
           <td width=50% align=right bgcolor="{#form_label_bgcolor#}">
            <font style="color:{#form_label_font_color#}; font-size:{#form_label_font_size#}; font-weight:{#form_label_font_weight#}; background-color:{#form_label_font_bgcolor#};">
               
            </font>
           </td>
           <td width=50% bgcolor="{#form_field_bgcolor#}">
            <font style="color:{#form_field_font_color#}; font-size:{#form_field_font_size#}; font-weight:{#form_field_font_weight#}; background-color:{#form_field_font_bgcolor#};">
             <button type=button name=pass_reset onclick="this.form.submit();">{lang->desc p1='user' p2=$lang_set p3='btn_pass_reset'}</button>
            </font>
           </td>
          </tr>
          <tr>
           <td colspan=2 align=center bgcolor="{#table_std_bgcolor#}">&nbsp;
            
           </td>
          </tr>
          <tr>
           <td colspan=2 align=center bgcolor="{#form_btn_bgcolor#}">
            <font style="color:{#form_btn_font_color#}; font-size:{#form_btn_font_size#}; font-weight:{#form_btn_font_weight#}; background-color:{#form_btn_font_bgcolor#};">
             <input name=login_btn type=submit id=login_btn value="{lang->desc p1='user' p2=$lang_set p3='btn_login'}" style="font-size:{#submit_btn_font_size#}; background-color:{#submit_btn_bgcolor#};">
            </font>
           </td>
          </tr>
          <tr>
           <td colspan=2 align=center bgcolor="{#form_btn_bgcolor#}">
            <font style="color:{#form_btn_font_color#}; font-size:{#form_btn_font_size#}; font-weight:{#form_btn_font_weight#}; background-color:{#form_btn_font_bgcolor#};">
              
            </font>
           </td>
          </tr>
          <tr>
           <td colspan=2 align=center bgcolor="{#form_btn_bgcolor#}">
            <font style="color:{#form_btn_font_color#}; font-size:8pt; font-weight:{#form_btn_font_weight#}; background-color:{#form_btn_font_bgcolor#};">
             {lang->desc p1='user' p2=$lang_set p3='need_acct'} <a href=./register.php>{lang->desc p1='user' p2=$lang_set p3='reg_here'}</a>
            </font>
           </td>
          </tr>
         </table>
        </form><br>
{elseif $change_pass}
    {if $notice != ""}
            <div class="fail">
             {$notice}
            </div>
    {/if}

        <form action=user.php method=post>
         <table width=100% border=0 cellspacing=0 cellpadding=0>
          <tr align=center>
           <td colspan=2 bgcolor="{#form_title_bgcolor#}">
            <font style="color:{#form_title_font_color#}; font-size:{#form_title_font_size#}; font-weight:{#form_title_font_weight#}; background-color:{#form_title_font_bgcolor#};">
             {lang->desc p1='user' p2=$lang_set p3='pw_title'}
            </font>
           </td>
          </tr>

          <tr>
           <td width=50% align=right bgcolor="{#form_label_bgcolor#}">
            <font style="color:{#form_label_font_color#}; font-size:{#form_label_font_size#}; font-weight:{#form_label_font_weight#}; background-color:{#form_label_font_bgcolor#};">
             {lang->desc p1='user' p2=$lang_set p3='c_pass'}: 
            </font>
           </td>
           <td width=50% bgcolor="{#form_field_bgcolor#}">
            <font style="color:{#form_field_font_color#}; font-size:{#form_field_font_size#}; font-weight:{#form_field_font_weight#}; background-color:{#form_field_font_bgcolor#};">
             <input name=c_pass type=text id=c_pass>
            </font>
           </td>
          </tr>
          <tr>
           <td width=50% align=right bgcolor="{#form_label_bgcolor#}">
            <font style="color:{#form_label_font_color#}; font-size:{#form_label_font_size#}; font-weight:{#form_label_font_weight#}; background-color:{#form_label_font_bgcolor#};">
             {lang->desc p1='user' p2=$lang_set p3='new_pass'}: 
            </font>
           </td>
           <td width=50% bgcolor="{#form_field_bgcolor#}">
            <font style="color:{#form_field_font_color#}; font-size:{#form_field_font_size#}; font-weight:{#form_field_font_weight#}; background-color:{#form_field_font_bgcolor#};">
             <input name=new_pass type=password id=new_pass>
            </font>
           </td>
          </tr>
          <tr>
           <td width=50% align=right bgcolor="{#form_label_bgcolor#}">
            <font style="color:{#form_label_font_color#}; font-size:{#form_label_font_size#}; font-weight:{#form_label_font_weight#}; background-color:{#form_label_font_bgcolor#};">
             {lang->desc p1='user' p2=$lang_set p3='v_pass'}: 
            </font>
           </td>
           <td width=50% bgcolor="{#form_field_bgcolor#}">
            <font style="color:{#form_field_font_color#}; font-size:{#form_field_font_size#}; font-weight:{#form_field_font_weight#}; background-color:{#form_field_font_bgcolor#};">
             <input name=v_pass type=password id=v_pass>
            </font>
           </td>
          </tr>
          <tr>
           <td colspan=2 align=center bgcolor="{#table_std_bgcolor#}">&nbsp;
            
           </td>
          </tr>
          <tr>
           <td colspan=2 align=center bgcolor="{#form_btn_bgcolor#}">
            <font style="color:{#form_btn_font_color#}; font-size:{#form_btn_font_size#}; font-weight:{#form_btn_font_weight#}; background-color:{#form_btn_font_bgcolor#};">
             <input name=btn_change_pw type=submit id=btn_change_pw value="{lang->desc p1='user' p2=$lang_set p3='btn_change_pw'}" style="font-size:{#submit_btn_font_size#}; background-color:{#submit_btn_bgcolor#};">
            </font>
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

		<div align="center">
             <!-- change password button is not needed
             <button type=button onClick="document.location.href='./user.php?act=cpw'">{lang->desc p1='user' p2=$lang_set p3='change_pass'}</button>

             <button class="blackbutton" type=button onClick="document.location.href='./mailbox.php'">{lang->desc p1='mailbox' p2=$lang_set p3='userlink'} ({$msgcount})</button>       -->
            </div>
    

  {if count($list) > 0}

    {if $ispromotion eq 1}

        {if $ishistroy eq 1}
             <div class="extra_info" style="margin-left:35px;">&nbsp;*This is the list of live Promotions posted by you </div>
        {else}
                <div class="extra_info" style="margin-left:35px;">&nbsp;*This is the list of previous Promotions posted by you </div>
        {/if}
    {else}
	<div class="extra_info">&nbsp;*These are the Business Listing posted by you</div>
	{/if}
    {if $list}
    {section name=itm loop=$list}
      {assign var="subfile" value=$list[itm].subfile}
        <center>
            {include file="$deftpl/sublist/user_sublist0.tpl"}
        </center>
    {/section}
    {else}
         <div class="fail">
               {lang->desc p1='user' p2=$lang_set p3='no_list_found'}
        </div>
    {/if}
    {else}
             <div class="fail">
               {lang->desc p1='user' p2=$lang_set p3='no_list_found'}
          </div>
  {/if}


{/if}
{*****************************************

   Display Footer

******************************************}
{include file="$deftpl/sitefoot.tpl"}
