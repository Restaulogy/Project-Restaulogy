<a href="#" onclick="window.open('show.php?lid={$list[itm].id}&amp;show_type=BL');" title="View Listing">
	


		{if $list[itm].logo != ""}
			<img class="myimage"  border="0" src="logo/{$list[itm].logo}"/>
		{else}
		    <img class="myimage"  border="0" src="templates/{$deftpl}/images/nologo.jpg" />
		{/if}
</a>

