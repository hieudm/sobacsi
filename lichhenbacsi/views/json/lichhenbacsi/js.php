//<script>
elgg.provide('elgg.lichhenbacsi');

elgg.lichhenbacsi.init = function() {
	
	var statusButton = $(".navMidsbs li");
	statusButton.live('click', elgg.lichhenbacsi.updateLich);
	var btnXoaSoDen = $(".xoaSoDen");
	btnXoaSoDen.live('click',elgg.lichhenbacsi.xoaSoDen);
	
	$('.addPatient').live('keyup',function(e){
			var code = e.which;
            	if (code == 13){
					//alert ($(this).val());
					var patientName = $(this).val();
					var STT = $(this).parent().prev().children('div').text(); 
					elgg.lichhenbacsi.addLichHen(patientName,STT);
					
					}
            	
    });
	
	var optionPK = $('.choose_BS_PK');
	optionPK.live('change',elgg.lichhenbacsi.chooseBacSi);
	
	var btnCTL = $('.btnCTL');						
	//btnCTL.live('click',elgg.lichhenbacsi.OnclickXemLich);
	
	$('#myDate').text(elgg.lichhenbacsi.ds_layNgayDuocChon());
	if (btnCTL.length>0) {
		elgg.lichhenbacsi.OnclickXemLich();
	}
	
	
};
elgg.lichhenbacsi.xoaSoDen = function(){
	var trParent = $(this).parents().eq(1);
	//alert(trParent.find(".tdPatient").attr('id'));
	elgg.action('lichhenbacsi/deleteSoDen', {
						data: {
								relationshipID: trParent.find(".tdPatient").attr('id')
							},
						success: function(json) {
							elgg.lichhenbacsi.OnclickXemLich();
						}});
}

elgg.lichhenbacsi.addLichHen = function(patientID, stt){
	/* input cho addLichHen:
			groupID
			doctorName //null 'la chinh minh'
			patientID //Tên bệnh nhân
			statusLich //null la khong co
			stt
			date //chuỗi dạng: 16-1-2014
	*/
	var day = elgg.lichhenbacsi.ds_layNgayDuocChon();
	var phongKhamID = $('#inpPhongkham').attr('placeholder');
	//get doctorName
	var doctorName = null; 
	
	//Status Lich mac dinh la chotLich
	var statusLich = 'chotLich';
	elgg.action('lichhenbacsi/add', {
	data: {
		groupID: phongKhamID,
		patientID: patientID,
		statusLich: statusLich,
		stt: stt,
		isVangLai: 1, //1 vang lai, 0 binh thuong
		date: day		
	},
	success: function(json) {
		elgg.lichhenbacsi.OnclickXemLich();
	}
	});
	
	
}

elgg.lichhenbacsi.chooseBacSi = function(e) {

	var groupID = $(this).val();
	var listBacsi = $(this).siblings("select[name=doctorName]");
	
	//alert (groupID);
	
	elgg.action('lichhenbacsi/getListBacSi', {
	data: {
		groupID: groupID
	},
	success: function(json) {

		listBacsi.empty();
		
		listBacsi.append(json.output);
		
	}
	});

	e.preventDefault();

}
elgg.lichhenbacsi.ds_layNgayDuocChon = function() {
	var m = $('.chonThang').html();
	if (m)
	{
	var result = ($('.chonNgay').html() +'-'+ m.substring(m.indexOf(' ') + 1) + '-' + $('.chonNam').html());
	return result;
	}
	
}
elgg.lichhenbacsi.chonNgay = function (date) {
	var phongKhamID = $('#inpPhongkham').attr('placeholder');
	elgg.lichhenbacsi.xemchitietlich(date,phongKhamID);
}
elgg.lichhenbacsi.OnclickXemLich = function(e) {
	//Lấy ngày đã được đánh dấu trên lịch
	
	var preDate = elgg.lichhenbacsi.ds_layNgayDuocChon();
	
	//Lấy phòng khám ID vừa được chọn
	var phongKhamID = $('#inpPhongkham').attr('placeholder');
	xemThongBao(phongKhamID,preDate);
	elgg.lichhenbacsi.xemchitietlich(preDate,phongKhamID);
	//$('.btnCTL').empty();
	$('.btnCTL').html('<a href="'+elgg.config.wwwroot+'groups/profile/'+phongKhamID+'">Xem chi Tiết</a>');
	if (e) e.preventDefault();
}

elgg.lichhenbacsi.xemchitietlich = function (date, phongkhamID) {
	var divpanel = $('div[name=panelLich]');
	$('#imgLoading').show();
	elgg.action('lichhenbacsi/xemchitietlich', {
	data: {
		ngayGio: date,
		phongKhamID: phongkhamID
	},
	success: function(json) {
		divpanel.empty();
		divpanel.append(json.output);	
		$('#imgLoading').hide();
	}
	});
}

elgg.lichhenbacsi.addPress = function(){

            var parentAdd = $(this).parents().eq(1);
            parentAdd.find('td:not(:first-child)').remove();
            parentAdd.append('<td class="tdPatient">'+ $(this).val() + '</td>');
            parentAdd.append('<td class="tdDoctor"></td>');
            parentAdd.append('<td class="tdList" >'+
                                '<div class="navbar navbar-default ">'+
                                    '<button type="button" class="btn btn-navbar sltPhongkham df_bg2"  data-toggle="collapse" data-target=".toggleTable5">'+
                                        '<span class="caret"></span>'+
                                        
                                    '</button>'+
                                    
                                    '<div class="nav-collapse collapse toggleTable5" >'+
                                        '<ul id="" class="nav navMidsbs">'+
                                            '<li class="df_bg4 " name="cl"><a href="" data-toggle="modal">Chốt lịch</a></li>'+
                                            '<li class="df_bg4 " name="hl"><a href="" data-toggle="modal">Hẹn lại</a></li>'+
                                            '<li class="df_bg4 " name="dk"><a href="" data-toggle="modal">Đã khám</a></li>'+
                                            '<li class="df_bg4 " name="tc"><a href="" data-toggle="modal">Từ chối</a></li>'+
                                            '<li class="df_bg4 " name="xo"><a href="" data-toggle="modal">Xóa</a></li>'+
                                        '</ul>'+
                                    '</div>'+ 
                                '</div>'+
                            '</td>');

    	};
		
elgg.lichhenbacsi.updateLich = function(e) {
	var lstParent = $(this).parent();
        var nameElm = $(this).attr('name');
		var idElm = $(this).attr('id');
        var parLevel = $(this).parents().eq(4); //tr level
        if (($(this).attr('disabled') != null) || (idElm == 'xong')) {
            return;
        }
        switch (nameElm)
        {   
            case 'cl':
			elgg.action('lichhenbacsi/updateLichStatus', {
						data: {
								lichID: lstParent.attr('id'),
								lichStatus: $(this).attr('id')
							},
						success: function(json) {
							elgg.lichhenbacsi.OnclickXemLich();
						}
			});
                break;
            case 'hl':
			elgg.action('lichhenbacsi/updateLichStatus', {
						data: {
								lichID: lstParent.attr('id'),
								lichStatus: $(this).attr('id')
							},
						success: function(json) {
							elgg.lichhenbacsi.OnclickXemLich();
						}
			});
                break;
            case 'sd':
			var benhNhanID = parLevel.find('.tdPatient').attr('id');
			var phongKhamID = $('#inpPhongkham').attr('placeholder');
			var lichID = $(this).parent().attr('id');
			elgg.action('lichhenbacsi/addSoDen', {
						data: {
								benhNhanID: benhNhanID,
								phongKhamID: phongKhamID
							},
						success: function(json) {
							
							elgg.action('lichhenbacsi/delete', {
										data: {
												lichID: lichID
											},
										success: function(json) {
												elgg.lichhenbacsi.OnclickXemLich();
											}
							});
						}
			});
                break;
            case 'xo':
				var lichID = $(this).parent().attr('id');
				elgg.action('lichhenbacsi/delete', {
						data: {
								lichID: lichID
							},
						success: function(json) {
							elgg.lichhenbacsi.OnclickXemLich();
						}
			});
               
                break;
            default:
            
        }
	e.preventDefault();
}
elgg.lichhenbacsi.keepActivePanel = function() {
	var activePanel = $('#lstMyCalendar .active');
	switch (activePanel.attr('id'))
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
}

elgg.register_hook_handler('init', 'system', elgg.lichhenbacsi.init);