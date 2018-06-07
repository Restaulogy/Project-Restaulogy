<?php /* Smarty version Smarty-3.1.13, created on 2013-06-19 13:41:23
         compiled from "C:\wamp\www\restaurent_manager\modules\templates\_templates\helvetica\header_title.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2047651c167ab1e82c3-47057062%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '450c2a027046ff4b78c12d1983b34991932c60e8' => 
    array (
      0 => 'C:\\wamp\\www\\restaurent_manager\\modules\\templates\\_templates\\helvetica\\header_title.tpl',
      1 => 1331894796,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2047651c167ab1e82c3-47057062',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'info' => 0,
    'ELGG_GREEN' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51c167ab283df6_60431442',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51c167ab283df6_60431442')) {function content_51c167ab283df6_60431442($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'C:\\wamp\\www\\restaurent_manager\\class\\Smarty\\libs\\plugins\\modifier.date_format.php';
?><div id="tbl_header_title">
    <h2 style="color:#FFFFFF;"><?php echo $_smarty_tpl->tpl_vars['info']->value['template_content']['title'];?>
</h2>
    <p>  Deal for <b style="color:<?php echo $_smarty_tpl->tpl_vars['ELGG_GREEN']->value;?>
;"><?php echo $_smarty_tpl->tpl_vars['info']->value['template_content']['metro_area'];?>
</b><br> Valid upto <b style="color:<?php echo $_smarty_tpl->tpl_vars['ELGG_GREEN']->value;?>
;"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['info']->value['template_content']['end_date'],"%e, %B");?>
</b>
    </p>
</div>

<?php }} ?>