{include file='header.tpl'}
{if $sesslife}
  {if $smarty.session.qr_sess_expired AND $smarty.session.qr_sess_expired eq 1}
        <b>{$_lang.main.qrcode.empty}</b>
        {include file='footer.tpl'}
  {elseif $Global_member.member_role_id eq $smarty.const.ROLE_CUSTOMER}
     {include file='dashboard.tpl'}
  {elseif $Global_member.member_role_id neq $smarty.const.ROLE_CUSTOMER}
     {include file='admin_dashboard.tpl'}
  {else}
     {include file='home.tpl'}
     {include file='footer.tpl'}
  {/if}
{else} 
   {if $smarty.session.qr_sess_expired AND $smarty.session.qr_sess_expired eq 1}
        <b>{$_lang.main.qrcode.empty}</b>
        {include file='footer.tpl'}
   {elseif $non_avail_table eq 1}
	 	<b>{$_lang.table_unavailable}</b>
	 	{include file='footer.tpl'}
   {else}
          {if $smarty.session[$smarty.const.SES_TABLE] gt 0 || $smarty.session[$smarty.const.SES_ONLINE_STORE] gt 0}
          {else}
               {if $active_page eq 'services_request' OR $active_page eq 'customer_requests' OR $active_page eq 'feedback' OR $active_page eq 'tbl_menu' OR $active_page eq 'tbl_submenu_dishes' OR $active_page eq 'customer_rewards' OR $active_page eq 'edit_profile'}
        	   	 {literal}
                    <script type="text/javascript">
        	        	 setTimeout(function(){
        					   		alert('{/literal}{$_lang.main.qrcode.empty}{literal}');
        							window.location.href='{/literal}{$website}{literal}/user/dashboard.php';
        					   },1000);
                    </script>
                 {/literal}
             {/if}
          {/if}
        
          {include file='login.tpl'}
   {/if}
{/if}
