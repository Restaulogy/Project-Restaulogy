<?php /* Smarty version Smarty-3.1.13, created on 2013-12-03 12:04:28
         compiled from "C:\wamp\www\restaurent_manager\modules\templates\_templates\classic\section_biz_info.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1772529d6dcf54ded5-40080125%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1942088487f02ecf7393ad38fb4a93232b8200bb' => 
    array (
      0 => 'C:\\wamp\\www\\restaurent_manager\\modules\\templates\\_templates\\classic\\section_biz_info.tpl',
      1 => 1386052436,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1772529d6dcf54ded5-40080125',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_529d6dcf9ded56_43000576',
  'variables' => 
  array (
    'ELGG_BLUE' => 0,
    'theme_lang' => 0,
    'info' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_529d6dcf9ded56_43000576')) {function content_529d6dcf9ded56_43000576($_smarty_tpl) {?><table cellspacing="0" border="0" cellpadding="0" width="100%">
  <tr>
    <td valign="top" width="378">
    
    
    <h1 style="font-size:18px; font-family: Georgia, 'Times New Roman', Times, serif; color: <?php echo $_smarty_tpl->tpl_vars['ELGG_BLUE']->value;?>
;"><?php echo $_smarty_tpl->tpl_vars['theme_lang']->value['biz_info_lable'];?>
</h1>

    <p style="font-size: 14px; line-height: 22px; font-family: Georgia, 'Times New Roman', Times, serif; color: #333; margin: 0px;">
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
        <a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['info']->value['template_content']['firm_map_link'];?>
">Map</a><br/>
	<?php }?>


	 </p>
    </td>
    <td valign="top" width="246"><a href="<?php echo $_smarty_tpl->tpl_vars['info']->value['template_content']['promotion_link'];?>
" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['info']->value['template_content']['firm_logo'];?>
" align="right" alt="logo" style="border: solid 1px #FFF;float: right;max-height:150px;max-width:180px;display:block;" /></a></td>
  </tr>
</table>
<?php }} ?>