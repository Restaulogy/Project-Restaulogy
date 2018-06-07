	{if $notice != ""}
	    	<div class="fail">
            {$notice}
            </div>
	{/if}
{if $vs_user_limit eq 1}
 <div class="extra_info">*Add Your Business Listing</div>
{include file="$deftpl/form_validation.tpl"}
<center>
	<form class="job_detail_view" enctype="multipart/form-data"  id="form_detail" name="register_form2" action="register.php" method="post"><table width=100% align=center cellpadding=5 cellspacing=0>
       
        <table width=100% align=center cellpadding=5 cellspacing=0>
         <tr>
          <th colspan="6">
           {lang->desc p1='register' p2=$lang_set p3='step_details'} {$vs_level[$listing_level].title}
          </th>
         </tr>
              {include file="$deftpl/form_detail.tpl"}
         
         <tr>
            <td class="right_td">
                Your Logo
			</td>
			<td class="left_td" colspan=5>
			<input type="file" name="logo" /> &nbsp;&nbsp;
			<div class="extra_info">Upload Image File Recommended Formats: png,gif,jpg.</div>
           </font>
          </td>
         </tr>
         <tr>

          <td colspan=6 align="center" class="bottom_line">
          <input type=hidden id="cat_str" name=cat_str value={$cat_str} class="required">
          <input type=hidden name=listing_level value="1">
          <input type=hidden name=submit_flag value=1>
            
            <input type=submit name=list_reg value="{lang->desc p1='register' p2=$lang_set p3='btn_submit'}" class="blackbutton" style="width:100px; height:25px;">

          </td>
         </tr>
        </table>
       </form>
</center>
{else}
 {if $elgg_user_acct_type ==  "business" || $elgg_user_acct_type =="social/business organization"}
    <div class="alert">AS a Business Account can have Only One Listing.</div>
 {else}
    <div class="alert">As a regular user account you are not allowed to create new business listing.</div>
 {/if}
{/if}
