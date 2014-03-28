<?php 
	echo elgg_view('page/elements/header'); 
	
	$url = elgg_get_site_url();

	$id = elgg_get_logged_in_user_guid();
	
?>


<?php
	echo elgg_view('lichhenbacsi/submenu');
?>
	<div class="row" style="clear:both; margin-top:10px;">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<div class="row">
				<div class="col-md-8">
					<?php echo elgg_view('lichhenbacsi/chitietlichhen') ?>
				</div>
				<div class="col-md-4">
					<?php echo elgg_view('lichhenbacsi/lich') ?>
					<?php echo elgg_view('lichhenbacsi/thongbaobenhnhan') ?>
				</div>
			</div>
		</div>
		<div class="col-md-1"></div>
	</div>
<?php 
	echo elgg_view('page/elements/footer'); 
?>  

