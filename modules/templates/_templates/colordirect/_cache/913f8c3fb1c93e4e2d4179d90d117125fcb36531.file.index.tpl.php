<?php /* Smarty version Smarty-3.1.13, created on 2013-12-03 11:10:44
         compiled from "C:\wamp\www\restaurent_manager\modules\templates\_templates\colordirect\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:278455234355e650f34-85325297%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '913f8c3fb1c93e4e2d4179d90d117125fcb36531' => 
    array (
      0 => 'C:\\wamp\\www\\restaurent_manager\\modules\\templates\\_templates\\colordirect\\index.tpl',
      1 => 1386049233,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '278455234355e650f34-85325297',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5234355e943d92_09306213',
  'variables' => 
  array (
    'elgg_theme_url' => 0,
    'elgg_main_url' => 0,
    'elgg_site_logo' => 0,
    'elgg_site_name' => 0,
    'info' => 0,
    'translations' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5234355e943d92_09306213')) {function content_5234355e943d92_09306213($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_replace')) include 'C:\\wamp\\www\\restaurent_manager\\class\\Smarty\\libs\\plugins\\modifier.replace.php';
?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		<table>
			<tr>
			<td width="92">&nbsp;</td>
				<td align="center" style="padding: 5px 0 5px; background:#ffde00 url('<?php echo $_smarty_tpl->tpl_vars['elgg_theme_url']->value;?>
/images/bg_email.png') repeat;color:#000" class="case" width="591">
                   <!-- <a href="<?php echo $_smarty_tpl->tpl_vars['elgg_main_url']->value;?>
" style="background:transparent !important;"><img src="<?php echo $_smarty_tpl->tpl_vars['elgg_site_logo']->value;?>
" alt="logo" style="border:none;"/></a>-->
										<a href="<?php echo $_smarty_tpl->tpl_vars['elgg_main_url']->value;?>
" target="_blank" style="vertical-align:top !important;font-size:40px;font-weight: bold;line-height: 80px;background:transparent !important;"><img src="<?php echo $_smarty_tpl->tpl_vars['elgg_site_logo']->value;?>
" style="width:80px;height:80px;border:none;" /><?php echo $_smarty_tpl->tpl_vars['elgg_site_name']->value;?>
</a>
				</td>
				<td width="92">&nbsp;</td>
			</tr>
		</table>
		
		<table>
			<tr>
			<td width="92">&nbsp;</td>
				<td align="center" style="padding: 5px 0 5px; background:#ffde00 url('<?php echo $_smarty_tpl->tpl_vars['elgg_theme_url']->value;?>
/images/bg_email.png') repeat;color:#000" class="case" width="591">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['elgg_theme_url']->value;?>
/images/bg_divider_top.png" alt="divider" width="600" height="21"/>
				</td>
				<td width="92">&nbsp;</td>
			</tr>
		</table>

        <table>
			<tr>
			<td width="92">&nbsp;</td>
				<td align="center" style="padding: 5px 0 5px; background:#ffde00 url('<?php echo $_smarty_tpl->tpl_vars['elgg_theme_url']->value;?>
/images/bg_email.png') repeat;color:#000" class="case" width="591">
                    <?php echo $_smarty_tpl->getSubTemplate ("container.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

				</td>
				<td width="92">&nbsp;</td>
			</tr>
		</table>
		
		<?php if ($_smarty_tpl->tpl_vars['info']->value['template_content']['image']&&$_smarty_tpl->tpl_vars['info']->value['template_content']['image']!=''){?>
	     <table>
			<tr>
			<td width="92">&nbsp;</td>
				<td align="center" style="padding: 5px 0 5px; background:#ffde00 url('<?php echo $_smarty_tpl->tpl_vars['elgg_theme_url']->value;?>
/images/bg_email.png') repeat;color:#000" class="case" width="591">
                    <?php echo $_smarty_tpl->tpl_vars['info']->value['template_content']['image_box'];?>

				</td>
				<td width="92">&nbsp;</td>
			</tr>
		</table>
		<?php }?>
		
		<table>
		    
			<tr>
			<td width="92">&nbsp;</td>
				<td align="center" style="padding: 5px 0 5px; background:#ffde00 url('<?php echo $_smarty_tpl->tpl_vars['elgg_theme_url']->value;?>
/images/bg_email.png') repeat;color:#000" class="case" width="591">
                    <table width="590">
                    <tr>

					<td colspan="2" style="padding: 0 0 10px 0px; font-size: 16px; color:#000; margin: 0; font-family: Courier; " valign="top" align="left" width="590">
                    <u style="line-height:30px;font-size:20px;font-weight:bold;">Description:</u><br>
                    <?php echo smarty_modifier_replace(smarty_modifier_replace(smarty_modifier_replace($_smarty_tpl->tpl_vars['info']->value['template_content']['description'],'\r\n','<BR>'),"'","'"),'"','"');?>

					</td></tr>
                    <tr>
						<td colspan="2" align="left" style="height:20px; font-size: 1px; line-height: 1px; background:#000" height="20" valign="top">&nbsp;</td>
					</tr>
                    <tr>
						<td style="padding: 0; line-height: 1;" width="135" valign="top">
							<img src="<?php echo $_smarty_tpl->tpl_vars['elgg_theme_url']->value;?>
/images/img_deco_bottom.png" alt="decoration" width="60" height="72">
						</td>
						<td style="padding: 0 0 10px 0px; font-size: 11px; color:#000; margin: 0; font-family: Courier, 'Monaco', monospace; " valign="top" align="left" width="465">
							<p style="font-size: 15px;  line-height: 28px; color:#000; margin: 0; padding: 0;font-family: Courier, 'Monaco', monospace; letter-spacing: -1px"><?php echo $_smarty_tpl->tpl_vars['translations']->value['copyright'];?>
</p>
						</td>
					</tr>
					</table>
				</td>
				<td width="92">&nbsp;</td>
			</tr>
		</table>


<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }} ?>