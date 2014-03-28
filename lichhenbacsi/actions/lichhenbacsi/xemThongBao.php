<ul class="span4 lstSupRight" style="margin-left: 0;">
<?php
/*
input
	phongKhamID
	ngayGio 
*/

$phongKhamID = get_input('phongKhamID');
$ngayGio = get_input('ngayGio');
$thongBaoList =  elgg_get_entities_from_relationship(array(	'type'=>'object', 
														'subtypes'=>'thongbao', 	
														'relationship'=> 'cuaPhongKham' , 
														'relationship_guid'=>  $phongKhamID,
														'inverse_relationship' => TRUE,														
														'limit' => ELGG_ENTITIES_NO_VALUE
														)	
													);	
if (empty($thongBaoList)){
	echo '
		<li>
			<h6><a class="titleSbs_supH61" href="">Không có thông báo</a></h6>
		</li>';
						
}else{
	foreach($thongBaoList as $thongBao)
	{
		$bacsi = get_entity($thongBao->bacSiID);
		echo '<li>';
		echo '<h3 class="titleSbs_supH3"><i>'. elgg_view_friendly_time($thongBao->time_created).'</i></h3>';
		echo '<h5 class="titleSbs_supH61">'.$thongBao->thongBaoText.'</h5>';
		echo '<h4><a class="titleSbs_supH3" href="">By '.$bacsi->name.' </a></h4>';
		echo '<span class="df_bg4 xoaThongBao" id="'.$thongBao->guid.'">Xóa</span>';
		echo '</li>';
	}
}
?>
</ul>
<script>
 $('.xoaThongBao').click(function(){
	xoaThongBao($(this).attr('id'));
 });
</script>
