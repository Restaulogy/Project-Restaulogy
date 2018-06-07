{include file="$deftpl/header.tpl"}
<div data-role="page" id="view_result">
    <div data-role="header">
        <a href="{$vs_config.mainurl}/promotionslisting.php?listing_type=all&show_type={$show_type}" data-role="button" data-icon="home" data-iconpos="notext"  rel="external"></a>
        
		<h4>Filter Result</h4>
  <a href="filter.php?show_type={$show_type}" data-role="button" target="_blank" data-icon="plus" data-iconpos="left" rel="external">Set Alert</a>
	</div><!--header-->
	{if $show_filter}
         <div class='attention' style='text-align:left;font-size:11px;font-weight:normal;'>
		 	<b style='color:#FC6300;'>Filter : </b> {$show_filter}
		</div>
	{else}
         <div class='attention' style='text-align:left;font-size:11px;font-weight:normal;'>
		 	<b style='color:#FC6300;'>Filter : </b> No alerts are set.<a href="filter.php?show_type={$show_type}" >Add new Alert</a>
	 	</div>
    {/if}
	<div data-role="content">


            {if $list}
                <ul data-role="listview"  data-filter="true" data-inset="true">
                {section name=itm loop=$list}
            	    {assign var="subfile" value=$list[itm].subfile}
                    {include file="$deftpl/sublist/$subfile"}
                {/section}
            	</ul>
            	{if $paginate.total > $vs_config.search_page}
    		         <div align=center style="font-size: 10pt; font-weight: normal; color: black;">
    		           {paginate_prev}{paginate_middle format='page' prefix='[' suffix=']' page_limit='10'}{paginate_next}
    		          </div>
        		{/if}
            {else}
                <div class="notice">
                    Sorry! No {if $show_type == PR} promotion{else} business {/if} matches your criteria.
                </div>

            {/if}
	</div><!--Content-->
	
    <div data-role="footer">
		<center>
			<a href="#grid_filter" data-role="button" data-icon="search"><small>View Alert</small></a>
            {if $show_type eq 'PR'}
			<!-- <a href="promotionslisting.php?show_type=PR&listing_type=filter" data-role="button" data-icon="tag"><small>Coupons</small></a>
			-->
            {/if}
		</center>
	</div><!--footer-->
	
</div><!--Page-->
<div data-role="page" id="grid_filter">
      <div data-role="header">
        <a href="{$vs_config.mainurl}/promotionslisting.php?listing_type=all&show_type={$show_type}" data-icon="home" data-iconpos="notext" rel="external"></a>
		<h4>View Alert</h4>
    <a  href="filter.php?show_type={$show_type}" data-role="button" target="_blank" data-icon="plus" data-iconpos="notext"  rel="external">Set Alert</a>
	</div>
	<div data-role="content">

<center>
 	<div style="border:1px solid #CCC;width:300px;">
 		<div class="top_line" style="text-align:left;">
 		    <center><b style='font-size:14px;padding:2px;'>Alerts</b></center>
   		</div>

    	{if $filters}
		    <table id="results" style="border-collapse: collapse;margin:5px;">
			    <tr>
			    {assign var=th_style value="font-size:12px;font-weight:bolder;color:#17a;border-bottom:2px solid #ccc;border-top:2px solid #ccc;background:#fffff0;padding:4px 4px 4px 8px;text-align:center;"}
			        <td style="width:100px;{$th_style}">Title</td>
                    <td style="width:100px;{$th_style}">Created date</td>
			        <td style="width:100px;{$th_style}">Actions</td>
			    </tr>
		    	{section name=pitm loop=$filters}
			      {if $smarty.section.pitm.iteration%2}
			        <tr style='background:#efefef;'>
			      {else}
			          <tr style='background:#fff;'>
			      {/if}
		      		{assign var=td_style value="font-size:11px;padding:2px;border-bottom:1px solid #ccc;"}

			        <td style="width:100px;{$td_style}">{if $filters[pitm].title}{$filters[pitm].title}{else}Alert{/if}</td>
			        <td style="width:100px;{$td_style}"><center>{$filters[pitm].created_date|date_format:"%B %e, %Y"}</center></td>

			        <td style="width:100px;{$td_style}"><center><a style='color:#fc6300;font-size:10px;font-weight:normal;'   href="promotionslisting.php?show_type={$show_type}&listing_type=filter&filter_id={$filters[pitm].id}">Result</a>&nbsp;|&nbsp;<a style='color:#fc6300;font-size:10px;font-weight:normal;' target="_blank" href="filter.php?isView&show_type={$show_type}&filter_id={$filters[pitm].id}" >View</a>&nbsp;|&nbsp;<a style='color:#fc6300;font-size:10px;font-weight:normal;'  href="filter.php?show_type={$show_type}&filter_id={$filters[pitm].id}" data-rel="dialog" data-transition="pop" target="_blank">Edit</a>&nbsp;|&nbsp;<a style='color:#fc6300;font-size:10px;font-weight:normal;'  href="filter.php?show_type={$show_type}&filter_id={$filters[pitm].id}&amp;delete=1">Delete</a></center></td>
			     </tr>
		    {/section}
		  </table>
		    {assign var="table_id" value="results"}
            {include file="$deftpl/controls/pagination.tpl"}
		  {else}
			<div class="fail">
		        There is no alert set by you.
		    </div>
		  {/if}
    <div class="bottom_line"></div>
 </div>
</center>


	</div>
	 <div data-role="footer">
		<center>
        <a href="#view_result" data-role="button" data-icon="grid"><small>View Result</small></a>
        {if $show_type eq 'PR'}
			<!-- <a href="promotionslisting.php?show_type=PR&listing_type=filter" data-role="button" data-icon="tag"><small>Coupons</small></a> -->
        {/if}
		</center>
	</div><!--footer-->
</div>

{include file="$deftpl/sitefoot.tpl"}



