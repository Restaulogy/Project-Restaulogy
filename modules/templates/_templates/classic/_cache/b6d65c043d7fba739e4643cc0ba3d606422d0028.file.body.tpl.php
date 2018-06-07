<?php /* Smarty version Smarty-3.1.13, created on 2013-12-03 11:06:15
         compiled from "C:\wamp\www\restaurent_manager\modules\templates\_templates\classic\body.tpl" */ ?>
<?php /*%%SmartyHeaderCode:26617529d6dcf2e7e98-88987659%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b6d65c043d7fba739e4643cc0ba3d606422d0028' => 
    array (
      0 => 'C:\\wamp\\www\\restaurent_manager\\modules\\templates\\_templates\\classic\\body.tpl',
      1 => 1345284908,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '26617529d6dcf2e7e98-88987659',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'info' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_529d6dcf4205d3_80394783',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_529d6dcf4205d3_80394783')) {function content_529d6dcf4205d3_80394783($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_replace')) include 'C:\\wamp\\www\\restaurent_manager\\class\\Smarty\\libs\\plugins\\modifier.replace.php';
?><body>
<center>
<br>
<table width="800">
  <tr>
    <td width="75">&nbsp;</td>
    <td align="left" width="650">
        <?php echo $_smarty_tpl->getSubTemplate ("header_note.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    </td>
    <td width="75">&nbsp;</td>
  </tr>
</table>
<table width="800">
  <tr>
   <td width="75">&nbsp;</td>
    <td align="left"  bgcolor="#fffdf9" width="650">
        <?php echo $_smarty_tpl->getSubTemplate ("container_top.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


	   <div style="margin:10px;">
            <?php echo $_smarty_tpl->getSubTemplate ("section_biz_info.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    	<div>

    	<center><?php echo $_smarty_tpl->getSubTemplate ("line_break.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        	<?php if ($_smarty_tpl->tpl_vars['info']->value['template_content']['image']&&$_smarty_tpl->tpl_vars['info']->value['template_content']['image']!=''){?>
    		    <?php echo $_smarty_tpl->tpl_vars['info']->value['template_content']['image_box'];?>
 
            <?php }?>
        </center>
        
        <div style="font-size: 16px; line-height: 20px; font-family: Georgia, 'Times New Roman', Times, serif; color: #333; text-align:left justify !important; margin:15px;">
        <b style="font-size: 18px;line-height: 30px;">Description:</b><br>
 <?php echo smarty_modifier_replace(smarty_modifier_replace(smarty_modifier_replace($_smarty_tpl->tpl_vars['info']->value['template_content']['description'],'\r\n','<BR>'),"'","'"),'"','"');?>


		</div>
 		<center><?php echo $_smarty_tpl->getSubTemplate ("line_break.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</center>
    </td>
    <td width="75">&nbsp;</td>
  </tr>
</table>
<table width="800">
  <tr>
    <td width="75">&nbsp;</td>
    <td align="left" width="650">
        <?php echo $_smarty_tpl->getSubTemplate ("footer_note.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    </td>
    <td width="75">&nbsp;</td>
  </tr>
</table>
</center>
<?php }} ?>