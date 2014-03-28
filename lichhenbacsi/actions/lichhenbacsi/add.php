<?php

/*
	input:	
			isVangLai
			groupID
			doctorName
			patientID
			statusLich
			stt
			date //chuỗi dạng: 16-1-2014
*/	
	$bacSiID = get_input('doctorName');
	if ($bacSiID == null)
	{
		$bacSiID = elgg_get_logged_in_user_guid();
	}
	$isVangLai = get_input('isVangLai');
	$isVangLai = $isVangLai?$isVangLai:0;
	
	
	$groupID= get_input('groupID');
	
	$benhNhanName = get_input('patientID');
	$statusLich = get_input('statusLich');
	$STT =  get_input('stt');
	$ngayGio = strtotime(get_input('date'));
	$access_id = 1; //loggin users only
	
//tao ra Object Benh nhan
	$benhnhan =  new ElggObject();
	$benhnhan->subtype =  "benhnhan";
	$benhnhan->access_id = $access_id;
	$benhnhan->title = $benhNhanName;
	$benhnhanGUID = $benhnhan->save();
	
//tao ra Object lich hen
	//thiet lap metadata
	$lichhen =  new ElggObject();
	$lichhen->subtype =  "lich";
	$lichhen->access_id = $access_id;
	$lichhen->title = "lichhenkham";
	$lichhen->status= $statusLich;
	$lichhen->STT = (int)$STT;
	$lichhen->ngayGio = $ngayGio;
	$lichhen->isVangLai = (int)$isVangLai;
	$guid = $lichhen->save();
	//Thiet lap Relationship
	$lichhen->addRelationship($benhnhanGUID,'khamcho');
	$lichhen->addRelationship($groupID,'thuocphongkham');
	$lichhen->addRelationship($bacSiID,'giaochobacsi');
	
	$bacsi = get_entity($bacSiID);
	system_message("Bac si: ".$bacsi->name. " có lịch khám ngày ". $ngayGio. ' tại phòng khám '.$groupID);
	
	
	
	//Luu vao database
	
	//add_entity_relationship($guid,'giaochobacsi',$bacSiID);
