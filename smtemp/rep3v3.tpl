{***
					{if $NOSESS}
<span style="font: normal 10pt verdana;color:red;"> не е извършена настройка </span>
					{else}
<span style="font: normal 10pt verdana;"> извеждане в Excel </span>
<script>
$(document).ready(function() {ldelim}
	document.getElementById("frarep").focus();
	document.getElementById("frarep").src= "{$URLCREATE}";
{rdelim});
</script>
					{/if}
***}

					{if $NOSESS}
<span style="font: normal 10pt verdana;color:red;"> не са изведени отчетите за раздел 1 и раздел 2 </span>
					{else}
<span style="font: normal 10pt verdana;"> <center>ПОЧАКАЙ ИЗВЕЖДАНЕТО ... </center></span>
					{/if}
