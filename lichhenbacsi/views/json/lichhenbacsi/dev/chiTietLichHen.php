<?php
	$loggedInUser = elgg_get_logged_in_user_entity();
	if (!$loggedInUser) return;
	$groups = $loggedInUser->getGroups();
	$user_guid = elgg_get_logged_in_user_guid();
	
?>
<script type="text/javascript" src=" <?php echo elgg_get_site_url() . "/mod/lichhenbacsi/views/default/js/lichhenbacsi/lichhen.js"; ?> "></script>
<script type="text/javascript" src=" <?php echo elgg_get_site_url() . "/mod/lichhenbacsi/views/default/js/lichhenbacsi/jquery.tablednd.js"; ?> "></script>
<div class="navWapMid2">
        <div class="container">
            <ul id="lstPhongkhamTitle" class="nav nav-pills nav_sup " style="margin: 0;">
              <li id="phongkhamctCdbs" class="active"><a href="/lichhenbacsi/cuatoi">Của tôi</a></li>
              <li id="phongkhamtcCdbs" class=""><a href="/phongkhamonline/tatca">Tất cả</a></li>
              <li id="phongkhammmCdbs" class=""><a href="/phongkhamonline/moimo">Mới mở</a></li>
            </ul>
            <a href="">
                <div class="pull-right df_bg1" style="padding: 4px 10px; color: #fff; margin-top: -44px;">
					<a href="<?php echo elgg_get_site_url().'groups/add/'.$user_guid;?>" style="color: #fff;">Tạo mới phòng khám</a>
				</div>
            </a>
        </div>
</div>

<div id="row" class="container" style="min-height: 540px;">
        
        <div id="rowCuatoi" class="row">
            <div class="span8 df_mgt10">
                <div class="span8 pkWrap1">
                    <input id="inpPhongkham" name="tenPhongKham" class="" type="text" style="width: 70%; padding: 8px 0; height: 40px;">
                    <div class="btn-group sltPhongkham">
                      <a class="btn dropdown-toggle df_bg2" data-toggle="dropdown" href="cuatoi#">
                        <span class="caret"></span>
                      </a>
                      <ul id="eventselect" class="dropdown-menu">

						<?php
							$done = false;
							foreach($groups as $group){
								if (($group->owner_guid == $user_guid)&&(!$done)){
									?>
									<script type="text/javascript">
										$('#inpPhongkham').val('<?php echo $group->name ?>');
										$('#inpPhongkham').attr('placeholder','<?php echo $group->guid ?>');
									</script>
									<?php
									$done = true;
								}
								echo '<li value="'.$group->guid.'">'.$group->name.
									'</li>';
							}
						?>
						
                      </ul>
                    </div>
				<div class="span2 pull-right df_bg4 btnCTL">Xem chi tiết</a></div>
                </div>
                <div class="span8 danhsachTitle" style="margin-left: 0;">
                    <b>Lịch khám ngày : </b><b id="myDate">
					</b>
                </div>
                <div class=" span8 navWapMid3 df_mgNo">
                    <ul id="lstMyCalendar" class="nav nav-tabs df_mgt10">
                        <li id="lichCuatoi" class="active"><a class="df_bg1" href="cuatoi#">Của tôi</a></li>
                        <li id="lichPhongkham"><a class="df_bg1" href="cuatoi#">Phòng khám</a></li>
                        <li id="lichSoden"><a class="df_bg1" href="cuatoi#">Sổ đen</a></li>
                    </ul>
                </div> 
                <!--lich khám trong ngày-->
				<div id="panelLich" name="panelLich">
                    <!--lich phòng khám-->
					<img id="imgLoading" style="margin-left: 50%;" src=" <?php echo elgg_get_site_url() . '_graphics/imgLoading.gif"/>';?>
                 </div>
				<!----> 
            </div>
            <div class="span4 df_mgt10">
                <!--add calendar-->
                <div id="ds_conclass"><div id="ds_calclass"></div></div>
                
                <div class="span4 danhsachTitle df_mgt10" style="margin-left: 0;">
                    <b>Thông báo bệnh nhân </b>
                </div>
                <textarea class="span4" id="thongBaoText" style=" height: 150px; resize: none; width: 100%;"></textarea>
                <div style="height: 30px;">
                    <button class="btnlog pull-right" id='resetThongBao'>Nhập lại</button> 
                    <button class="btnlog active pull-right df_mgR5" id='submitThongBao'>Nhập thông báo</button>  
                </div>
				<div id="thongBaoList">
				</div>               
            </div>
        </div>
</div>

<script type="text/javascript" src=" <?php echo elgg_get_site_url() . "/mod/lichhenbacsi/views/default/js/lichhenbacsi/calendar.js"; ?> "></script>


<!--script calendar -->
<script type="text/javascript">
    ds_sh();
</script>

<!--lay value from list append input -->
<script type="text/javascript">
   $('#eventselect li ').click(function(){
        $('#eventselect li').removeClass('df_bg1'); 
        $(this).addClass('df_bg1');
        $('#inpPhongkham').val($(this).text());
		$('#inpPhongkham').attr('placeholder',$(this).val());
		elgg.lichhenbacsi.OnclickXemLich();
		
});
</script>

<!--sự kiện click của button trong lịch hẹn khám-->
<script type="text/javascript">
	
    $('#lstMyCalendar li').click(function(){
       $('#lstMyCalendar li').removeClass('active');
       $(this).addClass('active');
	
	switch ($(this).attr('id'))
	{	
		case 'lichPhongkham':
			$('#tblCuatoi, #tblSoden').hide();
			$('#tblPhongkham').show();
			break;
		case 'lichCuatoi':
			$('#tblPhongkham, #tblSoden').hide();
			$('#tblCuatoi').show();
			break;
		case 'lichSoden':
			$('#tblPhongkham, #tblCuatoi').hide();
			$('#tblSoden').show();
			break;
		default:
			$('#tblPhongkham, #tblSoden').hide();
			$('#tblCuatoi').show();
	}

    });
</script>
<script type="text/javascript" src=" <?php echo elgg_get_site_url() . "/mod/lichhenbacsi/views/default/js/lichhenbacsi/thongBaoAjax.js"; ?> "></script>
