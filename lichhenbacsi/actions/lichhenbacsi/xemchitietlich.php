
<?php 
/*
input:
	phongKhamID
	ngayGio
	
statusLich:
		chotLich
		dangKham
		daKham
*/

$phongKhamID = get_input('phongKhamID');
$ngayGio = strtotime(get_input('ngayGio'));
?>
<img id="imgLoading" style="margin-left: 50%;" src=" <?php echo elgg_get_site_url() . '_graphics/imgLoading.gif"/>';?>
 <!--lich sổ đen-->
					<table id="tblSoden" class="span8 tblWapMid1">
                        <tbody>
						
						<?php
						$soden =  elgg_get_entities_from_relationship(array(	'type'=>'object', 
														'subtypes'=>'benhnhan', 	
														'relationship'=> 'soDen' , 
														'relationship_guid'=>  $phongKhamID,
														'inverse_relationship' => TRUE,														
														'limit' => ELGG_ENTITIES_NO_VALUE
														)	
													);	
						if (empty($soden)){
							echo '<tr>
                            <td class="tdPatient">Sổ đen đang trống</td>
                            </td>
                        </tr>';
						
						}else{
							$i = 1;
							foreach($soden as $soDenItem)
							{
							//get Relationship ID
							$relationship = check_entity_relationship($soDenItem->guid,'soDen',$phongKhamID);
							echo '<tr class="'.(($i%2)?'df_bg0':'').'" >';
							echo '<td class="tdNumber "><div class="df_bg1">'.$i.'</div></td>';
							echo '<td class="tdPatient" id="'.$relationship->id.'">'.$soDenItem->title.'</td>';
							echo '<td class="tdList" colspan="2">
                                <span class="pull-right df_bg4 xoaSoDen">Xóa</span>
								</td>';
							$i++;
							}
						}
						
						?>
						
                    </tbody></table>

<?php
	

	$entities =  elgg_get_entities_from_relationship(array(	'type'=>'object', 
														'subtypes'=>'lich', 	
														'relationship'=> 'thuocphongkham' , 
														'relationship_guid'=>  $phongKhamID,
														'inverse_relationship' => TRUE,
														'metadata_names' => 'ngayGio',
														'metadata_values'=> $ngayGio,
														'order_by_metadata' => array('name' => 'STT', 'direction' => ASC, 'as' => integer),
														'limit' => ELGG_ENTITIES_NO_VALUE
														)	
													);									
	$user_guid = elgg_get_logged_in_user_guid();		
	if (empty($entities)){
	?>
	<!--thông báo khi chưa có lịch hẹn-->
	<table id="tblPhongkham" class="span8">
		<tbody>
			<tr> <td>Chưa có lịch hẹn </td></tr>
		</tbody>
	</table>
	<table id="tblCuatoi" class="span8">
		<tbody><tr> <td>Chưa có lịch hẹn</td> </tr></tbody>
	</table>
	<script type="text/javascript">
		elgg.lichhenbacsi.keepActivePanel();
	</script>
		<?php
			forward(REFERER);
		}
?>

<table id="tblPhongkham" class="span8 tblWapMid1">
                        <tbody>
						<?php 
							$i = 1;
							foreach($entities as $lichhen){
								
								if ($lichhen->status == 'dangKham')
							{	
									echo '<tr class=" df_bgActive">
				
										<td class="tdNumber "><div class=""><span style="color: red; display: block; font-weight: bold; margin-top: -10px;">Đang khám</span></div></td>';
							
							}
							elseif ($i % 2) 
							{
								echo '<tr class="df_bg0" >';
								echo '<td class="tdNumber "><div class="df_bg1">'.$lichhen->STT.'</div></td>';
									
							}
							else 
							{
								{	echo '<tr class="" >
									<td class="tdNumber "><div class="df_bg1">'.$lichhen->STT.'</div></td>'; }
							}
								
								//Lay ten benh nhan
								$patientID = $lichhen->getEntitiesFromRelationship('khamcho',false, ELGG_ENTITIES_NO_VALUE);
								echo '<td class="tdPatient">'.$patientID[0]->title. '</td>';
								
								//Lay ten bac si
								$bacsiID =  $lichhen->getEntitiesFromRelationship('giaochobacsi',false, ELGG_ENTITIES_NO_VALUE);
								echo '<td class="tdDoctor">'.$bacsiID[0]->name.'</td>';								
						?>
									<td class="tdList">
									<div class="navbar navbar-default ">
                                    <button type="button" class="btn btn-navbar sltPhongkham df_bg2" data-toggle="collapse" data-target=".toggleTable1">
                                        <span class="caret"></span>
                                        
                                    </button>
                                    
                                    <div class="nav-collapse collapse ">
                                        <ul id="" class="nav navMidsbs">
										
								<?php
									switch ($lichhen->status)
									{
										case 'chotLich':
											echo '<li id="dangKham" name="cl" class="df_bg4 df_bg2"><a href="" data-toggle="modal">Vào Khám</a></li>';
											break;
										case 'dangKham':
											echo '<li id="daKham" name="cl" class="df_bg4 df_bg2"><a href="" data-toggle="modal">Đã Khám</a></li>';
											break;
										case 'daKham':
											echo '<li id="xong" name="cl" class="df_bg4"><a href="" data-toggle="modal">Khám Xong</a></li>';
											break;
										default:
											echo '<li id="chotLich" name="cl" class="df_bg4 df_bg2"><a href="" data-toggle="modal">Chốt lịch</a></li>';
										
									}
								?>
     
                                            <li id="henLai" name="hl" class="df_bg4 <?php echo ($lichhen->status =='henLai'?'df_bg2':'');?>"><a href="" data-toggle="modal">Hẹn lại</a></li>        
                                            <li name="sd" class="df_bg4"><a href="" data-toggle="modal">Sổ đen</a></li>
                                            <li name="xo" class="df_bg4"><a href="" data-toggle="modal">Xóa</a></li>
                                        </ul>
                                    </div> 
                                </div>
										</td>
									
						<?php	
								
								echo '</tr>'; 
								$i++;
							};
							
						?>
                    </tbody>
</table>
                    <!--lich cua toi-->
<table id="tblCuatoi" class="span8 tblWapMid1">
                    
						<?php
						$i = 1;
							foreach($entities as $lichhen){
							$STT = (int)$lichhen->STT;
							if ($STT > $i)
							{
								while( $i < $STT){
								
								?>
								<tr class="<?php echo ($i%2)? 'df_bg0': '';?>">
								<td class="tdNumber "><div class="df_bg1"><?php echo $i; ?></div></td>
                            
									<td class="tdList" colspan="3">
										<input type="text" class="addPatient" placeholder="Thêm bệnh nhân">
									</td>
								</tr>
								<?php	
								$i++;
								}
							}
							
							$bacsiID =  $lichhen->getEntitiesFromRelationship('giaochobacsi',false, ELGG_ENTITIES_NO_VALUE);							
							if ($bacsiID[0]->guid == $user_guid) {
							
							/*if ($lichhen->isVangLai == '1')
							{
								 <tr class="df_bgAdd">
							}
							else
							*/
							if ($lichhen->status == 'dangKham')
							{	
									echo '<tr class="df_bgActive '. (($lichhen->isVangLai == '1')? 'df_bgAdd':'') .'">
				
										<td class="tdNumber "><div class=""><span style="color: red; display: block; font-weight: bold; margin-top: -10px;">Đang khám</span></div></td>';
							
							}
							elseif ($i % 2) 
							{
								echo '<tr class="'. (($lichhen->isVangLai == '1')? 'df_bgAdd':'df_bg0') .'" >';
								echo '<td class="tdNumber "><div class="df_bg1">'.$STT.'</div></td>';
									
							}
							else 
							{
								{	echo '<tr class="'. (($lichhen->isVangLai == '1')? 'df_bgAdd':'') .'" >
									<td class="tdNumber "><div class="df_bg1">'.$STT.'</div></td>'; }
							}
						
                            
							
							$patientID = $lichhen->getEntitiesFromRelationship('khamcho',false, ELGG_ENTITIES_NO_VALUE);
							echo '<td class="tdPatient" id="'.$patientID[0]->guid.'">'.$patientID[0]->title. '</td>';
								
                            echo '<td class="tdDoctor"></td>';
						?>
						
                            <td class="tdList">
                                <div class="navbar navbar-default ">
                                    <button type="button" class="btn btn-navbar sltPhongkham df_bg2" data-toggle="collapse" data-target=".toggleTable1">
                                        <span class="caret"></span>
                                        
                                    </button>
                                    
                                    <div class="nav-collapse collapse ">
                                        <ul id="<?php echo $lichhen->guid; ?>" class="nav navMidsbs">
										<?php
									switch ($lichhen->status)
									{
										case 'coMat':
											echo '<li id="dangKham" name="cl" class="df_bg4 df_bg2"><a href="" data-toggle="modal">Vào Khám</a></li>';
											echo '<li id="vangMat" name="hl" class="df_bg4"><a href="" data-toggle="modal">Vắng mặt</a></li>' ;
											break;
										case 'dangKham':
											echo '<li id="daKham" name="cl" class="df_bg4 df_bg2"><a href="" data-toggle="modal">Đã Khám</a></li>';
											echo '<li id="vangMat" name="hl" class="df_bg4"><a href="" data-toggle="modal">Vắng mặt</a></li>' ;
											break;
										case 'daKham':
											echo '<li id="xong" name="cl" class="df_bg4"><a href="" data-toggle="modal">Khám Xong</a></li>';
											echo '<li id="vangMat" name="hl" class="df_bg4"><a href="" data-toggle="modal">Vắng mặt</a></li>' ;
											break;
										case 'vangMat':
											echo '<li id="coMat" name="cl" class="df_bg4 df_bg2"><a href="" data-toggle="modal">Có mặt</a></li>';
											echo '<li id="vangMat" name="hl" class="df_bg4 df_bg2"><a href="" data-toggle="modal">Vắng mặt</a></li>' ;
											break;
										default:
											echo '<li id="coMat" name="cl" class="df_bg4 df_bg2"><a href="" data-toggle="modal">Có mặt</a></li>';
											echo '<li id="vangMat" name="hl" class="df_bg4"><a href="" data-toggle="modal">Vắng mặt</a></li>' ;
											
										
									}
								?>
                                       
                                                       
                                            <li name="sd" class="df_bg4"><a href="" data-toggle="modal">Sổ đen</a></li>
                                            <li name="xo" class="df_bg4"><a href="" data-toggle="modal">Xóa</a></li>
                                        </ul>
                                    </div> 
                                </div>
                            </td>
                        <?php	
								
								echo '</tr>'; 
								}
							
							$i++;
							};
							
						?>
							<tr class="">
								<td class="tdNumber "><div class="df_bg1"><?php echo $i; ?></div></td>
                            
									<td class="tdList" colspan="3">
										<input type="text" class="addPatient" placeholder="Thêm bệnh nhân">
									</td>
								</tr>
                    </table>
                   

<script type="text/javascript">
elgg.lichhenbacsi.keepActivePanel();
$("#tblCuatoi").tableDnD();
</script>
               