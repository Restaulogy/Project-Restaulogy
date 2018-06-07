{*****************************************

        Edit Category Template 
          phpDirectorySource

******************************************}
{*****************************************

   Get Template Config Variables

******************************************}
{config_load file="$deftpl/system.conf" section='edcat'}
{*****************************************

   Display Header

******************************************}
{include file="$deftpl/sitehead.tpl"}
{*****************************************

   Page Display

******************************************}

        {$edcat}

{*****************************************

   Display Footer

******************************************}
{include file="$deftpl/sitefoot.tpl"}
