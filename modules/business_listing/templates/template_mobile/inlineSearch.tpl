<div data-role="popup" id="popupsearch" data-dismissible="false" style="width:232px;" data-overlay-theme="a">
    <div data-role="header">
		<h1>Search Promotions</h1>
	</div>
	<div data-role="content" data-theme="c" style="padding:5px;">
	 <form name="top_search" id="top_search" action="search.php" method="post" data-ajax="false">
		<input class="searchfield" placeholder="keyword" type="text" id="search_keywords" name="sk" value="{$search_key}"/>
		<input type="hidden" name="sa" value="site"/>
		<input type="hidden" name="st" value="any"/>
		<input type="hidden" name="listing_type" value="{$listing_type}" />
		<div class="line_break"></div>
		<div class="biz_center">
		<input data-inline="true" data-icon="search" type="button"  onclick="$('#top_search').submit();" name="sp" value="Search"/>
		<input type="button" data-inline="true" data-icon="delete" onclick="$('#popupsearch').popup('close');"value="Cancel"/>
		</div>
	</form>
	</div>
</div>
