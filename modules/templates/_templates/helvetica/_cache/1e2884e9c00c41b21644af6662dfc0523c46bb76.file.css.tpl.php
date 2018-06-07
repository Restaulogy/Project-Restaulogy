<?php /* Smarty version Smarty-3.1.13, created on 2013-06-19 13:41:22
         compiled from "C:\wamp\www\restaurent_manager\modules\templates\_templates\helvetica\css.tpl" */ ?>
<?php /*%%SmartyHeaderCode:455851c167aadee289-67458219%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1e2884e9c00c41b21644af6662dfc0523c46bb76' => 
    array (
      0 => 'C:\\wamp\\www\\restaurent_manager\\modules\\templates\\_templates\\helvetica\\css.tpl',
      1 => 1331798532,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '455851c167aadee289-67458219',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'BACKCOLOR' => 0,
    'FORECOLOR' => 0,
    'FONTNAME' => 0,
    'HYPERLINK_COLOR' => 0,
    'HYPERLINK_HOVER_COLOR' => 0,
    'HEADER_NOTE_FORECOLOR' => 0,
    'elgg_theme_url' => 0,
    'TABLE_HEADER_FORECOLOR' => 0,
    'TABLE_CELL_FORECOLOR' => 0,
    'ELGG_GREEN' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51c167ab131435_77989240',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51c167ab131435_77989240')) {function content_51c167ab131435_77989240($_smarty_tpl) {?>
<?php $_smarty_tpl->tpl_vars["BACKCOLOR"] = new Smarty_variable("#161616", null, 0);?>
<?php $_smarty_tpl->tpl_vars["FORECOLOR"] = new Smarty_variable("#767572", null, 0);?>
<?php $_smarty_tpl->tpl_vars["FONTNAME"] = new Smarty_variable("Helvetica, Arial, sans-serif", null, 0);?>
<?php $_smarty_tpl->tpl_vars["HYPERLINK_COLOR"] = new Smarty_variable("#61c7dd", null, 0);?>
<?php $_smarty_tpl->tpl_vars["HYPERLINK_HOVER_COLOR"] = new Smarty_variable("#59b8cc", null, 0);?>
<?php $_smarty_tpl->tpl_vars["HEADER_NOTE_FORECOLOR"] = new Smarty_variable("#808080", null, 0);?>
<?php $_smarty_tpl->tpl_vars["TABLE_HEADER_FORECOLOR"] = new Smarty_variable("#f9f8f2", null, 0);?>
<?php $_smarty_tpl->tpl_vars["TABLE_CELL_FORECOLOR"] = new Smarty_variable("#949494", null, 0);?>


<style type="text/css">
body{
  background: <?php echo $_smarty_tpl->tpl_vars['BACKCOLOR']->value;?>
 !important;
  color: <?php echo $_smarty_tpl->tpl_vars['FORECOLOR']->value;?>
 !important;
  font-family:<?php echo $_smarty_tpl->tpl_vars['FONTNAME']->value;?>
 !important;
}
a:link {
	color: <?php echo $_smarty_tpl->tpl_vars['HYPERLINK_COLOR']->value;?>
;text-decoration:none;
}
a:hover {
	color: <?php echo $_smarty_tpl->tpl_vars['HYPERLINK_HOVER_COLOR']->value;?>
; text-decoration:none;
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
  color: <?php echo $_smarty_tpl->tpl_vars['HEADER_NOTE_FORECOLOR']->value;?>
;
}

#tbl_header .header_title {
    width:100%;height: 125px;
}

#tbl_header .header_note_arrow{
  height: 56px; background:url('<?php echo $_smarty_tpl->tpl_vars['elgg_theme_url']->value;?>
/images/arrow.gif') right no-repeat;display: block;
}

#tbl_header .header_title{
	width:504px; height:125px;
}
#tbl_header #tbl_header_title h2{
    padding-top:10px;   font-size: 30px; font-weight: bold;
    text-align:left;  line-height:32px;
    color: <?php echo $_smarty_tpl->tpl_vars['TABLE_HEADER_FORECOLOR']->value;?>
;
}

#tbl_header .header_title p {
     font-size: 18px; font-weight: normal;
	color: <?php echo $_smarty_tpl->tpl_vars['TABLE_CELL_FORECOLOR']->value;?>
;
}

#tbl_header .header_title #tbl_header_title p b{

	color: <?php echo $_smarty_tpl->tpl_vars['ELGG_GREEN']->value;?>
;
}


#tbl_header .header_title_icon{
	display:block;width:96px; height:125px; vertical-align:top;
	background: transparent url('<?php echo $_smarty_tpl->tpl_vars['elgg_theme_url']->value;?>
/images/badge-whats-new.gif')  no-repeat;
}



#top_seperator{
    background-image: url('<?php echo $_smarty_tpl->tpl_vars['elgg_theme_url']->value;?>
/images/header_top_separator.gif'); background-repeat: no-repeat; height: 7px;display: block;
}

#top_border{
    height: 16px; background-image: url('<?php echo $_smarty_tpl->tpl_vars['elgg_theme_url']->value;?>
/images/header_border.gif'); background-repeat: no-repeat;dislay:block;
}


#tbl_middle{
	padding-top: 10px; text-align:left;width:600px;
}

#tbl_middle .middle_border_seperator{
    height:25px;width:599px;display:block;border-top:#666 ridge 1px;
}

#tbl_middle th{
    font-size: 24px; font-weight: bold;  text-align:left;
    color:<?php echo $_smarty_tpl->tpl_vars['TABLE_HEADER_FORECOLOR']->value;?>
;
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
    font-size: 17px; font-weight: bold;   color:<?php echo $_smarty_tpl->tpl_vars['TABLE_HEADER_FORECOLOR']->value;?>
;
    text-align:left; padding:0px; margin:0px;
}

#email td{
   font-size: 12px;
}

</style>

<?php }} ?>