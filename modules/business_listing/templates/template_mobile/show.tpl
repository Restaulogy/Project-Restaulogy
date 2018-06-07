{*****************************************

            Index Template
          phpDirectorySource

******************************************}
{*****************************************

   Get Template Config Variables

******************************************}
{config_load file="$deftpl/system.conf" section='index'}
{*****************************************

   Display Document Header Containg Scripts/Stylesheets

******************************************}
{include file="$deftpl/header.tpl"}
{*****************************************

   Page Display

******************************************} 

  {include file="$deftpl/list/promotion.tpl"}

{*****************************************

   Display Footer

******************************************}
   {include file="$deftpl/sitefoot.tpl"}


