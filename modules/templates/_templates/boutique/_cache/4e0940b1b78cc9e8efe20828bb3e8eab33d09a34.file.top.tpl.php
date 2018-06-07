<?php /* Smarty version Smarty-3.1.13, created on 2013-12-03 11:12:20
         compiled from "C:\wamp\www\restaurent_manager\modules\templates\_templates\boutique\top.tpl" */ ?>
<?php /*%%SmartyHeaderCode:674451df7e64df7a64-99810537%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4e0940b1b78cc9e8efe20828bb3e8eab33d09a34' => 
    array (
      0 => 'C:\\wamp\\www\\restaurent_manager\\modules\\templates\\_templates\\boutique\\top.tpl',
      1 => 1386049337,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '674451df7e64df7a64-99810537',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51df7e64e34ad7_02229044',
  'variables' => 
  array (
    'elgg_theme_url' => 0,
    'elgg_main_url' => 0,
    'elgg_site_logo' => 0,
    'elgg_site_name' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51df7e64e34ad7_02229044')) {function content_51df7e64e34ad7_02229044($_smarty_tpl) {?>
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