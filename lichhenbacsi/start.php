<?php
/**
 * Members plugin intialization
 */

elgg_register_event_handler('init', 'system', 'lichhenbacsi_init');

/**
 * Initialize page handler and site menu item
 */
function lichhenbacsi_init() {
	global $CONFIG;
	
	elgg_register_page_handler('lichhenbacsi', 'lichhenbacsi_page_handler');

	//extend Ajax on every pages
	elgg_extend_view('js/elgg', 'lichhenbacsi/js');
	
	$action_path = elgg_get_plugins_path() . 'lichhenbacsi/actions/lichhenbacsi';
	
	//register Elgg Action
	elgg_register_action('lichhenbacsi/add', "$action_path/add.php");
	elgg_register_action('lichhenbacsi/delete', "$action_path/delete.php");
	elgg_register_action('lichhenbacsi/getListBacSi', "$action_path/getListBacSi.php");
	elgg_register_action('lichhenbacsi/xemchitietlich', "$action_path/xemchitietlich.php");
	elgg_register_action('lichhenbacsi/updateLichStatus', "$action_path/updateLichStatus.php");
	elgg_register_action('lichhenbacsi/addSoDen', "$action_path/addSoDen.php");
	elgg_register_action('lichhenbacsi/deleteSoDen', "$action_path/deleteSoDen.php");
	elgg_register_action('lichhenbacsi/taoThongBao', "$action_path/taoThongBao.php");
	elgg_register_action('lichhenbacsi/xemThongBao', "$action_path/xemThongBao.php");
	elgg_register_action('lichhenbacsi/xoaThongBao', "$action_path/xoaThongBao.php");
	
	elgg_register_ajax_view('lichhenbacsi/selectPK');
}

function lichhenbacsi_page_handler($page, $identifier){
	$page_dir =  elgg_get_plugins_path() .'lichhenbacsi/pages';
	switch ($page[0]) {
		case "test":
			include "$page_dir/test.php";
			break;
		case "cuatoi":
			include "$page_dir/mine.php";
			break;
		default:
			return false;
	}
	
	if($page[1] == 'selectPK' && !isset($page[2]))
		include "$page_dir/selectPK.php";
	if(isset($page[2]) && $page[1] == 'selectPK'){
		include "$page_dir/selectPKFromGroupId.php";
	}
}