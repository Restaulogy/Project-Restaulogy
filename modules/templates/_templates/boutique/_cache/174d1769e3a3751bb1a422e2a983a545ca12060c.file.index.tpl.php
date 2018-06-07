<?php /* Smarty version Smarty-3.1.13, created on 2015-06-30 14:07:07
         compiled from "C:\wamp\www\restaurant_in\modules\templates\_templates\boutique\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2089355925533091740-98545845%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '174d1769e3a3751bb1a422e2a983a545ca12060c' => 
    array (
      0 => 'C:\\wamp\\www\\restaurant_in\\modules\\templates\\_templates\\boutique\\index.tpl',
      1 => 1331892742,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2089355925533091740-98545845',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'elgg_theme_url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_559255330d7c51_39097064',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_559255330d7c51_39097064')) {function content_559255330d7c51_39097064($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


    <div align="center" width="100%" style="background: transparent url('<?php echo $_smarty_tpl->tpl_vars['elgg_theme_url']->value;?>
/images/bg_email.jpg') repeat-y center top; padding: 15px 0 15px">
        <?php echo $_smarty_tpl->getSubTemplate ("top.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

 </div>
  <div align="center" width="100%">
            <?php echo $_smarty_tpl->getSubTemplate ("body.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

  </div>


<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }} ?>