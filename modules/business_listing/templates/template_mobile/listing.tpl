

{*****************************************

   Display Header

******************************************}
{include file="$deftpl/sitehead.tpl"}
{*****************************************

   Page Display

******************************************}

 <div id="listing_panel">
 <ul>
   	<li class="UItabs"><a href="#list_Fetured">All Listing</a></b></li>
   	<li class="UItabs"><a href="#list_Recent">Recent</a></b></li>
   	<li class="UItabs"><a href="#list_Popular">Popular</a></b></li>
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
	<div id="list_Recent">
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


 	</div><!-- listing Panel-->

</center>
{*****************************************

   Display Footer

******************************************}
{include file="$deftpl/sitefoot.tpl"}
