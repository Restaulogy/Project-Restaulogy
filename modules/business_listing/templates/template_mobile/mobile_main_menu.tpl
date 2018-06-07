<center>
	<div data-role="controlgroup" data-type="horizontal">
		<a href="{$BASE_URL}page_all_jobs/" title="All Projects" data-role="button" rel="external" data-icon="grid" data-iconpos="notext"></a>
  <a href="{$BASE_URL}page_popular_jobs/" title="Popular Projects" data-role="button" rel="external"data-icon="star" data-iconpos="notext"></a>
		{if $elgg_user_acct_type eq "business" || $elgg_user_acct_type eq "social/business organization"}
		<a href="{$BASE_URL}{$URL_JOBS_AT_COMPANY}/{$elgg_current_user}/"  title="My Projects" data-role="button" rel="external"data-icon="star" data-iconpos="notext"></a>
		{/if}
		<a href="{$BASE_URL}prj_applied_by_me/" title="Project bidden by Me" data-role="button" rel="external"data-icon="star" data-iconpos="notext"></a>
		<a href="{$BASE_URL}posted_by_connection/" data-role="button" rel="external" data-icon="gear" data-iconpos="notext" title="By Connection"></a>
		<a href="{$BASE_URL}posted_by_groupmem/" data-role="button" rel="external" data-icon="check" data-iconpos="notext" title="By Group"></a>
		<a href="{$BASE_URL}quick_search/" data-role="button" rel="external" data-icon="search" data-iconpos="notext" title="search"></a>
        {if $elgg_user_acct_type eq "business" || $elgg_user_acct_type eq "social/business organization"}
		<a href="{$BASE_URL}post/" data-role="button" rel="external" data-icon="add" data-iconpos="notext" title="Add New"></a>
		{/if}
		<a href="{$BASE_URL}filter/" data-role="button" rel="external" data-icon="search" data-iconpos="notext" title="My filter"></a>
	</div>
</center>
