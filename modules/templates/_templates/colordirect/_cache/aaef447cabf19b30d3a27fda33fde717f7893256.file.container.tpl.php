<?php /* Smarty version Smarty-3.1.13, created on 2013-12-03 11:54:12
         compiled from "C:\wamp\www\restaurent_manager\modules\templates\_templates\colordirect\container.tpl" */ ?>
<?php /*%%SmartyHeaderCode:151445234355f058ec6-32188270%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aaef447cabf19b30d3a27fda33fde717f7893256' => 
    array (
      0 => 'C:\\wamp\\www\\restaurent_manager\\modules\\templates\\_templates\\colordirect\\container.tpl',
      1 => 1386051848,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '151445234355f058ec6-32188270',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5234355f7132b5_44824871',
  'variables' => 
  array (
    'elgg_theme_url' => 0,
    'ELGG_ORANGE' => 0,
    'info' => 0,
    'ELGG_BLUE' => 0,
    'theme_lang' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5234355f7132b5_44824871')) {function content_5234355f7132b5_44824871($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'C:\\wamp\\www\\restaurent_manager\\class\\Smarty\\libs\\plugins\\modifier.date_format.php';
?> <table cellpadding="0" cellspacing="0" border="0" align="center" width="600" style="font-family: Courier, 'Monaco', monospace; ">
	<tr>
	<td width="135" style="font-size: 1px; font-family: Courier, 'Monaco', monospace;padding: 25px 0 0;" align="left" valign="top"><img src="<?php echo $_smarty_tpl->tpl_vars['elgg_theme_url']->value;?>
/images/img_deco_1.png" alt="decoration" width="114" height="96"></td>
	<td width="465" valign="top" align="left" style="font-family: Courier, 'Monaco', monospace;" class="content">
		<table cellpadding="0" cellspacing="0" border="0"  style="color: #000; font: normal 11px Courier, 'Monaco', monospace; margin: 0; padding: 0;" width="465">

		<tr>
			<td style="padding: 20px 0 25px;" align="left">
				<h2 style="color:<?php echo $_smarty_tpl->tpl_vars['ELGG_ORANGE']->value;?>
 !important; font-weight: bold; line-height: 35px; font-size: 31px;"><?php echo $_smarty_tpl->tpl_vars['info']->value['template_content']['title'];?>
</h2>
				<p style="font-size: 16px;">
                    Deal for <b><?php echo $_smarty_tpl->tpl_vars['info']->value['template_content']['metro_area'];?>
</b><br/>
                    Valid Upto <b><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['info']->value['template_content']['end_date'],"%e, %B");?>
</b>
                </p>
			</td>
		</tr>
		</table>
	</td>

  </tr>
  <tr>
    <td width="600" colspan="2">
        <table cellspacing="0" border="0" cellpadding="0" width="100%">

    <tr>
        <th colspan="2" align="left" style="font-size:24px;font-weight:bold;color:<?php echo $_smarty_tpl->tpl_vars['ELGG_BLUE']->value;?>
 !important;padding-bottom:5px;"><?php echo $_smarty_tpl->tpl_vars['theme_lang']->value['biz_info_lable'];?>
</th>
    </tr>
  <tr>
    <td valign="top" width="378">

    <p style="font-size: 16px;">
<?php if ($_smarty_tpl->tpl_vars['info']->value['template_content']['firm']&&$_smarty_tpl->tpl_vars['info']->value['template_content']['firm']!=''&&strlen($_smarty_tpl->tpl_vars['info']->value['template_content']['firm'])>0){?>
        <?php if ($_smarty_tpl->tpl_vars['info']->value['template_content']['firm_link']){?><a href="<?php echo $_smarty_tpl->tpl_vars['info']->value['template_content']['firm_link'];?>
" target="_blank"><?php }?>
            <b><?php echo $_smarty_tpl->tpl_vars['info']->value['template_content']['firm'];?>
</b>
        <?php if ($_smarty_tpl->tpl_vars['info']->value['template_content']['firm_link']){?></a><?php }?>
        <br/>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['info']->value['template_content']['firm_contact']&&$_smarty_tpl->tpl_vars['info']->value['template_content']['firm_address']!=''&&strlen($_smarty_tpl->tpl_vars['info']->value['template_content']['firm_address'])>0){?>
        <?php echo $_smarty_tpl->tpl_vars['info']->value['template_content']['firm_contact'];?>
<br/>
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['info']->value['template_content']['firm_address']&&$_smarty_tpl->tpl_vars['info']->value['template_content']['firm_address']!=''&&strlen($_smarty_tpl->tpl_vars['info']->value['template_content']['firm_address'])>0){?>
        <?php echo $_smarty_tpl->tpl_vars['info']->value['template_content']['firm_address'];?>
<br/>
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['info']->value['template_content']['firm_city']&&$_smarty_tpl->tpl_vars['info']->value['template_content']['firm_city']!=''&&strlen($_smarty_tpl->tpl_vars['info']->value['template_content']['firm_city'])>0){?>
        <?php echo $_smarty_tpl->tpl_vars['info']->value['template_content']['firm_city'];?>
<br/>
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['info']->value['template_content']['firm_metro_area']&&$_smarty_tpl->tpl_vars['info']->value['template_content']['firm_metro_area']!=''&&strlen($_smarty_tpl->tpl_vars['info']->value['template_content']['firm_metro_area'])>0){?>
        <?php echo $_smarty_tpl->tpl_vars['info']->value['template_content']['firm_metro_area'];?>
 -
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['info']->value['template_content']['firm_state']&&$_smarty_tpl->tpl_vars['info']->value['template_content']['firm_state']!=''&&strlen($_smarty_tpl->tpl_vars['info']->value['template_content']['firm_state'])>0){?>
        <?php echo $_smarty_tpl->tpl_vars['info']->value['template_content']['firm_state'];?>
<br>
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['info']->value['template_content']['firm_country']&&$_smarty_tpl->tpl_vars['info']->value['template_content']['firm_country']!=''&&strlen($_smarty_tpl->tpl_vars['info']->value['template_content']['firm_country'])>0){?>
        <?php echo $_smarty_tpl->tpl_vars['info']->value['template_content']['firm_country'];?>

    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['info']->value['template_content']['firm_zip']&&$_smarty_tpl->tpl_vars['info']->value['template_content']['firm_zip']!=''&&strlen($_smarty_tpl->tpl_vars['info']->value['template_content']['firm_zip'])>0){?>
         <?php echo $_smarty_tpl->tpl_vars['info']->value['template_content']['firm_zip'];?>
<br/>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['info']->value['template_content']['firm_phone']&&$_smarty_tpl->tpl_vars['info']->value['template_content']['firm_country']!=''&&strlen($_smarty_tpl->tpl_vars['info']->value['template_content']['firm_country'])>0){?>
        <?php echo $_smarty_tpl->tpl_vars['info']->value['template_content']['firm_phone'];?>
<br/>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['info']->value['template_content']['firm_email']){?>
        <a href="mailto:<?php echo $_smarty_tpl->tpl_vars['info']->value['template_content']['firm_email'];?>
"><?php echo $_smarty_tpl->tpl_vars['info']->value['template_content']['firm_email'];?>
</a><br/>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['info']->value['template_content']['firm_website']){?>
        <a href="<?php echo $_smarty_tpl->tpl_vars['info']->value['template_content']['firm_website'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['info']->value['template_content']['firm_website'];?>
</a><br/>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['info']->value['template_content']['firm_map_link']){?>
        <a href="<?php echo $_smarty_tpl->tpl_vars['info']->value['template_content']['firm_map_link'];?>
" target="_blank">Map</a><br/>
	<?php }?>

	 </p>
    </td>
    <td valign="top" width="246"><a href="<?php echo $_smarty_tpl->tpl_vars['info']->value['template_content']['promotion_link'];?>
" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['info']->value['template_content']['firm_logo'];?>
" align="right" alt="logo" style="border: solid 1px #FFF;float: right;max-height:150px;max-width:180px;display:block;"/></a></td> 
  </tr>
</table>
    </td>
  </tr>
</table><!-- body -->
<?php }} ?>