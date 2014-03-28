<?php
//Thêm bệnh nhân vào sổ  đen
/* input:
	benhNhanID
	phongKhamID
*/
	$access_id = 1; //for logged in user
	
	$benhNhanID = get_input('benhNhanID');
	$benhNhan = get_entity($benhNhanID);
	$phongKhamID = get_input('phongKhamID');
	
	if( add_entity_relationship($benhNhanID,'soDen',$phongKhamID))
	{
		system_message("Bệnh Nhân: ". $benhNhan->title." đã được đưa vào danh sách sổ đen.");
	}else 
		register_error("Lỗi xảy ra khi đưa bệnh nhân : ". $benhNhan->title." vào sổ đen.");

	
?>