<?php /* Smarty version Smarty-3.1.13, created on 2013-06-19 13:41:23
         compiled from "C:\wamp\www\restaurent_manager\modules\templates\_templates\helvetica\middle\description.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3196251c167ab952987-74341046%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ec1cd691dd160582d0cf8736f1ab99de968de4fc' => 
    array (
      0 => 'C:\\wamp\\www\\restaurent_manager\\modules\\templates\\_templates\\helvetica\\middle\\description.tpl',
      1 => 1343123876,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3196251c167ab952987-74341046',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'info' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51c167aba33536_51488553',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51c167aba33536_51488553')) {function content_51c167aba33536_51488553($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_replace')) include 'C:\\wamp\\www\\restaurent_manager\\class\\Smarty\\libs\\plugins\\modifier.replace.php';
?><table id="tbl_middle">
      <tr>
            <th>
                Description
            </th>
      </tr>
      <tr>
            <td id="sepertor">&nbsp;</td>
      </tr>
      <tr>
            <td>
                <?php echo smarty_modifier_replace(smarty_modifier_replace(smarty_modifier_replace($_smarty_tpl->tpl_vars['info']->value['template_content']['description'],'\r\n','<BR>'),"'","'"),'"','"');?>

            </td>
      </tr>
      <tr>
            <td id="sepertor">&nbsp;</td>
      </tr>
</table>
<?php }} ?>