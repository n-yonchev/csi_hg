		{if empty($RODATA)}
<h3><center>няма грешки</center></h3>
		{else}
<br>
<u>грешки от {$RODATA.time|date_format:"%d.%m.%Y %H:%M:%S"} &nbsp;&nbsp;[{$RODATA.idreg4}] </u>
{foreach from=$ARTEXT item=elem}
<br>
<nobr>{$elem[0]}</nobr>
			{if empty($elem[1])}
			{else}
<br>
<span style="font:normal 8pt courier;color:blue">{$elem[1]}</span>
			{/if}
{/foreach}
		{/if}
				{if $RODATA.idbegitoserv==0}
				{else}
<br>
<font color=red>
последно данните са предадени на сървъра на {$RODATA.timebegitoserv|date_format:"%d.%m.%Y %H:%M:%S"} [id={$RODATA.idbegitoserv}]
<br>
но още не е получен отговор
</font>
				{/if}
<br>&nbsp;
