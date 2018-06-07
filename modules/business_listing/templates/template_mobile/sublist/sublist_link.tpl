<table id="promotion_listing_right_side_button">
    <tr>
		<td>
		{if $list[itm].favorites eq 0}
			<a href="#" onclick='document.location.href="favorite.php?new=1&show_type=BL&lid={$list[itm].id}&uid={$vs_current_user.id}"'>
				<img src='{$elgg_small_icon_url}bookmark_add.png'/>Add Business As Favorite
			</a>
		{else}
			<a href="#" onclick='document.location.href="favorite.php?new=-1&show_type=BL&lid={$list[itm].id}&uid={$vs_current_user.id}"'>
				<img src='{$elgg_small_icon_url}bookmark_remove.png'/>Remove Business From Favorite
			</a>
		{/if}
	    </td>
	</tr>
	<tr>
		<td>
		    <a href="#" onclick="window.open('contact.php?lid={$list[itm].id}');">
				<img src='{$elgg_small_icon_url}mail_new.png'/>{lang->desc p1='contact' p2=$lang_set p3='contact_link'}
			</a>
		</td>
	</tr>
	<tr>
		<td>
		    <a href="#" onclick="window.open('contact.php?lid={$list[itm].id}&act=refer');">
				<img src='{$elgg_small_icon_url}add_user.png'/>{lang->desc p1='contact' p2=$lang_set p3='refer_link'}
			</a>
		</td>
	</tr>
</table>
