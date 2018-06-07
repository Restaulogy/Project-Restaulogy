{*****************************************

        Edit Language Template 
          phpDirectorySource

******************************************}

{*****************************************

   Get Template Config Variables

******************************************}
{config_load file="$deftpl/system.conf" section='edlang'}
{*****************************************

   Display Header

******************************************}
{include file="$deftpl/sitehead.tpl"}
{*****************************************

   Page Display

******************************************}
        {$edlang}
{*****************************************

   Display Footer

******************************************}
{include file="$deftpl/sitefoot.tpl"}