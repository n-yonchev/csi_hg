{include file="_ajax.header.tpl"}

{include file='_window.header.tpl' TITLE="" }

{include file="_erform.tpl"}

<font size=+5> {$PERC} % </font>
<br>
<br>

{if isset($LINKNEXT)}
<script>
window.location.href="{$LINKNEXT}";
</script>
{else}
{/if}

{if isset($LINKCLOS)}
	<a class="submit" href="{$LINKCLOS}"> затвори </a>
{else}
{/if}


{include file='_window.footer.tpl'}

{include file="_ajax.footer.tpl"}
