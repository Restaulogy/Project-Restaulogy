{include file='header.tpl'}
<div class="wrapper">
 <h1>{$_lang.main.pref_mng_cntrols.online_users}</h1>
<table class="cnf">
 		{assign var=cnt value=0}
    {foreach $online_users as $_user }
		{if $cnt %2 eq 0}<tr>{/if}
		{math assign=cnt equation="x + 1" x=$cnt}
         <td>
			<a href="#">
				<img src="{$website}/css/jqm_extra_icon/green/user.png" alt="{$_user}"/>
				<span>{$_user}</span>
			</a>
		 </td>
     {if $cnt %2 eq 0}</tr>{/if}
    {/foreach}
</table>
</div> <!--/#wrapper-->

{include file='footer.tpl'}
