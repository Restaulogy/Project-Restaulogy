<div id="popupAddSiteReview" class='ui-body-a'>

<div data-role="content" style="padding:5px;">
    <h4>Which review site would you like to write review?</h4>
    <ul data-role="listview" data-inset="true" style="min-width:210px;" >
		 <!-- <li data-role="divider" data-theme="d2">Write review</li> -->
		 {foreach from=$restaurentinfo.rest_review_systems key=myId item=val}
            {if $myId eq 'rev_sys_yelp' and $val neq ''}
			     <li><a href="#" onclick="alert('{$_lang.downtown_demo_review_lnk}')" target="_balnk">Zomato</a></li>
			{/if}
			{if $myId eq 'rev_sys_tripadvisor' and $val neq ''}
			     <li><a href="#" onclick="alert('{$_lang.downtown_demo_review_lnk}')" target="_balnk">Tripadvisor</a></li>
			{/if}
			{if $myId eq 'rev_sys_urbanspoon' and $val neq ''}
			     <li><a href="#" onclick="alert('{$_lang.downtown_demo_review_lnk}')" target="_balnk">Urbanspoon</a></li>
			{/if}
			{if $myId eq 'rev_sys_google' and $val neq ''}
			     <li><a href="#" onclick="alert('{$_lang.downtown_demo_review_lnk}')" target="_balnk">Google</a></li>
			{/if}
		 {/foreach}
	</ul>
						
	<div class="biz_center">
        <!-- <input type="button" data-icon="delete" data-inline="true" onclick="$('#popupAddSiteReview').hide();" value="{$_lang.cancel_lbl}"/> -->
    </div>
</div>

</div>
