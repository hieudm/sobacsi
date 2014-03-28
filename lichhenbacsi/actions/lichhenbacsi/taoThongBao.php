<?php
/*
Input
	thongBaoText
	phongKhamID
*/

$thongBaoText = get_input('thongBaoText');
$phongKhamID = get_input('phongKhamID');
$bacSiID = elgg_get_logged_in_user_guid();
$access_id = 1; //only for logged in user

$thongBao =  new ElggObject();
$thongBao->subtype =  "thongbao";
$thongBao->thongBaoText =  $thongBaoText;
$thongBao->access_id = $access_id;
$thongBao->title = elgg_substr($thongBaoText,0,250) . "...";
$thongBao->bacSiID = $bacSiID;
$thongBaoGUID = $thongBao->save();

$thongBao->addRelationship($phongKhamID,'cuaPhongKham');
