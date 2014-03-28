<?php 
	$groupID= get_input('groupID');
	
	if($groupID!=""){
	$members = get_group_members($groupID);
	
	foreach($members as $member){
			echo '<option value="'.$member->guid.'">'.$member->name.'</option>';
		}
	}else
	{
		echo '<option> Chọn Bác sĩ </option>';
	 }
?>