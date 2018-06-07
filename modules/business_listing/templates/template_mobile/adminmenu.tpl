{* Admin Menu *}
<ul class="navlist">
	<li>
            {lang->desc p1='adminmenu' p2=$lang_set p3='title'}
	</li>
 	<li>
  		<a href={$vs_config.mainurl}/>
             {lang->desc p1='adminmenu' p2=$lang_set p3='home'}
    	</a>
  	</li>
{if $vs_current_admin.f_full or $vs_current_admin.f_user}
	<li>
 		<a href={$vs_config.mainurl}/eduser.php>
             {lang->desc p1='adminmenu' p2=$lang_set p3='eduser'}
   		</a>
   </li>
{/if}
	<li>
		<a href={$vs_config.mainurl}/amailbox.php>
             {lang->desc p1='mailbox' p2=$lang_set p3='adminlink'}({$amsgcount})
	    </a>
    </li>
{if $vs_current_admin.f_full or $vs_current_admin.f_list}
	<li>
 		<a href={$vs_config.mainurl}/manlist.php>
             {lang->desc p1='adminmenu' p2=$lang_set p3='manlist'}
   		</a>
	</li>
{/if}
{if $vs_current_admin.f_full or $vs_current_admin.f_level}
	<li>
 		<a href={$vs_config.mainurl}/edlevel.php>
             {lang->desc p1='adminmenu' p2=$lang_set p3='edlevel'}
   		</a>
     </li>
{/if}
{if $vs_current_admin.f_full or $vs_current_admin.f_exp}
	    <li>
            <a href={$vs_config.mainurl}/edexp.php>
             {lang->desc p1='adminmenu' p2=$lang_set p3='edexp'}
            </a>
     	</li>
{/if}
{if $vs_current_admin.f_full or $vs_current_admin.f_category}
	    <li>
            <a href={$vs_config.mainurl}/edcat.php>
             {lang->desc p1='adminmenu' p2=$lang_set p3='edcat'}
            </a>
            </li>
{/if}
{if ($vs_current_admin.f_full or $vs_current_admin.f_loc) AND $vs_config.use_loc_sel}
	    <li>
            <a href={$vs_config.mainurl}/edloc.php>
             {lang->desc p1='adminmenu' p2=$lang_set p3='edloc'}
            </a>
            </li>
{/if}
{if $vs_current_admin.f_full or $vs_current_admin.f_lang}
	    <li>
            <a href={$vs_config.mainurl}/edlang.php>
             {lang->desc p1='adminmenu' p2=$lang_set p3='edlang'}
            </a>
            </li>
{/if}
{if $vs_current_admin.f_full}
	    <li>
            <a href={$vs_config.mainurl}/import.php>
             {lang->desc p1='adminmenu' p2=$lang_set p3='import'}
            </a>
            </li>
{/if}
	    <li>
            <a href={$vs_config.mainurl}/admin.php>
             {lang->desc p1='adminmenu' p2=$lang_set p3='admin'}
            </a>
            
	    </li>
	    <li>
	        <!--{$admin_out}-->
	        <a href='{$vs_config.mainurl}/admin.php?act=out'>
             (Admin log Out)
            </a>
	    </li>
</ul>
