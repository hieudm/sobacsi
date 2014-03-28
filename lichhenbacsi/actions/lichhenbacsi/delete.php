<?php
/*
	input: lichID
*/

// Make sure we can get the comment in question
$lichID = get_input('lichID');
$lich = get_entity($lichID);
$lich->delete();
system_message('Đã xóa lịch khám');

forward(REFERER);