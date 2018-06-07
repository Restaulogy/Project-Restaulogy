<div data-role="header" data-position="fixed">
	<header>
{if $smarty.request.web_redt and $smarty.request.web_redt eq 1}
    {* $webtitle|wordwrap:150:'<br/>' *}
{else}
   <a data-inline="true" data-role="button" data-icon="smico" data-iconpos="notext" href="#mypanel" onclick="$('#mypanel').panel('open',optionsHash);">Open Menu</a>
     {if $sesslife}
				<a href="{$website}/user/logout" style="float:right;"  data-inline="true" data-role="button" data-theme='a' data-icon="shut-down" data-iconpos="notext">{$_lang.sign_out}</a>
			  {***if $Global_member.member_role_id eq $smarty.const.ROLE_MANAGER || $Global_member.member_role_id eq $smarty.const.ROLE_WAITER***}
             {if $Global_member.member_id gt 0}
                {if ($Global_member.member_role_id eq $smarty.const.ROLE_OWNER || $Global_member.member_role_id eq $smarty.const.ROLE_ADMIN)==FALSE}
                        <a href="{$website}/user/tbl_alerts.php" style="float:right;"  data-inline="true" data-role="button" data-theme='a' data-icon="notification" id="lnkalerts" title="{$_lang.tbl_alerts.title}"><b style="font-family:'Arial Narrow';">&nbsp;</b></a>
                 {/if}
			  {/if}
		   {else}
{*
		   {if $smarty.session[$smarty.const.SES_COOKIE_UID] gt 0}
            <a href="{$website}/user/tbl_alerts.php" style="float:right;"  data-inline="true" data-role="button" data-theme='a' data-icon="notification" id="lnkalerts" title="{$_lang.tbl_alerts.title}"><b style="font-family:'Arial Narrow';">&nbsp;</b></a>
		   {/if}
		    <a href="{$website}/user/register" style="float:right;"  data-inline="true" data-role="button" data-theme='a' data-icon="male-user" data-iconpos="notext">{$_lang.sign_up}</a>
			<a href="{$website}/user/login" style="float:right;"  data-inline="true" data-role="button" data-theme='a' data-icon="sign-in" data-iconpos="notext">{$_lang.sign_in}</a>
*}
		   {/if}

		 <div id="user_name">
    		{if $sesslife}
                Welcome,<br>
                {if $Global_member && $Global_member.full_name neq ""}
                    {$Global_member.full_name|truncate:30}
                {else}
                    Guest
                {/if}
            {else}
               &nbsp;
            {/if}
		 </div>

        {if $sesslife}
			 {if $Global_member.member_role_id eq $smarty.const.ROLE_CUSTOMER}
			 	<a href="{$website}/user/dashboard.php" id="logo">{$webtitle|wordwrap:150:'<br/>'}</a>
			 {else}
			 	<a href="{$website}" id="logo">{$webtitle|wordwrap:150:'<br/>'}</a>
			 {/if}
		{else}
			{if $smarty.session[$smarty.const.SES_TABLE] gt 0}
				<a href="{$website}/user/dashboard.php" id="logo">{$webtitle|wordwrap:150:'<br/>'}</a>
			{elseif $smarty.session[$smarty.const.SES_ONLINE_STORE] gt 0}
				<a href="{$website}/user/tbl_menu.php?online_store=1">{$webtitle|wordwrap:150:'<br/>'}</a>
			{else}
				<a href="{$website}" id="logo">{$webtitle|wordwrap:10:'<br/>'}</a>
			{/if}
		{/if}
{/if}
	</header>
</div> 
<div class="clearfix line_break"></div>
