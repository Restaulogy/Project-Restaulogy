
{assign var="BACKCOLOR" value="#161616"}
{assign var="FORECOLOR" value="#767572"}
{assign var="FONTNAME" value="Helvetica, Arial, sans-serif"}
{assign var="HYPERLINK_COLOR" value="#61c7dd"}
{assign var="HYPERLINK_HOVER_COLOR" value="#59b8cc"}
{assign var="HEADER_NOTE_FORECOLOR" value="#808080"}
{assign var="TABLE_HEADER_FORECOLOR" value="#f9f8f2"}
{assign var="TABLE_CELL_FORECOLOR" value="#949494"}

{literal}
<style type="text/css">
body{
  background: {/literal}{$BACKCOLOR}{literal} !important;
  color: {/literal}{$FORECOLOR}{literal} !important;
  font-family:{/literal}{$FONTNAME}{literal} !important;
}
a:link {
	color: {/literal}{$HYPERLINK_COLOR}{literal};text-decoration:none;
}
a:hover {
	color: {/literal}{$HYPERLINK_HOVER_COLOR}{literal}; text-decoration:none;
}

td {
  vertical-align:top !important;
}

#tbl_container{
   width:100% !important;
}

#tbl_content{
    font: 14px ; line-height:125%;
    text-align:left;width:600px;
}

#tbl_header{
      width:600px; height:204px;
}

#tbl_header .header_note{
  font-size: 11px;padding-top: 15px;
  color: {/literal}{$HEADER_NOTE_FORECOLOR}{literal};
}

#tbl_header .header_title {
    width:100%;height: 125px;
}

#tbl_header .header_note_arrow{
  height: 56px; background:url('{/literal}{$elgg_theme_url}{literal}/images/arrow.gif') right no-repeat;display: block;
}

#tbl_header .header_title{
	width:504px; height:125px;
}
#tbl_header #tbl_header_title h2{
    padding-top:10px;   font-size: 30px; font-weight: bold;
    text-align:left;  line-height:32px;
    color: {/literal}{$TABLE_HEADER_FORECOLOR}{literal};
}

#tbl_header .header_title p {
     font-size: 18px; font-weight: normal;
	color: {/literal}{$TABLE_CELL_FORECOLOR}{literal};
}

#tbl_header .header_title #tbl_header_title p b{

	color: {/literal}{$ELGG_GREEN}{literal};
}


#tbl_header .header_title_icon{
	display:block;width:96px; height:125px; vertical-align:top;
	background: transparent url('{/literal}{$elgg_theme_url}{literal}/images/badge-whats-new.gif')  no-repeat;
}



#top_seperator{
    background-image: url('{/literal}{$elgg_theme_url}{literal}/images/header_top_separator.gif'); background-repeat: no-repeat; height: 7px;display: block;
}

#top_border{
    height: 16px; background-image: url('{/literal}{$elgg_theme_url}{literal}/images/header_border.gif'); background-repeat: no-repeat;dislay:block;
}


#tbl_middle{
	padding-top: 10px; text-align:left;width:600px;
}

#tbl_middle .middle_border_seperator{
    height:25px;width:599px;display:block;border-top:#666 ridge 1px;
}

#tbl_middle th{
    font-size: 24px; font-weight: bold;  text-align:left;
    color:{/literal}{$TABLE_HEADER_FORECOLOR}{literal};
}

#seperator{
   height: 30px;
}

#tbl_footer{
  padding-top: 10px; text-align:left;width:600px;
}


#email {
  width:100%;
}
#email th{
    font-size: 17px; font-weight: bold;   color:{/literal}{$TABLE_HEADER_FORECOLOR}{literal};
    text-align:left; padding:0px; margin:0px;
}

#email td{
   font-size: 12px;
}

</style>
{/literal}
