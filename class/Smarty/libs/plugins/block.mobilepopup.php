<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     block.translate.php
 * Type:     block
 * Name:     translate
 * Purpose:  translate a block of text
 * -------------------------------------------------------------
 */
function smarty_block_mobilepopup($params, $content, &$smarty, &$repeat)
{
    // only output on the closing tag
				$strOp = '<div data-role="popup">';
				$strOp .= '<div data-role="header">';
				$strOp .= '<h1>'.$params['header_txt'].'</h1>';
				$strOp .= '</div>';
					 
    if (isset($content)) { 
        $strOp .= $content;
    }
     
				$strOp .= '</div>';
				
				return $strOp;
}
?>