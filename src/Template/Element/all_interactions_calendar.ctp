<?php
	$events = [];
	$i = 0;
	foreach ($interactions as $key => $interaction) {
		$length     = $interaction->length;
		$start_date = $interaction->start_date->format('Y-m-d H:i:s');
		$end_date   = $interaction->start_date->modify("+1 hours");
		$events[$i] = [
			'title' => $interaction->interaction_type->name,
			'start' => $start_date,
			'end'   => $end_date,
			'editable' => false,
		];
		$i++;
	}
?>
<style type="text/css">
	.fc-toolbar {
		text-transform: capitalize;
	}
</style>
<script type="text/javascript">
	$(document).ready(function() {		
		$('#calendar').fullCalendar({
			lang: 'es',
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},
			navLinks: true,
			editable: false,
			eventLimit: true,
			events: <?= json_encode($events) ?>
		});
	});
</script>
<div id='calendar'></div>