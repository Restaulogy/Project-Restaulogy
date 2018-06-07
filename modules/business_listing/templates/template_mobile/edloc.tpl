{*****************************************

        Edit Locations Template 
          phpDirectorySource

******************************************}
{*****************************************

   Get Template Config Variables

******************************************}
{config_load file="$deftpl/system.conf" section='edloc'}
{*****************************************

   Display Header

******************************************}
{include file="$deftpl/sitehead.tpl"}
{*****************************************

   Page Display

******************************************}

        {$edloc}

{*****************************************

   Display Footer

******************************************}
{include file="$deftpl/sitefoot.tpl"}
