{*----------
17.06.2009 - за финансиста - заради насочване на постъпление към дело 
----------*}
	{if isset($DATADIRE)}
<table align=center>
<tr><td style="background-color:moccasin; font: normal 8pt verdana; padding: 10px;">
насочване към дело на постъпление <b>{$DATADIRE.rofina.inco}
<br>
{$DATADIRE.rofina.descrip}</b>
<br>
		{if isset($DATADIRECASE)}
<a style="font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer"
{include file="_href.tpl" LINK=$DATADIRE.oklink}> насочи към текущото дело
</a>
&nbsp;&nbsp;
		{else}
		{/if}
<a style="font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer"
{include file="_href.tpl" LINK=$DATADIRE.exitlink}> прекрати
</a>
</table>
	{else}
	{/if}
