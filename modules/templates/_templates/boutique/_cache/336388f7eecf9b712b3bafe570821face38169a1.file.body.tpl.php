<?php /* Smarty version Smarty-3.1.13, created on 2015-06-30 14:07:07
         compiled from "C:\wamp\www\restaurant_in\modules\templates\_templates\boutique\body.tpl" */ ?>
<?php /*%%SmartyHeaderCode:272895592553319f005-29458148%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '336388f7eecf9b712b3bafe570821face38169a1' => 
    array (
      0 => 'C:\\wamp\\www\\restaurant_in\\modules\\templates\\_templates\\boutique\\body.tpl',
      1 => 1364975053,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '272895592553319f005-29458148',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'elgg_theme_url' => 0,
    'info' => 0,
    'translations' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_559255332951c1_44957706',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_559255332951c1_44957706')) {function content_559255332951c1_44957706($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'C:\\wamp\\www\\restaurant_in\\class\\Smarty\\libs\\plugins\\modifier.date_format.php';
if (!is_callable('smarty_modifier_replace')) include 'C:\\wamp\\www\\restaurant_in\\class\\Smarty\\libs\\plugins\\modifier.replace.php';
?><table cellpadding="0" cellspacing="0" border="0" align="center" width="599" style="font-family: Georgia, serif;" >
  <tr>
    <td width="599" valign="top" align="left" bgcolor="#ffffff" style="font-family: Georgia, serif; background: #fff; border-top: 5px solid #e5bd5f">
		<table cellpadding="0" cellspacing="0" border="0"  style="color: #717171; font: normal 11px Georgia, serif; margin: 0; padding: 0;" width="599">
		<tr>
			<td width="15" style="font-size: 1px; line-height: 1px; width: 15px;"><img src="<?php echo $_smarty_tpl->tpl_vars['elgg_theme_url']->value;?>
/images/spacer.gif" alt="space" width="15"></td>
			<td style="padding: 15px 0 5px; font-family: Georgia, serif;" valign="top" align="center" width="569">
				<img src="<?php echo $_smarty_tpl->tpl_vars['elgg_theme_url']->value;?>
/images/divider_top_full.png" alt="divider"><br>
			</td>
			<td width="15" style="font-size: 1px; line-height: 1px; width: 15px;"><img src="<?php echo $_smarty_tpl->tpl_vars['elgg_theme_url']->value;?>
/images/spacer.gif" alt="space" width="15"></td>
		</tr>
		<tr>
			<td width="15" style="font-size: 1px; line-height: 1px; width: 15px;"><img src="<?php echo $_smarty_tpl->tpl_vars['elgg_theme_url']->value;?>
/images/spacer.gif" alt="space" width="15"></td>
			<td style="padding: 10px 0 0; font-family: Helvetica, Arial, sans-serif;" align="left">
				<h2 id="header_title"><?php echo $_smarty_tpl->tpl_vars['info']->value['template_content']['title'];?>
</h2>
                <span style="font-size: 14px;">  Deal for <b><?php echo $_smarty_tpl->tpl_vars['info']->value['template_content']['metro_area'];?>
</b> Valid upto <b><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['info']->value['template_content']['end_date'],"%e, %B");?>
</b>
                </span>
			</td>
			<td width="15" style="font-size: 1px; line-height: 1px; width: 15px;"><img src="<?php echo $_smarty_tpl->tpl_vars['elgg_theme_url']->value;?>
/images/spacer.gif" alt="space" width="15"></td>
		</tr>

		<tr>
			<td width="15" style="font-size: 1px; line-height: 1px; width: 15px;"><img src="<?php echo $_smarty_tpl->tpl_vars['elgg_theme_url']->value;?>
/images/spacer.gif" alt="space" width="15"></td>
			<td style="padding: 15px 0 5px; font-family: Georgia, serif;" valign="top" align="center" width="569">
              <?php echo $_smarty_tpl->getSubTemplate ("biz_info.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

			</td>
			<td width="15" style="font-size: 1px; line-height: 1px; width: 15px;"><img src="<?php echo $_smarty_tpl->tpl_vars['elgg_theme_url']->value;?>
/images/spacer.gif" alt="space" width="15"></td>
		</tr>
	</table>
   </td>
  </tr> 
  <?php if ($_smarty_tpl->tpl_vars['info']->value['template_content']['image']&&$_smarty_tpl->tpl_vars['info']->value['template_content']['image']!=''){?>
  <tr>
    <td width="599" valign="top" align="left" bgcolor="#ffffff" style="font-family: Georgia, serif; background: #fff; ">
	<table cellpadding="0" cellspacing="0" border="0"  style="color: #717171; font: normal 11px Georgia, serif; margin: 0; padding: 0;" width="599">
		<tr>
			<td width="15" style="font-size: 1px; line-height: 1px; width: 15px;"><img src="<?php echo $_smarty_tpl->tpl_vars['elgg_theme_url']->value;?>
/images/spacer.gif" alt="space" width="15"></td>
			<td style="padding: 10px 0 0; font-family: Helvetica, Arial, sans-serif;" align="center">
            <?php echo $_smarty_tpl->tpl_vars['info']->value['template_content']['image_box'];?>

			</td>
		</tr>
    </table>
  </td>
 </tr>
 <?php }?>
 
 <tr>
    <td width="599" valign="top" align="left" bgcolor="#ffffff" style="font-family: Georgia, serif; background: #fff; ">
	<table cellpadding="0" cellspacing="0" border="0"  style="color: #717171; font: normal 11px Georgia, serif; margin: 0; padding: 0;" width="599">
		<tr>
			<td width="15" style="font-size: 1px; line-height: 1px; width: 15px;"><img src="<?php echo $_smarty_tpl->tpl_vars['elgg_theme_url']->value;?>
/images/spacer.gif" alt="space" width="15"></td>
			<td style="padding: 10px 0 0; font-family: Helvetica, Arial, sans-serif;" align="left">
	<b style="font-size:18px;line-height:30px;">Description:</b>
    <p style="color:#767676; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 16px;">
                <?php echo smarty_modifier_replace(smarty_modifier_replace(smarty_modifier_replace($_smarty_tpl->tpl_vars['info']->value['template_content']['description'],'\r\n','<BR>'),"'","'"),'"','"');?>

    </p>
			</td>
		</tr>
		<tr>
			<td width="15" style="font-size: 1px; line-height: 1px; width: 15px;"><img src="<?php echo $_smarty_tpl->tpl_vars['elgg_theme_url']->value;?>
/images/spacer.gif" alt="space" width="15"></td>
			<td style="padding: 10px 0 0; font-family: Helvetica, Arial, sans-serif;" align="left">
				<img src="<?php echo $_smarty_tpl->tpl_vars['elgg_theme_url']->value;?>
/images/divider_full.png" alt="divider">
			</td>
		</tr>
		<tr>
				<td colspan="2" style="padding: 10px 0 0;  border-bottom:4px solid #c89c22;"></td>
		</tr>
		</table>
	</td>
  </tr>
 <tr>
	  <td style="font-size: 1px; height: 10px; line-height: 1px;" height="10"><img src="<?php echo $_smarty_tpl->tpl_vars['elgg_theme_url']->value;?>
/images/spacer.gif" alt="space" width="15"></td>
  </tr>
  <tr>
   <td align="center" >
    <table class="footer">
			      <tr>
			        <td>
                       <?php echo $_smarty_tpl->tpl_vars['translations']->value['copyright'];?>

					</td>
			      </tr>
	</table><!-- footer-->
	<br/>
	</td>
  </tr>
</table><!-- body -->
<?php }} ?>