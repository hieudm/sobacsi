<!--/modal them benh nhan cho kham-->
    <div class="modal fade modalThemBenhNhan" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md">
            <div class="modal-content none-radius">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="margin:5px 10px 0 0">&times;</button>
              <h4 style="border-bottom:#42B3E5 thin solid; padding:0 10px 5px; font-weight: bold;">Thêm bệnh nhân</h4>
              <div class="row" style="margin:10px 0">
                <div class="col-xs-12"><p>Tên bệnh nhân</p></div>
              	<div class="col-xs-12"><input class="form-control none-radius" type="text" name="name"></div>
                <div class="col-xs-12" style="margin:10px 0">
                	<button class="btn btn-info bg-blue none-radius" data-dismiss="modal" type="button" onClick="ThemBenhNhanChoKham()">Thêm</button>
                </div>
              </div>
            </div>
          </div>
    </div>      
    <!--/modal them benh nhan cho kham-->
    
    <!--/modal them benh nhan hen truoc-->
    <div class="modal fade modalThemBenhNhanHenTruoc" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md">
            <div class="modal-content none-radius">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="margin:5px 10px 0 0">&times;</button>
              <h4 style="border-bottom:#42B3E5 thin solid; padding:0 10px 5px; font-weight: bold;">Thêm bệnh nhân</h4>
              <div class="row" style="margin:10px 0">
                <div class="col-xs-12"><p>Tên bệnh nhân</p></div>
              	<div class="col-xs-12"><input class="form-control none-radius" type="text" name="name"></div>
                <div class="col-xs-12"><p>Giờ khám</p></div>
              	<div class="col-xs-12"><input class="form-control none-radius" type="text" name="time"></div>
                <div class="col-xs-12" style="margin:10px 0">
                	<button class="btn btn-info bg-blue none-radius" data-dismiss="modal" type="button" onClick="ThemBenhNhanHenTruoc()">Thêm</button>
                </div>
              </div>
            </div>
          </div>
    </div>      
    <!--/modal them benh nhan hen truoc-->




<div style="background: #fff;" class="row shadow-bot">
        	<div style="background-color:#39B3D7; margin-bottom:10px" class="col-md-12">
                <h4 style="color:#FFFFFF">Lịch khám ngày 05/03/2014<!--4-->
            </h4></div>
            <!--dropdown phong kham-->
            <div style="margin: 0 0 10px 0" class="col-md-12">
                <div class="btn-group">
                  <a style="width:400px" type="button" class="btn btn-default title-blue" href="#">Chọn Phòng Khám</a>
                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                    <span style="font-size:0px">.</span>
		    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul style="width:400px" class="dropdown-menu list-phongkham" role="menu">
                  	<li><a data-link="#">Chọn Phòng Khám</a></li>
                    <li><a data-link="/phongkhamonline/chitiet">Phòng khám mắt</a></li>
                    <li><a data-link="/phongkhamonline/chitiet">Phòng khám đa khoa</a></li>
                  </ul>
                </div> 
                <a id="btnChiTietPK" style="margin-left:20px" class="none-radius btn btn-info bg-prey" type="button">Xem chi tiết</a>       
                <button onclick="XemSoDen()" class="none-radius btn btn-primary bg-black" type="button">Xem sổ đen</button>
            </div>
            <!--/dropdown phong kham-->
            <!--dropdown bac sy-->
            <div style="margin: 0 0 10px 0" class="col-md-12">
                <div class="btn-group">
                  <a style="width:400px" type="button" class="btn btn-default title-blue" href="#">Chọn bác sĩ</a>
                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                    <span style="font-size:0px">.</span>
		    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul style="width:400px" class="dropdown-menu list-bacsi" role="menu">
                  	<li><a data-link="#">Chọn bác sĩ</a></li>
                    <li><a data-link="hosocuatoi.html/tam">Bác sĩ Tâm</a></li>
                    <li><a data-link="hosocuatoi.html/tai">Bác sĩ Tài</a></li>
                  </ul>
                </div> 
                <a id="btnChiTietBS" style="margin-left:20px" class="none-radius btn btn-info bg-prey" type="button">Xem chi tiết</a>       
            </div>
            <!--/dropdown bac sy-->
            <div class="col-md-7">
                <div class="wrapHen">
                    
                    <div class="row">
                    	<div class="col-xs-12">
                    		<h4 class="title-blue pull-left" style="margin:0">Hẹn trước</h4>
                    		<img src="http://works.datcommodities.com:85/mod/sobacsi_GUI/views/default/images/ajax-loader.gif" style="margin-left:10px;display:none" width="15px" class="loading"/>
                    	</div>
                    </div>
                    <div class="row">
                    	<div class="col-xs-7">
                            <!--search-->
                            <div style="margin-top:5px" class="input-group search-top">
                              <input id="inputNameHenTruoc" type="text" placeholder="search" class="form-control"/>
                              <span class="input-group-btn">
                                <button type="button" class="btn btn-default" onClick="SearchHenTruoc()">
                                  <div class="icon ic-search"></div>
                                </button>
                              </span>
                            </div>
                            <!--/search-->
                        </div>
                    
                        <div class="col-xs-5">
                        	<button type="button" class="btn btn-info none-radius" style="margin:0" data-toggle="modal" data-target=".modalThemBenhNhanHenTruoc">Thêm bệnh nhân</button>
                        </div>
                        
                    </div>
                    <!--danh sách người hẹn trước-->
                    <div class="lstHentruoc">
                        <div style="padding: 5px 0;" class="row">
                            <div class="col-xs-4">Nguyễn Văn A</div>
                            <div class="col-xs-3">00:05 AM</div>
                            <div class="col-xs-5">
                                <a onclick="Next()" class="pull-right ic-play icon" href="javascript:void(0)"></a>
                                <a onclick="Pause()" class="pull-right ic-pause icon" href="javascript:void(0)"></a>
                                <a onclick="Delete()" class="pull-right ic-cancel icon" href="javascript:void(0)"></a>
                                <a onclick="BlackList()" class="pull-right ic-black icon" href="javascript:void(0)"></a>
                            </div>
                        </div>
                        <div style="padding: 5px 0;" class="row">
                            <div class="col-xs-4">Nguyễn Văn A</div>
                            <div class="col-xs-3">00:05 AM</div>
                            <div class="col-xs-5">
                                <a onclick="Next()" class="pull-right ic-play icon" href="javascript:void(0)"></a>
                                <a onclick="Pause()" class="pull-right ic-pause icon" href="javascript:void(0)"></a>
                                <a onclick="Delete()" class="pull-right ic-cancel icon" href="javascript:void(0)"></a>
                                <a onclick="BlackList()" class="pull-right ic-black icon" href="javascript:void(0)"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="wrapHen">
                
                	<div class="row" style="margin-top:5px">
                        <div class="col-xs-12">
                            <h4 class="title-blue pull-left" style="margin:0">Chờ khám</h4>
                            <img src="http://works.datcommodities.com:85/mod/sobacsi_GUI/views/default/images/ajax-loader.gif" style="margin-left:10px;display:none" width="15px" class="loading"/>
                            <button type="button" class="btn btn-info pull-right btnSort" style=" border-radius: 0">Đổi thứ tự</button>
                            <button type="button" class="btn btn-info pull-right btnUpdateSort" style=" border-radius: 0; display:none">Cập nhật</button>
                        </div>
                    </div>
                    <div class="row" style="margin-top:5px">
                        <div class="col-xs-12">
                            <input type="text" class="form-control txtThemBN" placeholder=" + Thêm bệnh nhân"/>
                        </div>
                    </div>
                
                    <div id="sortable" class="lstHentruoc connectedSortable ui-sortable ui-sortable-disabled">
                        <div id="1" style="padding: 5px 0;" class="row">
                            <div class="col-xs-2"><div class="number df_bg1">1</div></div>
                            <div class="col-xs-6">Nguyễn Văn A</div>
                            <div class="col-xs-4">
                                <a class="pull-right ic-black icon" href="javascript:void(0)"></a>
                            </div>
                        </div>
                        <div id="2" style="padding: 5px 0;" class="row">
                            <div class="col-xs-2"><div class="number df_bg1">2</div></div>
                            <div class="col-xs-6">Nguyễn Văn B</div>
                            <div class="col-xs-4">
                                <a class="pull-right ic-run icon" href="javascript:void(0)"></a>
                            </div>
                        </div>
                        <div id="3" style="padding: 5px 0;" class="row">
                            <div class="col-xs-2"><div class="number df_bg1">3</div></div>
                            <div class="col-xs-6">Nguyễn Văn C</div>
                            <div class="col-xs-4">
                                <a class="pull-right ic-next icon" href="javascript:void(0)"></a>
                            </div>
                        </div>
                        <div id="4" style="padding: 5px 0;" class="row">
                            <div class="col-xs-2"><div class="number df_bg1">4</div></div>
                            <div class="col-xs-6">Nguyễn Văn D</div>
                            <div class="col-xs-4">
                                <a class="pull-right ic-checkin icon" href="javascript:void(0)"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<script type="text/javascript" src=" <?php echo elgg_get_site_url() . "/mod/lichhenbacsi/views/default/js/lichhenbacsi/calendar.js"; ?> "></script>
        <!--script calendar -->
    <script type="text/javascript">
        ds_sh();
    </script>  	