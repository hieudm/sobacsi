<?php 
echo elgg_view('page/elements/header'); 
$messages = elgg_view('page/elements/messages', array('object' => $vars['sysmessages']));
?> 	<div class="elgg-page-messages">
		<?php echo $messages; ?>
	</div>
<?php	

echo elgg_view_form('lichhenbacsi/add');

echo elgg_view('page/elements/footer');

