<div class="navTable">
	<table class="navTable" style="width:100%">
		<tr>
                
                {if $sesslife AND ($Global_member.member_role_id eq $smarty.const.ROLE_MANAGER OR $Global_member.member_role_id eq $smarty.const.ROLE_ADMIN OR $Global_member.member_role_id eq $smarty.const.ROLE_WAITER)}
                
                <th {if $active_page eq "tbl_complaints"}class="active"{else}class="link" onclick='window.location.href="{$website}/user/tbl_complaints.php";'{/if}>{$_lang.tbl_complaints.listing_title}
                </th>
                <th {if $active_page eq "tbl_dishes"}class="active"{else}class="link" onclick='window.location.href="{$website}/user/tbl_feedback_stats.php";'{/if}>{$_lang.tbl_feedback.feed_stats}
                </th>
               
                {else}
                    
                    <th {if $active_page eq "tbl_complaints"}class="active"{else}class="link" onclick='window.location.href="{$website}/user/tbl_complaints.php?mode={$smarty.const.MODE_CREATE}";'{/if}>{$_lang.tbl_complaints.listing_title}</th>
                    
                    <th {if $active_page eq "tbl_feedback"}class="active"{else}class="link" onclick='window.location.href="{$website}/user/tbl_feedback.php"'{/if}>{$_lang.tbl_feedback.create_title}</th>
                {/if}
		</tr>
	</table>
</div>
<br>
