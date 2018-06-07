<?php
/**
 * Smarty plugin
 * 
 * @package Smarty
 * @subpackage PluginsFunction
 */

/**
 * Smarty {html_input} function plugin
 * 
 * Type:     function<br>
 * Name:     html_input<br>
 * Date:     Feb 24, 2003<br>
 * Purpose:  format HTML tags for the input<br>
 * Examples: {html_input name="xxx" value="xxx"} 
 * Output:   <input type="text" name="xxx" id="xxx" value="xxx"/>
 * Params:
 * <pre>
 * - name        - (required) - name for the text
	* - value						 - (optional) - value for the text
	* - id									 - (optional) - id for the text
	* - type							 - (optional) - by default text 
	* - placeholder - (optional) - for place holder text
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
function smarty_function_html_input($params, $template)
{ 
 	require_once(SMARTY_PLUGINS_DIR . 'shared.escape_special_chars.php');
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
												case 'placeholder':
                $$_key = $_val;
                break; 

            default:
                if (!is_array($_val)) {
                    $extra .= ' ' . $_key . '="' . smarty_function_escape_special_chars($_val) . '"';
                } else {
                    throw new SmartyException ("html_input: extra attribute '$_key' cannot be an array", E_USER_NOTICE);
                } 
                break;
        } 
    } 

    if (empty($name)) {
        trigger_error("html_input: missing 'name' parameter", E_USER_NOTICE);
        return;
    } 
				
				if (empty($type)) {
        $type = 'text'; 
    }
				
				if (empty($id)) {
        $id = $name; 
    }
 
		 
				return  '<input placeholder="'.$placeholder.'" type="'.$type.'" name="'.$name.'" value="' . $value .'" id="'.$id.'" ' . $extra . ' />';
} 

?>