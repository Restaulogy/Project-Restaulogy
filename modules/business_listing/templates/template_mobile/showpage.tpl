{*****************************************

         Show A Page Template
          phpDirectorySource

******************************************}
{*****************************************

   Get Template Config Variables

******************************************}
{config_load file="$deftpl/system.conf" section='showpage'}
{*****************************************

   Display Header

******************************************}
{include file="$deftpl/sitehead.tpl"}
{*****************************************

   Page Display

******************************************}
        {include file="$deftpl/$showpage"}
{*****************************************

   Display Footer

******************************************}
{include file="$deftpl/sitefoot.tpl"}