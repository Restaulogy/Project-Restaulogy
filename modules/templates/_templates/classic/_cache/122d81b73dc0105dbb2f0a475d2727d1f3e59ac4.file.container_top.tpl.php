<?php /* Smarty version Smarty-3.1.13, created on 2013-12-03 11:06:15
         compiled from "C:\wamp\www\restaurent_manager\modules\templates\_templates\classic\container_top.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1439529d6dcf4a7ad0-01993179%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '122d81b73dc0105dbb2f0a475d2727d1f3e59ac4' => 
    array (
      0 => 'C:\\wamp\\www\\restaurent_manager\\modules\\templates\\_templates\\classic\\container_top.tpl',
      1 => 1331891750,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1439529d6dcf4a7ad0-01993179',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'elgg_theme_url' => 0,
    'ELGG_ORANGE' => 0,
    'info' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_529d6dcf519db0_22859013',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_529d6dcf519db0_22859013')) {function content_529d6dcf519db0_22859013($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'C:\\wamp\\www\\restaurent_manager\\class\\Smarty\\libs\\plugins\\modifier.date_format.php';
?><table style="background-color: #fffdf9;" width="684" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td valign="top" width="173">
			<!--ribbon-->
			<table border="0" cellspacing="0" cellpadding="0" style="background:transparent url('<?php echo $_smarty_tpl->tpl_vars['elgg_theme_url']->value;?>
/images/ribbon.jpg') 40px top  no-repeat;">
			<tr>
				<td height="120" width="35"></td>
				<td  valign="top"   height="120" width="90" style="color:#FFF;font-size:14px;padding-top:5px;">
				    <center>
						<b>Deal</b><br/>
						<b style="font-size:36px;">#</b>

					</center>

				</td>
			</tr>
			</table>
			<!--ribbon-->
		</td>
		<td valign="middle" width="493">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td height="5"></td>
				</tr>
				<tr>
					<td>
					<h1 style="color: <?php echo $_smarty_tpl->tpl_vars['ELGG_ORANGE']->value;?>
; margin-top: 0px; margin-bottom: 0px; font-weight: normal; font-size:30px; font-family: Georgia, 'Times New Roman', Times, serif"><?php echo $_smarty_tpl->tpl_vars['info']->value['template_content']['title'];?>
</h1>
					
					</td>
				</tr>
				
				<tr>
					<td height="40" style="font-size: 14px;">
						for <b style="color:#281779;"><?php echo $_smarty_tpl->tpl_vars['info']->value['template_content']['metro_area'];?>
</b>
					</td>
				</tr>
			</table>
			<!--date-->

			 <table style="background:#312c26 url(<?php echo $_smarty_tpl->tpl_vars['elgg_theme_url']->value;?>
/images/date-bg.jpg);">
			 	<tr>
				<td width="350" height="39" style="font-size: 16px;font-family: Georgia, 'Times New Roman', Times, serif; color: #ffffff; line-height:30px; ">
              		<center>
                 			valid upto <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['info']->value['template_content']['end_date'],"%e, %B");?>

             		</center>
             		</td>
				</tr>
			 </table>
			 
			 <!--/date-->
		</td>
		<td width="18"></td>
	</tr>
	</table>
	 
	</td>
    </tr>
</table><!--/header-->
<?php }} ?>