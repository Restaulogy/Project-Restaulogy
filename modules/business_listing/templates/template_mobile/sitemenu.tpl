{* Site Menu *}
<ul class="navlist">
<li style="line-height:30px; font-size:16px; font-weight:bolder;">{lang->desc p1='sitemenu' p2=$lang_set p3='title'}</li>
<li><a href={$vs_config.mainurl}/>{lang->desc p1='sitemenu' p2=$lang_set p3='home'}</a></li>
<li><a href={$vs_config.mainurl}/user.php>{lang->desc p1='sitemenu' p2=$lang_set p3='user'}{$user_out}</a></li>
<li><a href={$vs_config.mainurl}/register.php>{lang->desc p1='sitemenu' p2=$lang_set p3='register'}</a></li>
<li><a href={$vs_config.mainurl}/showpage.php?display=compare>{lang->desc p1='sitemenu' p2=$lang_set p3='compare'}</a></li>
{if $vs_config.show_admin or $vs_current_admin.login != ""}
            <li><a href={$vs_config.mainurl}/admin.php>{lang->desc p1='sitemenu' p2=$lang_set p3='admin'}</a></li>
			<li><a href='{$vs_config.mainurl}/admin.php?act=out'>
             	(Admin log Out)
            	</a>
			</li>
{/if}
</ul>


