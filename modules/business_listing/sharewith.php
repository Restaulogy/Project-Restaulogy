<?php
	/**
	 * Modified riverdashboard to facebook-like
	 *
	 * @package ImprovedRiverdashboard
	 */
	/**
	 * @author Snow.Hellsing <snow.hellsing@firebloom.cc>
	 * @copyright FireBloom Studio
	 * @link http://firebloom.cc
	 */
	/**
	 * Elgg river dashboard plugin index page
	 * 
	 * @package ElggRiverDash
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd <info@elgg.com>
	 * @copyright Curverider Ltd 2008-2009
	 * @link http://elgg.org/
	 */

		require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/engine/start.php');

		gatekeeper();

		$list_id = get_input('list_id');
		$promotion_id = get_input('promotion_id');
		$promotion_title = get_input('promotion_title');
		$promotion_title = str_replace("@@and@@", "&", $promotion_title);

		$content = get_input('content');
		$orient = get_input('display');
		$callback = get_input('callback');

		$body = '';
		if (empty($callback)) {
			//user status
			$area1 = elgg_view('riverdashboard/status');
			
			//set a view to display a welcome message
			$body .= elgg_view("riverdashboard/welcome");
	
			//set a view to display a site wide message
			$body .= elgg_view("riverdashboard/post",array('list_id'=>$list_id,'promotion_id' => $promotion_id,'promotion_title' => $promotion_title));

		}

		switch($orient) {
			case 'mine':
					$subject_guid = $_SESSION['user']->guid;
					$relationship_type = '';
					break;
			case 'friends':
                    $subject_guid = $_SESSION['user']->guid;
					$relationship_type = 'friend';
					break;
			default:
                    $subject_guid = $_SESSION['user']->guid;
                    //$subject_guid = 0;
					$relationship_type = 'allmember';
					break;
		}

        if (!($content))
            $content="all";

        switch ($content) {
            case "Groups":
               $type = '';
               $subtype = '';
               $relationship_type = 'onlygroup';
               break;
            case "Jobs":
               $type = 'Object';
               $subtype = 'Biz_Job';
               $relationship_type = 'allmember';
               break;
            case "Projects":
               $type = 'Object';
               $subtype = 'Biz_Project';
               $relationship_type = 'allmember';
               break;
            case "Events":
               $type = 'Object';
               $subtype = 'UniversalCalendarEvents';
               $relationship_type = 'allmember';
               break;
            case "Promotions":
               $type = 'Object';
               $subtype = 'Biz_Promotion';
               $relationship_type = 'allmember';
               break;
            case "all":
               $type = '';
               $subtype = '';
               $relationship_type = 'allmember';
               break;
            default:
               $type = '';
               $subtype = '';
               $relationship_type = $content;
               break;
        }

		$river = elgg_view_river_items($subject_guid, 0, $relationship_type, $type, $subtype, '') . "</div>";
		// Replacing callback calls in the nav with something meaningless
		$river = str_replace('callback=true','replaced=88,334',$river);

		$nav = elgg_view('riverdashboard/nav',array(
													'type' => $type,
													'subtype' => $subtype,
													'orient' => $orient,
                                                    'prevcontent' => $content
														));
        echo elgg_view_layout('two_column', '', elgg_view('page_elements/header').$body);

?>
