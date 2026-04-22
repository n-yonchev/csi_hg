{*----
bastat==={$BASESTATUS}flagstat={$FLAGYESSTAT}
----*}
				{if isset($BASESTATUS) and $BASESTATUS<>""}
<div class="red7div">
ВНИМАНИЕ.
<br>
В основните данни на това дело има непопълнени ЗАДЪЛЖИТЕЛНИ полета.
<br>
		{if $BASESTATUS==""}
		{elseif $BASESTATUS=="0"}
Поради изчерпване на лимита
НЯМАТЕ ДОСТЪП ЗА КОРЕКЦИЯ НА ДАННИТЕ ПО ДЕЛОТО.
		{elseif $BASESTATUS=="1"}
Това отваряне е ПОСЛЕДНАТА ВЪЗМОЖНОСТ да попълните тези данни
преди достъпа Ви до делото да бъде ПРЕКРАТЕН.
		{else}
Имате право да отваряте това дело още <font size=+1> {$BASESTATUS} </font> пъти.
<br>
Ако след това задължителните полета все още са непопълнени,
достъпа Ви до делото ще бъде ПРЕКРАТЕН.
		{/if}
</div>
				{else}
				{/if}

{if $EPEP_LINK}
	<div style="color: white; background-color: #2b02a6; padding: 5px 10px; font-size: 14px; font-weight: bold; margin: 5px 0;">
		Делото е свързано с ел. партида!
	</div>
{/if}
