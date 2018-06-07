{*****************************************

         Registration Template 
          phpDirectorySource

******************************************}
{*****************************************

   Get Template Config Variables

******************************************}
{config_load file="$deftpl/system.conf" section='register'}
{*****************************************

   Display Header

******************************************}
{include file="$deftpl/sitehead.tpl"}
{*****************************************

   Page Display

******************************************}
{if $page == 0}
        {include file="$deftpl/register_0.tpl"}
{elseif $page == 1}
		{include file="$deftpl/register_1.tpl"}
{elseif $page == 2}
        {include file="$deftpl/register_2.tpl"}
{elseif $page == 3}
        {include file="$deftpl/register_3.tpl"}
{elseif $page == 4}
      	{include file="$deftpl/register_4.tpl"}
{/if}
{*****************************************

   Display Footer

******************************************}
{include file="$deftpl/sitefoot.tpl"}
