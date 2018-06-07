<div data-role="page" id="pglogo">
    {include file="$deftpl/edlist/header.tpl"}

    <div data-role="content">
    
         {if $vs_level[$listing_level].logo}
		        <table class="job_detail_panal_table">
		         <tr>
					<th colspan="2">
		            {lang->desc p1='pds_level' p2=$lang_set p3='logo'}
		            </th>
				 </tr>
		   {if $vs_current_listing.logo != ""}
				 <tr>
			        <td class="detail_right_td">
		         		Your Current Logo
					</td>

					<td class="detail_left_td">
					
					<img src={$vs_current_listing.logo}>
		            </td>
				</tr>
		    {/if}
		        <tr>
		            <td class="detail_right_td">
		                Update Your Logo
					</td>
					<td class="detail_left_td">
					<input type="file" name="logo" ACCEPT="text/html,image/jpeg"> &nbsp;&nbsp;
		            <div class="extra_info">Upload Image File Recommended Formats: png,gif,jpg.</div>
		           </font>
		          </td>
		         </tr>
				 <tr>
					<td colspan="2">
						<span class="form_error" id="logo_error"></span>
					</td>
				 </tr>
		         <tr>
		           <td colspan="2" align="center" class="bottom_line">
					<input type="hidden" name="btn_logo" id="btn_logo" value=""/>
                   <!--
                   <input type="button" onclick="filterFileType(logo);"  value="{lang->desc p1='edlist' p2=$lang_set p3='btn_upload'}" data-theme="a"/>
		           -->
		           &nbsp;
		           </td>
		           </tr>
		         </table>
		  {/if}
          {literal}
<script type="text/javascript" lanaguage="javascript">
          function filterFileType(field) {
              $('#logo_error').html('');
          if(!IsNonEmpty(field.value)){
                $('#logo_error').html('Please Upload a file.');
                
          }else{
			  if ((IsFileType(field.value, 'png') || IsFileType(field.value, 'gif') || IsFileType(field.value, 'jpg')) == false){
                $('#logo_error').html('Your uploaded file must be in .gif|.png|.jpg Format\nPlease select again.');
	 		 }else{
                $('#btn_logo').val('1');
				document.forms.register_edit_form2.submit();
	 		 }

			return false;
          }


			return true;
}
</script>
          {/literal}
		  
	</div><!-- content -->
    {include file="$deftpl/edlist/footer.tpl"}
</div><!-- page -->
