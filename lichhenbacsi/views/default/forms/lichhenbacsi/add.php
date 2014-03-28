<?php 
	$groups = elgg_get_entities(array('type'=>'group'));
?>
STT <input type="text" name="stt"><br>
GROUP ID
<select name="groupID" class="choose_BS_PK">
	<option value="" selected="selected"> Chọn phòng khám </option>
	<?php
		foreach($groups as $group){
			echo '<option value="'.$group->guid.'">'.$group->name.'</option>';
		}
	?>
</select><br>
Chọn bác sĩ trong nhóm
<select name="doctorName" class="result_BS_PK">
	<option> Chọn Bác sĩ </option>
</select><br>
Tên bệnh nhân
<input type="text" name="patientID"><br>
Trạng thái lịch
<select name="statusLich">
	<option value="chuaChotLich"> Chưa chốt lịch </option>
	<option value="chotLich"> Chốt lịch </option>
	<option value="henLai"> Hẹn lại </option>
	<option value="daKham"> Đã khám </option>
</select>
<br/>

  <script>
  $(function() {
    $( "#datepicker" ).datepicker({ dateFormat: 'd-m-yy' });
  });
  </script>
Thời gian <input type="text" id="datepicker" name="date"><br>
<input type="submit" value="Nhấn nào"><br>
