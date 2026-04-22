{*
	$FIELD - входното поле
*}
<link rel="stylesheet" type="text/css" media="all" href="jscalendar/calendar-win2k-1.css" />
<script type="text/javascript" src="jscalendar/calendar.js"></script>
<script type="text/javascript" src="jscalendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="jscalendar/calendar-setup.js"></script>
<script>
Calendar.setup({ldelim}
	inputField   : '{$FIELD}', 
	ifFormat     : '%Y-%m-%d',
	firstDay     : 1,
	weekNumbers  : false
//	ifFormat     : '%Y-%m-%d',
//	timeFormat   : '24',
//	position  : [20, 100]   
{rdelim});
</script>
