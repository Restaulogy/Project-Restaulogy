<?php /* Smarty version Smarty-3.1.13, created on 2013-07-12 09:26:20
         compiled from "C:\wamp\www\restaurent_manager\modules\templates\_templates\boutique\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3205351df7e64b81797-88290397%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7457bb1c930fceb6ceb0d09ba45b474c22fdf7f9' => 
    array (
      0 => 'C:\\wamp\\www\\restaurent_manager\\modules\\templates\\_templates\\boutique\\index.tpl',
      1 => 1331892742,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3205351df7e64b81797-88290397',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'elgg_theme_url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51df7e64c9b373_14550904',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51df7e64c9b373_14550904')) {function content_51df7e64c9b373_14550904($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


    <div align="center" width="100%" style="background: transparent url('<?php echo $_smarty_tpl->tpl_vars['elgg_theme_url']->value;?>
/images/bg_email.jpg') repeat-y center top; padding: 15px 0 15px">
        <?php echo $_smarty_tpl->getSubTemplate ("top.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

 </div>
  <div align="center" width="100%">
            <?php echo $_smarty_tpl->getSubTemplate ("body.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

  </div>


<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }} ?>