

{*****************************************

   Display Header

******************************************}
{include file="$deftpl/sitehead.tpl"}
{*****************************************

   Page Display

******************************************}

 <div id="listing_panel">
	<ul>
	   	<li class="UItabs"><a href="#list_Fetured">{$translations.promotion.listing_title}</a></li>
	   	<li class="UItabs"><a href="#list_Recent">Recent</a></li>
	   	<li class="UItabs"><a href="#list_Popular">Popular</a></li>
	   	<li class="UItabs"><a href="#list_Connection">Connection</a></li>
	   	<li class="UItabs"><a href="#list_Group">Group</a></li>
	</ul>
	
   <div id="list_Fetured">
    <!-- For Fetured listing -->
	   {if count($feature_list) > 0}
			{assign var="list" value=$feature_list}
			    {section name=itm loop=$list}
                  {assign var="prefix_tab" value="feature"}
			      {assign var="subfile" value=$list[itm].subfile}
			      {include file="$deftpl/sublist/$subfile"}
			    {/section}

	    {else}
	            <div class="fail">
	               {lang->desc p1='user' p2=$lang_set p3='no_list_found'}
	          </div>
	  	{/if}

   </div>
	<div   id="list_Recent">
    <!-- For Recent listing -->
        {if count($recent_list) > 0}
	    	{assign var="list" value=$recent_list}
		    	{section name=itm loop=$list}
		    	     {assign var="prefix_tab" value="recent"}
		      		{assign var="subfile" value=$list[itm].subfile}
		      		{include file="$deftpl/sublist/$subfile"}
		    	{/section}
	    {else}
	             <div class="fail">
	               {lang->desc p1='user' p2=$lang_set p3='no_list_found'}
				</div>
		{/if}
	</div>
  	<div   id="list_Popular">
   <!-- For Most Popular listing -->
		{if count($popular_list) > 0}
		  {assign var="list" value=$popular_list}
		    {section name=itm loop=$list}
              {assign var="prefix_tab" value="popular"}
		      {assign var="subfile" value=$list[itm].subfile}
		      {include file="$deftpl/sublist/$subfile"}
		    {/section}

	    {else}
	            <div class="fail">
	               {lang->desc p1='user' p2=$lang_set p3='no_list_found'}
	          </div>
	  {/if}
	</div>

	<div   id="list_Connection">
   <!-- For Most Conncetion listing -->
		{if count($connection_list) > 0}
		  {assign var="list" value=$connection_list}
		    {section name=itm loop=$list}
              {assign var="prefix_tab" value="connection"}
		      {assign var="subfile" value=$list[itm].subfile}
		      {include file="$deftpl/sublist/$subfile"}
		    {/section}

	    {else}
	            <div class="fail">
	               {lang->desc p1='user' p2=$lang_set p3='no_list_found'}
	          </div>
	  {/if}
	</div>

    <div   id="list_Group">
   <!-- For Most Group listing -->
		{if count($connection_list) > 0}
		  {assign var="list" value=$group_list}
		    {section name=itm loop=$list}
              {assign var="prefix_tab" value="group"}
		      {assign var="subfile" value=$list[itm].subfile}
		      {include file="$deftpl/sublist/$subfile"}
		    {/section}

	    {else}
	            <div class="fail">
	               {lang->desc p1='user' p2=$lang_set p3='no_list_found'}
	          </div>
	  {/if}
	</div>
 	</div><!-- listing Panel-->

</center>
{*****************************************

   Display Footer

******************************************}
{include file="$deftpl/sitefoot.tpl"}
