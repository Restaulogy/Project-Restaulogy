

{*****************************************

   Display Header

******************************************}
{include file="$deftpl/sitehead.tpl"}
{*****************************************

   Page Display

******************************************}

  {if count($recent_list) > 0}
	{if $fav_operation}
	    <div class="approved">
	        {$fav_operation}
	    </div>
    {/if}
    {assign var="list" value=$recent_list}
    {section name=itm loop=$list}
      {assign var="subfile" value=$list[itm].subfile}
      {include file="$deftpl/sublist/$subfile"}
    {/section}

    {else}
             <div class="fail">
               {lang->desc p1='user' p2=$lang_set p3='no_list_found'}
          </div>
  {/if}



{*****************************************

   Display Footer

******************************************}
{include file="$deftpl/sitefoot.tpl"}
