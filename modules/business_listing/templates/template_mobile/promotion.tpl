{*****************************************

       Edit Listing Template
          phpDirectorySource

******************************************}

{*****************************************

   Get Template Config Variables

******************************************}
{config_load file="$deftpl/system.conf" section='edlist'}
{*****************************************

   Display Header

******************************************}
{include file="$deftpl/header.tpl"}
{*****************************************

   Page Display

******************************************}
{include file="$deftpl/promotion/script.tpl"}
 
{if $elgg_user_acct_type eq  "business"}
    
    {$is_new_promotion}
    {if $operation != ""}
    	<div class="approved">
            {$operation}
        </div>
	{/if}
	{if $op_error != ""}
    	<div class="fail">
            {$op_error}
        </div>
	{/if}

	{if $notice != ""}
      {$notice}
	{/if}

	{if $fbsharemsg != ""}
      {$fbsharemsg}
	{/if}

	{if $isowner eq 0}
	<div data-role="page">
		<div class="error">Not Authorized Owner! Access Denied.</div>
		<center><input data-icon="back" data-inline="true" type="button" onclick="window.location.href='{$elgg_site_url}promotionslisting.php?show_type=PR&listing_type=all'" value="{$_lang.back_lbl}"/></center>
	</div>
	    	
	{else}
 

    {if $is_save_success eq 1}
          <center><input type="button" onclick="fn_call_close();" value="Close"/></center>
          {literal}
            <script type="text/javascript">
				function fn_call_close(){
                    if(window.opener != null){
					    window.opener.location.reload();self.close();
					}else{
					    window.location.href='promotionslisting.php?show_type=PR&listing_type=post';
					}
				}
			</script>
          {/literal}
    {/if}
 
 

{if $is_new_promotion || $is_renew_promotion || $is_edit_promotion}
		{include file="$deftpl/promotion/form.tpl"} 
{/if} 
{/if}<!-- end of $isowner -->
{if $is_view_promotion}
{include file="$deftpl/promotion/view.tpl"}
{/if}
{literal}
<script type='text/javascript'>
	function toggle_history_current(isHistory){
		if(isHistory){
            $('#current_grd').hide();
            $('#history_grd').show();
			$('#btn_show_history').hide();
			$('#btn_show_current').show();

  		}else{
            $('#current_grd').show();
            $('#history_grd').hide();
			$('#btn_show_history').show();
			$('#btn_show_current').hide();
		}
	}
	$(document).ready(function(){
        toggle_history_current(0);
 	});
</script>
{/literal}

{else}
	<div class="alert">Sorry, your user account does not have the necessary permissions to post a promotion.</div>
{/if}
{*****************************************

   Display Footer

******************************************}
{include file="$deftpl/sitefoot.tpl"}
