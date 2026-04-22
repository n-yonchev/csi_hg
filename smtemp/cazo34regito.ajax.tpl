{include file="_ajax.header.tpl"}
{include file='_window.header.tpl' TITLE="предаване към регистъра" WIDTH=400}
{include file="_erform.tpl"}

		{if isset($MESS)}
<h3>{$MESS}</h3>
			{if isset($ERCONT)}
{$ERCONT}
			{else}
				{if isset($ISALER)}
<center>
има грешки в данните
</center>
<br>
<br>
{$FICONT}
				{else}
<center>
данните са предадени успешно
</center>
<br>
<a style="font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer" 
onclick="$('#ficont').show();resizeNyroModalIframe();return false;">пълния протокол</a>
<br>
<br>
<div id="ficont" style="display:none">{$FICONT}</div>
				{/if}
<br>
<br>
			{/if}
		{else}
<br>
<center>
очакване на отговор ...
</center>
<br>
		{/if}

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
