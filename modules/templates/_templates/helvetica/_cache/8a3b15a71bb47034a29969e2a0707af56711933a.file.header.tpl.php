<?php /* Smarty version Smarty-3.1.13, created on 2013-12-03 11:09:57
         compiled from "C:\wamp\www\restaurent_manager\modules\templates\_templates\helvetica\header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:228751c167ab17eb42-70978023%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8a3b15a71bb47034a29969e2a0707af56711933a' => 
    array (
      0 => 'C:\\wamp\\www\\restaurent_manager\\modules\\templates\\_templates\\helvetica\\header.tpl',
      1 => 1386049194,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '228751c167ab17eb42-70978023',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51c167ab1b91c2_79648455',
  'variables' => 
  array (
    'elgg_main_url' => 0,
    'elgg_site_logo' => 0,
    'elgg_site_name' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51c167ab1b91c2_79648455')) {function content_51c167ab1b91c2_79648455($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include 'C:\\wamp\\www\\restaurent_manager\\class\\Smarty\\libs\\plugins\\modifier.truncate.php';
?><table id="tbl_header">

    <tr>
        <td class="header_note" align="center">
           <!-- <a href="<?php echo $_smarty_tpl->tpl_vars['elgg_main_url']->value;?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['elgg_site_logo']->value;?>
" style="border:none;"/></a>-->
						<a href="<?php echo $_smarty_tpl->tpl_vars['elgg_main_url']->value;?>
" target="_blank" style="color:#fff !important;vertical-align: top !important;font-size:40px;font-weight: bold;line-height: 80px;"><img src="<?php echo $_smarty_tpl->tpl_vars['elgg_site_logo']->value;?>
" style="width:80px;height:80px;border:none;" /><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['elgg_site_name']->value,20);?>
</a>
						
		</td>
    	<td class="header_note_arrow"></td>
    </tr>
    <tr>
    	<td colspan="2" id="top_seperator"></td>
    </tr>

    <tr>
        <td class="header_title">
            <?php echo $_smarty_tpl->getSubTemplate ("header_title.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        </td>
        <td class="header_title_icon">
        </td>
    </tr>
      <tr>
        <td colspan="2" id="top_border"></td>
      </tr>
</table>
<?php }} ?>