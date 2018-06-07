<div class="navTable_border">
<table class="navTable" style="width:350px;">
	<tr>        
        <th {if $active_page eq "tbl_complaints"}class="active"{else}class="link" onclick='window.location.href="{$website}/user/tbl_complaints.php";'{/if}>{$_lang.tbl_complaints.listing_title}</th>
        <th {if $active_page eq "tbl_feedback"}class="active"{else}class="link" onclick='window.location.href="{$website}/user/tbl_feedback.php"'{/if}>{$_lang.tbl_feedback.title}</th>
	</tr>
</table>
</div>
