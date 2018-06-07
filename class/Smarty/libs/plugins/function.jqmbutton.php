<?php
/**
 * Smarty plugin
 * 
 * @package Smarty
 * @subpackage PluginsFunction
 */

/**
 * Smarty {jqmbutton} function plugin
 * 
 * Type:     function<br>
 * Name:     jqmbutton<br>
 * Date:     Feb 24, 2003<br>
 * Purpose:  format HTML tags for the button<br>
 * Examples: {jqmbutton value="xxx"} 
 * Output:   <input type="button" name="xxx" id="xxx" value="xxx"/>
 * Params:
 * <pre>
	* - type							 - (required) - by default button
	* - value						 - (required) - value for the button
 * - name        - (optional) - name for the text
	* - id									 - (optional) - id for the text 
	* - icon							 - (optional) - data-icon   
	* - iconpos					- (optional) - data-iconpos
	* - mini						- (optional) - data-mini
	* - theme						- (optional) - data-theme     
	* - inline						- (optional) - data-icon   
	* - onclick				 - (optional) - data-icon   
	* - extra							- (optional) - for extra attribtes
	* 
 * </pre>
 * 
 * @author Monte Ohrt <monte at ohrt dot com> 
 * @author credits to Duda <duda@big.hu> 
 * @version 1.0
 * @param array                    $params   parameters
 * @param Smarty_Internal_Template $template template object
 * @return string 
 * @uses smarty_function_escape_special_chars()
 */
function smarty_function_jqmbutton($params, $template)
{  
				require_once(SMARTY_PLUGINS_DIR . 'shared.escape_special_chars.php');
				
				global $_lang;
				
    $name = '';
    $value = '';
				$id = ''; 
				$icon	= ''; 					 
				$iconpos	= ''; 			
				$inline	= ''; 	
				$onclick = '';			
    $extra = '';
				$placeholder = ''; 
    
    foreach($params as $_key => $_val) {
        switch ($_key) {
            case 'name':
												case 'value':
												case 'icon':
												case 'iconpos':
												case 'mini':
												case 'theme':
												case 'inline': 
												case 'id':
												case 'type':  
                $$_key = $_val;
                break; 
												case 'onclick': 
                if (!is_array($_val)) {
                    $$_key = smarty_function_escape_special_chars($_val);
                } else {
                    throw new SmartyException ("html_image: extra attribute '$_key' cannot be an array", E_USER_NOTICE);
                } 
                break;

            default:
                if (!is_array($_val)) {
                    $extra .= ' ' . $_key . '="' . smarty_function_escape_special_chars($_val) . '"';
                } else {
                    throw new SmartyException ("mobile_button: extra attribute '$_key' cannot be an array", E_USER_NOTICE);
                } 
                break;
        } 
    } 

    
				
		 if (empty($type)) {
        $type = 'button'; 
    } 
		 
		if (empty($inline)) {
        $inline = 'true'; 
    } 
				
				switch($type){
						case 'form_cancel' : 
										$type = 'reset';
										$value = set_value($value,$_lang['cancel_lbl']); 
										$icon 	= 'delete';
						break;
						case 'form_save' : 
										$type = 'submit';
										$value = set_value($value,$_lang['save_lbl']);
										$icon 	= 'save';
						break;
						case 'cancel' : 
										$type = 'button';
										$value = set_value($value,$_lang['cancel_lbl']); 
										$icon 	= 'delete';
						break;
						
						case 'delete' : 
										$type = 'button';
										$value = set_value($value,$_lang['delete_lbl']); 
										$icon 	= 'recycle-full';
						break;
						
						case 'close'		:
										$type = 'button';
										$value = set_value($value,$_lang['close_lbl']);  
										$icon 	= 'delete';
						break; 
						default:
							   if (($iconpos != 'notext') && empty($value)) {
        						trigger_error("html_button: missing 'value' parameter", E_USER_NOTICE);
        						return;
    							} 
									break;	
				}
		
		/*		
		if (empty($iconpos)) {
        $iconpos = 'left'; 
    }
		*/
				
	  if (empty($inline)) {
        $inline = 'true'; 
    } 
				return  '<input '.(is_not_empty($mini) ? 'data-mini="'.$mini.'"':'').' data-inline="'.$inline.'" data-icon="'.$icon.'" '.(is_not_empty($theme) ? 'data-theme="'.$theme.'"' : '').' '.(is_not_empty($iconpos) ? 'data-iconpos="'.$iconpos.'"' : '').' type="'.$type.'" name="'.$name.'" onclick="'.$onclick.'" value="' . $value .'" id="'.$id.'" ' . $extra . '/>';
} 

?>