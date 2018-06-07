{*****************************************

       Admin Edit Listings Template
          phpDirectorySource

******************************************}
{*****************************************

   Get Template Config Variables

******************************************}
{config_load file="$deftpl/system.conf" section='manlist'}
{*****************************************

   Display Header

******************************************}
{include file="$deftpl/sitehead.tpl"}
{*****************************************

   Page Display

******************************************}
{if $vs_current_admin.f_full or $vs_current_admin.f_user}

 {**********************************************
  Admin privileges exist for editing users
 ***********************************************}
	{if $notice != ""}
          <div class="fail">
             {$notice}
           </div>
   {/if}
        <form class="job_detail_view" action="manlist.php" method=post>
         <table   width=100% border=0>
          <tr>
           <th colspan=2>
             {lang->desc p1='manlist' p2=$lang_set p3='title'}
           </th>
          </tr>
         <tr>
          <td class="right_td">
				Select User
			</td>
			<td class="left_td">
            {$user_sel}
			</td>
			</tr>
         <tr>
            <td class="right_td">
				Select State
			</td>
			<td class="left_td">
			{lang->select p1='liststate' p2=$lang_set p3=$ssel_prop}
			</td>
		</tr>
         <tr>
   			<td class="right_td">
				Select Level
			</td>
			<td class="left_td">
			{lang->select p1='mem_level' p2=$lang_set p3=$sel_prop}
  			</td>
		</tr>
         <tr>
   <td colspan=2 align=center >
        <input type=submit name=list_search value="{lang->desc p1='manlist' p2=$lang_set p3='btn_search'}" class="blackbutton" style="width:100px;">
   	</td>
		</tr>
         <tr>
   			<td class="right_td">
				{lang->desc p1='manlist' p2=$lang_set p3='s_firm'}
			</td>
			<td class="left_td">
				<input type=text name=s_firm value={$s_firm}>
   			</td>
		</tr>
         <tr>

   			<td class="right_td">
				{lang->desc p1='manlist' p2=$lang_set p3='s_id'}
			</td>
			<td class="left_td">
           		<input type=text name=s_id value={$s_id}>
           </td>
         </tr>

  {if $list_sel != ""}
         <tr>
          <td colspan=2 align=center  >
            {$list_sel}&nbsp;
            <input type=submit name=go value="{lang->desc p1='manlist' p2=$lang_set p3='btn_go'}" class="blackbutton" style="width:60px; height:20px;"/>
          </td>
         </tr>
         <tr>
          <td class="right_td">
            {lang->desc p1='manlist' p2=$lang_set p3='radio_state'}
          </td>
          <td class="left_td">
            {lang->desc p1='liststate' p2=$deftpl p3=$vs_current_listing.state}
          </td>
         </tr>
         <tr>
          <td colspan=2 align=center  >

    {if $vs_current_listing.state != "apr"}
            <input type=submit name=btn_approve value="{lang->desc p1='manlist' p2=$lang_set p3='btn_approve'}" class="blackbutton" style="width:100px;" />
            <input type=submit name=btn_disapprove value="{lang->desc p1='manlist' p2=$lang_set p3='btn_disapprove'}" class="blackbutton" style="width:100px;" />
    {else}
            <input type=submit name=btn_disapprove value="{lang->desc p1='manlist' p2=$lang_set p3='btn_disapprove'}" class="blackbutton" style="width:100px;" />
    {/if}
    {if $vs_current_listing.state == "del"}
            <input type=submit name=btn_remove value="{lang->desc p1='manlist' p2=$lang_set p3='btn_remove'}" class="blackbutton" style="width:100px;"/>
    {/if}

          </td>
         </tr>
         <tr>
          <td class="right_td">
            {lang->desc p1='pds_list' p2=$lang_set p3='level'}

          </td>
          <td class="left_td">
      {section name=itm loop=$vs_level_ct}
        {assign var="ct" value=$vs_level_ct[itm]}
        {if $vs_level[$ct].level==$vs_current_listing.level}
            <input type=radio style="width:25px;" name=level value={$vs_level[$ct].level} checked /> {lang->desc p1='mem_level' p2=$lang_set p3=$vs_level[$ct].level} &nbsp;
        {else}
            <input type=radio style="width:25px;" name=level value={$vs_level[$ct].level} /> {lang->desc p1='mem_level' p2=$lang_set p3=$vs_level[$ct].level}<br>
        {/if}
      {/section}

          </td>
         </tr>
		 <tr>
		 	<td colspan="2" align="center">
			 <input type=submit name=btn_level value="{lang->desc p1='manlist' p2=$lang_set p3='btn_level'}" class="blackbutton" style="width:150px;" />
			 </td>
		 </tr>
         <tr>
          <td class="right_td">
            {lang->desc p1='pds_list' p2=$lang_set p3='address1'}
			</td>
		  <td class="left_td">
            {$vs_current_listing.address1}
           </td>
         </tr>
         <tr>
          <td class="right_td">
            {lang->desc p1='pds_list' p2=$lang_set p3='zip'}
          </td>
		  <td class="left_td">
            {$vs_current_listing.zip}
          </td>
         </tr>
         <tr>
          <td class="right_td">
            {lang->desc p1='pds_list' p2=$lang_set p3='contact'}
           </td>
		  <td class="left_td">
            {$vs_current_listing.contact}
           </td>
         </tr>
         <tr>
          <td class="right_td">
            {lang->desc p1='pds_list' p2=$lang_set p3='phone'}
             </td>
		  <td class="left_td">
            {$vs_current_listing.phone}
            </td>
         </tr>
         <tr>
          <td class="right_td">
            {lang->desc p1='pds_list' p2=$lang_set p3='fax'}
            </td>
		  <td class="left_td">
            {$vs_current_listing.fax}
           </td>
         </tr>
         <tr>
          <td class="right_td">
            {lang->desc p1='pds_list' p2=$lang_set p3='mobile'}
            </td>
		  <td class="left_td">
            {$vs_current_listing.mobile}
            </td>
         </tr>
         <tr>
          <td class="right_td">
            {lang->desc p1='pds_list' p2=$lang_set p3='description'}
            </td>
		  <td class="left_td">
            {$vs_current_listing.description}
          </td>
         </tr>
         <tr>
          <td class="right_td">
            {lang->desc p1='pds_list' p2=$lang_set p3='website'}
             </td>
		  <td class="left_td">
            <a href="http://{$vs_current_listing.website}">{$vs_current_listing.website}</a>
           </td>
         </tr>
         <tr>
          <td class="right_td">
            {lang->desc p1='pds_list' p2=$lang_set p3='email'}
             </td>
		  <td class="left_td">
            <a href="mailto:{$vs_current_listing.email}">{$vs_current_listing.email}</a>
          </td>
         </tr>
         <tr>
          <td class="right_td">
            {lang->desc p1='pds_list' p2=$lang_set p3='premium'}
            </td>
		  <td class="left_td">
            {$vs_current_listing.premium}
          </td>
         </tr>
         <tr>
          <td colspan=2 align=center bgcolor="{#form_field_bgcolor#}">

            <input type=hidden name=id value="{$vs_current_listing.id}" />
            <input type=submit name=btn_edit value="{lang->desc p1='manlist' p2=$lang_set p3='btn_edit'}" class="blackbutton" style="width:100px;" />
           </td>
         </tr>
  {/if}
        </table>
       </form>
{/if}
{*****************************************

   Display Footer

******************************************}
{include file="$deftpl/sitefoot.tpl"}
