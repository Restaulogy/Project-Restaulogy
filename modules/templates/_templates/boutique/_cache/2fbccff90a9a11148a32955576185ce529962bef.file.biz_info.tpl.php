<?php /* Smarty version Smarty-3.1.13, created on 2013-12-03 11:55:49
         compiled from "C:\wamp\www\restaurent_manager\modules\templates\_templates\boutique\biz_info.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2165451df7e6531d8d2-31988091%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2fbccff90a9a11148a32955576185ce529962bef' => 
    array (
      0 => 'C:\\wamp\\www\\restaurent_manager\\modules\\templates\\_templates\\boutique\\biz_info.tpl',
      1 => 1386051934,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2165451df7e6531d8d2-31988091',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51df7e65889dd0_25925892',
  'variables' => 
  array (
    'ELGG_BLUE' => 0,
    'theme_lang' => 0,
    'info' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51df7e65889dd0_25925892')) {function content_51df7e65889dd0_25925892($_smarty_tpl) {?><table cellspacing="0" border="0" cellpadding="0" width="560">
  <tr>
    <th colspan="2" align="left" style="font-size:18px; line-height:30px;color:<?php echo $_smarty_tpl->tpl_vars['ELGG_BLUE']->value;?>
">
        <?php echo $_smarty_tpl->tpl_vars['theme_lang']->value['biz_info_lable'];?>

    </th>
  </tr>
  <tr>
    <td valign="top" width="350" style="font-size:12px;line-height:20px;">

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

    </td>
     <td valign="top" width="210"><a href="<?php echo $_smarty_tpl->tpl_vars['info']->value['template_content']['promotion_link'];?>
" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['info']->value['template_content']['firm_logo'];?>
" align="right" alt="logo" style="border: solid 1px #FFF;float: right;max-height:150px;max-width:180px;display:block;" /></a></td>
  </tr>
</table>
<?php }} ?>