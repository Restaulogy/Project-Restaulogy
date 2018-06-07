{*****************************************

         Edit Users Template
         phpDirectorySource

******************************************}

{*****************************************

   Get Template Config Variables

******************************************}
{config_load file="$deftpl/system.conf" section='eduser'}
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

        <form action="eduser.php"   method=post>


  {if $page == 'main' and $user_list != ""}
	<center>
	<table   class="myTABLE" >
			<tr style="background:#b1d8fe;"  class="column1">
    			<th width="70px">ID</th>
                <th width="100px">User</th>
                <th width="100px">joining Date</th>
                <th width="150px">Email</th>
				<th width="100px"># of Listing</th>
			</tr>
    {section name='itm' loop=$user_list}
      {assign var='userid' value=$user_list[itm].id}
        
			<tr>
			    <td class="column1">{$userid}</td>
                <td class="column1">
					<a href="eduser.php?id={$userid}">
                 	{$vs_user[$userid].login}
                	</a>
				</td>
                <td class="column1">{$vs_user[$userid].joindate}</td>
                <td class="column1"><a href="mailto:{$vs_user[$userid].usermail}">
                 {$vs_user[$userid].usermail}
                </a></td>
				<td class="column1">{$user_list[itm].listing_count}</td>
			</tr>

    {/section}
    	</table>
    <center>
    {if $paginate.total > $vs_config.users_page}
            <center>
               {paginate_prev}{paginate_middle format=#user_paging_format# prefix=#user_paging_prefix# suffix=#user_paging_suffix# page_limit=#user_paging_limit#}{paginate_next}
			 </center>
    {/if}
  {/if}
  {if $page == 'add' or $page == 'change'}
            <table width=100% class="job_detail_view"  >
             <tr>
              <td class="right_td">
                {lang->desc p1='pds_user' p2=$lang_set p3='login'}
			  </td>
              <td class="left_td">
                <input type=text name=login value="{$vs_user[$user_id].login}" / >
               </td>
			 </tr>
             <tr>
              <td class="right_td">
                {lang->desc p1='pds_user' p2=$lang_set p3='usermail'}
               </td>
              <td class="left_td">
                <input type=text name=usermail value="{$vs_user[$user_id].usermail}"/>
          
              </td>
             </tr>
    {if $page == 'change'}
      {if $vs_config.admin_chg_pw}
             <tr>
              <td class="right_td">
                {lang->desc p1='pds_user' p2=$lang_set p3='pass'}
               </td>
              <td class="left_td">
                <input type=text name=pass />
                </td>
             </tr>
       {/if}
             <tr>
              <td colspan=2 align=center bgcolor="{#form_btn_bgcolor#}"/>
                <input type=hidden name=id value="{$user_id}"/>
                <input type=hidden name=usermail_old value="{$vs_user[$user_id].usermail}"/>
                <input type=hidden name=login_old value="{$vs_user[$user_id].login}"/>
                <input type=submit name=change_user value="{lang->desc p1='eduser' p2=$lang_set p3='btn_change'}" class="blackbutton"/>
                <input type=submit name=delete_user value="{lang->desc p1='eduser' p2=$lang_set p3='btn_delete'}" class="blackbutton" />

              </td>
             </tr>
    {else}
            <tr>
              <td class="right_td">
                {lang->desc p1='pds_user' p2=$lang_set p3='pass'}
               </td>
              <td class="left_td">
                <input type=text name=pass />
              </td>
             </tr>
             <tr>
              <td colspan=2 align=center>
                <input type=submit name=add_user value="{lang->desc p1='eduser' p2=$lang_set p3='btn_add'}" class="blackbutton" />
               
              </td>
             </tr>
    {/if}
            </table>
  {/if}
			<center>
             <input type=submit name=new_user value="{lang->desc p1='eduser' p2=$lang_set p3='btn_new'}" class="blackbutton" />
			</center>
        </form>
{/if}



{*****************************************

   Display Footer

******************************************}
{include file="$deftpl/sitefoot.tpl"}
