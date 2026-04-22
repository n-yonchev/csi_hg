{*----
	източник : case.tpl 
----*}
							{if $FLAGARCHIVE}
<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script>
$(document).ready(function() {ldelim}
	$('.arch').cluetip({ldelim} width: 300, local:true, cursor:'pointer' {rdelim});
{rdelim});
</script>
							{else}
							{/if}
