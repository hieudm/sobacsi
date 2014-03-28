<?

	$lichhen = get_entity(get_input('lichID'));
	$lichhen->status = get_input('lichStatus');
	$lichhen->save();
	$patientID = $lichhen->getEntitiesFromRelationship('khamcho',false, ELGG_ENTITIES_NO_VALUE);
	
	system_message("Đã cập nhật lịch hẹn cho: ".$patientID[0]->title);