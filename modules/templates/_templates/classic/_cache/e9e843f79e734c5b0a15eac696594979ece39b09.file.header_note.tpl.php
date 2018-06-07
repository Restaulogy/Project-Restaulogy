<?php /* Smarty version Smarty-3.1.13, created on 2013-12-03 11:08:27
         compiled from "C:\wamp\www\restaurent_manager\modules\templates\_templates\classic\header_note.tpl" */ ?>
<?php /*%%SmartyHeaderCode:21310529d6dcf44d021-42978023%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e9e843f79e734c5b0a15eac696594979ece39b09' => 
    array (
      0 => 'C:\\wamp\\www\\restaurent_manager\\modules\\templates\\_templates\\classic\\header_note.tpl',
      1 => 1386049103,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21310529d6dcf44d021-42978023',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_529d6dcf47cb96_50986540',
  'variables' => 
  array (
    'translations' => 0,
    'elgg_main_url' => 0,
    'elgg_site_logo' => 0,
    'elgg_site_name' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_529d6dcf47cb96_50986540')) {function content_529d6dcf47cb96_50986540($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include 'C:\\wamp\\www\\restaurent_manager\\class\\Smarty\\libs\\plugins\\modifier.truncate.php';
?>
 <!--top links-->
    <p class="header_note">
        <?php echo $_smarty_tpl->tpl_vars['translations']->value['plugin']['header_note'];?>

	</p>

    <center>
        <a href="<?php echo $_smarty_tpl->tpl_vars['elgg_main_url']->value;?>
" target="_blank" style="vertical-align: top !important;font-size:40px;font-weight: bold;line-height: 80px;"><img src="<?php echo $_smarty_tpl->tpl_vars['elgg_site_logo']->value;?>
" style="width:80px;height:80px;border:none;" /><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['elgg_site_name']->value,20);?>
</a>
    </center>
<!--header-->

<?php }} ?>