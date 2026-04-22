{***
		$ISTTIP 
***}
<style>
.he7 {ldelim}font: normal 7pt verdana !important; background-color:silver !important; padding-left:4px;{rdelim}
.ro7 {ldelim}font: normal 7pt verdana !important; border-bottom: 1px solid black !important;{rdelim}
.ertype {ldelim}background-color:lightsalmon;cursor:help;{rdelim}
</style>
			{if $ISTTIP}
<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script>
$(document).ready(function() {ldelim}
	$('.deliinfo').cluetip({ldelim} width: 660, cursor:'help' {rdelim});
{rdelim});
</script>
			{else}
			{/if}
