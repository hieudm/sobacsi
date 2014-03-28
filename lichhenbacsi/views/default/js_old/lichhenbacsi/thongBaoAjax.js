$('#resetThongBao').click(function() {
	$('#thongBaoText').val('');
});

$('#submitThongBao').click(function(){
var phongKhamID = $('#inpPhongkham').attr('placeholder');
var day = elgg.lichhenbacsi.ds_layNgayDuocChon();
elgg.action('lichhenbacsi/taoThongBao', {
	data: {
		phongKhamID: phongKhamID,
		thongBaoText: $('#thongBaoText').val()		
	},
	success: function(json) {
		$('#thongBaoText').val('');
		xemThongBao(phongKhamID,day);
	}
	});

});
function xoaThongBao(thongBaoID) {
var phongKhamID = $('#inpPhongkham').attr('placeholder');
var day = elgg.lichhenbacsi.ds_layNgayDuocChon();
elgg.action('lichhenbacsi/xoaThongBao', {
	data: {
		thongBaoID: thongBaoID	
	},
	success: function(json) {
		xemThongBao(phongKhamID,day);
	}
	});
};

function xemThongBao(phongKhamID,ngayGio) {
var divpanel =$('#thongBaoList');
elgg.action('lichhenbacsi/xemThongBao', {
	data: {
		phongKhamID: phongKhamID,
		ngayGio: ngayGio	
	},
	success: function(json) {
		divpanel.empty();
		divpanel.append(json.output);
	}
	});
}
