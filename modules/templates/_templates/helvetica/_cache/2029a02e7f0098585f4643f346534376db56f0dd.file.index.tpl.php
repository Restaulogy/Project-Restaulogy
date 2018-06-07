<?php /* Smarty version Smarty-3.1.13, created on 2013-06-19 13:41:22
         compiled from "C:\wamp\www\restaurent_manager\modules\templates\_templates\helvetica\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1812151c167aac4f744-29602209%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2029a02e7f0098585f4643f346534376db56f0dd' => 
    array (
      0 => 'C:\\wamp\\www\\restaurent_manager\\modules\\templates\\_templates\\helvetica\\index.tpl',
      1 => 1344925782,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1812151c167aac4f744-29602209',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'info' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51c167aad88195_35381110',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51c167aad88195_35381110')) {function content_51c167aad88195_35381110($_smarty_tpl) {?>
<html>
<head>
<title>Very Helvetica</title>
     <?php echo $_smarty_tpl->getSubTemplate ("css.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</head>
<body>

<table id="tbl_container">
    <tr>
        <td valign="top">
        <center>
        <?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        </center>
         </td>
    </tr>
</table>
<table id="tbl_container">
    <tr>
        <td valign="top">
        <center>
        <?php echo $_smarty_tpl->getSubTemplate ("middle/biz_info.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        </center>
         </td>
    </tr>
</table>
<?php if ($_smarty_tpl->tpl_vars['info']->value['template_content']['image']&&$_smarty_tpl->tpl_vars['info']->value['template_content']['image']!=''){?>
<table id="tbl_container">
    <tr>
        <td valign="top">
        <center>
         <?php echo $_smarty_tpl->tpl_vars['info']->value['template_content']['image_box'];?>

        </center>
         </td>
    </tr>
</table>
<?php }?>
<table id="tbl_container">
    <tr>
        <td valign="top">
        <center>
        <?php echo $_smarty_tpl->getSubTemplate ("middle/description.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        </center>
         </td>
    </tr>
</table>
<table id="tbl_container">
    <tr>
        <td valign="top">
        <center>
        <?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        </center>
         </td>
    </tr>
</table>
</body>
</html>
<?php }} ?>