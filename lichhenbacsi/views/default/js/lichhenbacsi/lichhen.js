function LoadDanhSach(){
	alert("LoadDanhSach()");
	$(".loading").show();
}
function CapNhatDanhSachChoKham(){
	var idsInOrder = $("#sortable").sortable("toArray");
	alert(idsInOrder + "; CapNhatDanhSachChoKham()");	
}
function XemSoDen(){
	alert("XemSoDen()");	
}
function SearchHenTruoc(){
	alert("SearchHenTruoc()");
}
function DangThongBao(){
	alert("DangThongBao()");
}
function ThemBenhNhanChoKham(v){
	alert("ThemBenhNhanChoKham("+v+")");	
}
function ThemBenhNhanHenTruoc(){
	alert("ThemBenhNhanHenTruoc()");		
}
function Next(){ alert("Next()"); }
function Pause(){ alert("Pause()"); }
function Delete(){ alert("Delete()"); }
function BlackList(){ alert("BlackList()"); }

$(document).ready(function(){
	$(".dropdown-menu a").click(function(){
			$(this).parent().parent().parent().children('a').html($(this).html());
			//alert($(this).attr("link"));
			
	});			   
	$(".list-phongkham a").click(function(){
		$("#btnChiTietPK").attr("href",$(this).attr("data-link"));
		LoadDanhSach();
	});
	
	$(".list-bacsi a").click(function(){
		$("#btnChiTietBS").attr("href",$(this).attr("data-link"));
	});
	
	$("#sortable").sortable({
			connectWith: ".connectedSortable"
	}).disableSelection();
	$("#sortable").sortable( "disable" );
	
	$(".btnSort").click(function(){
		$("#sortable").sortable( "enable" );	
		$(".btnUpdateSort").show();
		$(this).hide();
		$("#sortable .row").css("cursor","move");
	});
	
	$(".btnUpdateSort").click(function(){
		CapNhatDanhSachChoKham();							   	
		$(".btnSort").show();
		$(this).hide();
		$("#sortable").sortable( "disable" );
		$("#sortable .row").css("cursor","auto");
	});
	
	$(".lstHentruoc .ic-pause").click(function(){
		$(this).toggleClass("click");
		//$(".lstHentruoc .row").removeClass("active");
		$(this).parent().parent().toggleClass("active");
	});
	$(".txtThemBN").keyup(function(e) {
		v = $(this).val();								 
		if (e.which == 13) {
			ThemBenhNhanChoKham(v);
			e.preventDefault();
		}
	});
});