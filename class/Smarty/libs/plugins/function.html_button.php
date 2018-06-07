<?php
/**
 * Smarty plugin
 * 
 * @package Smarty
 * @subpackage PluginsFunction
 */

/**
 * Smarty {html_button} function plugin
 * 
 * Type:     function<br>
 * Name:     html_button<br>
 * Date:     Feb 24, 2003<br>
 * Purpose:  format HTML tags for the button<br>
 * Examples: {html_button value="xxx"} 
 * Output:   <input type="button" name="xxx" id="xxx" value="xxx"/>
 * Params:
 * <pre>
	* - value						 - (required) - value for the text
 * - name        - (optional) - name for the text
	* - id									 - (optional) - id for the text
	* - type							 - (optional) - by default text  
	* - extra							- (optional) - for extra attribtes
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
function smarty_function_html_button($params, $template)
{ 
 
    $name = '';
    $value = '';
				$id = ''; 
    $extra = '';
				$placeholder = ''; 
    
    foreach($params as $_key => $_val) {
        switch ($_key) {
            case 'name':
												case 'value':
												case 'id':
												case 'type':  
                $$_key = $_val;
                break; 

            default:
                if (!is_array($_val)) {
                    $extra .= ' ' . $_key . '="' . smarty_function_escape_special_chars($_val) . '"';
                } else {
                    throw new SmartyException ("html_button: extra attribute '$_key' cannot be an array", E_USER_NOTICE);
                } 
                break;
        } 
    } 

    if (empty($value)) {
        trigger_error("html_button: missing 'value' parameter", E_USER_NOTICE);
        return;
    } 
				
				if (empty($type)) {
        $type = 'button'; 
    } 
		 
				return  '<input type="'.$type.'" name="'.$name.'" value="' . $value .'" id="'.$id.'" ' . $extra . '/>';
} 

?>