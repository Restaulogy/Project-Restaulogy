<?php /* Smarty version Smarty-3.1.13, created on 2015-06-30 14:07:07
         compiled from "C:\wamp\www\restaurant_in\modules\templates\_templates\boutique\top.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10208559255331684f8-76605439%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bc93a12d1c20c1daf11d189db68df715367e89c1' => 
    array (
      0 => 'C:\\wamp\\www\\restaurant_in\\modules\\templates\\_templates\\boutique\\top.tpl',
      1 => 1386049337,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10208559255331684f8-76605439',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'elgg_theme_url' => 0,
    'elgg_main_url' => 0,
    'elgg_site_logo' => 0,
    'elgg_site_name' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5592553318b781_82486237',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5592553318b781_82486237')) {function content_5592553318b781_82486237($_smarty_tpl) {?>
<table cellpadding="0" cellspacing="0" border="0" align="center" width="599" style="font-family: Georgia, serif; background: url('<?php echo $_smarty_tpl->tpl_vars['elgg_theme_url']->value;?>
/images/bg_header.jpg') no-repeat center top" height="142">
  <tr>
    <td style="margin: 0; padding: 15px 0 5px 0 ; background: #c89c22 url('<?php echo $_smarty_tpl->tpl_vars['elgg_theme_url']->value;?>
/images/bg_header.jpg') no-repeat center top" align="center" valign="top">
  <a href="<?php echo $_smarty_tpl->tpl_vars['elgg_main_url']->value;?>
" target="_blank" style="color:#fff !important;vertical-align: top !important;font-size:30px;font-weight: bold;line-height: 60px;"><img src="<?php echo $_smarty_tpl->tpl_vars['elgg_site_logo']->value;?>
" style="width:80px;height:80px;border:none;" /><?php echo $_smarty_tpl->tpl_vars['elgg_site_name']->value;?>
</a>
    </td>
  </tr>
  <tr>
    <td style="margin: 0; padding: 25px 0 0;" align="center" valign="top">
		<p style="color: #645847; font: bold 11px Georgia, serif; margin: 0; padding: 0; line-height: 12px; text-transform: uppercase;"></p>
    </td>
  </tr>
  <tr>
	  <td style="font-size: 1px; height: 15px; line-height: 1px;" height="15">&nbsp;</td>
  </tr>
</table><!-- header-->
<?php }} ?>