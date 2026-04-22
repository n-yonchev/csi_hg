{*
<br> &nbsp;
<center>
			{if $ISEND}
<b>ондцнрнбйюрю опхйкчвх</b>
			{else}
				{if isset($GROU)}
<b>ярзойю {$STEP} цпсою {$GROU}</b>
<script>
document.location.href="{$URLNEXTGROU}";
</script>
				{else}
<b>ярзойю {$STEP}</b>
<script>
document.location.href="{$URLNEXTSTEP}";
</script>
				{/if}
			{/if}
</center>
<br> &nbsp;
*}

<style>
.mark {ldelim}font: bold 14pt verdana;{rdelim}
</style>
<br>
<center>
			{if $NODISPLAY}
<b>ОНВЮЙЮИ......</b>
			{else}
				{if $ISEND}
<b>ондцнрнбйюрю опхйкчвх</b>
				{else}
					{if isset($GROU)}
ярзойю <span class="mark">{$STEP}</span>&nbsp;&nbsp;&nbsp; цпсою <span class="mark">{$GROU}</span>
					{else}
ярзойю <span class="mark">{$STEP}</span>
					{/if}
				{/if}
			{/if}
</center>
<br> &nbsp;
				{if !$ISEND and isset($NEXTURL)}
<script>
document.location.href="{$NEXTURL}";
</script>
				{else}
				{/if}
	