var ds_i_date = new Date();
ds_c_month = ds_i_date.getMonth() + 1;
ds_c_year = ds_i_date.getFullYear();

// Get Element By Id
function ds_getel(id) {
	return document.getElementById(id);
}

// Get the left and the top of the element.
function ds_getleft(el) {
	// var tmp = el.offsetLeft;
	// el = el.offsetParent
	// while(el) {
	// 	tmp += el.offsetLeft;
	// 	el = el.offsetParent;
	// }
	// return tmp;
}
function ds_gettop(el) {
	// var tmp = el.offsetTop;
	// el = el.offsetParent
	// while(el) {
	// 	tmp += el.offsetTop;
	// 	el = el.offsetParent;
	// }
	// return tmp;
}

// Output Element
var ds_oe = ds_getel('ds_calclass');
// Container
var ds_ce = ds_getel('ds_conclass');

// Output Buffering
var ds_ob = ''; 
function ds_ob_clean() {
	ds_ob = '';
}
function ds_ob_flush() {
	ds_oe.innerHTML = ds_ob;
	ds_ob_clean();
}
function ds_echo(t) {
	ds_ob += t;
}

var ds_element; // Text Element...

var ds_monthnames = [
'THÁNG 1', 'THÁNG 2', 'THÁNG 3', 'THÁNG 4', 'THÁNG 5', 'THÁNG 6',
'THÁNG 7', 'THÁNG 8', 'THÁNG 9', 'THÁNG 10', 'THÁNG 11', 'THÁNG 12'
]; // You can translate it for your language.

var ds_daynames = [
 'CN','T2', 'T3', 'T4', 'T5', 'T6', 'T7'
]; // You can translate it for your language.

// Calendar template
function ds_template_main_above(m,y) {
	return '<table cellpadding="0" cellspacing="0" class="ds_tbl">'
	   	 + '<tr class="df_bg5">'
		 + '<td class="dong1_cot1 icon_imagesY" style="cursor: pointer" onclick="ds_py();">  </td>'
		 + '<td colspan="5" class="dong1_cot3 chonNam">'+y+'</td>'
		 + '<td class="dong1_cot5 icon_imagesY" style="cursor: pointer" onclick="ds_ny();">  </td>'
		 + '</tr>'
	     + '<tr class="df_bg2">'
		 + '<td class="dong1_cot2 icon_imagesY" style="cursor: pointer" onclick="ds_pm();">  </td>'
		 + '<td colspan="5" class="dong2_cot3 chonThang">' + m +'</td>'
		 + '<td class="dong1_cot4 icon_imagesY" style="cursor: pointer" onclick="ds_nm();">  </td>'
		 + '</tr>'
		 + '<tr>';
}

function ds_template_day_row(t) {

	return '<td class="ds_subhead df_bg1">' + t + '</td>';
	// Define width in CSS, XHTML 1.0 Strict doesn't have width property for it.
}

function ds_template_new_week() {
	return '</tr><tr>';
}

function ds_template_blank_cell(colspan) {
	return '<td class="cspnone" colspan="' + colspan + '"></td>';
}
function ds_chonNgay(e){	
	//Đổi background của ngày được chọn trước đó
	var preDate = $('.chonNgay');
	preDate.removeClass("df_bg2 chonNgay");
	preDate.css("color", "");
	
	$(e).addClass("df_bg2 chonNgay");
	$(e).css("color", "#fff");
	
	//Lấy thông tin ngày đã chọn:
	var monthPos = ds_monthnames[0].indexOf(' ') + 1;
	var date = $(e).html() +'-'+ $('.chonThang').html().substring(monthPos) + '-' + $('.chonNam').html();
	$('#myDate').text(date);
	elgg.lichhenbacsi.chonNgay (date);
	
}

function ds_template_day(d,m,y) {
	var currDate = new Date();
	var currMonth = currDate.getMonth();
	var currYear = currDate.getFullYear();
	var currDay = currDate.getUTCDate();
	var cell = null;
	if(currMonth == (m-1) && currDay == d && currYear == y)
		cell = '<td class="ds_cell df_bg2 chonNgay" onclick="ds_chonNgay(this);" style="color: #fff;">';
	else cell = '<td class="ds_cell" onclick="ds_chonNgay(this);" >';
	var output = cell +d+'</td>';
	return  output;
	// Define width the day row.
}

function ds_template_main_below() {
	return '</tr>'
	     + '</table>';
}

// This one draws calendar...
function ds_draw_calendar(m, y) {
	// First clean the output buffer.
	ds_ob_clean();
	// Here we go, do the header
	ds_echo (ds_template_main_above(ds_monthnames[m - 1] , y));
	for (i = 0; i < 7; i ++) {
		ds_echo (ds_template_day_row(ds_daynames[i]));
	}
	// Make a date object.
	var ds_dc_date = new Date();
	ds_dc_date.setMonth(m - 1);
	ds_dc_date.setFullYear(y);
	ds_dc_date.setDate(1);
	if (m == 1 || m == 3 || m == 5 || m == 7 || m == 8 || m == 10 || m == 12) {
		days = 31;
	} else if (m == 4 || m == 6 || m == 9 || m == 11) {
		days = 30;
	} else {
		days = (y % 4 == 0) ? 29 : 28;
	}
	var first_day = ds_dc_date.getDay();
	var first_loop = 1;
	// Start the first week
	ds_echo (ds_template_new_week());
	// If sunday is not the first day of the month, make a blank cell...
	if (first_day != 0) {
		ds_echo (ds_template_blank_cell(first_day));
	}
	var j = first_day;
	for (i = 0; i < days; i ++) {
		// Today is sunday, make a new week.
		// If this sunday is the first day of the month,
		// we've made a new row for you already.
		if (j == 0 && !first_loop) {
			// New week!!
			ds_echo (ds_template_new_week());
		}
		// Make a row of that day!
		ds_echo (ds_template_day(i + 1, m, y));
		// This is not first loop anymore...
		first_loop = 0;
		// What is the next day?
		j ++;
		j %= 7;
	}
	// Do the footer
	ds_echo (ds_template_main_below());
	// And let's display..
	ds_ob_flush();
	// Scroll it into view.
	//ds_ce.scrollIntoView();
}

// A function to show the calendar.
// When user click on the date, it will set the content of t.
function ds_sh(t) {
	// Set the element to set...
	ds_element = t;
	// Make a new date, and set the current month and year.
	var ds_sh_date = new Date();
	ds_c_month = ds_sh_date.getMonth() + 1;
	ds_c_year = ds_sh_date.getFullYear();
	// Draw the calendar
	ds_draw_calendar(ds_c_month, ds_c_year);
	// To change the position properly, we must show it first.
	ds_ce.style.display = '';
	// Move the calendar container!
	the_left = ds_getleft(t);
	//the_top = ds_gettop(t) + t.offsetHeight;
	ds_ce.style.left = the_left + 'px';
	//ds_ce.style.top = the_top + 'px';
	// Scroll it into view.
	ds_ce.scrollIntoView();
}

// Hide the calendar.
function ds_hi() {
	ds_ce.style.display = 'none';
}

// Moves to the next month...
function ds_nm() {
	// Increase the current month.
	ds_c_month ++;
	// We have passed December, let's go to the next year.
	// Increase the current year, and set the current month to January.
	if (ds_c_month > 12) {
		ds_c_month = 1; 
		ds_c_year++;
	}
	// Redraw the calendar.
	ds_draw_calendar(ds_c_month, ds_c_year);
}

// Moves to the previous month...
function ds_pm() {
	ds_c_month = ds_c_month - 1; // Can't use dash-dash here, it will make the page invalid.
	// We have passed January, let's go back to the previous year.
	// Decrease the current year, and set the current month to December.
	if (ds_c_month < 1) {
		ds_c_month = 12; 
		ds_c_year = ds_c_year - 1; // Can't use dash-dash here, it will make the page invalid.
	}
	// Redraw the calendar.
	ds_draw_calendar(ds_c_month, ds_c_year);
}

// Moves to the next year...
function ds_ny() {
	// Increase the current year.
	ds_c_year++;
	// Redraw the calendar.
	ds_draw_calendar(ds_c_month, ds_c_year);
}

// Moves to the previous year...
function ds_py() {
	// Decrease the current year.
	ds_c_year = ds_c_year - 1; // Can't use dash-dash here, it will make the page invalid.
	// Redraw the calendar.
	ds_draw_calendar(ds_c_month, ds_c_year);
}

// Format the date to output.
function ds_format_date(d, m, y) {
	// 2 digits month.
	m2 = '00' + m;
	m2 = m2.substr(m2.length - 2);
	// 2 digits day.
	d2 = '00' + d;
	d2 = d2.substr(d2.length - 2);
	// YYYY-MM-DD
	return y + '-' + m2 + '-' + d2;
}

// When the user clicks the day.
function ds_onclick(d, m, y) {
	// Hide the calendar.
	
	ds_hi();
	// Set the value of it, if we can.
	if (typeof(ds_element.value) != 'undefined') {
		ds_element.value = ds_format_date(d, m, y);
	// Maybe we want to set the HTML in it.
	} else if (typeof(ds_element.innerHTML) != 'undefined') {
		ds_element.innerHTML = ds_format_date(d, m, y);
	// I don't know how should we display it, just alert it to user.
	} else {
		alert (ds_format_date(d, m, y));
	}
}

// And here is the end.
