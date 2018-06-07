	<input type="hidden" name="listing_level" value="{$listing_level}"/>
    <input type="hidden" name="submit_flag" value="1"/>
    <input type="hidden" name="cat_str" value="{$cat_str}"/>
    <center>
	{assign var='fn_js_footer_click_on' value="$('.btn_save_profile').css('display','inline');$('.btn_logo_upload').css('display','none');"}
	{assign var='fn_js_footer_click_off' value="$('.btn_save_profile').css('display','none');$('.btn_logo_upload').css('display','inline');"} 
    <div class="btn_save_profile" style="display:inline;">
    {if $isThisBusProfile == 1}
		<input type="hidden" name="list_reg" value="Save Profile"/>
        <button type="submit"  data-theme="a" data-inline="true">Save Profile</button>
    {else}
		<input type="hidden" name="list_reg" value="{lang->desc p1='register' p2=$lang_set p3='btn_submit'}"/> 
	 	<button type="submit"  data-theme="a" data-inline="true">{lang->desc p1='register' p2=$lang_set p3='btn_submit'}</button>
		
		
		
    {/if}
	<a href="#pglogo" title="Logo" data-theme="a" data-inline="true" data-role="button" onClick="{$fn_js_footer_click_off}" style="font-size:10px !important;">Update Logo</a>
    </div>
      <div class="btn_logo_upload" style="display:none;">
     <input type="button" onclick="filterFileType(logo);"  value="{lang->desc p1='edlist' p2=$lang_set p3='btn_upload'}" data-theme="a" data-inline="true"/>
      </div>
    </center>
    
<div data-role="footer" >
<center>
	<div data-role="navbar">
		<ul>
    
        <li><a href="#detail" title="Detail" data-role="button" data-icon="home" data-iconpos="top" onClick="{$fn_js_footer_click_on}" style="font-size:10px !important;">Detail</a></li>
        <li><a href="#contact" title="Contact Information" data-role="button" data-icon="grid" data-iconpos="top" onClick="{$fn_js_footer_click_on}" style="font-size:10px !important;">Contact</a></li>
        <li><a href="#product" title="Product & Services" data-role="button" data-icon="star" data-iconpos="top" onClick="{$fn_js_footer_click_on}" style="font-size:10px !important;">Product</a></li>
        <li><a href="#settings" title="Settings" data-role="button" data-icon="gear" data-iconpos="top" onClick="{$fn_js_footer_click_on}" style="font-size:10px !important;">Set.</a></li>
        <li><a href="#workhrs" title="Work Hour" data-role="button" data-icon="watch" data-iconpos="top" onClick="{$fn_js_footer_click_on}" style="font-size:10px !important;">Hrs</a></li> 
		</ul>
	</div>
</center>
</div>
<div style="height:55px;display:block;"></div>
