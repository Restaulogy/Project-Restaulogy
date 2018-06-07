<?php /* Smarty version Smarty-3.1.13, created on 2013-12-03 11:06:15
         compiled from "C:\wamp\www\restaurent_manager\modules\templates\_templates\classic\header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10307529d6dcf25d957-24298935%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '682b8b4e6f73ee7a229919889a13b2e712509738' => 
    array (
      0 => 'C:\\wamp\\www\\restaurent_manager\\modules\\templates\\_templates\\classic\\header.tpl',
      1 => 1331788996,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10307529d6dcf25d957-24298935',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'html_title' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_529d6dcf285465_94497296',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_529d6dcf285465_94497296')) {function content_529d6dcf285465_94497296($_smarty_tpl) {?>
<html>
<head>
<title><?php echo $_smarty_tpl->tpl_vars['html_title']->value;?>
</title>
<?php echo $_smarty_tpl->getSubTemplate ("css.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</head>
<?php }} ?>