<?php
/*
input
	thongBaoID
*/
$thongBaoID = get_input('thongBaoID');
$thongBao = get_entity($thongBaoID);
$thongBao->delete();

forward(REFERER);
?>